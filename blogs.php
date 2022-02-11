<?php 
session_start();
include('config/dbconfig.php');
$status = $_SESSION['topf_acive'];
if (isset($_SESSION['topf_uid'])==null) {
    $_SESSION['error_msg'] = "Login as an admin to access Home page.";
    header('location: login.php');
}else{
if ($status==0) {
    $_SESSION['error_msg'] = "You Have Blocked By Admin.";
    // echo $_SESSION['topf_acive'];
    // echo $_SESSION['topf_uname'];
    unset($_SESSION['topf_uid']);
    unset($_SESSION['topf_acive']);
    header('location: login.php');
}else{
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <title>Blogs</title>
</head>
<body id="body-pd">
    
    <?php include('includes/admin_sidebar.php') ?>

    <?php 
        if (isset($_SESSION['error_msg'])) {
            ?>
         <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error_msg']; ?></div>
        
        <?php
          unset($_SESSION['error_msg']);
         }

         if (isset($_SESSION['success_msg'])) {
            ?>
         <div class="alert alert-success" role="alert"><?php echo $_SESSION['success_msg']; ?></div>
            <?php  
            unset($_SESSION['success_msg']);
         }

         ?>


    <div class="container-fluid p-2 shadow">
        <div width="100%" class="mb-2 mt-2"><a href="add-new-blog.php"><button class="btn btn-success">Add New Blog</button></a></div>
          <div class="table-responsive">
            <table id="users" class="table mb-0">
                <thead>
                    <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Meta Description</th>
                    <th>Keywords</th>
                    <th>Admin</th>
                    <th>Action</th>
                 </tr>
                 </thead>
                 <tbody>
               <?php
                   $getAllPosts = "SELECT * FROM `posts`";
                   $getPosts = $conn->prepare($getAllPosts);
                   $getPosts->execute();
                   $postrow = $getPosts->rowCount();
                 
                   if ($postrow>0) {
                       while ($postfetch = $getPosts->fetch()) {
                           
                  ?>
                 <tr>
                     <td><?php echo $postfetch['p_id'] ?></td>
                     <td><?php echo $postfetch['p_title'] ?></td>
                     <td><?php echo $postfetch['p_slug'] ?></td>
                     <td><?php echo $postfetch['p_desc'] ?></td>
                     <td><?php echo $postfetch['p_keywords'] ?></td>
                     <td><?php echo $postfetch['p_admin'] ?></td>
                     <td><a href="includes/activities/edit-blog.php?bid=<?php echo $postfetch['p_id'] ?>"><i class="fas fa-edit" style="color: #03be03;"></i></a>
                    <?php if ($postfetch['p_active']==1) {
                        # code...
                    ?>
                     <a href="config/deactive-blog.php?bid=<?php echo $postfetch['p_id'] ?>"><i class="fas fa-align-slash" style="color: #f81a0f;"></i></a> 
                    <?php 
                     }else{
                       ?>
                       <a href="config/active-blog.php?bid=<?php echo $postfetch['p_id'] ?>"><i class="fas fa-align-justify" style="color: #f81a0f;"></i></a> 
                       <?php 
                     }
                    ?>
                    </td>
                    <tr>
                  
                  <?php
                    }
                }
                  ?>
                 </tbody>

             </table>
            </div>
        </div>
    
    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

  
</body>
</html>

<?php 
}
}
?>