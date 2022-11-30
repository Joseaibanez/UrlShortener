<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shorter extends Model
{
    use HasFactory;
    protected $fillable = ['original_url','url_key','redirect_url','userId'];
}
