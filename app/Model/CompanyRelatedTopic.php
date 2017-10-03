<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CompanyRelatedTopic extends Model
{
    protected $fillable = [
        'topicId',
        'companyId'
    ];
}

