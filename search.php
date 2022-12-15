<?php 

	include("classes/autoload.php");

	$login = new Login();
	$user_data = $login->check_login($_SESSION['mybook_userid']);
	
	if(isset($_GET['find'])){

		$find = addslashes($_GET['find']);

		$sql = "select * from users where first_name like '%$find%' || last_name like '%$find%' limit 30";
		$DB = new Database();
		$results = $DB->read($sql);


	}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Timeline | Memory</title>

    
	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Webestica.com">
	<meta name="description" content="Bootstrap 5 based Social Media Network and Community Theme">

	
    <!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/vendor/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/OverlayScrollbars.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/tiny-slider.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/choices.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/glightbox.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/dropzone.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/flatpickr.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/plyr.css" />
 
    
  <!-- Theme CSS -->
	<link id="style-switch" rel="stylesheet" type="text/css" href="assets/css/style.css">

</head>
    <body>
	
		<br>
		<?php include("header.php"); ?>

		<!--cover area-->
		<div style="width: 800px;margin:auto;min-height: 400px;">
		 
			<!--below cover area-->
			<div style="display: flex;">	

				<!--posts area-->
 				<div style="min-height: 400px;flex:2.5;padding: 20px;padding-right: 0px;">
 					
 					<div style="border:solid thin #aaa; padding: 10px;background-color: white;">

  					 <?php 

  					 		$User = new User();
  					 		$image_class = new Image();

  					 		if(is_array($results)){

  					 			foreach ($results as $row) {
  					 				# code...
  					 				$FRIEND_ROW = $User->get_user($row['userid']);
 									
 									if($row['type'] == "profile"){
 										include("user.php");
 									}elseif($row['type'] == "group"){
 										include("group.inc.php");
 									}
 					 			}
  					 		}else{

  					 			echo "no results were found";
  					 		}

  					 ?>

  					 <br style="clear: both;">
 					</div>
  

 				</div>
			</div>

		</div>

            
<!-- =======================
JS libraries, plugins and custom scripts -->

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap.bundle.min.js"></script>

<!-- Vendors -->
<script src="assets/vendor/tiny-slider.js"></script>
<script src="assets/vendor/OverlayScrollbars.min.js"></script>
<script src="assets/vendor/choices.min.js"></script>
<script src="assets/vendor/glightbox.min.js"></script>
<script src="assets/vendor/flatpickr.min.js"></script>
<script src="assets/vendor/plyr.js"></script>
<script src="assets/vendor/dropzone.min.js"></script>

<!-- Template Functions -->
<script src="assets/js/functions.js"></script>
 
</body>
</html>