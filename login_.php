<?php
session_start();
include "db_con.php";

if(isset($_POST['userName']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$uname = validate($_POST['userName']);
$pass = validate($_POST['password']);

if (empty($uname)) {
    header("Location: Login.php?erro=User Name is required");
    exit;
}
else if(empty($pass)) {
    header("Location: Login.php?erro=Password is required");
    exit;
}

$sql = "SELECT * FROM ayosdb WHERE userName='$uname' AND password='$password'";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['userName'] === $uname && $row['password'] === $pass) {
        echo "Logged In!";
        $_SESSION['userName'] = $row['userName'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("Location: Home.php");
        exit();
    }
    else{
        header("Location: Login.php?erro=Incorrect User Name or Password");
        exit();
    }
}
else {
    header("Location:  Login.php");
    exit();
}