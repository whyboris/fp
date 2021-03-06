<?php

include_once('connection.php');

session_start();

if(!empty($_SESSION['name'])){
    $userName = $_SESSION['name'];
} else {
    header('Location: login.php');
}

?>

<html>
<head>
    <title>Welcome to Mongo Press</title>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link href="assets/custom.css" rel="stylesheet">
    <script src="assets/custom.js"></script>
    <link rel="shortcut icon" href="assets/favicon.png" type="image/png">
    <link rel="icon" href="assets/favicon.png" type="image/png">

    <!-- SUMMERNOTE code - make conditional based on page -->

    <link href="assets/summernote.css" rel="stylesheet">
    <script src="assets/summernote.min.js"></script>

<?php
    if (isset($dataTables)) {
?>
    <script src="DataTables/jquery.datatables.min.js"></script>
    <link href="DataTables/jquery.datatables.min.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: false,
                lengthChange: false,
                paginate: false,
                info: false
            });
        });
    </script>
<?php

    } else {
        echo '';
    }

?>

    <!-- summernote - make it conditional -->

    <script type="text/javascript">

        $(document).ready(function() {

        });

    </script>

</head>

<body>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Mongo Press</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $userName ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="user.php">Profile</a></li>
                    <li><a href="blog.php">Blog settings</a></li>
                <?php

                    $userType = $userCollection->findOne(array('name'=>$userName))['type'];

                    if ($userName == 'admin' || $userType == 'admin') {
                        echo '<li role="separator" class="divider"></li>';
                        echo '<li><a href="useradmin.php">Administer Users</a></li>';
                        echo '<li><a href="blogadmin.php">Administer Blogs</a></li>';
                    }
                ?>
                    <li role="separator" class="divider"></li>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
