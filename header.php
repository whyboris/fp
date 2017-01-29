<?php

session_start();

if(!empty($_SESSION['name'])){
    $userName = $_SESSION['name'];
} else {
    header('Location: login.php');
}
?>

<html>
<head>
    <title>Welcome to Forbes Press</title>
    <script src="assets/jquery.min.js"></script>
    <script src="assets/bootstrap.min.js"></script>
    <link href="assets/bootstrap.min.css" rel="stylesheet">
    <link href="assets/custom.css" rel="stylesheet">

<?php
    if (isset($dataTables)) {
?>
    <script src="DataTables/jquery.datatables.min.js"></script>
    <link href="DataTables/jquery.datatables.min.css" rel="stylesheet">
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: false,
                lengthChange: false
            });
        });
    </script>
<?php

    } else {
        echo '';
    }

?>


</head>

<body>


<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Forbes Press</a>
        </div>

        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <?php echo $userName ?> <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="usersettings.php">Profile</a></li>
                    <li><a href="#">Statistics</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="logout.php">Log out</a></li>
                </ul>
            </li>
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>
