<?php

$username = $_POST['username'];
$age  = $_POST['age'];
$email = $_POST['email'];
$passwrd = $_POST['passwrd'];

if (!empty($username) && !empty($age) && !empty($email) && !empty($passwrd))
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "lsm";

// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From register Where email = ? Limit 1";
  $INSERT = "INSERT Into register (username, age, email, passwrd)values(?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssss", $username,$age,$email,$passwrd);
      $stmt->execute();
      echo "You are registered sucessfully";
     } else {
      echo "This Email ID is already registered";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All fields are required";
 die();
}
?>