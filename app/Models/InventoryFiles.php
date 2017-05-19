<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryFiles extends Model
{
  use SoftDeletes;
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['inventory_id', 'url', 'file_type'];
  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $dates = ['deleted_at'];
}
