<?php
$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "arifpharmacy";

$conn = new mysqli($hostname,$username,$password);

// Make my_db the current database
$db_selected = mysqli_select_db($conn, $dbname);

if (!$db_selected) {
  // If we couldn't, then it either doesn't exist, or we can't see it.
  $sql = 'CREATE DATABASE arifpharmacy';

  if (mysqli_query($conn, $sql)) {
      echo "Database my_db created successfully\n";
  } else {
      echo 'Error creating database: ' . mysqli_error() . "\n";
  }
}

mysqli_close($conn);


$conn = new mysqli($hostname,$username,$password,$dbname);
if($conn->connect_error) {
    die("Connection Fail".$conn->connect_error);
}

$query = "SELECT ID FROM tb_manager";
$result = mysqli_query($conn, $query);

if(empty($result)) {
                $query = "CREATE TABLE tb_manager (
                          ID int(11) AUTO_INCREMENT,
                          manager_id varchar(255) NOT NULL,
                          manager_name varchar(255) NOT NULL,
                          manager_phone_no varchar(255) NOT NULL,
                          manager_address varchar(255) NOT NULL,
                          PRIMARY KEY  (ID)
                          )";
                $result = mysqli_query($conn, $query);
}


$managerid = $_POST['manager_id'];
$managername = $_POST['manager_name'];
$managercontact = $_POST['manager_phone_no'];
$manageraddress = $_POST['manager_address'];

$sql = "INSERT INTO tb_manager( manager_id,manager_name,manager_phone_no,manager_address) VALUES($managerid, '$managername',$managercontact,'$manageraddress' )";
// $dept, $subject, $contact, $email
if ($conn->query($sql) === TRUE) {
    echo "Your Information Saved successfully\n";
    echo "<a href='../index.php'>return to homepage</a>";
} else {
    if ($managerid == "" || $$managername == "" ||  $$managercontact == "" || $$manageraddress == "") {
         echo "Please input your values!\n";
         echo "<a href='../manager_insert.php'><h3><strong>Retry</strong></h3></a>";
    }else {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>