<?php 

session_start();

	include("classes/connect.php");
	include("classes/login.php");
 
	$email = "";
	$password = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{


		$login = new Login();
		$result = $login->evaluate($_POST);
		
		if($result != "")
		{

			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following errors occured:<br><br>";
			echo $result;
			echo "</div>";
		}else
		{
            include("cookes.php");  
			header("Location: profile");
			die;
		}
 

		$email = $_POST['email'];
		$password = $_POST['password'];
		

	}


	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign in Zikrayat</title>

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
	<link rel="stylesheet" type="text/css" href="assets/vendor/glightbox.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendor/dropzone.min.css" />
  <link rel="stylesheet" type="text/css" href="assets/vendor/choices.min.css">

	<!-- Theme CSS -->
	<link id="style-switch" rel="stylesheet" type="text/css" href="assets/css/style.css">
	 
</head>
<body>

<main>

<!-- **************** MAIN CONTENT START **************** -->

  <!-- Main content START -->
  <div class="bg-primary pt-5 pb-0 position-relative">
    <!-- Container START -->
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-12">
          <!-- Title -->
          <h5 class="display-4 text-white mb-4 position-relative"></h5>
        
        </div>
        <div class="col-sm-10 col-md-8 col-lg-6 position-relative z-index-1">
          <!-- Sign in form START -->
          <div class="card card-body p-4 p-sm-5 mt-sm-n5 mb-n5">
            <!-- Title -->
            <h2 class="h1 mb-2">Sign in</h2>
            <p>Don't have an account?<a href="signup.php"> Click here to sign up</a></p>
            <!-- Form START -->
            <form class="mt-4" method="post">
              <!-- Email -->
              <div class="mb-3 position-relative input-group-lg">
                <input name="email" value="<?php echo $email ?>"type="email" class="form-control" placeholder="Email">
              </div>
              <div class="mb-3 position-relative input-group-lg">
                <input name="password" type="password" class="form-control" placeholder="Password">
              </div>
              <!-- Remember me -->
              <div class="mb-3 d-sm-flex justify-content-between">
                <div>
                  <input type="checkbox" class="form-check-input" id="rememberCheck">
                  <label class="form-check-label" for="rememberCheck">Remember me?</label>
                </div>
              </div>
              <!-- Button -->
              <div class="d-grid">
                <button type="submit" class="btn btn-lg btn-primary-soft">Login</button>
              </div>
              <!-- Copyright -->
              <p class="mb-0 mt-3">©2022 <a target="_blank" href="https://www.sarmad.co.vu/">Sarmad.</a> All rights reserved</p>
            </form>
            <!-- Form END -->
          </div>
          <!-- Sign in form START -->
        </div>
      </div> <!-- Row END -->
    </div>
    <!-- Container END -->
  </div>
  <!-- Main content END -->

</main>
<!-- **************** MAIN CONTENT END **************** -->

<!-- =======================
Footer START -->
<footer class="pt-5 pb-2 pb-sm-4 position-relative bg-mode">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-10 col-md-8 col-lg-6">
        <div class="d-grid d-sm-flex justify-content-center justify-content-sm-between align-items-center mt-3">
          <!-- Nav -->
          <ul class="nav">
            <li class="nav-item"><a class="nav-link fw-bold ps-0 pe-2" href="#">Terms</a></li>
            <li class="nav-item"><a class="nav-link fw-bold px-2" href="#">Privacy</a></li>
            <li class="nav-item"><a class="nav-link fw-bold px-2" href="#">Cookies</a></li>
          </ul>
          <!-- Social icon -->
          <ul class="nav justify-content-center justify-content-sm-end">
            <li class="nav-item">
              <a class="nav-link px-2 fs-5" href="#"><i class="fa-brands fa-facebook-square"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-2 fs-5" href="#"><i class="fa-brands fa-twitter-square"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-2 fs-5" href="#"><i class="fa-brands fa-linkedin"></i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link px-2 fs-5" href="#"><i class="fa-brands fa-youtube-square"></i></a>
            </li>
           </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- =======================
Footer END -->

<!-- **************** MAIN CONTENT END **************** -->

<!-- =======================
JS libraries, plugins and custom scripts -->

<!-- Bootstrap JS -->
<script src="assets/vendor/bootstrap.bundle.min.js"></script>

<!-- Vendors -->
<script src="assets/vendor/pswmeter.min.js"></script>

<!-- Template Functions -->
<script src="assets/js/functions.js"></script>

</body>
</html>