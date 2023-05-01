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
        <h1>Members</h1>
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
            <label>Member ID:</label>
            <input type="number" name="MemberID" required><br>
            <label>First Name:</label>
            <input type="text" name="FirstName" required><br>
            <label>Last Name:</label>
            <input type="text" name="LastName" required><br>
            <label>Phone Number:</label>
            <input type="text" name="Phone" required><br>
            <label for = "tier">Membership Tier:</label>
            <select id= "tier" name= "tier" required>
                <option value = "" selected disabled>Select Tier</option>
                <option value= "Gold">Gold</option>
                <option value="Silver">Silver</option>
            </select>
            <br>
            <button type = "submit" name = "addMember">Add Member</button>
            <br><br>
            </form>
            <form method="post">
            <label>Member ID:</label>
            <input type="number" name="deleteID" required><br>
            <button type = "submit" name = "removeMember">Remove Member</button>
            </form>
        </div>
        <div class="middle">
           <?php
          if (isset($_POST['addMember'])) {
            $memID = $_POST['MemberID'];
            $fn = $_POST['FirstName'];
            $ln = $_POST['LastName'];
            $phone = $_POST['Phone'];
            $tier = $_POST['tier'];

            $sql0 = "INSERT INTO Member (MemberID, FirstName, LastName, Phone) VALUES (?,?, ?, ?)";
            $sql1 = "INSERT INTO Membership (Address, MemberID, Tier) VALUES ('123 Main St', ?, ?)";

            $stmt0 = mysqli_prepare($conn, $sql0);
            $stmt1 = mysqli_prepare($conn, $sql1);

            mysqli_stmt_bind_param($stmt0,'ssss', $memID, $fn, $ln, $phone);
            mysqli_stmt_bind_param($stmt1,'ss', $memID, $tier);

            mysqli_execute($stmt0);
            mysqli_execute($stmt1);

            $result0 = mysqli_query($conn, $sql0);
            $result1 = mysqli_query($conn, $sql1);

            include 'member_table.php';
          }

            else if (isset($_POST['removeMember'])) {
            $deleteID = $_POST['deleteID'];
            $deleteSql = "DELETE FROM Member WHERE MemberID = ?";
            $deleteStmt = mysqli_prepare($conn, $deleteSql);
            mysqli_stmt_bind_param($deleteStmt, 's', $deleteID);
            mysqli_execute($deleteStmt);

            include 'member_table.php';
          }

            else if (isset($_POST['search'])) {
                include 'member_search.php';

          }
          else{
            include 'member_table.php'; 
          }


          ?>
        </div>
        <div class="inner">
            <form method="post">
            <label>Member ID:</label>
            <input type="text" name="MemberID"><br>
            <label>First Name:</label>
            <input type="text" name="FirstName"><br>
            <label>Last Name:</label>
            <input type="text" name="LastName"><br>
            <label>Phone Number:</label>
            <input type="text" name="Phone"><br>
            <label for = "tier">Membership Tier:</label>
            <select id= "tier" name= "tier">
                <option value = "" selected disabled>Select Tier</option>
                <option value= "Gold">Gold</option>
                <option value="Silver">Silver</option>
            </select>
            <br>
            <button type = "submit" name = "search">Search Member</button>
            </form>
        </div>
        </div>
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
   </form>
    </main>
   </body>
</html>

<?php

 // close database connection
 mysqli_close($conn);

?>
