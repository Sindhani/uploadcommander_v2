<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpDesk extends Model
{
    protected $table = 'helpdesk';

    protected $fillable = ['is_menu','linked_page','assignment','description',  'creater', 'content','is_active'];
}
