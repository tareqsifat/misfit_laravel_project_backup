<?php

namespace App\Models;

use App\Traits\GlobalStatus;
use Illuminate\Database\Eloquent\Model;

class CurrencyDataProvider extends Model
{
    use GlobalStatus;

    protected $guard = ['id'];

    protected $casts = [
        'configuration' => 'object',
    ];
}
