<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Both Cache is cleared";
}); 

// Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index'); 
Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('login');
});
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login'); 

Route::post('/user_login', [App\Http\Controllers\LoginController::class, 'user_login'])->name('user_login');

 
 

Route::get('/getNewService/{id}', [App\Http\Controllers\IndexController::class, 'getService'])->name('getService');
Route::get('changeStatus', [App\Http\Controllers\IndexController::class, 'changeStatus'])->name('changeStatus');

//Save Activity
Route::post('/save_activity', [App\Http\Controllers\AssignTaskController::class, 'save_activity'])->name('save_activity');
Route::get('/get_activity/{id}', [App\Http\Controllers\AssignTaskController::class, 'get_activity'])->name('get_activity');

//Supervisor activity
Route::post('/supervisor_save_activity', [App\Http\Controllers\AssignTaskController::class, 'supervisor_save_activity'])->name('supervisor_save_activity');
Route::get('/get_activity_super/{id}', [App\Http\Controllers\AssignTaskController::class, 'get_activity_super'])->name('get_activity_super');

//Logout
Route::get('logout', ['as' => 'logout', 'uses' => 'App\Http\Controllers\LoginController@logout']);

Route::group(['prefix' => 'admin',  'middleware' => 'auth',  'middleware' => 'role:admin', 'as' => 'admin.'], function() {
    
    Route::get('add_user', [App\Http\Controllers\LoginController::class, 'add_user_view'])->name('add_user');
    Route::post('/check_username', [App\Http\Controllers\LoginController::class, 'check_username'])->name('check_username');
    Route::post('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');
    Route::get('/edit_user/{id}', [App\Http\Controllers\LoginController::class, 'edit_user'])->name('edit_user');
    Route::post('/update_user/{id}', [App\Http\Controllers\LoginController::class, 'update_user'])->name('update_user');
    //Dashboard
    Route::get('/dashboard', [App\Http\Controllers\IndexController::class, 'st_dashboard'])->name('st_dashboard');
    Route::get('/dashboard_new', [App\Http\Controllers\IndexController::class, 'dashboard_new'])->name('dashboard_new');
    Route::get('/dashboard_total', [App\Http\Controllers\IndexController::class, 'dashboard_total'])->name('dashboard_total');
  
    

}); 

Route::group(['prefix' => 'backoffice',  'middleware' => 'auth',  'middleware' => 'role:admin,backoffice', 'as' => 'backoffice.'], function() {
    
    Route::get('add_user', [App\Http\Controllers\LoginController::class, 'add_user_view'])->name('add_user');
    Route::post('/check_username', [App\Http\Controllers\LoginController::class, 'check_username'])->name('check_username');
    Route::post('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');
    Route::get('/edit_user/{id}', [App\Http\Controllers\LoginController::class, 'edit_user'])->name('edit_user');
    Route::post('/update_user/{id}', [App\Http\Controllers\LoginController::class, 'update_user'])->name('update_user');
    
    //Add Back Office
    Route::get('add_backoffice', [App\Http\Controllers\LoginController::class, 'add_backoffice'])->name('add_backoffice');
    Route::post('/backoffice_register', [App\Http\Controllers\LoginController::class, 'backoffice_register'])->name('backoffice_register');
    Route::get('/edit_backoffice/{id}', [App\Http\Controllers\LoginController::class, 'edit_backoffice'])->name('edit_backoffice');
    Route::post('/update_backoffice/{id}', [App\Http\Controllers\LoginController::class, 'update_backoffice'])->name('update_backoffice');
    
    //Add SuperVisoe
    Route::get('add_supervisor', [App\Http\Controllers\LoginController::class, 'add_supervisor'])->name('add_supervisor');
    Route::post('/supervisor_register', [App\Http\Controllers\LoginController::class, 'supervisor_register'])->name('supervisor_register');
    Route::get('/edit_supervisor/{id}', [App\Http\Controllers\LoginController::class, 'edit_supervisor'])->name('edit_supervisor');
    Route::post('/update_supervisor/{id}', [App\Http\Controllers\LoginController::class, 'update_supervisor'])->name('update_supervisor');

    
    //Assign Supervisor to Student
    Route::get('assign-user', [App\Http\Controllers\AssignController::class, 'assign_user'])->name('assign_user');
    Route::post('/register_assign_user', [App\Http\Controllers\AssignController::class, 'register_assign_user'])->name('register_assign_user');
    Route::get('/edit-assign-user/{id}', [App\Http\Controllers\AssignController::class, 'edit_assign_user'])->name('edit_assign_user');
    Route::post('/update_assign_user/{id}', [App\Http\Controllers\AssignController::class, 'update_assign_user'])->name('update_assign_user');
    Route::delete('/delete_assign_user/{id}', [App\Http\Controllers\AssignController::class, 'delete_assign_user'])->name('delete_assign_user');
    
    //assign Task
    Route::get('assign-task', [App\Http\Controllers\AssignTaskController::class, 'assign_task'])->name('assign_task');
    Route::post('create_task', [App\Http\Controllers\AssignTaskController::class, 'create_task'])->name('create_task');

    Route::get('/edit-assign-task/{id}', [App\Http\Controllers\AssignTaskController::class, 'edit_assign_task'])->name('edit_assign_task');
    Route::post('/update_assign_task/{id}', [App\Http\Controllers\AssignTaskController::class, 'update_assign_task'])->name('update_assign_task');
    Route::delete('/delete_assign_task/{id}', [App\Http\Controllers\AssignTaskController::class, 'delete_assign_task'])->name('delete_assign_task');
     
    
    //Host Detail
    Route::get('add-host', [App\Http\Controllers\AssignController::class, 'add_host'])->name('add_host');
    Route::post('/create_host', [App\Http\Controllers\AssignController::class, 'create_host'])->name('create_host');
    Route::get('/edit-host/{id}', [App\Http\Controllers\AssignController::class, 'edit_host'])->name('edit_host');
    Route::post('/update_host/{id}', [App\Http\Controllers\AssignController::class, 'update_host'])->name('update_host');
    Route::delete('/delete_host/{id}', [App\Http\Controllers\AssignController::class, 'delete_host'])->name('delete_host');

    //Approvd - Disapproved Task
    Route::get('approved-disapproved-task', [App\Http\Controllers\AssignTaskController::class, 'approved_disapproved_task'])->name('approved_disapproved_task');
    
    //Report
    Route::get('report/activity-report', [App\Http\Controllers\AssignTaskController::class, 'activity_report'])->name('activity_report');
    Route::post('/report/get_activity_report', [App\Http\Controllers\AssignTaskController::class, 'get_activity_report'])->name('get_activity_report');
    Route::post('/report/pdf_activity_report', [App\Http\Controllers\AssignTaskController::class, 'pdf_activity_report'])->name('pdf_activity_report');
}); 


Route::group(['prefix' => 'supervisor',  'middleware' => 'auth',  'middleware' => 'role:admin,supervisor', 'as' => 'supervisor.'], function() {
    
    Route::get('add_user', [App\Http\Controllers\LoginController::class, 'add_user_view'])->name('add_user');
    Route::post('/check_username', [App\Http\Controllers\LoginController::class, 'check_username'])->name('check_username');
    Route::post('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');
    Route::get('/edit_user/{id}', [App\Http\Controllers\LoginController::class, 'edit_user'])->name('edit_user');
    Route::post('/update_user/{id}', [App\Http\Controllers\LoginController::class, 'update_user'])->name('update_user');

    //Assign Supervisor to Student
    Route::get('assign-user', [App\Http\Controllers\AssignController::class, 'assign_user'])->name('assign_user');
    Route::post('/register_assign_user', [App\Http\Controllers\AssignController::class, 'register_assign_user'])->name('register_assign_user');
    Route::get('/edit-assign-user/{id}', [App\Http\Controllers\AssignController::class, 'edit_assign_user'])->name('edit_assign_user');
    Route::post('/update_assign_user/{id}', [App\Http\Controllers\AssignController::class, 'update_assign_user'])->name('update_assign_user');
    Route::delete('/delete_assign_user/{id}', [App\Http\Controllers\AssignController::class, 'delete_assign_user'])->name('delete_assign_user');

    //assign Task
    Route::get('assign-task', [App\Http\Controllers\AssignTaskController::class, 'assign_task'])->name('assign_task');
    Route::post('create_task', [App\Http\Controllers\AssignTaskController::class, 'create_task'])->name('create_task');

    Route::get('/edit-assign-task/{id}', [App\Http\Controllers\AssignTaskController::class, 'edit_assign_task'])->name('edit_assign_task');
    Route::post('/update_assign_task/{id}', [App\Http\Controllers\AssignTaskController::class, 'update_assign_task'])->name('update_assign_task');
    Route::delete('/delete_assign_task/{id}', [App\Http\Controllers\AssignTaskController::class, 'delete_assign_task'])->name('delete_assign_task');
     
    //Approvd - Disapproved Task
    Route::get('approved-disapproved-task', [App\Http\Controllers\AssignTaskController::class, 'approved_disapproved_task'])->name('approved_disapproved_task');
}); 


Route::group(['prefix' => 'student',  'middleware' => 'auth',  'middleware' => 'role:admin,student', 'as' => 'student.'], function() {
    
    Route::get('assigned-task', [App\Http\Controllers\AssignTaskController::class, 'assign_task'])->name('assign_task'); 
    Route::get('approved-disapproved-task', [App\Http\Controllers\AssignTaskController::class, 'approved_disapproved_task'])->name('approved_disapproved_task');
}); 


