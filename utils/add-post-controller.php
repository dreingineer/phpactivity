<?php 
include_once("connectiondb.php");
class Add_Post extends Connection {

  protected $id;
  protected $postTitle;
  protected $featuredImage;
  protected $postContent;

  function __construct($postTitle, $postContent) {
    parent::__construct();

    $this->postTitle = $postTitle;
    $this->postContent = $postContent;
  }

  static function main() {
    $add = new Add_Post(
      $_POST["postTitle"],
      $_POST["postContent"]
    );

    $add->check_button($_POST);
    $add->add_post();
    header("Location: http://localhost/aquino/phpactivity/backpage.php");
  }

  
}

?>