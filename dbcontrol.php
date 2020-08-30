<?php

  session_start();

  $servername = 'localhost';
  $username = 'root';
  $password = '';
  $dbname = 'crud_account';
  $firstname = '';
  $lastname = '';
  $email = '';
  $city = '';
  $update_status = false;

  // connect to mysql database
  $connect = new mysqli($servername, $username, $password, $dbname);

  if($connect->connect_error) {
    die("Connection Failed" . $con->connect_error);
  }

  $stmt = $connect->prepare('
    insert into account (firstname, lastname, email, city) values (?, ?, ?, ?)
  ');

  // when save button is clicked
  if(isset($_POST['save'])) {
    $firstname = test_input($_POST['firstname']);
    $lastname = test_input($_POST['lastname']);
    $email = test_input($_POST['email']);
    $city = test_input($_POST['city']);

    entertext($firstname, $lastname, $email, $city);
    $_SESSION['msg'] = "Info Saved!";
    header('location: activity.php');
  }

  // get records
  $sqlget = "select id, firstname, lastname, email, city from account";
  $result = $connect->query($sqlget);

  // update records
  if(isset($_POST['update'])) {
    
    // $id = mysql_real_escape_string($_POST['id']);
    // $firstname = mysql_real_escape_string($_POST['firstname']);
    // $lastname = mysql_real_escape_string($_POST['lastname']);
    // $email = mysql_real_escape_string($_POST['email']);
    // $city = mysql_real_escape_string($_POST['city']);

    $id = test_input($_POST['id']);
    $firstname = test_input($_POST['firstname']);
    $lastname = test_input($_POST['lastname']);
    $email = test_input($_POST['email']);
    $city = test_input($_POST['city']);

    $sqlUpdateQuery = "UPDATE account SET firstname='$firstname', lastname='$lastname', email='$email', city='$city' where id='$id'";
    // $connect->query($sqlUpdateQuery);
    // mysqli_query($connect, "update account set firstname='$firstname', lastname='$lastname', email='$email', city='$city' where id='$id'");
    if($connect->query($sqlUpdateQuery) === TRUE) {
      $_SESSION['msg'] = "Account Updated.";
      header('location: activity.php');
    } else {
      echo "Error updating record: " . $connect->error;
    }
  }

  // delete record 
  if(isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sqlDeleteQuery = "DELETE FROM account WHERE id='$id'";

    if($connect->query($sqlDeleteQuery) === TRUE) {
      $_SESSION['msg'] = "Selected Account Deleted.";
      header('location: activity.php');
    } else {
      echo "Error deleting record: " . $connect->error;
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function entertext($a, $b, $c, $d) {
    global $stmt;
    $stmt->bind_param("ssss", $firstname, $lastname, $email, $city);
    $firstname = $a;
    $lastname = $b;
    $email = $c;
    $city = $d;
    $stmt->execute();
  }

  // $connect->close();
?>