<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class AssignUser extends Model
{
    use Notifiable;
    public $table = "assign_users"; 
    public $timestamps = false;

    protected $fillable = [
        'supervisor_id', 'student_id','status','user_id','date'];
}
