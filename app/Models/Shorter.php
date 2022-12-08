<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shorter extends Model
{
    use HasFactory;
    protected $fillable = ['url_key','original_url','redirect_url','userMail', 'visitas'];
}
