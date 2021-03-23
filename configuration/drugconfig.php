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

$query = "SELECT ID FROM tb_drug";
$result = mysqli_query($conn, $query);

if(empty($result)) {
                $query = "CREATE TABLE tb_drug (
                          ID int(11) AUTO_INCREMENT,
                          drug_id varchar(255) NOT NULL,
                          drug_name varchar(255) NOT NULL,
                          drug_category varchar(255) NOT NULL,
                          drug_company varchar(255) NOT NULL,
                          drug_desp varchar(255) NOT NULL,
                          drug_cost varchar(255) NOT NULL,
                          PRIMARY KEY  (ID)
                          )";
                $result = mysqli_query($conn, $query);
}


$drugid = $_POST['drug_id'];
$drugname = $_POST['drug_name'];
$drugcategory = $_POST['drug_category'];
$drugcompany = $_POST['drug_company'];
$drugdesp = $_POST['drug_desp'];
$drugcost = $_POST['drug_cost'];

$sql = "INSERT INTO tb_drug( drug_id,drug_name,drug_category,drug_company,drug_desp,drug_cost) VALUES($drugid, '$drugname','$drugcategory','$drugcompany','$drugdesp',$drugcost )";
// $dept, $subject, $contact, $email
if ($conn->query($sql) === TRUE) {
    echo "Your Information Saved successfully\n";
    echo "<a href='../index.php'>return to homepage</a>";
} else {
    if ($drugid == "" || $drugname == "" ||  $drugcategory == "" || $drugcompany == "") {
         echo "Please input your values!\n";
         echo "<a href='../drug_insert.php'><h3><strong>Retry</strong></h3></a>";
    }else {
         echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>