<?php
session_start();
$servername = "localhost";
		$username = "vk"; // Mysql username
		$password = "123";	// Mysql Password

		$dbname = "incidentresponse";	// database name
		 
		
		$con = new mysqli($servername, $username, $password, $dbname);

?>

<html lang = "en">
<head>
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-repeat: no-repeat;
  background-image: url('abc.jpg');
  background-attachment: fixed;
  background-position: center;
  background-color: black;
  background-size: cover;
}
</style>
<title> CSIRT Login Page User/Admin </title>
<link rel = "stylesheet" type = "text/css" href = "home.css"/>
</head>
<body>
   <h1><br><br><br><br> INCIDENT TRACKING SYSTEM </h1>
<div align="center" class="login">
<form action="" method="POST">

  <div class="UsernamePassword">
    <b>USERNAME<br></b><input type="text" name="user"><br><br>
    <b>PASSWORD<br></b><input type="password" name="pass"><br><br>
  </div>

  <div class = "Login">
    <input type="submit" name="submit" value="Login">
  </div>

</form>
</div>
</body>

<style type="text/css">


input[type=text]:focus {
    border: 1px solid #555;
}

input[type=text] {
  width: 200px;
  height: 30px;
}

input[type=password] {
  width: 200px;
  height: 30px;
}

.Login input[type=button], input[type=submit], input[type=reset] {
    background-color: #0464ff;
    border: 1px;
    color: white;
    padding: 16px 144px;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    position: center;
    font-size: 16px;
    width: 200px;
}

.Login {
  height: 50%;
display: flex;
align-items: center;
justify-content: center
}

.UsernamePassword {
  top: 50%;
}


</style>

<?php
if(isset($_POST["submit"])){

$user=$_POST['user'];
$pass=$_POST['pass'];


        if($user=='admin' && $pass=='123'){
                $_SESSION['login_user'] = $user;
                echo "<script> location.href='home_admin.php'; </script>";
                exit;	
        } 
	
        else{
        $sql = mysqli_query($con,"SELECT * FROM incident_responder WHERE username = '$user' AND password = '$pass'");

	
	$row = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        
	
        if (mysqli_num_rows($sql) == 1)
        {
	        $_SESSION['login_user'] = $user;
                echo "<script> location.href='home_user.php'; </script>";
                exit;	
        }
        else
        {
		 ?> <h2>Invalid Login. Please try again!</h2> <?php
                  header("refresh: 0; url = index.php");	// if invalid login, user is redirected to login page
        }
        }

}
else{
echo "<script>alert('Please Enter the correct credentials!')</script>";
}

?>
 <p style="text-align:center;"> <a href="create.php" ><b>CREATE AN ACCOUNT</b></a></p><button style="float:right;" >

</html>
