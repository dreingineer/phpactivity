<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Post Page</title>
</head>
<body>
  <form method="POST" action="utils/add-post-controller.php">
    <h1>Post Information</h1>
    <label for="">Title</label>
    <input type="text" name="postTitle"><br>
    <label for="">Image</label>
    <input type="file" name="featuredImage"><br>
    <label for="">Content</label><br>
    <textarea name="postContent"></textarea><br>
    <input type="submit" name="add-action" value="submit"><br>
    <hr>
    <a href="backpage.php">Back</a> | 
    <a href="frontpage.php">Go to Front Page</a>
  </form>
</body>
</html>