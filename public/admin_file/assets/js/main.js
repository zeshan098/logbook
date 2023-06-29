/* all role */
$(document).ready(function (e) {
	$('#cust_register').click(function(e) {
	 e.preventDefault(); 
    var username = $("#username").val();
    var email = $("#useremail").val(); 
    var role = $("#role").val(); 
    var password = $("#password-input").val(); 
    if (username == "" || email == "" || password == "") {
        $(".invalid-feedback").show(); 
    } else { 
        $.ajax({
            url: "/user_register",
            type: "POST",
            data: {
                "_token": $('#token').val(),
                username: username,
                role: role,
                email: email, 
                password: password, 
            },
            
            success: function(data)
            {
                if(data.error)
                {
                // invalid file format.
                    Toastify({

                        text: data.error, 
                        duration: 3000,
                        class:"bg-danger",
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#dc3545",
                          },
                        }).showToast(); 
                    }
                else
                {
                    Toastify({

                        text: data.success,
                        className: "success",
                        duration: 3000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        
                        }).showToast(); 
                        $("#register_form")[0].reset(); 
                    
                }
            },
                
        });
    }
    });
});



/* Username Checek */
$(document).ready(function(){

    $("#username").keyup(function(){
      var token = $('input[name="_token"]').val(); 
       var username = $(this).val().trim(); 
       if(username != ''){ 
          $.ajax({
             url: 'check_username',
             type: 'post',
             data: {username: username, "_token": token},
             
             success: function(response){
    
                 $('#screenNameError').html(response);
                  
    
              }
          });
       }else{
          $("#screenNameError").html("");
           
       }
    
     });
    
  });
 
/* End Username checek */

/* Student / Teacher Login */
$(document).ready(function (e) {
    $('#cust_login').click(function(e) {
     e.preventDefault(); 
      var username = $("#username").val(); 
      var password = $("#password-input").val(); 
      $.ajax({
        url: "/user_login",
        type: "POST",
        data: {
          "_token": $('#token').val(),
          username: username,  
          password: password 
        },
        
        success: function(data)
        {
            if(data.error)
            {
                Toastify({

                    text: data.error, 
                    duration: 3000,
                    class:"bg-danger",
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#dc3545",
                    },
                    }).showToast(); 
            }
            else
            { 
            
                if(data.role == 'admin'){
                    window.location.href = "/admin/add_user";

                }else if(data.role == 'backoffice'){
                    window.location.href = "/backoffice/add_user";

                }else if(data.role == 'supervisor'){
                    window.location.href = "/supervisor/assign-task";

                }
                
                else{
                    window.location.href = "/student/assigned-task";

                }
            
            }
        },
              
      });
    });
});

 
 

///Add User 
$(document).ready(function () {
    $('#create_user').click(function (e) {
      e.preventDefault();
  
      var user_name = $("#user_name").val();
      var email = $("#useremail").val();
      var username = $("#username").val();
      var password = $("#password").val(); 
      var vocation = $("#vocation").val();
      var host_id = $("#host_id").val();
      var college = $("#college").val();
      var isValid = true;
  
      // Validation for each field
      if (user_name.trim() === '') {
        $('#user_name').addClass('is-invalid');
        isValid = false;
      } else {
        $('#user_name').removeClass('is-invalid');
      }
  
      if (email.trim() === '') {
        $('#useremail').addClass('is-invalid');
        isValid = false;
      } else {
        $('#useremail').removeClass('is-invalid');
      }
  
      if (username.trim() === '') {
        $('#username').addClass('is-invalid');
        isValid = false;
      } else {
        $('#username').removeClass('is-invalid');
      }
  
      if (password.trim() === '') {
        $('#password').addClass('is-invalid');
        isValid = false;
      } else {
        $('#password').removeClass('is-invalid');
      }
   
  
      if (vocation.trim() === '') {
        $('#vocation').addClass('is-invalid');
        isValid = false;
      } else {
        $('#vocation').removeClass('is-invalid');
      }
  
      if (host_id.trim() === '') {
        $('#host_id').addClass('is-invalid');
        isValid = false;
      } else {
        $('#host_id').removeClass('is-invalid');
      }
  
      if (college.trim() === '') {
        $('#college').addClass('is-invalid');
        isValid = false;
      } else {
        $('#college').removeClass('is-invalid');
      }
  
      if (!isValid) {
        return;
      }
  
      $.ajax({
        url: "register",
        type: "POST",
        data: {
          "_token": $('#token').val(),
          name: user_name,
          username: username,
          password: password, 
          email: email,
          vocation: vocation,
          host_id:host_id,
          college:college
        },
        success: function (data) {
          if (data.error) {
            Toastify({
              text: data.error,
              duration: 3000,
              class: "bg-danger",
              close: true,
              gravity: "top",
              position: "center",
              stopOnFocus: true,
              style: {
                background: "#dc3545",
              },
            }).showToast();
          } else {
            Toastify({
              text: data.success,
              className: "success",
              duration: 3000,
              close: true,
              gravity: "top",
              position: "center",
              stopOnFocus: true,
            }).showToast();
            location.reload();
          }
        },
      });
    });
  });


  //backofficr
  $(document).ready(function () {
    $('#create_backoffice').click(function (e) {
      e.preventDefault();
  
      var user_name = $("#user_name").val();
      var email = $("#useremail").val();
      var username = $("#username").val();
      var password = $("#password").val();  
      var isValid = true;
  
      // Validation for each field
      if (user_name.trim() === '') {
        $('#user_name').addClass('is-invalid');
        isValid = false;
      } else {
        $('#user_name').removeClass('is-invalid');
      }
  
      if (email.trim() === '') {
        $('#useremail').addClass('is-invalid');
        isValid = false;
      } else {
        $('#useremail').removeClass('is-invalid');
      }
  
      if (username.trim() === '') {
        $('#username').addClass('is-invalid');
        isValid = false;
      } else {
        $('#username').removeClass('is-invalid');
      }
  
      if (password.trim() === '') {
        $('#password').addClass('is-invalid');
        isValid = false;
      } else {
        $('#password').removeClass('is-invalid');
      }
   
   
  
      if (!isValid) {
        return;
      }
  
      $.ajax({
        url: "backoffice_register",
        type: "POST",
        data: {
          "_token": $('#token').val(),
          name: user_name,
          username: username,
          password: password, 
          email: email 
        },
        success: function (data) {
          if (data.error) {
            Toastify({
              text: data.error,
              duration: 3000,
              class: "bg-danger",
              close: true,
              gravity: "top",
              position: "center",
              stopOnFocus: true,
              style: {
                background: "#dc3545",
              },
            }).showToast();
          } else {
            Toastify({
              text: data.success,
              className: "success",
              duration: 3000,
              close: true,
              gravity: "top",
              position: "center",
              stopOnFocus: true,
            }).showToast();
            location.reload();
          }
        },
      });
    });
  });

  //backofficr
  $(document).ready(function () {
    $('#create_supervisor').click(function (e) {
      e.preventDefault();
  
      var user_name = $("#user_name").val();
      var email = $("#useremail").val();
      var username = $("#username").val();
      var password = $("#password").val();  
      var isValid = true;
  
      // Validation for each field
      if (user_name.trim() === '') {
        $('#user_name').addClass('is-invalid');
        isValid = false;
      } else {
        $('#user_name').removeClass('is-invalid');
      }
  
      if (email.trim() === '') {
        $('#useremail').addClass('is-invalid');
        isValid = false;
      } else {
        $('#useremail').removeClass('is-invalid');
      }
  
      if (username.trim() === '') {
        $('#username').addClass('is-invalid');
        isValid = false;
      } else {
        $('#username').removeClass('is-invalid');
      }
  
      if (password.trim() === '') {
        $('#password').addClass('is-invalid');
        isValid = false;
      } else {
        $('#password').removeClass('is-invalid');
      }
   
   
  
      if (!isValid) {
        return;
      }
  
      $.ajax({
        url: "supervisor_register",
        type: "POST",
        data: {
          "_token": $('#token').val(),
          name: user_name,
          username: username,
          password: password, 
          email: email 
        },
        success: function (data) {
          if (data.error) {
            Toastify({
              text: data.error,
              duration: 3000,
              class: "bg-danger",
              close: true,
              gravity: "top",
              position: "center",
              stopOnFocus: true,
              style: {
                background: "#dc3545",
              },
            }).showToast();
          } else {
            Toastify({
              text: data.success,
              className: "success",
              duration: 3000,
              close: true,
              gravity: "top",
              position: "center",
              stopOnFocus: true,
            }).showToast();
            location.reload();
          }
        },
      });
    });
  });
 
//Assign User
$(document).ready(function (e) {
    $('#assign_user').click(function(e) {
     e.preventDefault(); 
      var supervisor_id = $("#supervisor_id").val(); 
      var student_id = $("#student_id").val();  
      $.ajax({
        url: "register_assign_user",
        type: "POST",
        data: {
          "_token": $('#token').val(),
          supervisor_id: supervisor_id,
          student_id: student_id 
        },
        
        success: function(data)
        {
            if(data.error)
            {
                Toastify({
  
                    text: data.error, 
                    duration: 3000,
                    class:"bg-danger",
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        background: "#dc3545",
                    },
                    }).showToast(); 
            }
            else
            { 
            
              Toastify({
  
                text: data.success,
                className: "success",
                duration: 3000,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                
                }).showToast();  
                location.reload();
            
            }
        },
              
      });
    });
  });
  
  $(function() {

	$('.delete_assign_user').on('click',function(){
	     
	  var id = $(this).data('id');   
	  // AJAX request  
	  $("#del-service-field").val(id);    
	});
});


$('#delete-assign-record').click(function(e) {
	var id = $('#del-service-field').val(); 
	var token = $('input[name="_token"]').val(); 
	 
	 $.ajax({
		url:'delete_assign_user/'+id,
		method:"DELETE",
		data:{"id":id, "_token": token,},
		success: function (data){ 
			Toastify({

        text: data.success,
        className: "success",
        duration: 10000,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
      
      }).showToast();   
			location.reload();
		}
		})
		 
});

//Assign task backoffice
$(document).ready(function (e) {
	$('#assign_task_backoffice').click(function(e) {
	 e.preventDefault(); 
    var assign_to = $("#assign_to").val(); 
    var assign_by = $("#assign_by").val(); 
    var start_date = $("#start_date").val(); 
    var end_date = $("#end_date").val(); 
    var task_name = $("#task_name").val(); 
    var task_detail = $("#task_detail").val();  
    var status = $("#floatingSelect").val();  
    if (assign_to == "" || start_date == "" || end_date == "" || task_name == "" || task_detail == "" || status == "") {
        $(".invalid-feedback").show(); 
    } else { 
        $.ajax({
            url: "create_task",
            type: "POST",
            data: {
                "_token": $('#token').val(),
                assign_to: assign_to, 
                assign_by:assign_by,
                start_date : start_date, 
                end_date : end_date, 
                task_name : task_name, 
                task_detail : task_detail,
                status : status
            },
            
            success: function(data)
            {
                if(data.error)
                {
                // invalid file format.
                    Toastify({

                        text: "Something Wrong", 
                        duration: 3000,
                        class:"bg-danger",
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#dc3545",
                          },
                        }).showToast(); 
                    }
                else
                {
                    Toastify({

                        text: data.success,
                        className: "success",
                        duration: 3000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        
                        }).showToast();  
                        location.reload();
                    
                }
            },
                
        });
    }
    });
});


//Assign Task
$(document).ready(function (e) {
	$('#assign_task').click(function(e) {
	 e.preventDefault(); 
    var assign_to = $("#assign_to").val(); 
    var start_date = $("#start_date").val(); 
    var end_date = $("#end_date").val(); 
    var task_name = $("#task_name").val(); 
    var task_detail = $("#task_detail").val();  
    var status = $("#floatingSelect").val();  
    if (assign_to == "" || start_date == "" || end_date == "" || task_name == "" || task_detail == "" || status == "") {
        $(".invalid-feedback").show(); 
    } else { 
        $.ajax({
            url: "create_task",
            type: "POST",
            data: {
                "_token": $('#token').val(),
                assign_to: assign_to, 
                start_date : start_date, 
                end_date : end_date, 
                task_name : task_name, 
                task_detail : task_detail,
                status : status
            },
            
            success: function(data)
            {
                if(data.error)
                {
                // invalid file format.
                    Toastify({

                        text: "Something Wrong", 
                        duration: 3000,
                        class:"bg-danger",
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#dc3545",
                          },
                        }).showToast(); 
                    }
                else
                {
                    Toastify({

                        text: data.success,
                        className: "success",
                        duration: 3000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        
                        }).showToast();  
                        location.reload();
                    
                }
            },
                
        });
    }
    });
});


$(function() {

	$('.delete_assign_task').on('click',function(){
	     
	  var id = $(this).data('id');   
	  // AJAX request  
	  $("#del-service-field").val(id);    
	});
});


$('#delete-assign-task').click(function(e) {
	var id = $('#del-service-field').val(); 
	var token = $('input[name="_token"]').val(); 
	 
	 $.ajax({
		url:'delete_assign_task/'+id,
		method:"DELETE",
		data:{"id":id, "_token": token,},
		success: function (data){ 
			Toastify({

        text: data.success,
        className: "success",
        duration: 10000,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
      
      }).showToast();   
			location.reload();
		}
		})
		 
});


//Activity Log
$(function() {

	$('.show_activity').on('click',function(){
	  
	  var user_name = $(this).data('name');    
	  var id = $(this).data('id');     
	  var status = $(this).data('status'); 
	  console.log(status);
	  // AJAX request
	  $("#customer_name").html(user_name);  
	  $(".pop_id").val(id);  
	  $(".task_status").val(status);  
	});
});

$(function() {

	$('.show_activity').on('click',function(){
	  var id = $(this).data('id');
      var user_name = $(this).data('name');  
	  $.get('/get_activity/' + id , function (data) {
         
        console.log(data);
        $("#bodyData").empty();
        var bodyData = '';
        var i=1;
        $.each(data,function(index,row){
            const dateString = row.complete_date; // Assume the date is returned as a string in the "date" field
            const date = new Date(dateString);
            const formattedDate = date.toLocaleDateString("en-US", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit"
            }).split('/').join('-'); // Replace slashes with dots
           // console.log(formattedDate); 
            bodyData+="<div class='py-3 d-flex border-bottom'>"
            bodyData+="<div class='flex-grow-1 ms-3'>"
            bodyData+="<h6 class='mb-1'>"+user_name+" </h6>"
                    +"<p class='text-muted mb-2'>"+row.remarks+"</p>" 
                    +"<small class='mb-0 text-muted'> <i class='bx bx-calendar'></i>" +formattedDate+"</small>"
                    +"<small class='mb-0 text-muted'> <i class='bx bx-stopwatch'></i>"+row.start_time + " - " + row.end_time +"</small>";
                    bodyData+="</div>";
                    bodyData+="</div>";
                    
        })
        $("#bodyData").append(bodyData);
     }) 
	   
	});
});


 

$(document).ready(function (e) {
	$('#add_activity').click(function(e) {
	 e.preventDefault(); 
    var cust_id = $(".pop_id").val();  
    var call_type = $("#call_type").val();   
    var msg = $("#meassageInput").val();    
    var start_time = $("#start_time").val();  
    var end_time = $("#end_time").val(); 
    if (call_type == "" || msg == "" || start_time == "" || end_time == "") {
        
      Toastify({
        text: "Please enter Detail",
        duration: 3000,
        class: "bg-danger",
        close: true,
        gravity: "top",
        position: "center",
        stopOnFocus: true,
        style: {
          background: "#dc3545",
        },
      }).showToast();
      return;
    } else { 
        $.ajax({
            url: "/save_activity",
            type: "POST",
            data: {
                "_token": $('#token').val(),
                cust_id: cust_id,  
                call_type: call_type, 
                msg:msg,
                start_time:start_time,
                end_time:end_time
            },
            
            success: function(data)
            {
                if(data.error)
                {
                // invalid file format.
                    Toastify({

                        text: "Something Wrong", 
                        duration: 3000,
                        class:"bg-danger",
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#dc3545",
                          },
                        }).showToast(); 
                    }
                else
                {
                    Toastify({

                        text: data.success,
                        className: "success",
                        duration: 5000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        
                        }).showToast(); 
                        $("#my-form")[0].reset(); 
                        location.reload();
                    
                }
            },
                
        });
    }
    });
});


//Super Visor Activity
$(function() {

	$('.show_activity_super').on('click',function(){
	  
	  var user_name = $(this).data('name');    
	  var id = $(this).data('id');  
	  var status = $(this).data('status'); 
	  console.log(user_name);
	  // AJAX request
	  $("#customer_name").html(user_name);  
	  $(".pop_id").val(id);  
	  $(".task_status").val(status);  

      // if (status === "approved" || status === "dis_approved") {
      //     $("#my-form").hide();
      // } else {
      //     $("#my-form").show();
      // }
	});
});


$(function() {

	$('.show_activity_super').on('click',function(){
	  var id = $(this).data('id');
      var user_name = $(this).data('name');  
	  $.get('/get_activity_super/' + id , function (data) {
         
        console.log(data);
        $("#bodyData").empty();
        var bodyData = '';
        var i=1;
        $.each(data,function(index,row){
            const dateString = row.complete_date; // Assume the date is returned as a string in the "date" field
            const date = new Date(dateString);
            const formattedDate = date.toLocaleDateString("en-US", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit"
            }).split('/').join('-'); // Replace slashes with dots
           // console.log(formattedDate); 
            bodyData+="<div class='py-3 d-flex border-bottom'>"
            bodyData+="<div class='flex-grow-1 ms-3'>"
            bodyData+="<h6 class='mb-1'>"+user_name+" </h6>"
                    +"<p class='text-muted mb-2'>"+row.remarks+"</p>" 
                    +"<small class='mb-0 text-muted'> <i class='bx bx-calendar'></i>" +formattedDate+"</small>"
                    +"<small class='mb-0 text-muted'> <i class='bx bx-stopwatch'></i>"+row.start_time + " - " + row.end_time +"</small>";
                    bodyData+="</div>";
                    bodyData+="</div>";
                    
        })
        $("#bodyData").append(bodyData);
     }) 
	   
	});
});


$(document).ready(function (e) {
	$('#super_task_activity').click(function(e) {
	 e.preventDefault(); 
    var cust_id = $(".pop_id").val();  
    var call_type = $("#call_type").val();   
    if (call_type == "") {
        $(".invalid-feedback").show(); 
    } else { 
        $.ajax({
            url: "/supervisor_save_activity",
            type: "POST",
            data: {
                "_token": $('#token').val(),
                cust_id: cust_id,  
                call_type: call_type 
            },
            
            success: function(data)
            {
                if(data.error)
                {
                // invalid file format.
                    Toastify({

                        text: "Something Wrong", 
                        duration: 3000,
                        class:"bg-danger",
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        style: {
                            background: "#dc3545",
                          },
                        }).showToast(); 
                    }
                else
                {
                    Toastify({

                        text: data.success,
                        className: "success",
                        duration: 3000,
                        close: true,
                        gravity: "top", // `top` or `bottom`
                        position: "center", // `left`, `center` or `right`
                        stopOnFocus: true, // Prevents dismissing of toast on hover
                        
                        }).showToast(); 
                        $("#my-form")[0].reset(); 
                        location.reload();
                    
                }
            },
                
        });
    }
    });
});


//Assign Host / Company 
$(document).ready(function () {
    $('#add_host_info').submit(function (e) {
      e.preventDefault();
      
      var company_name = $("#company_name").val();
      
      // Validate if company_name is empty
      if (company_name.trim() === '') {
        Toastify({
          text: "Please enter Host",
          duration: 3000,
          class: "bg-danger",
          close: true,
          gravity: "top",
          position: "center",
          stopOnFocus: true,
          style: {
            background: "#dc3545",
          },
        }).showToast();
        return;
      }
      
      $.ajax({
        url: "create_host",
        type: "POST",
        data: {
          "_token": $('#token').val(),
          company_name: company_name
        },
        success: function (data) {
          if (data.error) {
            Toastify({
              text: data.error,
              duration: 3000,
              class: "bg-danger",
              close: true,
              gravity: "top",
              position: "center",
              stopOnFocus: true,
              style: {
                background: "#dc3545",
              },
            }).showToast();
          } else {
            Toastify({
              text: data.success,
              className: "success",
              duration: 3000,
              close: true,
              gravity: "top",
              position: "center",
              stopOnFocus: true,
            }).showToast();
            location.reload();
          }
        },
      });
      
      // Submit the form after the AJAX request is completed
      //$(this).off('submit').submit();
    });
  });
  
$(function() {

	$('.delete_host').on('click',function(){
	     
	  var id = $(this).data('id');   
	  // AJAX request  
	  $("#del-service-field").val(id);    
	});
});


$('#delete-host-record').click(function(e) {
	var id = $('#del-service-field').val(); 
	var token = $('input[name="_token"]').val(); 
	 
	 $.ajax({
		url:'delete_host/'+id,
		method:"DELETE",
		data:{"id":id, "_token": token,},
		success: function (data){ 
			Toastify({

        text: data.success,
        className: "success",
        duration: 10000,
        close: true,
        gravity: "top", // `top` or `bottom`
        position: "center", // `left`, `center` or `right`
        stopOnFocus: true, // Prevents dismissing of toast on hover
      
      }).showToast();   
			location.reload();
		}
		})
		 
});
