<?php

$username = $_POST['username'];
$email  = $_POST['email'];
$mobile_number = $_POST['mobile_number'];
$password = $_POST['pass'];




if (!empty($username) || !empty($email) || !empty($mobile_number) || !empty($password) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "nproject";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') ' . mysqli_connect_error());
}
else{
  $SELECT = "SELECT mobile_number From register Where mobile_number = ? Limit 1";
  $INSERT = "INSERT Into register (username , email ,mobile_number, pass )values(?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("i", $mobile_number);
     $stmt->execute();
     $stmt->bind_result($mobile_number);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssis", $username,$email,$mobile_number,$pass);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>