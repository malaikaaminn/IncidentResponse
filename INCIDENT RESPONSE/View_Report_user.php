<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<button id="back" style="background-color: "><a href="getReport_user.php" style="color:">Back</a></button><div style="margin-top:10px; style : center" >
<style>
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}	
.modal form label {
	font-weight: normal;
}
	
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>INCIDENT REPORT</h2>

<table>
  <tr>
    <th>Incident No</th>
    <th>Type</th>
    <th>Date</th>
    <th><b>state</b></th>
  </tr>


<?php

                $servername = "localhost";
		$username = "vk"; // Mysql username
		$password = "123";	// Mysql Password

		$dbname = "incidentresponse";	// database name
		 
		
		$con = new mysqli($servername, $username, $password, $dbname);
 
                $incident_number = $_GET['incident_no'];
              
              
               
                $query = "SELECT * FROM incident where incident_id = '$incident_number'";
                $res=mysqli_query($con,$query);
                $row=$res->fetch_assoc();

                $incident_no = $row['incident_id'];
                $incident_type = $row['incident_type'];
                $incident_Date = $row['date_created'];
                $incident_state = $row['state'];
 

?>

<tr>
    <td><?php echo $incident_no ?></td>
    <td><?php echo $incident_type ?></td>
    <td><?php echo $incident_Date ?></td>
    <td><?php echo $incident_state ?></td>
  </tr>

  
</table>
<br>
<br>



<br>
<br>
<br>
<form method="post">
<button type="submit" name="submit1">ADD COMMENT</button>
</form>

<?php

$user=$_SESSION['login_user'];
if(isset($_POST["submit1"])){

?>
<br>
<form method="post">
  <label for="comment_id">Comment Id:</label><br>
  <input type="text" id="comment_id" name="comment_id" value="ID"><br>
 
  <label for="desc">Description:</label><br>
  <input type="text" id="descrip" name="descrip" value="Description"><br><br>
  <button type="submit" name="submit2">ADD</button> 
</form> 

<?php


}
$incident_number = $_GET['incident_no'];
if(isset($_POST["submit2"])){

$comm_id=$_POST['comment_id'];

$comm_desc=$_POST['descrip'];
$query="insert into comment(incident_id,username,comment_id,description) VALUES ('$incident_number','$user','$comm_id','$comm_desc')";
$res=mysqli_query($con,$query);


}

?>
<br>
<br>
<br>


<br>
<br>
<br>
<table>

<tr>
    <th>COMMENTS</th>
</tr>
<tr>
    <th>Comment Id </th>
<th>Comment</th>
<th>Time Recorded </th>
</tr>

<?php

$query = "SELECT * FROM comment where incident_id = '$incident_number' ORDER by time_recorded desc";
$res=mysqli_query($con,$query);

while ($row=mysqli_fetch_assoc($res)) {

$comment_id = $row['comment_id'];
$comment_desc = $row['description'];
$comment_time = $row['time_recorded'];

?>
<tr>
    <td><?php echo $comment_id ?></td>
    <td><?php echo $comment_desc ?></td>
    <td><?php echo $comment_time ?></td>
  </tr>

<?php

}

?>



</table>







<table>
<br>
<br>
<tr>
    <th>Ip Address Associated</th>
</tr>
<tr>
    <th>Ip Address </th>
    <th>Association </th>
</tr>

<?php

$query = "SELECT * FROM incident_ip where incident_id = '$incident_number'";
$res=mysqli_query($con,$query);

while ($row=mysqli_fetch_assoc($res)) {

$incident_ip = $row['ip_address'];
$incident_assoc = $row['association'];

?>

<tr>
    <td><?php echo $incident_ip ?></td>
    <td><?php echo $incident_assoc ?></td>
  </tr>

<?php

}

?>

</table>
<br>
<br>





<table>

<tr>
    <th>Person Associated</th>
</tr>
<tr>
    <th>Person Email </th>
    <th>Association </th>
</tr>

<?php

$query = "SELECT * FROM incident_person where incident_id = '$incident_number'";
$res=mysqli_query($con,$query);

while ($row=mysqli_fetch_assoc($res)) {

$incident_email = $row['person_email'];
$incident_assoc = $row['association'];

?>

<tr>
    <td><?php echo $incident_email ?></td>
    <td><?php echo $incident_assoc ?></td>
  </tr>

<?php

}

?>

</table>
