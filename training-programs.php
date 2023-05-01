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
        <h1>Training</h1>
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
            <button type = "submit" name = "viewAll">View All Plans</button>
            </form>
            <br>

            <form method="post">
            <label>Plan ID:</label>
            <input type="number" name="PlanNum" required><br>
            <button type = "submit" name = "viewPlan">View Plan</button>
            </form>
            <br>

            <form method="post">
            <label>Program ID:</label>
            <input type="number" name="ProgramID" required><br>
            <label>Exercise Name:</label>
            <input type="text" name="ExerciseName" required><br>
            <label># of Sets:</label>
            <input type="number" name="NumSets" required><br>
            <label>Weight:</label>
            <input type="number" name="Weight" required><br>
            <label># of Reps:</label>
            <input type="number" name="NumReps" required><br>
            <button type = "submit" name = "addExercise">Add Exercise</button>
            <br><br>
            </form>
        </div>
        <div class="rightSection">
           <?php
          if (isset($_POST['viewPlan'])) {
            $programID = $_POST['PlanNum']; 
            include 'training_table_plan.php';
          }
          else if (isset($_POST['addExercise'])) {
            // get form data
            $programID = $_POST['ProgramID'];
            $exerciseName = $_POST['ExerciseName'];
            $numSets = $_POST['NumSets'];
            $weight = $_POST['Weight'];
            $numReps = $_POST['NumReps'];

            // check if programID exists in Program table
            $sql = "SELECT ProgramID FROM Program WHERE ProgramID = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $programID);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $num_rows = mysqli_stmt_num_rows($stmt);
            mysqli_stmt_close($stmt);

            if ($num_rows == 0) {
                // insert programID into Program table
                $sql = "INSERT INTO Program (ProgramID) VALUES (?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'i', $programID);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            // check if exerciseName exists in Exercise table
            $sql = "SELECT ExerciseName FROM Exercise WHERE ExerciseName = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 's', $exerciseName);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $num_rows = mysqli_stmt_num_rows($stmt);
            mysqli_stmt_close($stmt);

            if ($num_rows == 0) {
                // insert exerciseName into Exercise table
                $sql = "INSERT INTO Exercise (ExerciseName) VALUES (?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 's', $exerciseName);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            // insert workout plan into WorkoutPlan table
            $sql = "INSERT INTO WorkoutPlan (ProgramID, ExerciseName, NumberSets, Weight, NumberReps) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, 'isiii', $programID, $exerciseName, $numSets, $weight, $numReps);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            include 'training_table_all.php';
          }

          else{
            include 'training_table_all.php'; 
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
