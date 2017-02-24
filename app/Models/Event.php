<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Event extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'events';
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    public static $rules = [
        'title'             => 'required|min:3',
        'event_datetime'    => 'required|date',
        'meta.description'  => 'required'
    ];


    /**
     * Associations
     * ======================================================================================================
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Local Scopes
     * ======================================================================================================
     */

    /**
     * @param $query
     * @param $departmentId
     * @return mixed
     */
    public function scopeGetDepartmentEvents($query, $departmentId)
    {
        return $query->where('department_id', $departmentId);
    }

    /**
     * @param $query
     * @param $userId
     * @return mixed
     */
    public function scopeGetSelfEvents($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePrivateEvents($query)
    {
        return $query->where('scope', 'private');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublicEvents($query)
    {
        return $query->where('scope', 'public');
    }

    /**
     * Serialization
     * ======================================================================================================
     */

    public function getTitleAttribute()
    {
        return ucwords($this->attributes['title']);
    }
}
