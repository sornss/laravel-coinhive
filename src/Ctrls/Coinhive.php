<?php

namespace Springbuck\LaravelCoinhive\Ctrls;

use Illuminate\Http\Request;
use Springbuck\LaravelCoinhive\Services\Token;
use Springbuck\LaravelCoinhive\Services\Links;
use Springbuck\LaravelCoinhive\Services\User;
use Springbuck\LaravelCoinhive\Services\Stats;

class CoinhiveCtrl
{
    protected $token, $links, $user, $stats;
    protected $header = [];
    
    public function __construct(Request $req, Token $token, Links $links, User $user, Stats $stats){
        $this->req = $req;
        $this->token = $token;
        $this->links = $links;
        $this->user = $user;
        $this->stats = $stats;
        $this->name = $this->req->input('name');
    }

    public function getMeta(){
        return $this->jsonify([
            'name' => 'Laravel Coinhive', 
            'version' => '0.0.0'
        ]);
    }
    
    public function postTokenVerify(){
        $token = $this->req->input('token');
        $hashes = $this->req->input('hashes');
        return $this->jsonify($this->token->verify($token, $hashes));
    }
    
    public function postLinksCreate(){
        $url = $this->req->input('url');
        $hashes = $this->req->input('hashes');
        return $this->jsonify($this->links->create($url, $hashes));
    }
    
    public function getUserBalance(){
        return $this->jsonify($this->user->setName($this->name)->balance());
    }
    
    public function postUserWithdraw(){
        $amount = $this->req->input('amount');
        return $this->jsonify($this->user->setName($this->name)->withdraw($amount));
    }
    
    public function getUserTop(){
        $count = $this->req->input('count');
        $order = $this->req->input('order');
        return $this->jsonify($this->user->setName($this->name)->top($count, $order));
    }
    
    public function getUserList(){
        $count = $this->req->input('count');
        $page = $this->req->input('page');
        return $this->jsonify($this->user->setName($this->name)->list($count, $page));
    }
    
    public function postUserReset(){
        return $this->jsonify($this->user->setName($this->name)->reset());
    }
    
    public function postUserResetAll(){
        return $this->jsonify($this->user->setName($this->name)->resetAll());
    }
    
    public function getStatsPayout(){
        return $this->jsonify($this->stats->payout());
    }
    
    public function getStatsSite(){
        return $this->jsonify($this->stats->site());
    }
    
    public function getStatsHistory(){
        $start = $this->req->input('start');
        $stop = $this->req->input('stop');
        return $this->jsonify($this->stats->history($start, $stop));
    }

    public function jsonify(array $data, $status = 200, $header = []){
        return response()->json($data, $status, array_merge($this->header, $header));
    }
}
