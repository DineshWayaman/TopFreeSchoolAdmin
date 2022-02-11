<?php 
include('dbconfig.php');
session_start();


if (isset($_POST['userregister'])) {
    $userName = $_POST['name'];
    $userPassword = $_POST['password'];
    $userEmail = $_POST['email'];

    $insertUser = "INSERT INTO admins(a_username, a_email, a_password)  
    VALUES (?,?,?)";
    $insertQuery = $conn->prepare($insertUser);
    $insertQuery->execute(array($userName,$userEmail,$userPassword));

    if ($insertQuery) {
        $_SESSION['success_msg'] = "Registration Successfully Completed. You can log in now.";
         header('location: ../includes/activities/register.php');
    }else{
        $_SESSION['error_msg'] = "Error while proccessing. Please try again.";
         header('location: ../includes/activities/register.php');
    }

}

if (isset($_POST['login'])) {
    $userName = $_POST['username'];
    $userPassword = $_POST['password'];

    $checkUser = "SELECT * FROM `admins` WHERE `a_username`=? AND `a_password`=?";
    $getUser = $conn->prepare($checkUser);
    $getUser->execute(array($userName,$userPassword));
    $userrow = $getUser->rowCount();
    $userfetch = $getUser->fetch();
    if ($userrow>0) {
        $_SESSION['topf_uid'] = $userfetch['a_id'];
        $_SESSION['topf_uname'] = $userfetch['a_username'];
        $_SESSION['topf_acive'] = $userfetch['a_active'];
        $_SESSION['success_msg'] = "Login Successfully Completed.";
        header('location: ../index.php');
    }else{
        $_SESSION['error_msg'] = "Sorry, that user name or password is incorrect. Please try again.";
        header('location: ../login.php');
    }
}


if (isset($_POST['addcat'])) {
    $catName = $_POST['cattitle'];
    $catDesc = $_POST['catdesc'];

    $insertCat = "INSERT INTO categories(c_name, c_desc)  
    VALUES (?,?)";
    $insertQuery = $conn->prepare($insertCat);
    $insertQuery->execute(array($catName,$catDesc));

    if ($insertQuery) {
        $_SESSION['success_msg'] = "Cat Added Successfully Completed.";
         header('location: ../includes/activities/add-category.php');
    }else{
        $_SESSION['error_msg'] = "Error while proccessing. Please try again.";
         header('location: ../includes/activities/add-category.php');
    }

}

if(isset($_FILES['upload']['name']))
{
 $file = $_FILES['upload']['tmp_name'];
 $file_name = $_FILES['upload']['name'];
 $file_name_array = explode(".", $file_name);
 $extension = end($file_name_array);
 $new_image_name = rand() . '.' . $extension;
 chmod('upload', 0777);
 $allowed_extension = array("jpg", "gif", "png");
 if(in_array($extension, $allowed_extension))
 {
  move_uploaded_file($file, '../img/blogimage/' . $new_image_name);
  $function_number = $_GET['CKEditorFuncNum'];
  $url = 'http://localhost/topfreeschooladmin/img/blogimage/' . $new_image_name;
  $message = '';
  echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
 }
}


if (isset($_POST['save-blog'])) {

    $title = $_POST['title'];
    $metadesc = $_POST['meta'];
    $content = $_POST['content'];
    $keywords = $_POST['keywords'];
    $cat = $_POST['cat'];
    $slug = '/'.preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($_POST['title'])));
    $logedAdminID = $_SESSION['topf_uid'];

    if ($title==null || $metadesc==null || $content==null || $keywords==null) {
        $_SESSION['error_msg'] = "You Should enter all field and add Feature Image.";
        header('location: ../add-new-blog.php');
      

    }else{


$target_dir = "../img/featured/";
$target_file = $target_dir . basename($_FILES["fimg"]["name"]);
$url = 'http://localhost/topfreeschooladmin/img/featured/'. basename($_FILES["fimg"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["fimg"]["tmp_name"]);
  if($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    // echo "File is not an image.";
    $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fimg"]["size"] > 500000) {
//   echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fimg"]["tmp_name"], $target_file)) {


    $insertPost = "INSERT INTO posts(p_title, p_slug, p_desc, p_feature_img, p_content, p_keywords, p_admin, p_cat)  
    VALUES (?,?,?,?,?,?,?)";
    $insertPostQuery = $conn->prepare($insertPost);
    $insertPostQuery->execute(array($title, $slug, $metadesc, $url, $content, $keywords, $logedAdminID, $cat));

    if ($insertPostQuery) {
        $_SESSION['success_msg'] = "Blog Addedd Successfully Completed.";
         header('location: ../add-new-blog.php');
    }else{
        $_SESSION['error_msg'] = "Error while proccessing. Please try again.";
         header('location: ../add-new-blog.php');
    }
    
  } else {
    $_SESSION['bloome_error_msg'] = "Sorry, there was an error Entering your file.";
    header('location: ../add-new-blog.php');
  }
}
}

}


if (isset($_POST['update-blog'])) {
    $bid = $_POST['bid'];
    $title = $_POST['title'];
    $metadesc = $_POST['meta'];
    $content = $_POST['content'];
    $keywords = $_POST['keywords'];
    $slug = $_POST['slug'];
  
  
    $updatePost = "UPDATE posts SET p_title=?, p_slug=?, p_desc=?, p_content=?, p_keywords=? WHERE p_id ='$bid'";
      $updatePostQuery = $conn->prepare($updatePost);
      $updatePostQuery->execute(array($title,$slug,$metadesc,$content,$keywords));
  
      if ($updatePostQuery) {
          $_SESSION['success_msg'] = "Blog Update Successfully Completed.";
           header('location: ../blogs.php');
      }else{
          $_SESSION['error_msg'] = "Error while proccessing. Please try again.";
           header('location: ../blogs.php');
      }
      
  
  }



