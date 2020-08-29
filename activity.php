<?php include('dbcontrol.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Activity PHP CRUD</title>
</head>
<body>
  <h1>CRUP PHP AND MySQL</h1><br>
  
  <div>
    <h2>
      <?php if(isset($_SESSION['msg'])):
          echo $_SESSION['msg'];
          unset($_SESSION['msg']);
      ?>
      <?php endif ?>
    </h2>
  </div>
  
  
  <form method="POST" action="dbcontrol.php">
    <label for="">First Name:</label>
    <input type="text" name="firstname" id=""><br>
    <label for="">Last Name:</label>
    <input type="text" name="lastname" id=""><br>
    <label for="">Email:</label>
    <input type="email" name="email" id=""><br>
    <label for="">City:</label>
    <input type="text" name="city" id=""><br><br>
    <input type="submit" name="save">
  </form>

  <br>
  <div>
    <?php
      if($result->num_rows > 0) {
        while($row = mysqli_fetch_array($result)) {
          echo $row["id"] . " " . $row["firstname"] . " " . $row["lastname"] . " " . $row["email"] . " " . $row["city"] ."<br>";
        }
      } else {
        echo "0 results";
      }
    ?>
  </div>
  
  <table>
    <thead>
      <tr>
      <th>ID</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>City</th>
      <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_array($result)) { ?>
      <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['firstname'] ?></td>
        <td><?php echo $row['lastname'] ?></td>
        <td><?php echo $row['email'] ?></td>
        <td><?php echo $row['city'] ?></td>
        <td>
          <a href="#">Update</a>
        </td>
        <td>
          <a href="#">Delete</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  <?php
    // $servername = 'localhost';
    // $username = 'root';
    // $password = '';

    // $connect = new mysqli($servername, $username, $password);

    // if($connect->connect_error) {
    //   die("Connection Failed ". $connect->connect_error);
    // }

    // $usedb = "use crud_account";
    // $sql = "create database crud_account";
    // if($connect->query($usedb) === true) {
    //   echo "Successfully used crud_account db";
    // } elseif ($connect->query($sql) === true) {
    //   echo "Database created successfully";
    // } else {
    //   echo "Error creating database: " . $connect->error;
    // }

    // $createTableQuery = "
    //   create table account(
    //     id int(6) auto_increment primary key,
    //     firstname varchar(30) not null,
    //     lastname varchar(30) not null,
    //     email varchar(50) not null,
    //     city varchar(50) not null,
    //     reg_date timestamp default current_timestamp on update current_timestamp
    //   )
    // ";

    // crate table query
    // if($connect->query($createTableQuery) === true) {
    //   echo "Table created successfully!";
    // } else {
    //   echo "Error creating table: " . $connect->error;
    // }
  ?>
</body>
</html>