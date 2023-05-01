<?php
// start session
session_start();

//https://people.eecs.ku.edu/~a542f781/index.php
// database connection information
$dbhost = "mysql.eecs.ku.edu";
$dbuser = "a542f781";
$dbpass = "password";
$dbname = "a542f781";
//$_SESSION['loginAttempted'] = false;

// connect to the database
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// check if form is submitted
if (isset($_POST['submit'])) {
  //$_SESSION['loginAttempted'] = true;
    // retrieve form input
    $EmployeeID = mysqli_real_escape_string($conn, $_POST['EmployeeID']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // retrieve user data from database
    $sql = "SELECT * FROM Employee WHERE EmployeeID = '$EmployeeID' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);

    // check if user exists
    if (mysqli_num_rows($result) == 1) {
        // set session variables
        $_SESSION['EmployeeID'] = $EmployeeID;
        $_SESSION['loggedin'] = true;
      

        // redirect to homepage
        header("Location: dashboard.php");
    } else //if ($_SESSION['loginAttempted'] == true) 
    {
        // display error message
        echo "<h2>Invalid EmployeeID or password.</h2>";
        //echo '<script>alert("Invalid EmployeeID or password.")</script>';
    }
}

// close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label>Employee ID:</label><br>
        <input type="text" name="EmployeeID"><br>
        <label>Password:</label><br>
        <input type="password" name="password"><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
    </div>
</body>
</html>