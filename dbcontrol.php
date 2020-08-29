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

?>