<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManpowerType extends Model
{
    use SoftDeletes;

    protected $table = 'manpower_types';
    protected $fillable = ['name', 'slug', 'rate', 'extended_rate'];

    public static $rules = [
        'name' => 'required',
    ];

    public static $filterable = [
        'name',
        'slug',
        'rate',
        'extended_rate'
    ];

    public function manpower()
    {
        return $this->hasMany('App\Models\Manpower');
    }
}
