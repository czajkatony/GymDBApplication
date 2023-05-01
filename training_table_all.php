<?php
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

$sql = "SELECT Employee.LastName AS TrainerLN, ProgramID, Member.LastName AS MemberLN, Member.FirstName, Fee FROM Member, Employee, Trains, Tracks WHERE Member.MemberID = Trains.MemberID AND Tracks.MemberID = Member.MemberID AND Employee.EmployeeID = Trains.EmployeeID"; 
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo "<table>";
  echo "<tr><th>Trainer</th><th>Program ID</th><th>Member LN</th><th>Member FN</th><th>Fee</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["TrainerLN"] . "</td><td>" . $row["ProgramID"] . "</td><td>" . $row["MemberLN"] . "</td><td>" . $row["FirstName"]  . "</td><td>" . $row["Fee"] . "</td></tr>";
  }
  echo "</table>";
} else {
  echo "No results found.";
}

// close the database connection
mysqli_close($conn);
?>
