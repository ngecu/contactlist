<?php
$db = mysqli_connect('localhost', 'root', '', 'phone');

if (isset($_POST['submit'])) {
  
    $contactName =  $_POST['contactName'];
  $contactPhone = $_POST['contactPhone'];

  $query = "INSERT INTO `contact`(`personName`, `personPhone`) VALUES('$contactName', '$contactPhone');";
mysqli_query($db, $query);

#echo '<p style="color:red;argin:0;">' .$contactName.' Added successful ';

}


if (isset($_POST['deleteContact'])) {
  $contactName = $_POST['Name'];

  $query= "DELETE FROM `contact` WHERE `personName` = '$contactName' LIMIT 1 ;";
  mysqli_query($db, $query);
  header('location: index.php?=successDeleted');

}

?>