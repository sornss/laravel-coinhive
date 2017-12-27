<?php

namespace Springbuck\LaravelCoinhive\Services;


class Coinhive
{
    protected $secret;
    
    protected $http;

    private $config = [];
    
    private $errors = [
        'invalid_secret' => 'The secret provided as GET or POST parameter is invalid.',
        'bad_request' => 'A malformed request was received. ',
        'wrong_method' => 'The API expected a POST request but a GET request was performed. ',
        'not_found' => 'The API endpoint could not be found. Check the URL for your API call. ',
        'internal_error' => 'Something bad happened on our side. Contact us if the issue persists. ',
        
        'missing_input' => 'No name provided as GET parameter',
        'unknown_user' => 'The user name is not known (has never connected to the pool). ',
        
        'missing_input' => 'No name or amount provided as POST parameters. ',
        'unknown_user' => 'The user name is not known (has never connected to the pool). ',
        'invalid_amount' => 'The specified amount to withdraw is invalid (e.g. negative). ',
        'insufficent_funds' => 'The user doesn\'t have enough hashes to withdraw the specified amount. ',
        
        'invalid_page' => 'The page of users could not be found.',
        
        'missing_input' => 'No name provided as POST parameter',
        
        'missing_input' => 'No url or hashes provided as POST parameters.',
        'invalid_url' => 'The provided target URL is not a valid http:// or https:// URL. ',
        '' => '',
    ];
    
    public function __construct(HTTPClient $http){
        //initialise and configure key variables
        $this->http = $http;
        $this->http->setBasePath('https://api.coinhive.com');
        $this->http->setTimeout('3.0');
        $this->secret = config('coinhive.secret');
    }

    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    public function getSecret()
    {
        return $this->secret;
    }

    public function response($response)
    {
        return [
            'status_code' => $response->getStatusCode(),
            'content_type' => $response->getHeader('content-type'),
            'body' => $this->parseBody((string) $response->getBody())
        ];
    }

    public function parseBody($body)
    {
        //ensure json data
        $body = json_decode($body);

        //check for error
        //$body['status'] 
        return (true) ? [
            'original' => $body
        ] : [
            'error' => $body['error'],
            'error_desc' => $this->errors[$body['error']],
            'original' => $body
        ];
    }
}
