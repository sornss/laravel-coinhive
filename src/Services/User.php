<?php

namespace Springbuck\LaravelCoinhive\Services;

// Users
class User extends Coinhive
{
   
    protected $name;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    // /user/balance
    /**
     * URL: https://api.coinhive.com/user/balance
     * Method: GET
     */
    public function balance()
    {
        return $this->response($this->http->get('/user/balance', [
            'query' => [
                'secret' => $this->getSecret(),
                'name' => $this->name
            ]
        ]));
    }

    // /user/withdraw
    /**
     * URL: https://api.coinhive.com/user/withdraw
     * Method: POST
     */
    public function withdraw($amount)
    {
        return $this->response($this->http->post('/user/withdraw', [
            'form_params' => [
                'secret' => $this->getSecret(),
                'name' => $this->name,
                'amount' => $amount
            ]
        ]));
    }
    
    // /user/top
    /**
     * URL: https://api.coinhive.com/user/top
     * Method: GET
     */
    public function top($count = '128', $order = 'total')
    {
        return $this->response($this->http->get('/user/top'), [
            'query' => [
                'secret' => $this->getSecret(),
                'count' => $count,
                'order' => $order
            ]
        ]);
    }
    
    // /user/list
    /**
     * URL: https://api.coinhive.com/user/list
     * Method: GET
     */
    public function list($count = 4096, $page = '')
    {
        return $this->response($this->http->get('/user/list'), [
            'query' => [
                'secret' => $this->getSecret(),
                'count' => $count,
                'page' => $page
            ]
        ]);
    }
    
    // /user/reset
    /**
     * URL: https://api.coinhive.com/user/reset
     * Method: POST
     */
    public function reset()
    {
        return $this->response($this->http->post('/user/reset', [
            'form_params' => [
                'secret' => $this->getSecret(),
                'name' => $this->name,
            ]
        ]));
    }
    
    // /user/reset-all
    /**
     * URL: https://api.coinhive.com/user/reset-all
     * Method: POST
     */
    public function resetAll()
    {
        return $this->response($this->http->post('/user/reset-all', [
            'form_params' => [
                'secret' => $this->getSecret()
            ]
        ]));
    }
    
    
}
