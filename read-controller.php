<?php

include_once("connectiodb.php");
class Read_Post extends Connection {
  protected $post;

  function get_all_post() {
    $prepare = $this->mysqli->prepare( "select * from post orderby postDate");

    $prepare->execute();
    $result = $prepare->get_result();

    while($row = $result->fetch_assoc()) {
      $this->post[] = $row;
    }

    $this->mysqli->close();
  }

  function get_by_id($id) {
    
  }
}



?>