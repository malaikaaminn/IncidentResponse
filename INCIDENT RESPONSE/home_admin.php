<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Title</title>
<br>
<br>
<br>
<button id="back" style="background-color: "><a href="index.php" style="color:">LOGOUT</a></button><div style="margin-top:10px; style : center" >
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* Style the body */
body {
  font-family: Arial;
  margin: 0;
}

/* Header/Logo Title */
.header {
  padding: 60px;
  text-align: center;
  background: #1abc9c;
  color: white;
  font-size: 30px;
}

/* Page Content */
.content {padding:20px;}
</style>
</head>
<body>

<div class="header">
  <h1>INCIDENT RESPONSE TRACKING SYSTEM</h1>
  <h2>ADMIN PAGE</h2>
  <p></p>
</div>

<div class="content">
  <h1>Please Select any one option</h1>
  <p>Get Incident Report</p><form action="/getReport_admin.php" method="get">
  <button type="submit">Submit</button>
</form>
<br>
<br>
  <p>Check all Incidents / ADD NEW INCIDENT</p>
<form action="/Main.php" method="get">
  <button type="submit">Submit</button>
</form>
</div>



</body>
</html>
