#overlay
<?php
require( __DIR__.'/facebook_start.php' );
if(!isset($_SESSION['pro_name']))
{
	header("Location: index.php");
}
$token = $_SESSION['facebook_access_token'];
//$r = new HttpRequest('https://graph.facebook.com/me?access_token='.$r, HttpRequest::METH_POST);

$output = curly($token);
echo $output;
$r=json_decode($output, true);
$id= $r['id'];
$path = "cache/".$id.$_SESSION['proapp'].".jpg";
$_SESSION['path'] = $path;
// only create if not already exists in cache
if (!file_exists($path)){
	create($id, $path);
}
else{
	echo " \n already exitst : ".$path;
}
//override line 13. Always create for testing purposes
//create($id, $path);
//output as jpeg
//header('Content-Type: image/jpg');
//readfile($path);

//upload($path,$token,$fb);


// HttpRequest for user profile image
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

// Create image
function create($id, $path){

	// base image is just a transparent png in the same size as the input image
	$base_image = imagecreatefrompng("images/template480.png");
	// Get the facebook profile image in 200x200 pixels
	$photo = imagecreatefromjpeg("http://graph.facebook.com/".$id."/picture?width=480&height=480");
	//$photo = imagecreatefromjpeg("http://graph.facebook.com/".$id."/picture?width=200&height=200");


	// read overlay
	$overlay = imagecreatefrompng($_SESSION['overlay_path']);
	// keep transparency of base image
	imagesavealpha($base_image, true);
	imagealphablending($base_image, true);
	// place photo onto base (reading all of the photo and pasting unto all of the base)
	imagecopyresampled($base_image, $photo, 0, 0, 0, 0, 480, 480, 480, 480);

	// place overlay on top of base and photo
	imagecopy($base_image, $overlay, 0, 0, 0, 0, 480, 480);
	// Save as jpeg
	imagejpeg($base_image, $path);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Show your support for <?php echo $_SESSION['pro_name']; ?> | Update </title>
	<link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skeleton.css">
	<link rel="icon" type="image/png" href="images/favicon.png">
	<link href="css/custom.css" rel="stylesheet">

</head>
<body>
	<img src=<?php echo $bg_path?> class="bg">
	<div class="container">
		<div class="row">

			<div class="header">
				<h1>You new profile picture is ready !</h1>
				<img class="profile" src=<?php echo $path ?> alt="">
			</div>
			<div class="content">
				<br/>
				<form action="update.php" method='post'>
					<label for="update" >Status:</label>
					<textarea class="u-full-width" placeholder="" name="text"></textarea>
					<input class="button-primary" value="Update" type="submit">
				</form>




			</div>
			<div class="footer">
				Made by <a href="https://www.facebook.com/profile.php?id=100011915590320">@Nilanka Manoj</a>
			</div>
		</div>


	</body>

	</html>
