<?php
/**
 * Created by PhpStorm.
 * User: IROKO ISAIAH
 * Date: 2/16/2017
 * Time: 8:14 PM
 */

namespace Springbuck\LaravelCoinhive\Services;

use GuzzleHttp\Client;

class HTTPClient extends Client
{
    protected $basePath = '';
    protected $timeout = '';
    
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const PATCH = 'PATCH';
    const OPTIONS = 'OPTIONS';
    const HEAD = 'HEAD';
    const DELETE = 'DELETE';

    public function __construct(){
        //make provision for long running task,
        //to prevent PHP from timing out
        ini_set('max_execution_time', '360000');

        parent::__construct([
            // 'headers' => $this->tweakedHeaders(),
            'verify' => false,
            'allow_redirects' => true,
            'cookies' => true,
            'curl' => [
                CURLOPT_SSLVERSION => CURL_SSLVERSION_DEFAULT,
            ]
        ]);

    }

    public function setTimeout($timeout = '2.0')
    {
        $this->timeout = $timeout;
    }
    
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }

    protected function tweakedHeaders(){
        return [
            'User-Agent' => array_rand([
                'Mozilla/5.0 (Linux; Android 6.0.1; SM-G920V Build/MMB29K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Microsoft; Lumia 950) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
                'Mozilla/5.0 (Linux; Android 6.0.1; Nexus 6P Build/MMB29P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
                'Mozilla/5.0 (Linux; Android 6.0.1; E6653 Build/32.2.A.0.253) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'Mozilla/5.0 (Linux; Android 6.0; HTC One M9 Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'Mozilla/5.0 (Linux; Android 5.1.1; SHIELD Tablet Build/LMY48C) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Safari/537.36',
                'Mozilla/5.0 (Linux; Android 4.4.3; KFTHWI Build/KTU84M) AppleWebKit/537.36 (KHTML, like Gecko) Silk/47.1.79 like Chrome/47.0.2526.80 Safari/537.36',
                'Mozilla/5.0 (Linux; Android 5.0.2; LG-V410/V41020c Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/34.0.1847.118 Safari/537.36',
                'Mozilla/5.0 (CrKey armv7l 1.5.16041) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.0 Safari/537.36',
                'Mozilla/5.0 (Linux; U; Android 4.2.2; he-il; NEO-X5-116A Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
                'Mozilla/5.0 (Linux; Android 4.2.2; AFTB Build/JDQ39) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.173 Mobile Safari/537.22',
                'Dalvik/2.1.0 (Linux; U; Android 6.0.1; Nexus Player Build/MMB29T)',
                'AppleTV5,3/9.1.1',
                'Mozilla/5.0 (Nintendo WiiU) AppleWebKit/536.30 (KHTML, like Gecko) NX/3.0.4.2.12 NintendoBrowser/4.3.1.11264.US',
                'Mozilla/5.0 (Windows Phone 10.0; Android 4.2.1; Xbox; Xbox One) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2486.0 Mobile Safari/537.36 Edge/13.10586',
                'Mozilla/5.0 (PlayStation 4 3.11) AppleWebKit/537.73 (KHTML, like Gecko)',
                'Mozilla/5.0 (PlayStation Vita 3.61) AppleWebKit/537.73 (KHTML, like Gecko) Silk/3.2',
                'Mozilla/5.0 (Nintendo 3DS; U; ; en) Version/1.7412.EU',
                'Mozilla/5.0 (X11; U; Linux armv7l like Android; en-us) AppleWebKit/531.2+ (KHTML, like Gecko) Version/5.0 Safari/533.2+ Kindle/3.0+',
                'Mozilla/5.0 (Linux; U; en-US) AppleWebKit/528.5+ (KHTML, like Gecko, Safari/528.5+) Version/4.0 Kindle/3.0 (screen 600x800; rotate)',
                'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246',
                'Mozilla/5.0 (X11; CrOS x86_64 8172.45.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.64 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/601.3.9 (KHTML, like Gecko) Version/9.0.2 Safari/601.3.9',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36',
                'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:15.0) Gecko/20100101 Firefox/15.0.1',
                'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)',
                'Mozilla/5.0 (compatible; bingbot/2.0; +http://www.bing.com/bingbot.htm)',
                'Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)'
            ]),
        ];
    }
    
    public function aGet($path, \Closure $onSuccess, \Closure $onFailure, $options = []){
        $this->aSyncRequest(self::GET, $path, $onSuccess, $onFailure, $options);
    }
    
    public function aPost($path, \Closure $onSuccess, \Closure $onFailure, $options = []){
        $this->aSyncRequest(self::POST, $path, $onSuccess, $onFailure, $options);
    }
    
    public function aPut($path, \Closure $onSuccess, \Closure $onFailure, $options = []){
        $this->aSyncRequest(self::PUT, $path, $onSuccess, $onFailure, $options);
    }
    
    public function aPatch($path, \Closure $onSuccess, \Closure $onFailure, $options = []){
        $this->aSyncRequest(self::PATCH, $path, $onSuccess, $onFailure, $options);
    }
    
    public function aDelete($path, \Closure $onSuccess, \Closure $onFailure, $options = []){
        $this->aSyncRequest(self::DELETE, $path, $onSuccess, $onFailure, $options);
    }
    
    public function aOptions($path, \Closure $onSuccess, \Closure $onFailure, $options = []){
        $this->aSyncRequest(self::OPTIONS, $path, $onSuccess, $onFailure, $options);
    }
    
    public function aHead($path, \Closure $onSuccess, \Closure $onFailure, $options = []){
        $this->aSyncRequest(self::AHEAD, $path, $onSuccess, $onFailure, $options);
    }
    
    public function get($path, $options = []){
        return $this->syncRequest(self::GET, $path, $options);
    }
    
    public function post($path, $options = []){
        return $this->syncRequest(self::GET, $path, $options);
    }
    
    public function put($path, $options = []){
        return $this->syncRequest(self::GET, $path, $options);
    }
    
    public function patch($path, $options = []){
        return $this->syncRequest(self::GET, $path, $options);
    }
    
    public function delete($path, $options = []){
        return $this->syncRequest(self::GET, $path, $options);
    }
    
    public function options($path, $options = []){
        return $this->syncRequest(self::GET, $path, $options);
    }

    public function head($path, $options = []){
        return $this->syncRequest(self::GET, $path, array_merge($options, [
            'base_uri' => $this->basePath,
            'timeout'  => $this->timeout,
        ]));
    }

    private function syncRequest($method, $path, $options = []){
        return $this->request($method, $path, array_merge($options, [
            'base_uri' => $this->basePath,
            'timeout'  => $this->timeout,
        ]));
    }
    
    private function aSyncRequest($method, $path, \Closure $onSuccess, \Closure $onFailure, $options = []){
        $promise = $this->requestAsync($method, $path, $options);
        $promise->then($onSuccess, $onFailure);
        $promise->wait();  
    }

}