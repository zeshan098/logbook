<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class HostDetail extends Model
{
    use Notifiable;
    public $table = "host_details"; 
    public $timestamps = false;

    protected $fillable = [
        'company_name',  'status','user_id','date'];
}
