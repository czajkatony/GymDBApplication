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

$sql = "SELECT ExerciseName, NumberSets, Weight, NumberReps FROM WorkoutPlan WHERE ProgramID = ?"; 
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $programID);
mysqli_execute($stmt);
$result = mysqli_stmt_get_result ($stmt);

if (mysqli_num_rows($result) > 0) {
  echo "<table>";
  echo "<tr><th>Exercise</th><th>Sets</th><th>Weight</th><th>Reps</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["ExerciseName"] . "</td><td>" . $row["NumberSets"] . "</td><td>" . $row["Weight"] . "</td><td>" . $row["NumberReps"]  . "</td></tr>";
  }
  echo "</table>";
} else {
  echo "No results found.";
}

// close the database connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
