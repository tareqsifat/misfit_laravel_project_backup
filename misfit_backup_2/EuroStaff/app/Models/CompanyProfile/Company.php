<?php

namespace App\Models\CompanyProfile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public const NAME = 'name';
    public const PROFILE_DESCRIPTION = 'profile_description';
    public const BUSINESS_STREAM_ID = 'business_stream_id';
    public const ESTABLISHMENT_DATE = 'establishment_date';
    public const COMPANY_WEBSITE_URL = 'company_website_url';

    protected $fillable = [
        self::NAME,
        self::PROFILE_DESCRIPTION,
        self::BUSINESS_STREAM_ID,
        self::ESTABLISHMENT_DATE,
        self::COMPANY_WEBSITE_URL,
    ];
}
