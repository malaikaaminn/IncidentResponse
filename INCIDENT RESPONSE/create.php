<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;background-repeat: no repeat;
  background-size: 100%;
}
form {border: 0px solid #f1f1f1;}
h2{font-size: 50px;
text-align:center; }
input[type=text], input[type=password],  input[type=EMAIL] {
    width: 20%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 10%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>

<h1 style="text-align:center;"><b>CREATE AN ACCOUNT</b></h1>
  <form action="create.php" method="post">
  <div class="imgcontainer">
   
  </div>

  <div class="container" style="text-align:center;">
    <label for="uname" ><b> Enter first name:    </b></label>
    <input type="text" placeholder="Enter first name" name="first_name" required style="text-align:center;"><br><br>
    <label for="uname" ><b> ENTER last name:</b></label>
    <input type="text" placeholder="last name" name="last_name" required style="text-align:center; width: 300px;height: 25px;"><br><br>
    <label for="uname" ><b> Username:    </b></label>
    <input type="text" placeholder="Type here" name="username" required style="text-align:center;"><br><br>
    <label for="uname" ><b>password:</b></label>
    <input type="password" placeholder="****" name="pass" required style="text-align:center;"><br><br>


   
    <button type="submit" name="submit1" style="text-align:center;background-color:green;color:white;">SUBMIT</button><br><button1 style="float:center;" >Already have an Acoount <a href="index.php">login</a></button1>
   
  </div>

<?php

                $servername = "localhost";
		$username = "vk"; // Mysql username
		$password = "123";	// Mysql Password

		$dbname = "incidentresponse";	// database name
		 
		
		$con = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST["submit1"])){

$person_fname=$_POST['first_name'];
$person_lname=$_POST['last_name'];
$person_username=$_POST['username'];
$person_password=$_POST['pass'];

$query="insert into incident_responder (lastname,firstname,username,password) VALUES ('$person_fname','$person_lname','$person_username','$person_password')";
$res=mysqli_query($con,$query);

if($res){
echo "<script>alert('ACCOUNT CREATED!')</script>";
}

}

?>

</body>
</html>