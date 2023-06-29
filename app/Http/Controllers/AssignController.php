<?php

namespace App\Http\Controllers;
use App\Models\User;  
use App\Models\AssignUser;   
use App\Models\AssignTask; 
use App\Models\HostDetail; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;  
use Carbon\Carbon;
use Session;
use DB;  

class AssignController extends Controller
{
    //Host Detail
    public function add_host()
    {
        $role = Auth::user()->role; 
        $host_details = DB::table("host_details")->where('status', 'open')->get();
        if($role == 'backoffice'){
            return view('backoffice.host.add_host')
            ->with('host_details', $host_details);
        }
    }

    public function create_host(Request $request)
    {
        $role = Auth::user()->role;  
         
        HostDetail::create([  
                    'company_name' => $request->input('company_name'),  
                    'status' => 'open', 
                    'user_id' => Auth::user()->id, 
                    'date' => now() 
       ]); 
       return response()->json(['success'=>'Successfully Done']);
          
    }

    public function edit_host($id)
    {
        $role = Auth::user()->role; 
        $edit_host = \DB::table('host_details')->where('id', $id)->first(); 
        if($role == 'backoffice'){
            return view('backoffice.host.edit_host')
            ->with('edit_host', $edit_host);
        }  
        else{
            return redirect()->back();
        }

        
    }

    public function update_host(Request $request, $id)
    
    { 
        $role = Auth::user()->role; 
        DB::table('host_details')
                    ->where('id', $id)
                    ->update([    
                        'company_name' => $request->input('company_name'),  
                        'status' => 'open', 
                        'user_id' => Auth::user()->id,  
                        'date' => now(),   ]); 
       
         
        if($role == 'backoffice'){ 
            return redirect('backoffice/add-host');
        }else{
            return redirect()->back();
        }
        
    }  


    public function delete_host($id)
    
    {  
        DB::table('host_details')
                        ->where('id', $id)
                        ->update([  
                        'status' => 'close', 
                        'date' => now(), 
                        'user_id' => Auth::user()->id  ]);  


        return response()->json(['success' => 'Record deleted successfully!']);
       
        
    }




    //Assign user

    public function assign_user()
    
    {
        $role = Auth::user()->role;  
        
        if($role == 'backoffice'){
            $supervisor = DB::table("users")->where('role', 'supervisor')->where('status', 'open')->get();
            $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();
    
            $assignedUsers = DB::table('assign_users')
                ->join('users AS student', 'assign_users.student_id', '=', 'student.id')
                ->join('users AS supervisor', 'assign_users.supervisor_id', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_users.id')
                ->where('assign_users.status', '=', 'open')
                ->get();
            return view('backoffice.assign.assign_user')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('assignedUsers', $assignedUsers);
        } 
        else if($role == 'supervisor'){
            
            $supervisor = DB::table("users")->where('role', 'supervisor')->where('status', 'open')->get();
            $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();

            $assignedUsers = DB::table('assign_users')
                ->join('users AS student', 'assign_users.student_id', '=', 'student.id')
                ->join('users AS supervisor', 'assign_users.supervisor_id', '=', 'supervisor.id')
                ->select('student.name AS student_name', 'supervisor.name AS supervisor_name', 'assign_users.id')
                ->where('assign_users.status', '=', 'open')
                ->where('assign_users.supervisor_id', '=', Auth::user()->id)
                ->get();
            return view('supervisor.assign.assign_user')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('assignedUsers', $assignedUsers);
        } 
        else{
            return redirect()->back();
        }
          
    }

    public function register_assign_user(Request $request)
    {
        $role = Auth::user()->role;  
        if($role == 'backoffice'){
            AssignUser::create([ 
                        'supervisor_id' => $request->input('supervisor_id'),
                        'student_id' => $request->input('student_id'),  
                        'status' => 'open', 
                        'user_id' => Auth::user()->id, 
                        'date' => now() 
           ]); 
           return response()->json(['success'=>'Successfully Done']);
            
        }else if($role == 'supervisor'){
            AssignUser::create([ 
                    'supervisor_id' => Auth::user()->id,
                    'student_id' => $request->input('student_id'),  
                    'status' => 'open', 
                    'user_id' => Auth::user()->id, 
                    'date' => now() 
             ]); 
            return response()->json(['success'=>'Successfully Done']);
        }   
    }

    public function edit_assign_user($id)
    {
        $role = Auth::user()->role;
        
        $supervisor = DB::table("users")->where('role', 'supervisor')->where('status', 'open')->get();
        $student = DB::table("users")->where('role', 'student')->where('status', 'open')->get();

        $edit_assign_user = \DB::table('assign_users')->where('id', $id)->first(); 
        if($role == 'backoffice'){
            return view('backoffice.assign.edit_assign_user')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('edit_assign_user', $edit_assign_user);
        } 
        else if($role == 'supervisor'){
            return view('supervisor.assign.edit_assign_user')
            ->with('supervisor', $supervisor)
            ->with('student', $student)
            ->with('edit_assign_user', $edit_assign_user);
        } 
        else{
            return redirect()->back();
        }

        
    }

    public function update_assign_user(Request $request, $id)
    
    { 
        $role = Auth::user()->role; 
        DB::table('assign_users')
                    ->where('id', $id)
                    ->update([   
                        'supervisor_id' => Auth::user()->id,
                        'student_id' => $request->input('student_id'),  
                        'status' => 'open', 
                        'user_id' => Auth::user()->id,  
                        'date' => now(),   ]); 
       
         
        if($role == 'backoffice'){ 
            return redirect('backoffice/assign-user');
        }else if($role == 'supervisor'){ 
            return redirect('supervisor/assign-user');
        }else{
            return redirect()->back();
        }
        
    }  


    public function delete_assign_user($id)
    
    {  
        DB::table('assign_users')
                        ->where('id', $id)
                        ->update([  
                        'status' => 'close', 
                        'date' => now(), 
                        'user_id' => Auth::user()->id  ]);  


        return response()->json(['success' => 'Record deleted successfully!']);
       
        
    }


}
