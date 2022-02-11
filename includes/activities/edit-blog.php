<?php
ob_start();
session_start();
include('../../config/dbconfig.php');
$postID = $_GET['bid'];
$status = $_SESSION['topf_acive'];
if (isset($_SESSION['topf_uid'])==null) {
    $_SESSION['error_msg'] = "Login as an admin to access Home page.";
    header('location: login.php');
}else{
if ($status==0) {
    $_SESSION['error_msg'] = "You Have Blocked By Admin.";
    // echo $_SESSION['bloodme_astatus'];
    // echo $_SESSION['bloodme_aname'];
    unset($_SESSION['topf_uid']);
    unset($_SESSION['topf_acive']);
    header('location: ../../login.php');
}else{

  $getPost = "SELECT * FROM `posts` WHERE `p_id`=$postID";
  $getPost = $conn->prepare($getPost);
  $getPost->execute();
  $postrow = $getPost->rowCount();

  if ($postrow>0) {
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.convform.js"></script>
    <script type="text/javascript" src="js/admin.js?v=<?php echo time() ?>"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time() ?>">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Edit Blog Post</title>
</head>
<body>

    <div class="container">



    <?php
     while ($postfetch = $getPost->fetch()) {
    ?>

    <form action="../../config/sqlcode.php" method="post">
    <div class="form-group mt-2">
      <input type="hidden" name="bid" value="<?php echo $postID ?>">
    <label for="inputAddress">Title</label>
    <input type="text" name="title" class="form-control" id="inputAddress" value="<?php echo $postfetch['p_title'] ?>">
    </div>
    <div class="form-group mt-2">
    <label for="inputAddress">Slug</label>
    <input type="text" name="slug" class="form-control" id="inputAddress" value="<?php echo $postfetch['p_slug'] ?>">
    </div>
  <div class="form-group mt-2">
    <label for="inputAddress2">Meta Description</label>
    <textarea type="text" name="meta" class="form-control" id="inputAddress2" style="max-height: 100px; min-height: 100px;"><?php echo $postfetch['p_desc'] ?></textarea>
  </div>
  <div class="form-group mt-2">
    <label for="inputAddress2">Keywords</label>
    <textarea type="text" name="keywords" class="form-control" id="inputAddress2" style="max-height: 100px; min-height: 100px;"><?php echo $postfetch['p_keywords'] ?></textarea>
  </div>
  <div class="form-group mt-2">
    <label for="inputAddress2">Content</label>
    <textarea type="text" name="content" class="form-control" id="content" placeholder=""><?php echo $postfetch['p_content'] ?></textarea>
  </div>
    <div style="width: 100%;" class="text-center mt-3">
    <button type="submit" name="update-blog" class="btn btn-success">Save Post</button>
</div>
    </form>

    <?php
  }
    ?>

    </div>

    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>

    <script>

    CKEDITOR.replace( 'content', {
        height: 300,
        filebrowserUploadUrl: "../../config/sqlcode.php"
        });

    </script>
    
</body>
</html>


<?php 
}
}
}
?>