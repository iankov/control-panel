<?php

namespace Iankov\ControlPanel\Models;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $table = 'static_pages';
    protected $fillable = ['name', 'route', 'content', 'active'];

    public $timestamps = true;
}