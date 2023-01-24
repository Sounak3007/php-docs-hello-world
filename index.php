<!DOCTYPE html>
<html>
<head>
<title>Educational registration form</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
<style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 16px;
      color: #444441;
      }
      body {
      background: url("/uploads/media/default/0001/01/b5edc1bad4dc8c20291c8394527cb2c5b43ee13c.jpeg") no-repeat center;
      background-size: cover;
      }
      h1, h2 {
      text-transform: uppercase;
      font-weight: 400;
      }
      h2 {
      margin: 0 0 0 8px;
      }
      .main-block {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100%;
      padding: 25px;
      background: rgba(0, 0, 0, 0.5); 
      }
      .left-part, form {
      padding: 25px;
      }
      .left-part {
      text-align: center;
      }
      .fa-graduation-cap {
      font-size: 72px;
      }
      form {
      background: rgba(0, 0, 0, 0.7); 
      }
      .title {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
      }
      .info {
      display: flex;
      flex-direction: column;
      }
      input, select {
      padding: 5px;
      margin-bottom: 30px;
      background: transparent;
      border: none;
      border-bottom: 1px solid #FFFFFF;
      }
      input::placeholder {
      color: #FFFFFF;
      }
      option:focus {
      border: none;
      }
      option {
      background: black; 
      border: none;
      }
      .checkbox input {
      margin: 0 10px 0 0;
      vertical-align: middle;
      }
      .checkbox a {
      color: #FFFFFF;
      }
      .checkbox a:hover {
      color:#FFFFFF;
      }
      .btn-item, button {
      padding: 10px 5px;
      margin-top: 20px;
      border-radius: 5px; 
      border: none;
      background: #26a9e0; 
      text-decoration: none;
      font-size: 15px;
      font-weight: 400;
      color: #fff;
      }
      .btn-item {
      display: inline-block;
      margin: 20px 5px 0;
      }
      button {
      width: 100%;
      }
      button:hover, .btn-item:hover {
      background: #FFFFFF;
      }
      @media (min-width: 568px) {
      html, body {
      height: 100%;
      }
      .main-block {
      flex-direction: row;
      height: calc(100% - 50px);
      }
      .left-part, form {
      flex: 1;
      height: auto;
      }
      }
</style>
</head>
<body>
<div class="main-block">
<div class="left-part">
<i class="fas fa-graduation-cap"></i>
<h1>Register to our courses</h1>
<div class="btn-group">
</div>
</div>
<form method="post" action="index.php" enctype="multipart/form-data">
<div class="title">
<i class="fas fa-pencil-alt"></i> 
<h2>Register here</h2>
</div>
<div class="info">
<input class="fname" type="text" name="name" required id="Name" title="only alphabets and spaces" patter="[A-Za-z]+" placeholder="Full name">
<input type="text" name="Address" id="Address" required placeholder="Address*">
<select name="Gender" id="Gender" required>
<option value="Gender" selected>Select*</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Others">Others</option>
</select>
<input type="text" name="Phone" required title="please enter 10 digit number " pattern="[1-9]{1}[0-9]{9}" placeholder="Phone Number*">
<input type="Email" name="Email" required id="Email" title="Please enter valid Email id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" placeholder="Email"> 
<input type="date" name="DOB" required id="DOB" placeholder="Dateofbirth* ">          
<select name="course" id="course" required>
<option value="course-type" selected>course type*</option>
<option value="short-courses">Short courses</option>
<option value="featured-courses">Featured courses</option>
<option value="undergraduate">Undergraduate</option>
<option value="diploma">Diploma</option>
<option value="certificate">Certificate</option>
<option value="masters-degree">Masters degree</option>
<option value="postgraduate">Postgraduate</option>
</select>
</div>
<button type="submit" name="submit" value="Submit">Submit</button>
</form>
</div>
<?php
date_default_timezone_set('asia/kolkata');
     // DB connection info
     //TODO: Update the values for $host, $user, $pwd, and $db
     //using the values you retrieved earlier from the Azure Portal.
     $host = "tcp:testserver12423.database.windows.net,1433";
$user = "sounak";
$pwd = "Ensim@2607";
$db = "REGISTRATION";
// Connect to database.
try {
     $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
     $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
     die(var_dump($e));
}
     // Insert registration info
     if(!empty($_POST)) {
     try {
         $name = $_POST['name'];
         $Address = $_POST['Address'];
   $Gender = $_POST['Gender'];
   $Phone = $_POST['Phone'];
   $Email = $_POST['Email'];
   $course = $_POST['course'];
   $DOB = $_POST['DOB'];
         $date = date("Y/m/d H:i:s");
         // Insert data
         $sql_insert = "INSERT INTO registration_table (name,Address,Gender,Phone,Email,course,DOB,date)
                    VALUES (?,?,?,?,?,?,?,?)";
         $stmt = $conn->prepare($sql_insert);
         $stmt->bindValue(1, $name);
   $stmt->bindValue(2, $Address);
         $stmt->bindValue(3, $Gender);
         $stmt->bindValue(4, $Phone);
   $stmt->bindValue(5, $Email);
   $stmt->bindValue(6, $course);
   $stmt->bindValue(7, $DOB);
   $stmt->bindValue(8, $date);
         $stmt->execute();
     }
     catch(Exception $e) {
         die(var_dump($e));
     }
     echo "<h3>Your're registered!</h3>";
     }
     // Retrieve data
     $sql_select = "SELECT * FROM registration_table";
     $stmt = $conn->query($sql_select);
     $registrants = $stmt->fetchAll();
     if(count($registrants) > 0) {
         echo "<h2>People who are registered:</h2>";
         echo "<table>";
         echo "<tr><th>Name</th>";
   echo "<th>Address</th>";
   echo "<th>Gender</th>";
         echo "<th>Phone</th>";
   echo "<th>Email</th>";
   echo "<th>course</th>";
   echo "<th>DOB</th>";
         echo "<th>Date</th></tr>";
         foreach($registrants as $registrant) {
             echo "<tr><td>".$registrant['name']."</td>";
             echo "<td>".$registrant['Address']."</td>";
        echo "<td>".$registrant['Gender']."</td>";
        echo "<td>".$registrant['Phone']."</td>";
        echo "<td>".$registrant['Email']."</td>";
        echo "<td>".$registrant['course']."</td>";
        echo "<td>".$registrant['DOB']."</td>";
             echo "<td>".$registrant['date']."</td></tr>";
         }
          echo "</table>";
     } else {
         echo "<h3>No one is currently registered.</h3>";
     }
?>
</body>
</html>
