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
            <td id="tableform">
                First Name : <input type="text" name="fname" id="fname">
                Last Name :<input type="text" name="lname" id="lname">
                <input type="submit" id="btn" value="Save"> 
            </td>
        </tr>
        
        <tr>
            <td id="table-data">
             <table border="1px solid black" width="100%" cellspacing="0px" cellpadding="10px">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ashok negi</td>
                </tr>
             </table>
            </td>
        </tr>
    </table>
</body>
</html>