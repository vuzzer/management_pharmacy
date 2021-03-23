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

$query = "SELECT ID FROM tb_customer";
$result = mysqli_query($conn, $query);

if(empty($result)) {
                $query = "CREATE TABLE tb_customer (
                          ID int(11) AUTO_INCREMENT,
                          customer_id varchar(255) NOT NULL,
                          customer_name varchar(255) NOT NULL,
                          customer_phone_no varchar(255) NOT NULL,
                          customer_address varchar(255) NOT NULL,
                          PRIMARY KEY  (ID)
                          )";
                $result = mysqli_query($conn, $query);
}


$customerid = $_POST['customer_id'];
$customername = $_POST['customer_name'];
$customercontact = $_POST['customer_phone_no'];
$customeraddress = $_POST['customer_address'];

$sql = "INSERT INTO tb_customer( customer_id,customer_name,customer_phone_no,customer_address) VALUES($customerid, '$customername',$customercontact,'$customeraddress' )";
// $dept, $subject, $contact, $email
if ($conn->query($sql) === TRUE) {
    echo "Your Information Saved successfully\n";
    echo "<a href='../index.php'>return to homepage</a>";
} else {
    if ($customerid == "" || $customername == "" ||  $customercontact == "" || $customeraddress == "") {
         echo "Please input your values!\n";
         echo "<a href='../customer_insert.php'><h3><strong>Retry</strong></h3></a>";
    }else {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>