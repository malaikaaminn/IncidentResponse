<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <title>New Incident Report</title>
    <link rel="stylesheet" type="text/css" href="NewIncident.css"/>


  </head>
<style>
body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background-repeat: no-repeat;
  background-image: url('newincident.jpg');
  background-attachment: fixed;
  background-position: center;
  background-color: black;
  background-size: cover;
}
</style>

  <p style="font-size:50px;text-align:center;"><b>NEW INCIDENT FORM</b></p>
  <form action = "NewIncident.php" method = "POST">
    <span class="SectionTitle" required>&nbsp;Incident Title</span>
    <div class="Section">
      <br>
      <input type = "text" style = "width: 50%" name = "IncidentTitle" placeholder="simple name" required>
      <br><br>
    </div>

      
      <br>

      <script type="text/javascript">
        function more_contacts() {
          var objTo = document.getElementById('room_fields')
          var divtest = document.createElement("div");
          divtest.innerHTML = '<div class="label"><br><br><hr/><center>Additional contact:<center/></div><hr/><div class="row"><div class="col"><span>Last name <input type="text" size=70% name="LastName"/></span></div><div class="col"><span>First name <input type="text" size=68% name="FirstName"></span></div></div><div class="row"><br><div class="col"><span>Email Address <input type="text" size=64% name="Email"></span></div><div class="col"><span>Job Title <input type="text" size=69% name="Job"></span></div></div><br><div class="row"><div class="col"><span><span>Relation to Incident <input type="text" size=54% name="relation"></span></div>\r\n';
          objTo.appendChild(divtest);
        }
      </script>
      <br>

     
      <script type="text/javascript">
        function add_ip() {
          var objTo = document.getElementById('room_fields')
          var divtest = document.createElement("div");
          divtest.innerHTML = '<div class="label"><br><br><hr/><center>Additional IP Address: <center/></div><hr/><span>IP Address: </span><input type="text" size=66% name="IP"/><span> Relation to Incident <input type="text" size=57% name="relation"></span></div>\r\n';
          objTo.appendChild(divtest);
        }
      </script>


     

   
      <span class="SectionTitle">&nbsp;Participant Information</span>

     

      <div id="room_fields">
          <div class="row">
            <br>
            <div class="col">
              <span>Last name    <input type="text" size=65% name="LastName"></span>
            </div>
 <br>
            <div class="col">
              <span>First Name <input type="text" size=65% name="FirstName"></span>
            </div>
          </div>
 

          <div class="row">
              <br>
              <div class="col">
                <span>Email Address <input type="text" size=60% name="Email"></span>
              </div>
 <br>
              <div class="col">
                <span>Job Title <input type="text" size=60% name="Job"></span>
              </div>
          </div>
          <div class="row">
            <br>
            <div class="col">
              <span>    Relation with the Incident <input type="text" size=50% name="Relation"></span>
            </div>
          </div>

          <br><br>
          <span> or </span>
<br>
          <br>

          <div id="ip">
            <span>IP Address: <input type = "text" size=50% name="ip" placeholder="192.168.0.0"></span>
            <span>          Relation to Incident <input type="text" size=70% name="ipRelation"></span>
          </div>
      </div>
 <br>
 <br>

      <div class="AddMoreFields">
        <div class="AddContacts" style="width:50%;display:inline;">
          <br>
          <input type="button" id="more_fields" onclick="more_contacts();" value="Add Participant" />
        </div>

        <div class="AddIP" style="width:50%;display:inline;">

          <input type="button" id="more_fields" onclick="add_ip();" value="Add IP" />
        </div>
      </div>
   

  
      <script type="text/javascript">
          function showfield(name) {
              if (name == 'Other') document.getElementById('IfOther').style.display = "block";
              else document.getElementById('IfOther').style.display = "none";
          }
          function hidefield() {
              document.getElementById('IfOther').style.display = 'none';
          }
      </script>
      <br>

      <body onload="hidefield()">

   
      <span class="SectionTitle">&nbsp;Incident Category</span>
      <div class="Section">
        <br>
        <select name="Category" onchange="showfield(this.options[this.selectedIndex].value)" required>
            <option value="" disabled selected>Select One</option>
<?php
                $servername = "localhost";
		$username = "vk"; // Mysql username
		$password = "123";	// Mysql Password

		$dbname = "incidentresponse";	// database name
		 
		
		$con = new mysqli($servername, $username, $password, $dbname);
                
                $query="select * from incident";
                $res=mysqli_query($con,$query);
                while ($row=mysqli_fetch_assoc($res)) {
                 $incident_type = $row['incident_type'];

?>
            <option value=<?php echo $incident_type ?>><?php echo $incident_type ?></option>
<?php

}

?>
            <option value="Other">Other</option>
        </select>
      </div>

      <!--Script reacts here: if other -> specify-->
      <div id="IfOther"><br>If Other, please specify:
          <input type="text" name="Specify"/>
      </div>
      <br><br>
         <div class="col">
              <span>Comment Id: <input type="text" size=68% name="comment_id"></span>
            </div>
<br>

      <!--Description of the Incident-->
      <span class="SectionTitle">&nbsp;Description:</span>
      <div class="Section">
        <br>
        <textarea name="textarea" style = "width: 80%; height:100px;" placeholder="Tell us about the incident..." required></textarea>
      </div>

      <!--Submit Button-->
      <div class="SubmitTicket">
        <br><input type="submit" name="submit" value="Submit" >
      </div>

    </form>
    <br><br><br><br>

<?php
$user=$_SESSION['login_user'];

                $servername = "localhost";
		$username = "vk"; // Mysql username
		$password = "123";	// Mysql Password
		$dbname = "incidentresponse";	// database name
		$con = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST["submit"])){

        if (isset($_REQUEST['IncidentTitle']))
          {$IncidentTitle = $_REQUEST['IncidentTitle'];
        }    
        if (isset($_REQUEST['Category']))
          {$Category = $_REQUEST['Category'];
        }
      

        # Sets Participant's last name, first name, email, job, and reason for association to the incident to be stored into the db
        if (isset($_REQUEST['LastName']))
        {       $LastName = $_REQUEST['LastName'];      
        }
        if (isset($_REQUEST['FirstName']))
        {       $FirstName = $_REQUEST['FirstName'];    
        }
        if (isset($_REQUEST['Email']))
        {       $Email = $_REQUEST['Email'];    }

        if (isset($_REQUEST['Job']))
        {       $Job = $_REQUEST['Job'];        }

        if (isset ($_REQUEST['Relation']))
        {       $Relation = $_REQUEST['Relation'];     }


	# Sets description to be entered into comments table
        if (isset($_REQUEST['textarea']))
        {       $textarea = $_REQUEST['textarea'];      }

        if (isset($_REQUEST['comment_id']))
        {       $commentid = $_REQUEST['comment_id'];      }

	# Sets ip address and reason for its association to the incident
	if (isset($_REQUEST['ip']))
        {       $IP = $_REQUEST['ip'];        }

        if (isset ($_REQUEST['ipRelation']))
        {       $ipRelation = $_REQUEST['ipRelation'];     }

$sql_1 = "INSERT INTO `incident` (incident_type, date_created, state, incident_title ) VALUES ('$Category', current_timestamp(), 'open', '$IncidentTitle')";
$res = mysqli_query($con,$sql_1);

$sql_2 = "select MAX(incident_id) AS inc_id from incident";
$res1 = mysqli_query($con,$sql_2);

$row = mysqli_fetch_row($res1);
$loc1 = $row[0];

$sql_3 = "insert into comment (incident_id,comment_id,description,username) VALUES ('$loc1','$commentid','$textarea','$user')";
$res2 = mysqli_query($con,$sql_3);

$sql_4 = "INSERT INTO incident_ip (ip_address, incident_id, association) VALUES ('$IP', '$loc1', '$ipRelation')";
$res_4 = mysqli_query($con,$sql_4);

$sql_5 = "INSERT INTO person (last_name, first_name, job_title, person_email) VALUES ('$LastName', '$FirstName', '$Job', '$Email')";
$res_5 = mysqli_query($con,$sql_5);

$sql_6 = "INSERT INTO incident_person (incident_id, person_email, association) VALUES ('$loc1','$Email','$Relation')";
$res_6 = mysqli_query($con,$sql_6);

if($res && $res1 && $res2 && $res_4 && $res_5 && $res_6){
echo "<script>alert('NEW INCIDENT CREATED! YOU WILL BE REDIRECTED TO THE HOME PAGE')</script>";
?>
<h3>If you are not redirected, please <a href = "home.php"> click here </a></h3>
<?php 
header("refresh: 1; url = Main.php");
} 
else{
echo "<script>alert('ERROR!')</script>";
}
}

?>


</html>
