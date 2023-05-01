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

$sql = "SELECT EmployeeID, SSN, FirstName, LastName, Phone, CertificationID FROM Employee";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  echo "<table>";
  echo "<tr><th>Employee ID</th><th>SSN</th><th>First Name</th><th>Last Name</th><th>Phone Number</th><th>Certification #</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["EmployeeID"] . "</td><td>" . $row["SSN"] . "</td><td>" . $row["FirstName"] . "</td><td>" . $row["LastName"]  . "</td><td>" . $row["Phone"]  . "</td><td>" . $row["CertificationID"]  . "</td></tr>";
  }
  echo "</table>";
} else {
  echo "No results found.";
}

// close the database connection
mysqli_close($conn);
?>
