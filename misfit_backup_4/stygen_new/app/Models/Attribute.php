<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function attributes_values(){
        // dd(Auth::guard('seller')->user());

        $companyId = Auth::guard('seller')->user()->company_id;
        return $this->hasMany(AttributeValue::class)->where('company_id', $companyId);
    }
}
