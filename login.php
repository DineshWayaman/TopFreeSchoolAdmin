<?php
session_start();
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
    

    <title>Login</title>
</head>
<body>
<?php 
        if (isset($_SESSION['error_msg'])) {
            ?>
         <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error_msg']; ?></div>
        
        <?php
          unset($_SESSION['error_msg']);
           }
         ?>

    <div class="container shadow login-height">
        <div class="row">
        <div class="col-md-6">
            <img src="https://aqwamag.com/wp-content/uploads/2021/05/1-1536x1090.jpg" class="width-img" alt="" srcset="">
        </div>
        <div class="col-md-6 text-center midle-all">
            <form action="config/sqlcode.php" method="post">
                <h4 class="text-center">Admin Login</h4>
                <div class="form-group col-md-12">
                <input type="text" name="username" id="inputEmail4" class="input-fieled shadow" placeholder="User Name">
             </div>
                 <div class="form-group col-md-12 mt-3">
                 <input type="password" name="password" id="inputPassword4" class="input-fieled shadow" placeholder="Password">
                </div>
                <div class="form-group col-md-12 mt-4 mb-3">
                 <input type="submit" name="login" class="login-btn btn-danger shadow" placeholder="Login">
                </div>
            </form>
        </div>

    </div>
    </div>
</body>
</html>