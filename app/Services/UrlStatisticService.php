<?php 

namespace App\Services;

use App\Models\Url;
use App\Http\Requests\ShortenUrlRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UrlStatistic; 

class UrlStatisticService
{
    public function findOneByUrlAndDate($url, $date)
    {
        $urlStatistic = UrlStatistic::where('url_id', $url->first()->id)->where('created_at','like', "{$date}%")->get();
    
        if(!$urlStatistic->first())
        {
            $urlStatistic = new UrlStatistic();
    
            $url->first()->statistics()->save($urlStatistic);
        }

        return $urlStatistic;
    }

    public function incrementUrlStatistic($urlStatistic)
    {
        $urlStatistic->clicks = $urlStatistic->getClicks() + 1;

        $urlStatistic->save();

        return $urlStatistic;
    }


    public function findOneByUrl($hash)
    {
        $url = Url::where('hash', $hash)->get();
        
        return $url;
    }

    public function findStatisticByUrl($url)
    {
         // On recupère une collection de statistique
        return  $url_statistics = $url->first()?->statistics;
 
    }
    public function chartData($statistics)
    {
        $data['labels'] = [];
        $data['dataset']['data'] = [];

        foreach ($statistics->toArray() as $key => $item)
        {
            $formatedDate = (new \DateTime($item['created_at']))->format('Y-m-d');

            array_push($data['labels'], $formatedDate);

            array_push($data['dataset']['data'], $item['clicks']);
        }

        return $data;
    }
}


