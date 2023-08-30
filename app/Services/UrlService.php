<?php 

namespace App\Services;
use App\Models\Url;
use App\Http\Requests\ShortenUrlRequest;
use Illuminate\Http\Request;
use Illuminate\Models\User;

class UrlService
{

    public function addUrl(string $longUrl,string $domain,$user)
    {
        $url = new URL();

        $hash = $this->generateHash();

        $shortUrl = $_SERVER['HTTP_ORIGIN']."/view/$hash";

        $url->fill([
            'hash' => $hash,
            'shortUrl' => $shortUrl,
            'longUrl' => $longUrl,
            'domain' => $domain
        ]);

        if($user === null)
        {
            $url->save();
        }

        $user->links()->save($url);
        
        return $url;
    }

    // Verifier si le lien entré dans le formulaire exite bel et bien sur internet
    public function parseUrl($url): string|bool
    {
        $domain = parse_url($url, PHP_URL_HOST);

        if(!filter_var(gethostbyname($domain), FILTER_VALIDATE_IP))
        {
            return false;
        }

        return $domain;
    }

    // Génerer le hash
    public function generateHash(int $offset = 0, int $length =  8)
    {
       return substr(md5(uniqid(mt_rand(),true)),$offset,$length); 
    }
}


