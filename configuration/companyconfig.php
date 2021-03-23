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

  if (mysqli_query( $conn, $sql)) {
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

$query = "SELECT ID FROM tb_company";
$result = mysqli_query($conn, $query);

if(empty($result)) {
                $query = "CREATE TABLE tb_company (
                          ID int(11) AUTO_INCREMENT,
                          company_invoice_id varchar(255) NOT NULL,
                          company_name varchar(255) NOT NULL,
                          company_phone_no varchar(255) NOT NULL,
                          company_address varchar(255) NOT NULL,
                          PRIMARY KEY  (ID)
                          )";
                $result = mysqli_query($conn, $query);
}


$companyid = $_POST['company_invoice_id'];
$companyname = $_POST['company_name'];
$companycontact = $_POST['company_phone_no'];
$companyaddress = $_POST['company_address'];

$sql = "INSERT INTO tb_company( company_invoice_id,company_name,company_phone_no,company_address) VALUES($companyid, '$companyname',$companycontact,'$companyaddress' )";
// $dept, $subject, $contact, $email
if ($conn->query($sql) === TRUE) {
    echo "Your Information Saved successfully\n";
    echo "<a href='../index.php'>return to homepage</a>";
} else {
    if ($companyid == "" || $companyname == "" ||  $companycontact == "" || $companyaddress == "") {
         echo "Please input your values!\n";
         echo "<a href='../company_insert.php'><h3><strong>Retry</strong></h3></a>";
    }else {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>