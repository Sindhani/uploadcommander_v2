<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faqs';

    protected $fillable = ['is_menu','support_bot_use','assignment','description', 'creater','content','is_active'];
}
