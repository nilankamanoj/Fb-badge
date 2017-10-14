<?php

require( __DIR__.'/facebook_start.php' );
require( __DIR__.'/cred.php' );
include('connect.php');
if(isset($_GET['id'])){
    $proapp=$_GET['id'];
    $_SESSION['proapp']=$proapp;



    $sql = "select * from items where fileurl='{$proapp}'";
    $query = mysqli_query($con,$sql);
    $i=mysqli_num_rows ($query);
    $row = mysqli_fetch_array($query);

    if($i==0){
        header("Location: index.php");
    }

    else{
        $_SESSION['overlay_path']='images/overlays/'.$row['fileurl'].'.png';
        $_SESSION['priview_path']='images/view/'.$row['fileurl'].'.jpg';
        $_SESSION['pro_name']=$row['name'];
        $_SESSION['pro_des']=$row['description'];
        $_SESSION['pro_create']=$row['uname'];
    }
}
$helper = $fb->getRedirectLoginHelper();

$permissions = ['email', 'user_posts','publish_actions']; // optional
// $callback_url    = 'http://isupportnetneutrality.in/login.php'; // Define this in crud.php
$loginUrl    = $helper->getLoginUrl($callback_url, $permissions);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Show your support for <?php echo $_SESSION['pro_name']; ?> </title>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link href="css/custom.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <img src=<?php echo $bg_path?> class="bg">
    <div class="container">
        <?php
        if(isset($_GET['id'])){

            ?>

            <div class="row">

                <div class="header">
                    <h1>Show your support for <?php echo $_SESSION['pro_name']; ?></h1>
                    <?php echo "<img class='profile' src='".$_SESSION['priview_path'] ."'/>" ; ?>

                </div>
                <div class="content">
                    <br/>
                    <p><?php echo $_SESSION['pro_des']; ?></p>
                    <a class="button button-primary" href=<?php echo htmlspecialchars($loginUrl);?> > Log in to Facebook </a>

                </div>

                <footer class="footer">
                    <div class="pp"><a href="privacy-policy.html">Privacy policy</a></div>
                    Made by <a href="https://www.facebook.com/profile.php?id=100011915590320">@Nilanka Manoj</a>
                </footer>

            </div>

            <?php
        }
        else{
            $sql = "select * from items";
            $query = mysqli_query($con,$sql);
            $i=mysqli_num_rows ($query);

            while($row = mysqli_fetch_array($query))
            {
                ?>

                <a href = <?php echo $home.'index.php?id='.$row['fileurl']; ?>><?php echo $home.'index.php?id='.$row['fileurl']; ?></a>
                <?php
            }
            ?>
            <div class="footer">
                Made by <a href="https://www.facebook.com/profile.php?id=100011915590320">@Nilanka Manoj</a>
            </div>
            <?php
        }
        ?>
    </div>

</body>
</html>
