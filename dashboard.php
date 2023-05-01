<?php

session_start();


  // check if user is logged in
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
  }
  
  // database connection information
  $dbhost = "mysql.eecs.ku.edu";
  $dbuser = "a542f781";
  $dbpass = "password";
  $dbname = "a542f781";
  
  // connect to the database
  $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  
  // check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  ?>
<!DOCTYPE html>
<html lang = "en">
   <head>
    <title>Dashboard</title>
    <link rel="stylesheet"  href="style.css">
   </head> 

<header>
      <h1>Dashboard</h1>
</header>
   <body>
    <main>
    <div class="button-container">
      <a href="members.php"><button class="button">Members</button></a>
      <a href="employees.php"><button class="button">Employees</button></a>
      <a href="training-programs.php"><button class="button">Training Programs</button></a>
      <a href="equipment.php"><button class="button">Equipment</button></a>
      <a href="locations."><button class="button">Locations</button></a>
    </div>
    </main>
   </body>
</html>

<?php

 // close database connection
 mysqli_close($conn);

?>
