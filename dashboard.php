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

  <?php
  // button 2 query
  if (isset($_POST['button2'])) {
    $sql = "SELECT * FROM table2";
    $result = mysqli_query($conn, $sql);
    // process query result
  }
  ?>
  

  <?php
  // button 3 query
  if (isset($_POST['button3'])) {
    $sql = "SELECT * FROM table3";
    $result = mysqli_query($conn, $sql);
    // process query result
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
        <h1>Members </h1> 
        <form method="post">
        <button type="submit" name="button1">View/Add Members</button>
        <?php
    
  // button 1 query
  if (isset($_POST['button1'])) {
    $sql = "SELECT * FROM Member";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Phone Number</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>" . $row["MemberID"] . "</td><td>" . $row["FirstName"] . "</td><td>" . $row["LastName"] . "</td><td>" . $row["Phone"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
    // process query result
  }
  ?>
        <h1>Employees</h1> 
        <form method="post">
        <button type="submit" name="button2">View/Add Employees</button>
        <h1>Training Programs</h1> 
        <form method="post">
        <button type="submit" name="button3">View/Add Training Programs</button>
        <h1>Equipment</h1> 
        <form method="post">
        <button type="submit" name="button4">View/Add Equipment</button>
        <h1>Locations</h1> 
        <form method="post">
        <button type="submit" name="button5">View/Add Locations</button>
  </form>
    </main>
   </body>
</html>

<?php

 // close database connection
 mysqli_close($conn);

?>