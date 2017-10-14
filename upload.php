#overlay
<?php
require( __DIR__.'/facebook_start.php' );

$token = $_SESSION['facebook_access_token'];
//$r = new HttpRequest('https://graph.facebook.com/me?access_token='.$r, HttpRequest::METH_POST);



?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>create new project-upload </title>
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
				<h1>create new project-upload  !</h1>

			</div>
			<?php
			if(isset($_GET['error']))
			{
				$error= $_SESSION['error'];
				foreach($error as $error)
				{
					?>
					<div class="alert alert-danger">
						<i class="glyphicon glyphicon-warning-sign"></i> &nbsp;  <?php echo $error; ?>
					</div>
					<?php
				}
				$_SESSION['error']=null;
			}
			?>
			<div class="content">
				<br/>
				<form action="complete.php" method='post' enctype="multipart/form-data">

					<input type="button" id="loadFileXml" value="Browse Device" onclick="document.getElementById('file').click();" />
					<input type="file" style="display:none;" id="file" name="file" value="<?php if(isset($error)){echo $file;}?>"/>
					<input class="u-full-width" placeholder="Project name" name="project_name"></input>

					<textarea class="u-full-width" placeholder="Some description" name="text"></textarea>
					<input class="button-primary" value="Update" type="submit">
				</form>

			</div>
			<div class="footer">
				Made by <a href="https://www.facebook.com/profile.php?id=100011915590320">@Nilanka Manoj</a>
			</div>
		</div>


	</body>
	</html>
