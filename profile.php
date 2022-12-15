<?php

	include("classes/autoload.php");
    
	$login = new Login();
	$_SESSION['mybook_userid'] = isset($_SESSION['mybook_userid']) ? $_SESSION['mybook_userid'] : 0;
	
	$user_data = $login->check_login($_SESSION['mybook_userid'],false);
 
 	$USER = $user_data;
 	
 	if(isset($URL[1]) && is_numeric($URL[1])){

	 	$profile = new Profile();
	 	$profile_data = $profile->get_profile($URL[1]);

	 	if(is_array($profile_data)){
	 		$user_data = $profile_data[0];
	 	}

 	}
 	
	//posting starts here
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		include("change_image.php");
		
		if(isset($_POST['first_name'])){

			$settings_class = new Settings();
			$settings_class->save_settings($_POST,$_SESSION['mybook_userid']);

		}elseif(isset($_POST['post'])){

			$post = new Post();
			$id = $_SESSION['mybook_userid'];
			$result = $post->create_post($id, $_POST,$_FILES);
			
			if($result == "")
			{
				header("Location: " . ROOT . "profile");
				die;
			}else
			{

				echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
				echo "<br>The following errors occured:<br><br>";
				echo $result;
				echo "</div>";
			}
		}
			
	}

	//collect posts
	$post = new Post();
	$id = $user_data['userid'];
	
	$posts = $post->get_posts($id);

	//collect friends
	$user = new User();
 	
	$friends = $user->get_following($user_data['userid'],"user");

	$image_class = new Image();


?>

<!DOCTYPE html>
	<html>
	<head>
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

      <?php
        include("look_css.php");
      ?>
    
</head> 
	<body style="font-family: tahoma; background-color: #d0d8e4;">
        <?php
            $id_user = $_SESSION['mybook_userid'];
        ?>
        <script>
            function setCookie(cname, cvalue, exdays) {
              const d = new Date();
              d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
              let expires = 'expires='+d.toUTCString();
              document.cookie = cname + '=' + cvalue + ';' + expires ;
              document.cookie = "time=" + d ;
            }

            function getCookie(cname) {
              let name = cname + '=';
              let ca = document.cookie.split(';');
              for(let i = 0; i < ca.length; i++) {
                let c = ca[i];
                while (c.charAt(0) == ' ') {
                  c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                  return c.substring(name.length, c.length);
                }
              }
              return '';
            }

            function checkCookie() {
              let user = getCookie("<?php echo $id_user ; ?>");
              if (user != '') {
                alert('Welcome again ( ' + user +' ) your last login was in: <?php echo  $user_data['date']; ?>');
              } else {
                  user= "<?php echo $user_data['first_name']." ". $user_data['last_name'] ; ?>"
                if (user != '' && user != null) {
                  setCookie("<?php echo $id_user ; ?>", user, 7);
                }
              }
            }    
            checkCookie();
        </script>    
<!-- =======================
Header START -->
<?php
    include("header.php");
?>
<!-- =======================
Header END -->
 
<main>
  
  <!-- Container START -->
  <div class="container">
    <div class="row g-4">
        
      <!-- Main content START -->
      <div class="col-lg-8 vstack gap-4">
        
          <!-- My profile START -->
        <div class="card ">
          <!-- Cover image -->
            <?php 

						$image = "images/cover_image.jpg";
						if(file_exists($user_data['cover_image']))
						{
							$image = $image_class->get_thumb_cover($user_data['cover_image']);
						}
					?>

          <div class="h-200px rounded-top" style="background-image:url(<?php echo ROOT . $image ?>); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
            <!-- Card body START -->
            <div class="card-body py-0">
              <div class="d-sm-flex align-items-start text-center text-sm-start">
                <div>
                    <?php 

                $image = "images/user_male.jpg";
                if($user_data['gender'] == "Female")
                {
                    $image = "images/user_female.jpg";
                }
                if(file_exists($user_data['profile_image']))
                {
                    $image = $image_class->get_thumb_profile($user_data['profile_image']);
                }
            ?>
                  <!-- Avatar -->
                  <div class="avatar avatar-xxl mt-n5 mb-3">
                    <img class="avatar-img rounded-circle border border-white border-3" src="<?php echo ROOT . $image ?>" alt="">
                  </div>
                </div>
                <div class="ms-sm-4 mt-sm-3">
                  <!-- Info -->
                  <h1 class="mb-0 h5"><?php echo $user_data['first_name'] . "<t> " . $user_data['last_name'] ?><i class="bi bi-patch-check-fill text-success small"></i></h1>
                  <p>@<?=$user_data['tag_name']?></p>
                </div>
                <!-- Button -->
                <div class="d-flex mt-3 justify-content-center ms-sm-auto">
                    <?php if(i_own_content($user_data)):?>
                        <button id="edit_account" onclick="show_edit_account(event)" id="edit_pro" data-bs-toggle="modal" data-bs-target="#modalCreateFeed5" class="btn btn-danger-soft me-2" type="button"> <i class="bi bi-pencil-fill pe-1"></i> Edit profile </button>
                    <?php endif; ?>
                </div>
                <div class=" mt-3 justify-content-center ">
                    <?php 
							$mylikes = "";
							if($user_data['likes'] > 0){

								$mylikes = "(" . $user_data['likes'] . " Followers)";
							}
						?>
                    <a href="<?=ROOT?>like/user/<?php echo $user_data['userid'] ?>">

                      <button id="follow_pro" class="btn btn-success-soft" type="button"> <i class="bi bi-pencil-fill pe-1">Follow <?php echo $mylikes ?></i></button>
                    </a>
                </div>
                  
                  
              </div>

                
            <!--change image cover area-->

                  <div class=" list-inline mb-0 text-center d-sm-flex align-items-start text-center text-sm-start mt-sm-0">
               <div class=" mt-3 justify-content-center ">
                    
                  <?php 

						$image = "images/cover_image.jpg";
						if(file_exists($user_data['cover_image']))
						{
							$image = $image_class->get_thumb_cover($user_data['cover_image']);
						}
					?>
					<?php 

						$image = "images/user_male.jpg";
						if($user_data['gender'] == "Female")
						{
							$image = "images/user_female.jpg";
						}
						if(file_exists($user_data['profile_image']))
						{
							$image = $image_class->get_thumb_profile($user_data['profile_image']);
						}
					?>
					<?php if(i_own_content($user_data)):?>
                    
                        <button data-bs-toggle="modal" data-bs-target="#modalCreateFeed7" id="follow_pro" class="btn btn btn-primary-soft btn-sm" type="button" href="<?=ROOT?>change_profile_image/profile"> <i class="bi bi-pencil-fill pe-1"></i> Change Profile </button>
                    
                        <button data-bs-toggle="modal" data-bs-target="#modalCreateFeed6" id="follow_pro" class="btn btn btn-primary-soft btn-sm" type="button" href="<?=ROOT?>change_profile_image/cover"> <i class="bi bi-pencil-fill pe-1"></i> Change Cover </button>
                    
					<?php endif; ?>

                </div>						
			</div>
            
            </div>
            <!-- Card body END -->
          
          </div>
          <!-- My profile END -->
          
          
        <div class="card ">
        <!-- Share feed START -->
        <div class=" card-body">
          <div class="d-flex mb-3">
            <!-- Avatar -->
            <div class="avatar avatar-xs me-2">
                
             <?php 

                $image = "images/user_male.jpg";
                if($user_data['gender'] == "Female")
                {
                    $image = "images/user_female.jpg";
                }
                if(file_exists($user_data['profile_image']))
                {
                    $image = $image_class->get_thumb_profile($user_data['profile_image']);
                }
            ?>

              <a href="#"> <img class="avatar-img rounded-circle" src="<?php echo ROOT . $image ?>" alt=""> </a>
            </div>
            <!-- Post input -->
            <form class="w-100">
              <input class="form-control pe-4 border-0" placeholder="Share your thoughts..." data-bs-toggle="modal" data-bs-target="#modalCreateFeed">
            </form>
          </div>
          <!-- Share feed toolbar START -->
          <ul class="nav nav-pills nav-stack small fw-normal">
            <li class="nav-item">
              <a class="nav-link bg-light py-1 px-2 mb-0" href="#!" data-bs-toggle="modal" data-bs-target="#feedActionPhoto"> <i class="bi bi-image-fill text-success pe-2"></i>Photo</a>
            </li>
          </ul>
          <!-- Share feed toolbar END -->
        </div>
        <!-- Share feed END -->

          </div>
        
        <?php 
            $Post = new Post();
            $id = $user_data['userid'];
	        $posts = $post->get_posts($id);


            if($posts)
            {
                foreach ($posts as $ROW) {
                    # code...

                    $user = new User();
                    $ROW_USER = $user->get_user($ROW['userid']);

                    include("post.php");
                }
            }
         ?>  
      </div>
      <!-- Main content END -->
        
        
        
      <!-- Right sidebar START -->
      <div class="col-lg-4">

        <div class="row g-4">

          <!-- Card START -->
          <div class="col-md-6 col-lg-12">
            <div class="card">
              <div class="card-header border-0 pb-0">
                <h5 class="card-title">About</h5>
                <!-- Button modal -->
              </div>
              <!-- Card body START -->
              <div class="card-body position-relative pt-0">
                <p>			
                    <?php
                        $settings_class = new Settings();
                        $settings = $settings_class->get_settings($_SESSION['mybook_userid']);
                        if(is_array($settings)){
                            echo "".htmlspecialchars($settings['about'])."";
                        }
                    ?> 
                  </p>
              </div>
              <!-- Card body END -->
            </div>
          </div>
          <!-- Card END -->

            
            <!-- Card START -->
          <div class="col-md-6 col-lg-12">
            <div class="card">
              <!-- Card header START -->
              <div class="card-header d-sm-flex justify-content-between border-0">
                <h5 class="card-title">Photos</h5>
              </div>
              <!-- Card header END -->
              <!-- Card body START -->
              <div class="card-body position-relative pt-0">
                <div class="row g-2">
                      
                 <?php
                    $DB = new Database();
                    $sql = "select image,postid from posts where has_image = 1 && userid = $user_data[userid] order by id desc limit 30";
                    $images = $DB->read($sql);

                    $image_class = new Image();

                    if(is_array($images)){

                        foreach ($images as $image_row) {
                            # code...
                            echo "<div class='col-6'><a href='" . ROOT . $image_class->get_thumb_post($image_row['image']) . "' data-gallery='image-popup' data-glightbox=''><img class='rounded img-fluid' src='" . ROOT . $image_class->get_thumb_post($image_row['image']) . "' alt=''></a></div>";
                        }
                    } else{ echo "No images were found!"; }
                ?>  

                </div>
              </div>
              <!-- Card body END -->
            </div>
          </div>
          <!-- Card END -->

        </div>

      </div>
      <!-- Right sidebar END -->

    </div> <!-- Row END -->
      
  </div>
  <!-- Container END -->

</main>    
<!-- **************** MAIN CONTENT END **************** -->

<?php
    include("modal.php");
    include("look_js.php");
?>
        
	</body>
</html>