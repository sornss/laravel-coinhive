<?php

namespace Springbuck\LaravelCoinhive\Services;

class Links extends Coinhive
{
    // Links
    // /link/create
    /**
     * URL: https://api.coinhive.com/link/create
     * Method: POST
     */
    public function createLink($url, $hashes)
    {
        return $this->response($this->http->post('/link/create', [
            'form_params' => [
                'secret' => $this->getSecret(),
                'url' => $url,
                'hashes' => $hashes
            ]
        ]));
    }

}
