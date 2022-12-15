<?php 

	include("classes/connect.php");
	include("classes/signup.php");

	$first_name = "";
	$last_name = "";
	$gender = "";
	$email = "";

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{


		$signup = new Signup();
		$result = $signup->evaluate($_POST);
		
		if($result != "")
		{

			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following errors occured:<br><br>";
			echo $result;
			echo "</div>";
		}else
		{

			header("Location: login");
			die;
		}
 

		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$gender = $_POST['gender'];
		$email = $_POST['email'];

	}


	

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign up Zikrayat</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="sarmad">
	<meta name="description" content="Login page">

	<!-- Favicon -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

	<!-- Plugins CSS -->
	<link rel="stylesheet" type="text/css" href="assets/all.min.css">
	<link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap-icons.css">

	<!-- Theme CSS -->
	<link id="style-switch" rel="stylesheet" type="text/css" href="assets/css/style.css">
	 
</head>

<body>

<!-- **************** MAIN CONTENT START **************** -->
<main>
  
  <!-- Container START -->
  <div class="container">
    <div class="row justify-content-center align-items-center vh-100 py-5">
      <!-- Main content START -->
      <div class="col-sm-10 col-md-8 col-lg-7 col-xl-6 col-xxl-5">
        <!-- Sign up START -->
        <div class="card card-body rounded-3 p-4 p-sm-5">
          <div class="text-center">
            <!-- Title -->
            <h1 class="mb-2">Sign up</h1>
            <span class="d-block">Already have an account? <a href="login.php">Login here</a></span>
          </div>
          <!-- Form START -->
          <form class="mt-4" method="post" action="">
            <div class="mb-3 input-group-lg position-relative">
                <!-- First Name -->
                <div class="mb-3 input-group-lg">
                  <input value="<?php echo $first_name ?>" name="first_name" type="text" class="form-control" placeholder="First Name">
                  <small>We'll never share your email with anyone else.</small>
                </div>
                <!-- Last Name -->
                <div class="mb-3 input-group-lg">
                  <input value="<?php echo $last_name ?>" name="last_name" type="text" class="form-control" placeholder="Last Name">
                  <small>We'll never share your email with anyone else.</small>
                </div>
              </div>
            <!-- Email -->
            <div class="mb-3 input-group-lg">
              <input value="<?php echo $email ?>" name="email" type="email" class="form-control" placeholder="Email">
              <small>We'll never share your email with anyone else.</small>
            </div>
            <div class="mb-3 input-group-lg">
                <select class="form-control" name="gender">
                    <option><?php echo $gender ?></option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div class="mb-3 input-group-lg btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked>Male
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option2" autocomplete="off" checked>Female
                </label>
            </div>
            <!-- New password -->
            <div class="mb-3 position-relative">
              <!-- Input group -->
              <div class="input-group input-group-lg">
                <input class="form-control fakepassword" name="password" type="password" id="psw-input" placeholder="Enter new password">
                <span class="input-group-text p-0">
                  <i class="fakepasswordicon fa-solid fa-eye-slash cursor-pointer p-2 w-40px"></i>
                </span>
              </div>
                
              <!-- Pswmeter -->
              <div id="pswmeter" class="mt-2"></div>
              <div class="d-flex mt-1">
                <div id="pswmeter-message" class="rounded"></div>
                <!-- Password message notification -->
                <div class="ms-auto">
                  <i class="bi bi-info-circle ps-1" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Include at least one uppercase, one lowercase, one special character, one number and 8 characters long." data-bs-original-title="" title=""></i>
                </div>
              </div>
            </div>
            <!-- Confirm password -->
            <div class="mb-3 input-group-lg">
              <input class="form-control" name="password2" type="password" placeholder="Confirm password">
            </div>
            <!-- Keep me signed in -->
            <div class="mb-3 text-start">
              <input type="checkbox" class="form-check-input" id="keepsingnedCheck">
              <label class="form-check-label" for="keepsingnedCheck"> Keep me signed in</label>
            </div>
            <!-- Button -->
            <div class="d-grid"><button type="submit" class="btn btn-lg btn-primary">Sign me up</button></div>
            <!-- Copyright -->
            <p class="mb-0 mt-3 text-center">©2022 <a target="_blank" href="https://srmd.co.vu/">Sarmad</a> All rights reserved</p>
          </form>
          <!-- Form END -->
        </div>
        <!-- Sign up END -->
      </div>
    </div> <!-- Row END -->
  </div>
  <!-- Container END -->

</main>

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