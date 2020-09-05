<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FrontPage Post</title>
</head>
<body>
  <ul>
    <li><a href="backpage.php">Go to Backpage</a></li>
  </ul>
  <?php 
    include("utils/read-controller.php");
    $read = new Read_Post();
    $read->get_all_post();
    $postDB = $read->get_resul();
  ?>
  <div class="post_all">
    <?php 
      if($postDB) {
        foreach($postDB as $stud) {
          ?>
          <div class="postStructure">
            <h1><?php echo $stud["postTitle"]; ?></h1>
            <img src="<?php echo $stud["featureImage"]; ?>">
            <p><?php echo $stud["postContent"]; ?></p>
          </div>
          <?php
        }
      }
    ?>
  </div>


<?php 
  // $server = 'localhost';
  // $uname = 'root';
  // $pass = '';

  // $con = new mysqli($server, $uname, $pass);

  // if($con->connect_error) {
  //   die("Connection Failed" . $con->connect_error);
  // }

  // $usedb = "use aquino_db";
  // $sql = "create database aquino_db";

  // if($con->query($usedb) === true) {
  //   echo "Successfully used aquino_db<br>";
  // } elseif ($con->query($sql) === true) {
  //   echo "Successfully created aquino_db<br>";
  // } else {
  //   echo "Error creating database: " . $con->error;
  // }

  // $sqlCreateTable = "
  //   create table post(
  //   id int(5) unsigned auto_increment primary key,
  //   postTitle varchar(50) not null,
  //   featureImage longtext default null,
  //   postContent longtext default null,
  //   postVisibilty int(1) default 1,
  //   postDate timestamp default current_timestamp on update current_timestamp
  // )";

  // if($con->query($sqlCreateTable) === true) {
  //   echo "Table post created successfully<br>";
  // }
  // else {
  //   echo "Error creating table: " . $con->error;
  // }

?>



</body>
</html>