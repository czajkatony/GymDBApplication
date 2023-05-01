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
  $search_terms = array();
  $sql_conditions = array();
  if (!empty($_POST['MemberID'])) {
    $search_terms[] = "MemberID LIKE '%" . $_POST['MemberID'] . "%'";
  }
  if (!empty($_POST['FirstName'])) {
    $search_terms[] = "FirstName LIKE '%" . $_POST['FirstName'] . "%'";
  }
  if (!empty($_POST['LastName'])) {
    $search_terms[] = "LastName LIKE '%" . $_POST['LastName'] . "%'";
  }
  if (!empty($_POST['Phone'])) {
    $search_terms[] = "Phone LIKE '%" . $_POST['Phone'] . "%'";
  }
  if (!empty($_POST['tier'])) {
    $search_terms[] = "Tier = '" . $_POST['tier'] . "'";
  }
  if (!empty($search_terms)) {
    $sql_conditions = " WHERE " . implode(" AND ", $search_terms);
  }
  $sql = "SELECT * FROM Member" . $sql_conditions;
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

// close the database connection
mysqli_close($conn);
?>
