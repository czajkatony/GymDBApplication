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
    <link rel="stylesheet"  href="style1.css" >
   </head> 

    <header>
        <div>
        </div>
        <div>
        <h1>Employee</h1>
        </div>
        <div class="home">
        <a href="dashboard.php"><button>Home</button></a>
        </div>


    </header>
   <body>
    <main>
        <div class="topSection">
        <div class="inner">
            <form method="post">
            <button type = "submit" name = "default">View Employees</button>
            <br><br>
            </form>
            <form method="post">
            <button type = "submit" name = "trainer">View Trainers</button>
            </form>
            <br><br>
            <form method="post">
            <button type = "submit" name = "manager">Manager View</button>
            </form>
        </div>
        <div class="rightSection">
           <?php
          if (isset($_POST['trainer'])) {
            include 'employeet_table.php';
          } else if (isset($_POST['manager'])) {
            include 'employeem_table.php';
          } else{
            include 'employee_table.php'; 
          }


          ?>
        </div>
        </div>
   </form>
    </main>
   </body>
</html>

<?php

 // close database connection
 mysqli_close($conn);

?>
