<?php

namespace Springbuck\LaravelCoinhive\Services;


class Token extends Coinhive
{
    // Tokens
    // /token/verify 
    /**
     * URL: https://api.coinhive.com/token/verify
        Method: POST
     */
    public function verify(string $token, int $hashes)
    {
        return $this->response($this->http->post('/token/verify', [
            'form_params' => [
                'secret' => $this->getSecret(),
                'token' => $url,
                'hashes' => $hashes
            ]
        ]));
    }

}
