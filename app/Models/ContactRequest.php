<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactRequest extends Model
{
    public const STATUS_NEW = 'new';

    protected $fillable = [
        'name', 'email', 'phone', 'business_name', 'message',
        'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term',
        'referrer', 'landing_page',
    ];
}
