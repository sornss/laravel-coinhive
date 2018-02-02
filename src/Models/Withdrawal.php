<?php

namespace Springbuck\LaravelCoinhive\Models;

use Springbuck\LaravelFoundation\Models\BaseModel as Model;

class Withdrawal extends Model
{
    public $rules = [
        'user_id' => 'required|numeric',
        'coins' => 'required|numeric'
    ];

    public $updateRules = [
        'user_id' => 'required|numeric',
        'coins' => 'required|numeric'
    ];
}
