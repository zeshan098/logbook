<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AssignTask extends Model
{
    use Notifiable;
    public $table = "assign_tasks"; 
    public $timestamps = false;

    protected $fillable = [
        'start_date', 'end_date','task_name','task_detail','assign_to', 'assign_by','ap_dis_by', 'status',
        'created_at', 'updated_at'];
}
