<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud ajax</title>
    <style>
        body{
            margin: 0px;
            padding: 0px;
            background-color: wheat;
            font-family: Arial, Helvetica, sans-serif;
        }
        #main{
            margin-left: 30%;
            background-color: white;
            text-align: center;
        }
        #formfields input{
            border-radius: 20px;
        }
        #header{
            background-color: yellow;
        }
        #tableform{
            background-color: lightblue;
            padding: 15px;
        }
        #table-data th{
            background-color: blue;
            color: white;
        }
        #modal{
		 background: rgba(0, 0, 0, 0.7);
		 position: fixed;
		 left: 0;
		 top: 0;
		width: 100%;
		height: 100%;
		z-index: 100;
        display: none;
		
		}
		#modal-form{
			background: #fff;
			width:40%;
			position: relative;
			top:15%;
			left: calc(60% - 20%);
			padding: 15px;
			border-radius: 4px;
		}   
		#modal-form h2{
  			margin: 0 0 15px;
  			padding-bottom: 10px ;
  			border-bottom: 1px solid black;
		}
        #close-btn{
			background: red;
			color: white;
			width: 30px;
			height: 30px;
			line-height: 30px;
			text-align: center;
			border-radius: 50px;
			position: absolute;
			top: -15px;
			right: -15px;
			cursor: pointer;
		}
        #modal-form table input{
            border-radius: 20px;
            margin:6px;
        }
        #update-btn{
            background-color: green;
            color: white;
        }
       
      
    </style>
</head>
<body>
   
<div id="modal">
			<div id="modal-form">
				<h2>Edit From</h2>
				<table cellpadding="10px" width="100%">
                    
				</table>
				<div id="close-btn" style="margin-top:20px" >X</div>
			</div>
		</div>


    <table id="main" border="0px" cellpspacing="0px">
        <tr>
            <td id="header">
                <h1>Add Records with php & ajax</h1></td>
        </tr>

        <tr>
            <td id="tableform">
                 <form id="formfields">
                  First Name : <input type="text" name="fname" id="fname">
                  Last Name :<input type="text" name="lname" id="lname">
                  <input type="submit" id="btn" style="background-color:green;color:white" value="Save"> 
                </form>
            </td>
        </tr>
        
        <tr>
            <td id="table-data">
              
            </td>
        </tr>
    </table>

    <script src="js/jquery.js"></script>
    <script>
        $(document).ready(function(){
    // 1 step ->  fetch data from database 
              function loadtable(){
                 $.ajax({
                    url : "ajax-load.php",
                    type : 'GET',
                    success : function(data){
                    $("#table-data").html(data);
                    }
                    
                }); // ajax functions
            } // loadtable function
            loadtable();  // call load table function

            // 2 step ->  this is for submit the data after btn click
            $("#btn").on("click",function(e){
                e.preventDefault();  
                var fname = $("#fname").val();
                var lname = $("#lname").val();

                if(fname == "" || lname ==""){
                    alert("all fileds are required");
                } else{ 
                  $.ajax({
                    url : "ajax-insert.php",
                    type : "POST",
                    data : {firstname : fname ,  lastname : lname},
                    success : function(data){          
                            if(data==1){
                                $("#formfields").trigger("reset");
                                loadtable();
                            }else{
                                alert("Failed");
                            }
                    },
                   
            // complete function return status code of ajax request whatever request  is success or failed it run both cases 
                    complete :function(xhr,status){
                        console.log(xhr.status);
                        console.log(status);
                    }
                });
            } // else statement off
            }); // form btn function 

 // 3 step ->  this is for delete button (delete a data from database)
            $(document).on("click",".delete-btn",function(){
                var userid = $(this).data("did");
                var element = this;

                $.ajax({
                    url : "ajax-delete.php",
                    type : "POST",
                    data : {id : userid},
                    success  : function(data){
                        if(data==1){
                        $(element).closest("tr").fadeOut(1000);
                        }else{
                            alert("failed");
                        }
                    }, 

                    complete :function(xhr,status){
                        console.log(xhr.status);
                        console.log(status);
                    }
                });
            });

        
   // 4 step ->  this is for edit the user data 
                $(document).on("click",".edit-btn",function(e){
                        $('#modal').slideDown(2000);
                        var user_id = $(this).data("eid");
            
                      // fetch user data from database for showing the data into input filed so user can easily modify the details
                        $.ajax({
                            url : "edit-data.php",
                            type : "GET",
                            data : {id : user_id},
                            success :function(data){
                                $("#modal-form table").html(data);
                            },
                            complete : function(xhr,status){
                                console.log(status);
                                console.log(xhr.status);
                            }
                        });

                });     
                
  // step 5 -> this is for close the modal box               
                $("#close-btn").click(function(e){
                    $("#modal").slideUp(2000);
                });

  // step 6 -> this code is update butoon after changing/ modified the user data when we click the update button
             $(document).on("click","#update-btn",function(e){
                    e.preventDefault();
                var user_id = $(this).data('uid');
                var fname = $("#first_name").val();
                var lname = $("#last_name").val();
                
                $.ajax({
                    url : "update-data.php",
                    type : "POST",
                    data : { id : user_id ,first_name:fname , last_name:lname},
                    success  : function(data){
                        if(data==1){
                            $("#modal").slideUp(1000);
                            loadtable();
                        }else{
                            alert("failed");
                            $("#modal").slideUp();
                        }
                    },
                    complete : function(xhr,status){
                        console.log(xhr.status);
                        console.log(xhr.statusText);
                    }
                });

             });
    

        }); // ready function close
    </script>
</body>
</html>