<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    use SoftDeletes;

    protected $table = 'assignments';
    protected $guarded = ['id'];

    public static $filterable = [
        'deadline',
        'project_name',
        'job_order_no',
        'first_name',
        'last_name'
    ];

    static function loadRatees( $jno = null, $category = null, $deptid = null ){

//'1','productions'
//'2','creatives'
//'3','cmtuva'
//'4','hr'
//'5','inventory'
//'6','admin'
//'7','ae'
//'8','accounting'
//'9','setup'
//'10','operations'
//'11','activations'
//'12','negotiators'
//'13','tl'

        $assigned_users = array();
        $departmentArray = [];

        $jo_results = JobOrder::where('job_order_no', '=', $jno)->firstOrFail();

        /*production*/
        if ( $deptid == 1 ){
            if( $category == 'post' ) {
                $departmentArray = [ 9 ];
            }else{
                $departmentArray = [ 7, 11, 9 ];
            }
        }
        /*cmtuva*/
        if ( $deptid == 3 ){
            if( $category == 'pre' ) {
                $departmentArray = [ 7, 11, 9, 8, 12 ];
            }elseif( $category == 'post' ) {
                $departmentArray = [ 12 ];
            }
        }
        /*hr*/
        if ( $deptid == 4 ){
            if( $category == 'pre' ) {
                $departmentArray = [ 7, 11, 9, 5 ];
            }elseif( $category == 'eprop' ) {
                $departmentArray = [ 11 ];
            }
        }
        /*inventory*/
        if ( $deptid == 5 ){
            if( $category == 'pre' ) {
                $departmentArray = [ 3, 7, 9, 11, 13 ];
            }elseif( $category == 'post' ) {
                $departmentArray = [ 13, 11 ];
            }
        }
        /*ae*/
        if ( $deptid == 7 ){
            if( $category == 'pre' ) {
                $departmentArray = [ 3, 11, 9, 1, 4, 5, 2 ];
            }elseif( $category == 'eprop' ) {
                $departmentArray = [ 11, 5, 2 ];
            }elseif( $category == 'post' ) {
                $departmentArray = [ 3, 11, 5, 2 ];
            }
        }
        /*setup and logistics*/
        if ( $deptid == 9 ){
            if( $category == 'pre' ) {
                $departmentArray = [ 3, 7, 1, 11, 5 ];
            }elseif( $category == 'eprop' ) {
                $departmentArray = [ 11, 7, 1 ];
            }elseif( $category == 'post' ) {
                $departmentArray = [ 1 ];
            }
        }
        /*activations*/
        if ( $deptid == 11 ){
            if( $category == 'pre' ) {
                $departmentArray = [ 7, 3, 9, 1, 4, 5, 8, 13 ];
            }elseif( $category == 'eprop' ) {
                $departmentArray = [ 7, 9, 4, 13 ];
            }elseif( $category == 'post' ) {
                $departmentArray = [ 13 ];
            }
        }

        $assigned_users = Assignment::where('job_order_id', '=', $jo_results->id)
            ->whereIn('department_id', $departmentArray)
            ->orderBy('department_id')
            ->get();

        return $assigned_users;

    }

    public function jobOrder()
    {
        return $this->belongsTo(JobOrder::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(CreativesTask::class);
    }
}
