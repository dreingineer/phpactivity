<?php

class Connection {
  protected $mysqli;

  function __contstruct() {
    $this->connect();
  }

  protected function connect() {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
      $servername = "localhost";
      $username = "root";
      $dbname = "aquino_db";

      $this->mysqli = new mysqli($servername, $username, "", $dbname);
      $this->set_charset("utf8mb4");
    } catch (Exception $e) {
      error_log($e->getMessage());
      exit("Something went wrong!");
    }
  }
}

class read extends Connection {

  function __contstruct() {
  }

  function expose() {
    echo "<pre>";
    print_r($this->mysqli);
    echo "</pre>";
  }
}

$read = new read();
$read->expore();

?>