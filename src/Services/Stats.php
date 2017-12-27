<?php

namespace Springbuck\LaravelCoinhive\Services;

// Stats
class Stats extends Coinhive
{
    // /stats/payout
    /**
     * URL: https://api.coinhive.com/stats/payout
     * Method: GET
     */
    public function payout()
    {
        return $this->response($this->http->get('/stats/payout', [
            'query' => [
                'secret' => $this->getSecret()
            ]
        ]));
    }
    
    // /stats/site
    /**
     * URL: https://api.coinhive.com/stats/site
     * Method: GET
     */
    public function site()
    {
        return $this->response($this->http->get('/stats/site', [
            'query' => [
                'secret' => $this->getSecret()
            ]
        ]));
    }
    
    // /stats/history
    /**
     * URL: https://api.coinhive.com/stats/history
     * Method: GET
     */
    public function history($start = null, $stop = null)
    {
        $start = (is_null($start)) ? (time() - (7*24*60*60)) : $start;
        $stop = (is_null($stop)) ? time() : $stop;
        
        return $this->response($this->http->get('/stats/history', [
            'query' => [
                'secret' => $this->getSecret(),
                'begin' => $start,
                'end' => $stop
            ]
        ]));
    }
    

}
