<?php
require( __DIR__.'/facebook_start.php' );
include('connect.php');
require( __DIR__.'/cred.php' );
$text = htmlspecialchars($_POST['text']);
$name = htmlspecialchars($_POST['project_name']);
//echo $text;
$token = $_SESSION['facebook_access_token'];
$output = curly($token);
echo $output;
$r=json_decode($output, true);
$id= $r['id'];

$uname=$r['name'];
$filename = $_FILES["file"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name
$filesize = $_FILES["file"]["size"];
$allowed_file_types = array('.png');
function curly($token){

    // create curl resource
    $ch = curl_init();

    // set url
    curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/me?access_token=".$token);

    //return the transfer as a string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // $output contains the output string
    $output = curl_exec($ch);

    // close curl resource to free up system resources
    curl_close($ch);

    return $output;
}
function create($fname,$pname){

    // base image is just a transparent png in the same size as the input image
    $base_image = imagecreatefrompng("images/template480.png");
    // Get the facebook profile image in 200x200 pixels
    $photo = imagecreatefromjpeg("images/view.jpg");
    //$photo = imagecreatefromjpeg("http://graph.facebook.com/".$id."/picture?width=200&height=200");

    //resizeImage($photo,920,920);
    // read overlay
    $overlay = imagecreatefrompng("images/overlays/".$pname);
    // keep transparency of base image
    imagesavealpha($base_image, true);
    imagealphablending($base_image, true);
    // place photo onto base (reading all of the photo and pasting unto all of the base)
    imagecopyresampled($base_image, $photo, 0, 0, 0, 0, 480, 480, 480, 480);

    // place overlay on top of base and photo
    imagecopy($base_image, $overlay, 0, 0, 0, 0, 480, 480);
    // Save as jpeg
    imagejpeg($base_image, 'images/view/'.$fname.'.jpg');
}
if($name=="")	{
    $error[] = "provide name !";
}
else if($text=="")	{
    $error[] = "provide a description !";
}

else if (in_array($file_ext,$allowed_file_types) && ($filesize < 20388608))
{
    $sql="SELECT id FROM items";
    $query = mysqli_query($con,$sql);
    $i=mysqli_num_rows ($query);
    $i++;

    $newN='pro_'.$i;
    $newfilename = $newN. $file_ext;

    move_uploaded_file($_FILES["file"]["tmp_name"], "images/overlays/" . $newfilename);
    create($newN,$newfilename);

    $sql = "insert into items values('{$i}','{$uname}','{$id}','{$name}','{$text}','{$newN}')";
    $query = mysqli_query($con,$sql);

    $url=$home.'index.php?id='.$newN;


}
elseif (empty($file_basename))
{
    // file selection error
    $error[] = "Select a file to upload!";
}
elseif ($filesize > 20388608)
{
    // file size error
    $error[] = "File is too large!.";
}
else
{
    // file type error
    $error[] = "File type error!";
    unlink($_FILES["file"]["tmp_name"]);
}
if(isset($error)){
    $_SESSION['error'] = $error;
    header("Location: upload.php?error");
}

session_write_close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Project created </title>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <link href="css/custom.css" rel="stylesheet">

</head>
<body>
    <?php include_once("analyticstracking.php") ?>
    <img src=<?php echo $bg_path?> class="bg">
    <div class="container">
        <div class="row">

            <div class="header">
                <h1>Thank you for create new project</h1>
                <img class="profile" src=<?php echo 'images/view/'.$newN.'.jpg'; ?> alt="">
            </div>
            <div class="content">
                Your project url:
            </br>
            <?php
            echo $url;
            ;
            ?>
            <br/>

        </div>
        <div class="footer">
            Made by <a href="https://www.facebook.com/profile.php?id=100011915590320">@Nilanka Manoj</a>
        </div>
    </div>


</body>
</html>
