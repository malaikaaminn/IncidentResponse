<!DOCTYPE html>
<html>
<head>
<button id="back" style="background-color: "><a href="home_user.php" style="color:">Back</a></button><div style="margin-top:10px; style : center" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
}

* {
  box-sizing: border-box;
}

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
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

<h2>Get Full Incident Report</h2>


<!-- <form class="example" action="/action_page.php">
  <input type="text" placeholder="Enter Incident no" name="search">
  <button type="submit"><i class="fa fa-search"></i></button>
</form> -->

<br>
<br>
<br>
<form action="/View_Report_user.php" method="get">
  <input type="text" name="incident_no" placeholder="Enter Incident No" name="search2">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>
<br>
<br>
<br>
<br>
<table>
  <tr>
    <th>Incident No</th>
    <th>Date</th>
    <th>state</th>
  </tr>

<?php

                $servername = "localhost";
		$username = "vk"; // Mysql username
		$password = "123";	// Mysql Password

		$dbname = "incidentresponse";	// database name
		 
		
		$con = new mysqli($servername, $username, $password, $dbname);


		 

$query = "SELECT * FROM incident";
$res=mysqli_query($con,$query);

while ($row=mysqli_fetch_assoc($res)) {

$incident_id = $row['incident_id'];
$incident_title = $row['incident_title'];
$incident_date = $row['date_created'];
$incident_state = $row['state'];


?>

   <tr>
    <td><?php echo $incident_id ?></td>
    <td><?php echo $incident_title ?></td>
    <td><?php echo $incident_date ?></td>
    <td><?php echo $incident_state ?></td>
  </tr>

<?php

}

?>




</table>

</body>
</html> 
