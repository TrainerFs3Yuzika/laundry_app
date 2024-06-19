<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{
    protected $fillable = [
        'website_title',
        'website_description',
        'timezone',
        'language',
        'logo',
        'favicon',
        'tax'
    ];
}
