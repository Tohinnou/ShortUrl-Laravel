<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShortenUrlRequest;
use App\Services\UrlService;
use App\Services\UrlStatisticService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ShortenController extends Controller
{
    public function __construct(UrlService $urlService,UrlStatisticService $urlStatisticService)
    {
        $this->urlService = $urlService;
        $this->urlStatisticService = $urlStatisticService;
    }

    public function add()
    {
        return view('welcome');
    }
    
    public function storeUrl(Request $request)
    {
        $longUrl = $request->input('url');
        $validator = Validator::make($request->all(),[
            'url' => 'required|max:255'
        ]);
        
        if($validator->fails())
        {
            return response()->json([
                'statusCode' => 400,
                'msg' => 'MISSING_ARG_URL'
            ])->header('Content-Type', 'application/json');
        }

        $user = $request->user();
       
        $domain = $this->urlService->parseUrl($longUrl);
          
        if(!$domain)
        {
            return response()->json([
                'statusCode' => 500,
                'msg' => 'INVALID_ARG_URL'
            ])->header('Content-Type', 'application/json');
        }

        $url = $this->urlService->addUrl($longUrl,$domain,$user ??= null);

        return response()->json([
            'shortUrl' => $url->shortUrl,
            'longUrl' => $url->longUrl,
            'user' => $user
        ])->header('Content-Type', 'application/json');

    }

    public function viewUrl($hash)
    {
        $url = Url::where('hash', $hash)->get();
        
        if(!$url)
        {
            return redirect()->route('home');
        }
      
        if(!$url[0]->user)
        {
            return redirect()->away($url->pluck('longUrl')[0]);
        }

        // Recuperer la date de click du lien
        $date = new \Datetime('now');
     
        $urlStatistic = $this->urlStatisticService->findOneByUrlAndDate($url, $date->format('Y-m-d'));
        
        $this->urlStatisticService->incrementUrlStatistic($urlStatistic->first());
     
        return redirect()->away($url->pluck('longUrl')[0]);
    }

    public function list(Request $request)
    {
        $user = $request->user();
       
        if(!$user)
        {
            return to_route('home');
        }

        $list = User::with('links')->orderBy('created_at', 'desc')->get();

        return view('home',[
            'links' => $list[0]->links,
        ]);
    }

    public function deleteUrl( $hash)
    {
       
        // $hash = $request->input('hash');
        
        $url = Url::where('hash', $hash)->get();
        
        if(!$url)
        {
            return response()->json([
                'statusCode' => 'URL_NOT_FOUND',
                'statusText' => "Ce lien n'existe pas"
            ])->header('Content-Type', 'application/json');
        }

        $url->first()->delete();

        return response()->json([
            'statusCode' => 'DELETE_SUCCESSFULLY',
            'statusText' => "L'url a été supprimè avec succès"
        ])->header('Content-Type', 'application/json');
    }

    public function statistics($hash)
    {
        $url = $this->urlStatisticService->findOneByUrl($hash);
        
        if(!$url)
        {
            return response()->json([
                'msg' => 'ECHEC',
            ])->header('Content-Type', 'application/json');

        }
       
        return response()->json([
            'msg' => 'SUCCESS',
            'data' => $this->urlStatisticService->chartData($this->urlStatisticService->findStatisticByUrl($url)),
        ])->header('Content-Type', 'application/json');

       
    }

    public function viewStatistics($hash)
    {
        $url = $this->urlStatisticService->findOneByUrl($hash);

        $data = $this->urlStatisticService->chartData($this->urlStatisticService->findStatisticByUrl($url));
    
        return view('url.statistic',[
            'data' => $data
        ]);
    }
}
