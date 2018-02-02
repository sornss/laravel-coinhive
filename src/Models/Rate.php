<?php

namespace Springbuck\LaravelCoinhive\Models;

use Springbuck\LaravelFoundation\Models\BaseModel as Model;

class Rate extends Model
{
    public $rules = [
        'value' => 'required|numeric'
    ];

    public $updateRules = [
        'value' => 'required|numeric'
    ];

}
    