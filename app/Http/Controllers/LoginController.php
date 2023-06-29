<?php

namespace App\Http\Controllers;
use App\Models\User;  
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;  
use Carbon\Carbon;
use Session;
use Socialite; 
use DB;  

class LoginController extends Controller
{
    

    public function login()
    
    {
        
        return view('admin.login');
         
    }


    public function signup()
    
    {
        
        return view('salon.signup');
         
    }

    public function forgot_password()
    
    {
        
        return view('salon.forgot_password');
         
    }
    
    public function add_user_view(){
        $data["users"] = array();
        $data['page_title'] = "Add User";
        $role = Auth::user()->role; 
        $data['page_description'] = "Add User"; 
        $host_details = DB::table("host_details")->where('status', 'open')->get();
        if($role == 'admin'){ 
            $user_list = DB::table('users')
                ->join('host_details', 'users.host_id', '=', 'host_details.id') 
                ->select('host_details.company_name AS company_name', 'users.*')
                ->where('users.status', '=', 'open')
                ->get(); 
            return view('admin.users.add_user')->with($data)
            ->with('user_list', $user_list)
            ->with('host_details', $host_details);
        }else if($role == 'backoffice'){ 
            $user_list = DB::table('users')
                ->join('host_details', 'users.host_id', '=', 'host_details.id') 
                ->select('host_details.company_name AS company_name', 'users.*')
                ->where('users.status', '=', 'open')
                ->where('users.role', '=', 'student')
                ->get(); 
            return view('backoffice.users.add_user')->with($data)
            ->with('user_list', $user_list)
            ->with('host_details', $host_details);
        }else{
            return redirect()->back();
        }
       
    }
    // Check duplicate username

    public function check_username(Request $request)
    {
        $a  =  $request->input('username');
        $username = DB::select(" select username from users where username = '$a' ");
        if($username!=[]){
           $response = "<span style='color: red;'>Duplicate Username.</span>";
        }else{
          $response = "<span style='color: green;'>New username.</span>";
        }
        return response()->json($response);
         
        
    }

    public function register(Request $request)
    {
        $role = Auth::user()->role;  
         
        User::create([ 
                    'name' => $request->input('name'),
                    'username' => $request->input('username'), 
                    'email' => $request->input('email'), 
                    'role' => 'student', 
                    'vocation' => $request->input('vocation'), 
                    'host_id' => $request->input('host_id'), 
                    'college' => $request->input('college'), 
                    'password' => Hash::make($request->input('password')),
                    'status' => 'open', 
                    'created_by' => Auth::user()->id, 
                    'updated_at' => now(),
                    'created_at' => now(),
       ]); 
       return response()->json(['success'=>'Added successfully']);
          
    }

    // Login salon / Teacher

    public function user_login(Request $request)
    {
        $input = $request->all(); 
         
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
  
        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        //dd(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])));
        if(auth()->attempt(array($fieldType => $input['username'], 'password' => $input['password'])))
        { 
            if(Auth::user()->status == "close"){
                Auth::logout();
                return response()->json(['error'=> 'Account inactive contact administrator!']);
            } else{
                $user = DB::Table('users')->where('username',$input['username'])->first(); 
                return response()->json(["success"=> 'successfully login', 'role' => $user->role]);
            }
            
        }else{
            Auth::logout();
            return response()->json(["error"=> 'Invalid login']); 
        }
        
    }

    //Logout
    public function logout(Request $request){
        Auth::logout();
        
        return redirect()->intended('/');
    }


    public function edit_user($id)
    {
        $role = Auth::user()->role;
        $host_details = DB::table("host_details")->where('status', 'open')->get();
        $edit_user = \DB::table('users')->where('id', $id)->first(); 
        if($role == 'admin'){  
            return view('admin.users.edit_user')
            ->with('edit_user', $edit_user)
            ->with('host_details', $host_details);
        }elseif($role == 'backoffice'){  
            return view('backoffice.users.edit_user')
            ->with('edit_user', $edit_user)
            ->with('host_details', $host_details);
        }elseif($role == 'supervisor'){  
            return view('supervisor.users.edit_user')
            ->with('edit_user', $edit_user)
            ->with('host_details', $host_details);
        }else{
            return redirect()->back();
        }

        
    }


    public function update_user(Request $request, $id)
    
    { 
        $role = Auth::user()->role; 
        DB::table('users')
                    ->where('id', $id)
                    ->update([   
                        'name' => $request->input('name'),
                        'username' => $request->input('username'), 
                        'email' => $request->input('email'),  
                        'vocation' => $request->input('vocation'),
                        'host_id' => $request->input('host_id'), 
                        'college' => $request->input('college'), 
                        'password' => Hash::make($request->input('password')),
                        'status' => $request->input('status'),  
                        'updated_at' => now(),   ]); 
       
         
        if($role == 'admin'){ 
            return redirect('admin/add_user');
        }else if($role == 'backoffice'){ 
            return redirect('backoffice/add_user');
        }else{
            return redirect()->back();
        }
        
    }  

    public function show()
    
    { 
        $role = Auth::user()->role; 
        
         
        if($role == 'student'){ 
            return view('student.show');
        }else{
            return redirect()->back();
        }
        
    }  

    //Backoffice add
    public function add_backoffice(){
        $data["users"] = array();
        $data['page_title'] = "Add User";
        $role = Auth::user()->role; 
        $data['page_description'] = "Add User"; 
        $host_details = DB::table("host_details")->where('status', 'open')->get();
        if($role == 'admin'){ 
            $user_list = DB::table('users') 
                ->where('users.status', '=', 'open')
                ->get();
            return view('admin.users.add_user')->with($data)
            ->with('user_list', $user_list)
            ->with('host_details', $host_details);
        }else if($role == 'backoffice'){ 
            $user_list = DB::table('users') 
                ->where('users.status', '=', 'open')
                ->where('users.role', '=', 'backoffice')
                ->get(); 
            return view('backoffice.users.add_backoffice')->with($data)
            ->with('user_list', $user_list);
        }else{
            return redirect()->back();
        }
       
    }


    public function backoffice_register(Request $request)
    {
        $role = Auth::user()->role;  
         
        User::create([ 
                    'name' => $request->input('name'),
                    'username' => $request->input('username'), 
                    'email' => $request->input('email'), 
                    'role' => 'backoffice', 
                    'vocation' => '', 
                    'host_id' => '', 
                    'password' => Hash::make($request->input('password')),
                    'status' => 'open', 
                    'created_by' => Auth::user()->id, 
                    'updated_at' => now(),
                    'created_at' => now(),
       ]); 
       return response()->json(['success'=>'Added successfully']);
          
    }


    public function edit_backoffice($id)
    {
        $role = Auth::user()->role; 
        $edit_user = \DB::table('users')->where('id', $id)->first(); 
        if($role == 'admin'){  
            return view('admin.users.edit_backoffice')
            ->with('edit_user', $edit_user);
        }elseif($role == 'backoffice'){  
            return view('backoffice.users.edit_backoffice')
            ->with('edit_user', $edit_user);
        }else{
            return redirect()->back();
        }

        
    }


    public function update_backoffice(Request $request, $id)
    
    { 
        $role = Auth::user()->role; 
        DB::table('users')
                    ->where('id', $id)
                    ->update([   
                        'name' => $request->input('name'),
                        'username' => $request->input('username'), 
                        'email' => $request->input('email'),   
                        'password' => Hash::make($request->input('password')),
                        'status' => $request->input('status'),  
                        'updated_at' => now(),   ]); 
       
         
        if($role == 'admin'){ 
            return redirect('admin/add_user');
        }else if($role == 'backoffice'){ 
            return redirect('backoffice/add_backoffice');
        }else{
            return redirect()->back();
        }
        
    }  


    //Super Visor add
    public function add_supervisor(){
        $data["users"] = array();
        $data['page_title'] = "Add User";
        $role = Auth::user()->role; 
        $data['page_description'] = "Add User"; 
        $host_details = DB::table("host_details")->where('status', 'open')->get();
        if($role == 'admin'){ 
            $user_list = DB::table('users') 
                ->where('users.status', '=', 'open')
                ->get();
            return view('admin.users.add_user')->with($data)
            ->with('user_list', $user_list)
            ->with('host_details', $host_details);
        }else if($role == 'backoffice'){ 
            $user_list = DB::table('users') 
                ->where('users.status', '=', 'open')
                ->where('users.role', '=', 'supervisor')
                ->get(); 
            return view('backoffice.users.add_supervisor')->with($data)
            ->with('user_list', $user_list);
        }else{
            return redirect()->back();
        }
       
    }


    public function supervisor_register(Request $request)
    {
        $role = Auth::user()->role;  
         
        User::create([ 
                    'name' => $request->input('name'),
                    'username' => $request->input('username'), 
                    'email' => $request->input('email'), 
                    'role' => 'supervisor', 
                    'vocation' => '', 
                    'host_id' => '', 
                    'password' => Hash::make($request->input('password')),
                    'status' => 'open', 
                    'created_by' => Auth::user()->id, 
                    'updated_at' => now(),
                    'created_at' => now(),
       ]); 
       return response()->json(['success'=>'Added successfully']);
          
    }


    public function edit_supervisor($id)
    {
        $role = Auth::user()->role; 
        $edit_user = \DB::table('users')->where('id', $id)->first(); 
        if($role == 'admin'){  
            return view('admin.users.edit_supervisor')
            ->with('edit_user', $edit_user);
        }elseif($role == 'backoffice'){  
            return view('backoffice.users.edit_supervisor')
            ->with('edit_user', $edit_user);
        }else{
            return redirect()->back();
        }

        
    }


    public function update_supervisor(Request $request, $id)
    
    { 
        $role = Auth::user()->role; 
        DB::table('users')
                    ->where('id', $id)
                    ->update([   
                        'name' => $request->input('name'),
                        'username' => $request->input('username'), 
                        'email' => $request->input('email'),   
                        'password' => Hash::make($request->input('password')),
                        'status' => $request->input('status'),  
                        'updated_at' => now(),   ]); 
       
         
        if($role == 'admin'){ 
            return redirect('admin/add_user');
        }else if($role == 'backoffice'){ 
            return redirect('backoffice/add_supervisor');
        }else{
            return redirect()->back();
        }
        
    }  

   
}
