<header class="navbar-light bg-mode fixed-top">

    <!-- Logo Nav START -->
	<nav class="navbar navbar-expand-lg">
		<div class="container">
            
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

			<!-- Logo START -->
			<a class="navbar-brand" href="<?=ROOT?>home">
        <img class="light-mode-item navbar-brand-item" src="assets/images/logo.svg" alt="logo">
				<img class="dark-mode-item navbar-brand-item" src="assets/images/logo.svg" alt="logo">
			</a>
            <!-- Logo END -->
   
		
			<!-- Nav right START -->
			<ul class="nav flex-nowrap align-items-center ms-auto list-unstyled">
        <li class="nav-item ms-2 dropdown">
            
					<a class="nav-link btn icon-md p-0" href="#" id="profileDropdown" role="button" data-bs-auto-close="outside" data-bs-display="static" data-bs-toggle="dropdown" aria-expanded="false">
						<img class="avatar-img rounded-2" src="<?php echo ROOT . $image ?>" alt="">
					</a>
          <ul class="dropdown-menu dropdown-animation dropdown-menu-end pt-3 small me-md-n3" aria-labelledby="profileDropdown">
            <!-- Profile info -->
            <li class="px-3">
              <div class="d-flex align-items-center position-relative">
                <!-- Avatar -->
                <div class="avatar me-3">
                  <img class="avatar-img rounded-circle" src="<?php echo ROOT . $image ?>" alt="avatar">
                </div>
                <div>
                  <a class="h6 stretched-link" href="#"> <?php echo $user_data['first_name'] . "<br> " . $user_data['last_name'] ?></a>
                  <p class="small m-0">@<?=$user_data['tag_name']?></p>
                </div>
              </div>
              <a class="dropdown-item btn btn-primary-soft btn-sm my-2 text-center" href="<?=ROOT?>profile">View profile</a>
            </li>
            <!-- Links -->
            <li><a class="dropdown-item" href="settings.html"><i class="bi bi-gear fa-fw me-2"></i>Settings & Privacy</a></li>
           
            <li> <hr class="dropdown-divider"></li>
               <li>
                   <a class="dropdown-item bg-danger-soft-hover" href="<?=ROOT?>logout"><i class="bi bi-power fa-fw me-2"></i>Log Out</a></li>
              </ul>
				</li>
			</ul>
			<!-- Nav right END -->
		</div>
	</nav>
	<!-- Logo Nav END -->
</header>