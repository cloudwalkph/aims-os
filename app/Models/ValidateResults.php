<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ValidateResults extends Model
{
    protected $table = 'validate_results';
    protected $guarded = ['id'];

    

    public function department()
    {
        return $this->has(Department::class);
    }
}
