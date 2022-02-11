<?php
ob_start();
include('config/sqlcode.php');
// include('../config/dbconfig.php');
$status = $_SESSION['topf_acive'];
if (isset($_SESSION['topf_uid']) == null) {
    $_SESSION['error_msg'] = "Login as an admin to access Home page.";
    header('location: login.php');
} else {
    if ($status == 0) {
        $_SESSION['error_msg'] = "You Have Blocked By Admin.";
        // echo $_SESSION['topf_acive'];
        // echo $_SESSION['topf_uname'];
        unset($_SESSION['topf_uid']);
        unset($_SESSION['topf_acive']);
        header('location: login.php');
    } else {

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
            <script type="text/javascript" src="js/admin.js?v=<?php echo time() ?>"></script>
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
            <link rel="stylesheet" href="css/admin.css?v=<?php echo time() ?>">
            <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

            <title>Users</title>
        </head>

        <body id="body-pd">

            <?php include('includes/admin_sidebar.php') ?>

            <div class="container-fluid p-2 shadow">
                <a href="includes/activities/register.php"><button class="btn btn-danger my-2 my-sm-0 mr-1" type="button">Add New Admin</button></a>
                <div class="table-responsive">
                    <table id="users" class="table table-dark table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $getAllAd = "SELECT * FROM `admins` ORDER BY `a_id` DESC";
                            $getadmins = $conn->prepare($getAllAd);
                            $getadmins->execute();
                            $adminrow = $getadmins->rowCount();

                            if ($adminrow > 0) {
                                while ($adminfetch = $getadmins->fetch()) {

                            ?>
                                    <tr>
                                        <td><?php echo $adminfetch['a_username'] ?></td>
                                        <td><?php echo $adminfetch['a_email'] ?></td>
                                        <td><i class="fas fa-edit" style="color: #03be03;"></i> <i class="fas fa-user-minus" style="color: #f81a0f;"></i></td>
                                    </tr>

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