<?php

require( __DIR__.'/facebook_start.php' );
require( __DIR__.'/cred.php' );

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email', 'user_posts','publish_actions']; // optional
// $callback_url    = 'http://isupportnetneutrality.in/login.php'; // Define this in crud.php
$loginUrl    = $helper->getLoginUrl($home.'login2.php', $permissions);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Create New Project </title>
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
        <div class="row">

            <div class="header">
                <h1>Create New Project</h1>
                <img class="profile" src="images/arjun.jpg"/>
            </div>
            <div class="content">
                <br/>
                <p>Get Support by Updating Profile Picture. </p>
                <a class="button button-primary" href=<?php echo htmlspecialchars($loginUrl);?> > continue </a>

            </div>
            <footer class="footer">
                <div class="pp"><a href="privacy-policy.html">Privacy policy</a></div>
                Made by <a href="https://www.facebook.com/profile.php?id=100011915590320">@Nilanka Manoj</a>
            </footer>

        </div>
    </div>


</body>
</html>
