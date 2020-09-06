<?php

include_once("connectiondb.php");
class Read_Post extends Connection {
  protected $post;

  function get_all_post() {
    // $queryGetAll = "SELECT * FROM post ORDER BY postDate";
    $prepare = $this->mysqli->prepare("SELECT * FROM post ORDER BY postDate");

    $prepare->execute();
    $result = $prepare->get_result();

    while($row = $result->fetch_assoc()) {
      $this->post[] = $row;
    }

    $this->mysqli->close();
  }

  function get_by_postid($id) {
    $prepare = $this->mysqli->prepare("select distinct 
    id, 
    postTitle, 
    featureImage,
    postContent 
    from post
    where id = ?");
    
    $prepare->bind_param("i", $id);
    $prepare->execute();
    $result = $prepare->get_result(); 

    while($row = $result->fetch_assoc()) { //fetch array
      $this->post[] = $row;
    }

    $this->mysqli->close();
  }

  function get_result() {
    return $this->post;
  }
}

?>