<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class ActivityLog extends Model
{
    use Notifiable;
    public $table = "activity_logs"; 
    public $timestamps = false;

    protected $fillable = [
        'remarks', 'start_time','end_time','task_id','user_id','complete_date','status'];
}
