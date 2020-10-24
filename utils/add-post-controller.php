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

  protected function check_button($button) {
    if(!isset($button["add-action"])) {
      exit("something went wrong!");
    }
  }
  
  protected function add_post() {
    $post = $this->mysqli->prepare(
      "INSERT INTO
      post 
      (postTitle, featureImage, postContent)
      VALUES (?, ?, ?)"
    );

    $target_dir = "image/";
    $target_file = $target_dir . basename($_FILES["featuredImage"]["name"]);
    $uploadOk = 1;

    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // check if image file is an actual image or fake intl_get_error_message
    $check = getimagesize($_FILES["featuredImage"]["tmp_name"]);

    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

    if($uploadOk == 0) {
      echo "Your file was not uploaded.";
    } else {
      // no errors found, try to upload the file
      if(move_uploaded_file($_FILES["featuredImage"]["tmp_name"], "../".$target_file)) {
        echo "The file ". basename($_FILES["featuredImage"]["tmp_name"]). " has been uploaded.";
      } else {
        echo "Sorry, the was an error uploading your file.";
      }
    }

    $this->featuredImage = $target_dir . $_FILES["featuredImage"]["name"];

    $post->bind_param("sss", $this->postTitle, $this->featuredImage, $this->postContent);
    $post->execute();
    $this->id = $post->id;
  }
}

Add_Post::main();
?>