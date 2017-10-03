<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CompanyRelatedBlog extends Model
{
    protected $fillable = [
        'blogId',
        'companyId'
    ];
}
