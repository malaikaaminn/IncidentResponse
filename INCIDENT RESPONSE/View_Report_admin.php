<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<button id="back" style="background-color: "><a href="getReport_admin.php" style="color:">Back</a></button><div style="margin-top:10px; style : center" >
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


<form method="post">
  <label for="state">EDIT Incident State:</label>
  <select id="text" name="incident">
    <option value="empty"></option>
    <option value="open">Open</option>
    <option value="closed">Closed</option>
    <option value="stalled">Stalled</option>
  </select>
  <br><br>
  <button type="submit" name="submit">CHANGE STATE</button> 
  

</form>

<?php
$incident_number = $_GET['incident_no'];
//echo "<script>alert('RUNS/WICKETS UPDATED $incident_number')</script>";
if(isset($_POST["submit"])){
 $type=$_POST['incident'];

 $query="update incident SET state='$type' where incident_id='$incident_number'";
 $res=mysqli_query($con,$query);


}

?>
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
<form method="post">
<button type="submit" name="submit3">Remove IP ADDRESS</button>
<button type="submit" name="submit5">Add IP ADDRESS</button>
</form>

<?php

if(isset($_POST["submit3"])){

?>

<form method="post">
<label for="remove_ip">Ip Address:</label><br>
  <input type="text" id="remove_ip" name="remove_ip" placeholder="192.168.1.0"><br>
  <button type="submit" name="submit4">REMOVE</button> 
</form>

<?php
}
if(isset($_POST["submit4"])){

$inc_ip=$_POST['remove_ip'];

$query="DELETE from incident_ip WHERE ip_address='$inc_ip'";
$res=mysqli_query($con,$query);

if($res){
echo "<script>alert('IP ADDRESS DELETED!')</script>";
}
else{
echo "<script>alert('Ip address not FOUND! Please type again')</script>";
}
}
?>

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
    <td><?php echo $commenter_name ?></td>
    <td><?php echo $comment_desc ?></td>
    <td><?php echo $comment_time ?></td>
  </tr>

<?php

}

?>



</table>





<?php

if(isset($_POST["submit5"])){

?>

<form method="post">
  <label for="ip_address">IP ADDRESS:</label><br>
  <input type="text" id="ip_address" name="ip_address" placeholder="192.168.1.1"><br>
  <label for="assoc">Association:</label><br>
  <input type="text" id="assoc" name="assoc" placeholder="Type Here"><br><br>
 
  <button type="submit" name="submit6">ADD</button> 
</form> 

<?php
}

$incident_number = $_GET['incident_no'];
if(isset($_POST["submit6"])){

$ip_add=$_POST['ip_address'];
$ip_assoc=$_POST['assoc'];

$query="insert into incident_ip(incident_id,ip_address,association) VALUES ('$incident_number','$ip_add','$ip_assoc')";
$res=mysqli_query($con,$query);

if($res){
echo "<script>alert('IP ADDRESS ADDED!')</script>";
}
else{
echo "<script>alert('Please fill all the fields!')</script>";
}
}

?>

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
<form method="post">
<button type="submit" name="submit7">Remove Person</button>
<button type="submit" name="submit8">Add Person</button>
</form>
<br>
<?php

if(isset($_POST["submit8"])){

?>

<form method="post">
  <label for="person_email">Person Email:</label><br>
  <input type="text" id="person_email" name="person_email" placeholder="abc@gmail.com"><br>
  <label for="last_name">Last Name:</label><br>
  <input type="text" id="last_name" name="last_name" placeholder="Last Name"><br>
  <label for="first_name">First Name:</label><br>
  <input type="text" id="first_name" name="first_name" placeholder="First Name"><br>
  <label for="job_title">Job Title:</label><br>
  <input type="text" id="job_title" name="job_title" placeholder="Job"><br>s
  <label for="person_email">Association:</label><br>
  <input type="text" id="assoc1" name="assoc1" placeholder="type here"><br><br>
  <button type="submit" name="submit9">ADD</button> 
</form> 

<?php
}

if(isset($_POST["submit9"])){
$person_email=$_POST['person_email'];
$person_last=$_POST['last_name'];
$person_first=$_POST['first_name'];
$person_job=$_POST['job_title'];
$person_assoc=$_POST['assoc1'];

$query="insert into person(person_email,last_name,first_name,job_title) VALUES ('$person_email','$person_last','$person_first','$person_job')";
$res=mysqli_query($con,$query);

$query="insert into incident_person(incident_id,person_email,association) VALUES ('$incident_number','$person_email','$person_assoc')";
$res1=mysqli_query($con,$query);

if($res1){
echo "<script>alert('PERSON ADDED!')</script>";
}
else{
echo "<script>alert('Please fill all the fields first!')</script>";
}

}

?>

<?php

if(isset($_POST["submit7"])){

?>

<form method="post">
  <label for="person_email">Person Email:</label><br>
  <input type="text" id="person_email2" name="person_email2" placeholder="abc@gmail.com"><br>
  <button type="submit" name="submit10">Remove</button> 
</form>
<?php
}

if(isset($_POST["submit10"])){

$person_email2=$_POST['person_email2'];

$query="Delete from incident_person where person_email='$person_email2'";
$res=mysqli_query($con,$query);

if($res){
echo "<script>alert('PERSON DELETED!')</script>";
}
else{
echo "<script>alert('please enter the correct email to remove the person from the record!')</script>";
}

}

?>


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
