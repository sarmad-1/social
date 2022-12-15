<?php 

	include("classes/autoload.php");
 

	$login = new Login();
	$user_data = $login->check_login($_SESSION['mybook_userid']);
 
 	$USER = $user_data;
 	
 	if(isset($_GET['id']) && is_numeric($_GET['id'])){

	 	$profile = new Profile();
	 	$profile_data = $profile->get_profile($_GET['id']);

	 	if(is_array($profile_data)){
	 		$user_data = $profile_data[0];
	 	}

 	}

  
	//posting starts here
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$post = new Post();
		$id = $_SESSION['mybook_userid'];
		$result = $post->create_post($id, $_POST,$_FILES);
		
		if($result == "")
		{
			header("Location:" . ROOT . "home");
			die;
		}else
		{

			echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
			echo "<br>The following errors occured:<br><br>";
			echo $result;
			echo "</div>";
		}
	}

	$corner_image = "images/user_male.jpg";
	if(isset($USER)){
		
		if(file_exists($USER['profile_image']))
		{
			$image_class = new Image();
			$corner_image = $image_class->get_thumb_profile($USER['profile_image']);
		}else{

			if($USER['gender'] == "Female"){

				$corner_image = "images/user_female.jpg";
			}
		}
	}


?>

<!DOCTYPE html>
	<html>
  <head>
  <title>Social - Network, Community and Event Theme</title>
      <?php
        include("look_css.php");
      ?>
</head>
        <body>
            
    

<!-- =======================
Header START -->
<?php
    include("header.php");
?>
<!-- =======================
Header END -->

<!-- **************** MAIN CONTENT START **************** -->
<main>
  
  <!-- Container START -->
  <div class="container">
    <div class="row g-4">

      <!-- Sidenav START -->
      <div class="col-lg-3">

        <!-- Advanced filter responsive toggler START -->
        <div class="d-flex align-items-center d-lg-none">
          <button class="border-0 bg-transparent" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSideNavbar" aria-controls="offcanvasSideNavbar">
            <i class="btn btn-primary fw-bold fa-solid fa-sliders-h"></i>
            <span class="h6 mb-0 fw-bold d-lg-none ms-2">My profile</span>
          </button>
        </div>
        <!-- Advanced filter responsive toggler END -->
        
        <!-- Navbar START-->
        <nav class="navbar navbar-expand-lg mx-0"> 
          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSideNavbar">
            <!-- Offcanvas header -->
            <div class="offcanvas-header">
              <button type="button" class="btn-close text-reset ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <!-- Offcanvas body -->
            <div class="offcanvas-body d-block px-2 px-lg-0">
              <!-- Card START -->
              <div class="card overflow-hidden">
                <!-- Cover image -->
                <div class="h-50px" style="background-image:url(assets/images/bg/01.jpg); background-position: center; background-size: cover; background-repeat: no-repeat;"></div>
                  <!-- Card body START -->
                  <div class="card-body pt-0">
                    <div class="text-center">
                    <!-- Avatar -->
                    <div class="avatar avatar-lg mt-n5 mb-3">
                      <a href="#!"><img class="avatar-img rounded border border-white border-3" src="<?php echo ROOT . $image ?>" alt=""></a>
                    </div>
                    <!-- Info -->
                    <h5 class="mb-0"> <a href="#!"> <?php echo $user_data['first_name'] . "<t> " . $user_data['last_name'] ?> </a> </h5>
                    <small>@<?=$user_data['tag_name']?></small>
                    <p class="mt-3"><?php
                        $settings_class = new Settings();
                        $settings = $settings_class->get_settings($_SESSION['mybook_userid']);
                        if(is_array($settings)){
                            echo "".htmlspecialchars($settings['about'])."";
                        }
                    ?></p>

                    <!-- User stat START -->
                    <div class="hstack gap-2 gap-xl-3 justify-content-center">
                      <!-- User stat item -->
                      <div>
                        <h6 class="mb-0">365</h6>
                        <small>Following</small>
                      </div>
                    </div>
                    <!-- User stat END -->
                  </div>

                  <!-- Divider -->
                  <hr>
                      

                  <!-- Side Nav START -->
                  <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                    <?php
                        $image_class = new Image();
                        $post_class = new Post();
                        $user_class = new User();

                        $following = $user_class->get_following($user_data['userid'],"user");
                      
                        if(is_array($following)){

                            foreach ($following as $follower) {
                                # code...
                                echo"<ui>";
                                $FRIEND_ROW = $user_class->get_user($follower['userid']);
                                include("user.php");
                                echo"</ui>";
                            }

                        }else{

                            echo "This user inst following anyone!";
                        }
                    ?>
                    </ul>
                  <!-- Side Nav END -->
                </div>
                <!-- Card body END -->
                  
                <!-- Card footer -->
                <div class="card-footer text-center py-2">
                  <a class="btn btn-link btn-sm" href="<?=ROOT?>profile">View Profile </a>
                </div>
              </div>
              <!-- Card END -->

                
                
                
              <!-- Helper link START -->
              <ul class="nav small mt-4 justify-content-center lh-1">
                
              </ul>
              <!-- Helper link END -->
              <!-- Copyright -->
              <p class="small text-center mt-1">©2022 <a class="text-body" target="_blank" href="#!"> @sarmad </a></p>
            </div>
          </div>
        </nav>
        <!-- Navbar END-->
      </div>
      <!-- Sidenav END -->

        
        
        
      <!-- Main content START -->
      <div class="col-md-8 col-lg-6 vstack gap-4">
     
        <!-- Share feed START -->
        <div class="card card-body">
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

        <!-- Card feed item START -->
        <!--posts-->
          <?php 
    
                $Post = new Post();
                $ROW = false;
                $DB = new Database();
                $user_class = new User();
                $image_class = new Image();

                $followers = $user_class->get_following($_SESSION['mybook_userid'],"user");

                $follower_ids = false;
                if(is_array($followers)){

                    $follower_ids = array_column($followers, "userid");
                    $follower_ids = implode("','", $follower_ids);

                }

                if($follower_ids){
                    $myuserid = $_SESSION['mybook_userid'];
                    $sql = "select * from posts where parent = 0 and owner = 0 and (userid = '$myuserid' || userid in('" .$follower_ids. "')) order by id desc";
                    $posts = $DB->read($sql);
                }

                if(isset($posts) && $posts)
                {

                    foreach ($posts as $ROW) {
                        # code...

                        $user = new User();
                        $ROW_USER = $user->get_user($ROW['userid']);

                        include("post.php");
                    }
                }
             ?> 
        <!-- Card feed item END -->
      </div>
      <!-- Main content END -->

      <!-- Right sidebar START -->
      <div class="col-lg-3">
        <div class="row g-4">
          <!-- Card follow START -->
          <div class="col-sm-6 col-lg-12">
            <div class="card">
              <!-- Card header START -->
              <div class="card-header pb-0 border-0">
                <h5 class="card-title mb-0">Who to follow</h5>
              </div>
              <!-- Card header END -->
              <!-- Card body START -->
              <div class="card-body">
                  <?php
                  		$find = "";
                        $sql = "select * from users where first_name like '%$find%' || last_name like '%$find%' limit 30";
                        $DB = new Database();
                        $results = $DB->read($sql);
                        
                        $User = new User();
  					 	$image_class = new Image();

                        if(is_array($results)){

                            foreach ($results as $row) {
                                # code...
                                $FRIEND_ROW = $User->get_user($row['userid']);
                                $image = "images/user_male.jpg";
		                        if($FRIEND_ROW['gender'] == "Female")
		                          {$image = "images/user_female.jpg";
		                          }
                                if(file_exists($FRIEND_ROW['profile_image']))
                                {
                                    $image = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']);
                                }

                                include("user.php");
                                
                            }
  					  }else{
                            echo "no results were found";
  					 		}
                ?>
              </div>
              <!-- Card body END -->
            </div>
          </div>
          <!-- Card follow START -->

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