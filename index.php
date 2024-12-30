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
    </style>
</head>
<body>
    <table id="main" border="0px" cellpspacing="0px">
        <tr>
            <td id="header">
                <h1>Add Records with php & ajax</h1></td>
        </tr>

        <tr>
            <td id="tableform"><form id="formfields">
                First Name : <input type="text" name="fname" id="fname">
                Last Name :<input type="text" name="lname" id="lname">
                <input type="submit" id="btn" value="Save"> 
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
                    },
                    complete :function(xhr,status){
                        console.log(xhr.status);
                        console.log(status);
                    }
                }); // ajax function
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
                        $(element).closest("tr").fadeOut();
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


        }); // ready function close
    </script>
</body>
</html>