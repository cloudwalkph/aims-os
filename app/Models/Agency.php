<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agency extends Model
{
    use SoftDeletes;

    protected $table = 'agencies';
    protected $fillable = ['name', 'slug'];

    public static $rules = [
        'name' => 'required',
    ];

    public static $filterable = [
        'name',
        'slug'
    ];

    public function manpower()
    {
        return $this->hasMany('App\Models\Manpower');
    }
}
