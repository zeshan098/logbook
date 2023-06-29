<?php

namespace App\Http\Controllers;
use App\Models\User;  
use App\Models\AssignUser;   
use App\Models\AssignTask;   
use App\Models\ActivityLog;  

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;  
use Carbon\Carbon;
use Session;
use DB;  
use PDF;
use Dompdf\Dompdf;

class AssignTaskController extends Controller
{
    public function assign_task()
    
    {
        $role = Auth::user()->role;  
        
        if($role == 'backoffice'){

            $supervisor = DB::table("users")->where('role', 'supervisor')->where('status', 'open')->get();
            $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();

            $assignedUsers = DB::table('assign_users')
                ->join('users AS student', 'assign_users.student_id', '=', 'student.id')
                ->join('users AS supervisor', 'assign_users.supervisor_id', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_users.supervisor_id As sup_id',
                         'assign_users.student_id As st_id')
                ->where('assign_users.status', '=', 'open')
                ->get();

            $assigned_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->whereIn('assign_tasks.status', ['to_do', 'in_progress', 'complete', 'approved', 'dis_approved'])
                ->get();
            return view('backoffice.task.assign_task')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('assignedUsers', $assignedUsers)
            ->with('assigned_task', $assigned_task);
            
        } 
        else if($role == 'supervisor'){
            
            $supervisor = DB::table("users")->where('role', 'supervisor')->where('status', 'open')->get();
            $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();

            $assignedUsers = DB::table('assign_users')
                ->join('users AS student', 'assign_users.student_id', '=', 'student.id')
                ->join('users AS supervisor', 'assign_users.supervisor_id', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_users.supervisor_id As sup_id',
                         'assign_users.student_id As st_id')
                ->where('assign_users.status', '=', 'open')
                ->where('assign_users.supervisor_id', '=', Auth::user()->id)
                ->get();

            $assigned_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->whereIn('assign_tasks.status', ['to_do', 'in_progress', 'complete', 'approved', 'dis_approved'])
                ->where('assign_tasks.assign_by', '=', Auth::user()->id)
                ->get();
            return view('supervisor.task.assign_task')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('assignedUsers', $assignedUsers)
            ->with('assigned_task', $assigned_task);
        } 
        else if($role == 'student'){
            $to_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status',  '=', 'to_do')
                ->where('assign_tasks.assign_to', '=', Auth::user()->id)
                ->get();

            $in_progress_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status',  '=', 'in_progress')
                ->where('assign_tasks.assign_to', '=', Auth::user()->id)
                ->get();
            
            $complete_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status',  '=', 'complete')
                ->where('assign_tasks.assign_to', '=', Auth::user()->id)
                ->get();
             
            return view('student.task.assign_task') 
            ->with('to_task', $to_task)
            ->with('in_progress_task', $in_progress_task)
            ->with('complete_task', $complete_task);

        }
        else{
            return redirect()->back();
        }
          
    }

    //Approved disapproved task
    public function approved_disapproved_task()
    
    {
        $role = Auth::user()->role;  
        
        if($role == 'backoffice'){

            $supervisor = DB::table("users")->where('role', 'supervisor')->where('status', 'open')->get();
            $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();
 

            $complete_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status', '=', 'complete') 
                ->get();

            $approved_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status', '=', 'approved') 
                ->get();
            $dis_approved_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status', '=', 'dis_approved') 
                ->get();
             
            return view('backoffice.task.app_dis')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('complete_task', $complete_task)
            ->with('approved_task', $approved_task)
            ->with('dis_approved_task', $dis_approved_task);
            
        } 
        else if($role == 'supervisor'){
            
            $supervisor = DB::table("users")->where('role', 'supervisor')->where('status', 'open')->get();
            $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();
 

            $complete_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status', '=', 'complete')
                ->where('assign_tasks.assign_by', '=', Auth::user()->id)
                ->get();

            $approved_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status', '=', 'approved')
                ->where('assign_tasks.assign_by', '=', Auth::user()->id)
                ->get();
            $dis_approved_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status', '=', 'dis_approved')
                ->where('assign_tasks.assign_by', '=', Auth::user()->id)
                ->get();
             
            return view('supervisor.task.app_dis')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('complete_task', $complete_task)
            ->with('approved_task', $approved_task)
            ->with('dis_approved_task', $dis_approved_task);
        } 
        else if($role == 'student'){
            $supervisor = DB::table("users")->where('role', 'supervisor')->where('status', 'open')->get();
            $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();
 

            $complete_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status', '=', 'complete')
                ->where('assign_tasks.assign_to', '=', Auth::user()->id)
                ->get();

            $approved_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status', '=', 'approved')
                ->where('assign_tasks.assign_to', '=', Auth::user()->id)
                ->get();
            $dis_approved_task = DB::table('assign_tasks')
                ->join('users AS student', 'assign_tasks.assign_to', '=', 'student.id')
                ->join('users AS supervisor', 'assign_tasks.assign_by', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_tasks.*')
                ->where('assign_tasks.status', '=', 'dis_approved')
                ->where('assign_tasks.assign_to', '=', Auth::user()->id)
                ->get();
             
            return view('student.task.app_dis')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('complete_task', $complete_task)
            ->with('approved_task', $approved_task)
            ->with('dis_approved_task', $dis_approved_task);

        }
        else{
            return redirect()->back();
        }
          
    }


    public function create_task(Request $request)
    {
        $role = Auth::user()->role;  
        if($role == 'backoffice'){
            AssignTask::create([ 
                'assign_to' => $request->input('assign_to'),
                'start_date' => $request->input('start_date'),  
                'end_date' => $request->input('end_date'), 
                'task_name' => $request->input('task_name'), 
                'task_detail' => $request->input('task_detail'), 
                'start_date' => $request->input('start_date'), 
                'status' => $request->input('status'),
                'assign_by' => $request->input('assign_by'), 
                'created_at' => now() 
            ]); 
            return response()->json(['success'=>'Successfully Done']);
        } 
        else if($role == 'supervisor'){ 
            AssignTask::create([ 
                        'assign_to' => $request->input('assign_to'),
                        'start_date' => $request->input('start_date'),  
                        'end_date' => $request->input('end_date'), 
                        'task_name' => $request->input('task_name'), 
                        'task_detail' => $request->input('task_detail'), 
                        'start_date' => $request->input('start_date'), 
                        'status' => $request->input('status'),
                        'assign_by' => Auth::user()->id, 
                        'created_at' => now() 
        ]); 
        return response()->json(['success'=>'Successfully Done']);
        }
    }


    public function edit_assign_task($id)
    {
        $role = Auth::user()->role;
        
        $supervisor = DB::table("users")->where('role', 'supervisor')->where('status', 'open')->get();
        $student = DB::table('assign_users')
                ->join('users AS student', 'assign_users.student_id', '=', 'student.id')
                ->join('users AS supervisor', 'assign_users.supervisor_id', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_users.supervisor_id As sup_id',
                         'assign_users.student_id As st_id')
                ->where('assign_users.status', '=', 'open')
                ->where('assign_users.supervisor_id', '=', Auth::user()->id)
                ->get();
         
        $edit_assign_task = \DB::table('assign_tasks')->where('id', $id)->first(); 
        if($role == 'backoffice'){
            return view('backoffice.task.edit_assign_task')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('edit_assign_task', $edit_assign_task);
        } 
        else if($role == 'supervisor'){
            return view('supervisor.task.edit_assign_task')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('edit_assign_task', $edit_assign_task);
        } 
        else{
            return redirect()->back();
        }

        
    }

    public function update_assign_task(Request $request, $id)
    
    { 
        $role = Auth::user()->role;  
         
        if($role == 'backoffice'){ 
            DB::table('assign_tasks')
                    ->where('id', $id)
                    ->update([   
                        'assign_to' => $request->input('assign_to'),
                        'start_date' => $request->input('start_date'),  
                        'end_date' => $request->input('end_date'), 
                        'task_name' => $request->input('task_name'), 
                        'task_detail' => $request->input('task_detail'), 
                        'start_date' => $request->input('start_date'),   
                        'status' => $request->input('status'),
                        'assign_by' => $request->input('assign_by'), 
                        'updated_at' => now()   ]); 
            return redirect('backoffice/assign-task');
        }else if($role == 'supervisor'){ 
            DB::table('assign_tasks')
                    ->where('id', $id)
                    ->update([   
                        'assign_to' => $request->input('assign_to'),
                        'start_date' => $request->input('start_date'),  
                        'end_date' => $request->input('end_date'), 
                        'task_name' => $request->input('task_name'), 
                        'task_detail' => $request->input('task_detail'), 
                        'start_date' => $request->input('start_date'),   
                        'status' => $request->input('status'),
                        'assign_by' => Auth::user()->id, 
                        'updated_at' => now()   ]); 
            return redirect('supervisor/assign-task');
        }else{
            return redirect()->back();
        }
        
    }  

    public function delete_assign_task($id)
    
    {  
        DB::table('assign_tasks')
                        ->where('id', $id)
                        ->update([  
                        'status' => 'close', 
                        'updated_at' => now(), 
                        'assign_by' => Auth::user()->id  ]);  


        return response()->json(['success' => 'Record deleted successfully!']);
       
        
    }

     //activity Log

    public function get_activity($id)
    {   
        
        $activity_detail  = \DB::table('activity_logs')->where('task_id', $id)->where('status', 'open')->orderBy('id', 'DESC')->get(); 
 
        return response()->json($activity_detail);
    }

    public function save_activity(Request $request)
    
    {  
        $user_id = Auth::user()->id; 
        ActivityLog::create([
            'task_id' => $request->input('cust_id'),   
            'remarks' => $request->input('msg'),     
            'start_time' => $request->input('start_time'), 
            'end_time' => $request->input('end_time'), 
            'complete_date' => now(), 
            'status' => 'open',
            'user_id' => $user_id,
        ]);

        DB::table('assign_tasks')
                    ->where('id', $request->input('cust_id'))
                    ->update([     
                        'status' => $request->input('call_type'), 
                        'updated_at' => now()   ]); 
 

        return response()->json(['success'=>'Added successfully']);
        
        
    }

    //Super visor activity
    public function get_activity_super($id)
    {   
        
        $activity_detail  = \DB::table('activity_logs')->where('task_id', $id)->where('status', 'open')->orderBy('id', 'DESC')->get(); 
 
        return response()->json($activity_detail);
    }


    public function supervisor_save_activity(Request $request)
    
    {  
        $user_id = Auth::user()->id; 
         

        DB::table('assign_tasks')
                    ->where('id', $request->input('cust_id'))
                    ->update([     
                        'status' => $request->input('call_type'), 
                        'ap_dis_by' => Auth::user()->id,
                        'updated_at' => now()   ]); 
 

        return response()->json(['success'=>'Added successfully']);
        
        
    }


    //Report
    
    public function activity_report()
    {
        $role = Auth::user()->role; 
        $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();
        // $host_details = DB::table("host_details")->where('status', 'open')->get();
        if($role == 'backoffice'){
            return view('backoffice.report.activity_report')
            ->with('student', $student);
        }
    }

    public function get_activity_report(Request $request)
    {
        $role = Auth::user()->role;  
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $assign_to = $request->input('assign_to'); 
        $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();
        $user_detail = DB::table('users')
                            ->join('host_details', 'host_details.id', '=', 'users.host_id')
                            ->select('host_details.company_name', 'users.*')
                            ->where('users.id', '=', $assign_to)
                            ->first();
        $query = DB::table('activity_logs')
                    ->join('users', 'users.id', '=', 'activity_logs.user_id')
                    ->join('assign_tasks', 'assign_tasks.id', '=', 'activity_logs.task_id')
                    ->select(
                        'users.name', 'assign_tasks.start_date', 'assign_tasks.end_date',
                        DB::raw('DATE(activity_logs.complete_date) as complete_date'),
                        DB::raw('ROUND(SUM(TIME_TO_SEC(activity_logs.end_time) - TIME_TO_SEC(activity_logs.start_time)) / 3600, 2) as total_hours'),
                        'activity_logs.remarks',
                        'assign_tasks.status'
                    )
                    ->where('activity_logs.user_id', '=', $assign_to)
                    ->where('activity_logs.status', '=', 'open')
                    ->groupBy('users.name', 'assign_tasks.start_date', 'assign_tasks.end_date', 'complete_date', 'activity_logs.remarks', 'assign_tasks.status')
                    ->orderBy('activity_logs.id')
                    ->get();
        if($role == 'backoffice'){
            return view('backoffice.report.activity_report')
                        ->with('user_detail', $user_detail)
                        ->with('activity_detail', $query)
                        ->with('student', $student)
                        ->with('start_date', $start_date)
                        ->with('end_date', $end_date)
                        ->with('assign_to', $assign_to);
        } 
    }

    public function pdf_activity_report(Request $request)
    {
        $role = Auth::user()->role;  
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $assign_to = $request->input('assign_to'); 
        $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();
        $user_detail = DB::table('users')
                            ->join('host_details', 'host_details.id', '=', 'users.host_id')
                            ->select('host_details.company_name', 'users.*')
                            ->where('users.id', '=', $assign_to)
                            ->first();
        $query = DB::table('activity_logs')
                    ->join('users', 'users.id', '=', 'activity_logs.user_id')
                    ->join('assign_tasks', 'assign_tasks.id', '=', 'activity_logs.task_id')
                    ->select('activity_logs.task_id',
                        'users.name', 'assign_tasks.start_date', 'assign_tasks.end_date',
                        DB::raw('DATE(activity_logs.complete_date) as complete_date'),
                        DB::raw('ROUND(SUM(TIME_TO_SEC(activity_logs.end_time) - TIME_TO_SEC(activity_logs.start_time)) / 3600, 2) as total_hours'),
                        'activity_logs.remarks',
                        'assign_tasks.status', 'assign_tasks.task_name' 
                    )
                    ->where('activity_logs.user_id', '=', $assign_to)
                    ->where('activity_logs.status', '=', 'open')
                    ->groupBy('users.name', 'assign_tasks.start_date', 'assign_tasks.end_date',
                     'complete_date', 'activity_logs.remarks', 'assign_tasks.status', 'assign_tasks.task_name',
                     'activity_logs.task_id')
                     ->orderBy('activity_logs.id')
                    ->get();
        
        $pdf = \PDF::loadView('backoffice.report.new_activity_report',['query'=>$query,
                    'user_detail'=>$user_detail ]); 
        return $pdf->download('pdf_file.pdf');
    }     
}
