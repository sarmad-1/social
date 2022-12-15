

<!-- Modal create Feed START -->
<div class="modal fade" id="modalCreateFeed" tabindex="-1" aria-labelledby="modalLabelCreateFeed" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <!-- Modal feed header START -->
      <div class="modal-header">
        <h5 class="modal-title" id="feedActionPhotoLabel">Add Text post</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal feed header END -->

        <!-- Modal feed body START -->
        <div class="modal-body">
            <form class="w-100"  method="post" enctype="multipart/form-data">
                <!-- Add Feed -->
                <div class="d-flex mb-3">
                  <!-- Avatar -->
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
          <div class="avatar avatar-xs me-2">
            <img class="avatar-img rounded-circle" src="<?php echo ROOT . $image ?>" alt="">
          </div>
          <!-- Feed box  -->

            <textarea name="post" class="form-control pe-4 fs-3 lh-1 border-0" rows="4" placeholder="Share your thoughts..." autofocus></textarea>
                </div>
                <!-- Modal feed footer -->
                <div class="modal-footer ">
                  <!-- Button -->
                    <button type="button" class="btn btn-danger-soft me-2" data-bs-dismiss="modal">Cancel</button>
                    <button id="post_button" type="submit" value="Post" class="btn btn-success-soft">Post</button>
                </div>
                <!-- Modal feed footer -->
            </form>
        </div>
  </div>
  </div>
</div>
<!-- Modal create feed END -->

<!-- Modal create Feed START -->
<div class="modal fade" id="modalCreateFeed2" tabindex="-1" aria-labelledby="modalLabelCreateFeed" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <!-- Modal feed header START -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelCreateFeed">Comments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal feed header END -->

      <!-- Modal feed body START -->
      <div class="modal-body">
          <!-- Comment wrap START -->
          <ul class="comment-wrap list-unstyled mb-0">
            <?php 

                $comments = $Post->get_comments($ROW['postid']);

                if(is_array($comments)){

                    foreach ($comments as $COMMENT) {
                        # code...
                        $ROW_USER = $user->get_user($COMMENT['userid']);
                        include("comment.php");
                    }
                }
            ?>
        </ul>
        <!-- Comment wrap END -->
    </div>
            <!-- Card body END -->
            <!-- Card footer START -->
            <div class="card-footer border-0 pt-0">
        </div>
      <!-- Modal feed body END -->

      <!-- Modal feed footer -->
      <div class="modal-footer row justify-content-between">
          
        <!-- Button -->
        <div class="col-lg-8 text-sm-end">
            <?php if($ROW['parent'] == 0): ?>

	  					 <br style="clear: both;">

						<?php if(!($is_group_post && $group_data['group_type'] == 'public' && !group_access($_SESSION['mybook_userid'],$group_data,'member'))): ?>

	  					<div class="d-flex mb-3">
                            <div class="avatar avatar-xs me-2">
                                <a href="#!"> <img class="avatar-img rounded-circle" src="<?php echo ROOT . $image ?>" alt=""> </a>
                            </div>
	 						
                            <form class="position-relative w-100" method="post" >

		 						<textarea name="post" class="form-control pe-4 bg-light" data-autoresize rows="1" placeholder="Add a comment..."></textarea>
		 						 <div class="position-absolute top-0 end-0">
                                    <input type="hidden" name="parent" value="<?php echo $ROW['postid'] ?>">
                      
                                     <button id="post_button" type="submit" value="Post" class="btn btn-success-soft">Post</button>
                                    <br>
                                </div>
	 						</form>
	 					</div>

 					 	<?php endif; ?>

 					 <?php else: ?>
 					 	<a href="<?=ROOT?>index-classic/<?php echo $ROW['parent'] ?>" >
 					 		<input id="post_button" style="width:auto;float: left;cursor: pointer;" type="button" value="Back to main post" />
 					 	</a>
 					 <?php endif; ?>
        </div>
      </div>
      <!-- Modal feed footer -->

    </div>
  </div>
</div>


<!-- Modal create Feed START -->
<div class="modal fade" id="modalCreateFeed4" tabindex="-1" aria-labelledby="modalLabelCreateFeed" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <!-- Modal feed header START -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelCreateFeed">Comments</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal feed header END -->

      <!-- Modal feed body START -->
      <div class="modal-body">
         <div class="d-flex mb-3">
            <!-- Comment wrap START -->
            <ul class="comment-wrap list-unstyled">
              <!-- Comment item START -->
                <?php 

                    $comments = $Post->get_limit_comments($ROW['postid']);

                    if(is_array($comments)){

                        foreach ($comments as $COMMENT) {
                            # code...
                            $ROW_USER = $user->get_user($COMMENT['userid']);
                            include("comment.php");
                        }
                    }
                    ?>
              <!-- Comment item END -->
            </ul>
    <!-- Comment wrap END -->
        </div>
       
      <!-- Modal feed footer -->
      <div class="modal-footer row justify-content-between">
          
        <!-- Button -->
        <div class=" text-sm-end">
          <button id="post_button" type="submit" value="Save" class="btn btn-success-soft">Save Edit</button>
        </div>
      </div>
      <!-- Modal feed footer -->
        </div>
    </div>
  </div>
</div>
<!-- Modal create feed END -->


<!-- Modal create Feed START -->
<div class="modal fade" id="modalCreateFeed5" tabindex="-1" aria-labelledby="modalLabelCreateFeed" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <!-- Modal feed header START -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelCreateFeed">Edit Account</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal feed header END -->

      <!-- Modal feed body START -->
      <div class="modal-body">
          <form class="w-100" method="post" enctype="multipart/form-data">
        <div style="min-height: 400px;width:100%;background-color: white;text-align: center;">
	<div style="padding: 20px;max-width:350px;display: inline-block;">
        <?php
    
            $settings_class = new Settings();
            $settings = $settings_class->get_settings($_SESSION['mybook_userid']);

            if(is_array($settings)){

                echo "First Name<input type='text' class='form-control' name='first_name' value='".htmlspecialchars($settings['first_name'])."' placeholder='First name' />";
                echo "<br>Last Name<input type='text' class='form-control' name='last_name' value='".htmlspecialchars($settings['last_name'])."' placeholder='Last name' />";

                echo "<br>Gender<select class='form-control' name='gender'<option>".htmlspecialchars($settings['gender'])."</option><option>Male</option><option>Female</option></select>";

                echo "<br>Email<input type='text' class='form-control' name='email'  value='".htmlspecialchars($settings['email'])."' placeholder='Email'/>";
                echo "<br>Password<input type='password' class='form-control' name='password'  value='".htmlspecialchars($settings['password'])."' placeholder='Password'/>";
                echo "<br>Repet Password<input type='password' class='form-control'class='form-control' name='password2'  value='".htmlspecialchars($settings['password'])."' placeholder='Password'/>";

                echo "<br>About me<br><textarea class='form-control' style='height:200px;' name='about'>".htmlspecialchars($settings['about'])."</textarea>";
            }	
			?>
			</div>
          </div>
       
      <!-- Modal feed footer -->
      <div class="modal-footer row justify-content-between">
          
        <!-- Button -->
        <div class=" text-sm-end">
          <button id="post_button" type="submit" value="Save" class="btn btn-success-soft">Save Edit</button>
        </div>
      </div>
      <!-- Modal feed footer -->
          </form>
        </div>
    </div>
  </div>
</div>
<!-- Modal create feed END -->


<!-- Modal create Feed START -->
<div class="modal fade" id="modalCreateFeed6" tabindex="-1" aria-labelledby="modalLabelCreateFeed" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <!-- Modal feed header START -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelCreateFeed">Change Cover Picature</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal feed header END -->

      <!-- Modal feed body START -->
      <div class="modal-body">
          <form class="w-100" method="post" action="<?=ROOT?>profile/cover" enctype="multipart/form-data">

            <input class="form-control" type="file" name="file">

            <div style="text-align: center;">
                <br><br>
            <?php

                echo "<img class='rounded img-fluid' src='" . ROOT . "$user_data[cover_image]'  >";

            ?>
          </div>
       
      <!-- Modal feed footer -->
      <div class="modal-footer row justify-content-between">
          
        <!-- Button -->
        <div class=" text-sm-end">
          <button id="post_button" value="Change" type="submit" class="btn btn-success-soft">Save Edit</button>
        </div>
      </div>
      <!-- Modal feed footer -->
          </form>
        </div>
    </div>
  </div>
</div>
<!-- Modal create feed END -->
        
        
<!-- Modal create Feed START -->
<div class="modal fade" id="modalCreateFeed7" tabindex="-1" aria-labelledby="modalLabelCreateFeed" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <!-- Modal feed header START -->
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabelCreateFeed">Change Profile Picature</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal feed header END -->

      <!-- Modal feed body START -->
      <div class="modal-body">
          <form class="w-100" method="post" action="<?=ROOT?>profile/profile" enctype="multipart/form-data">
        
            <input class="form-control" type="file" name="file">

            <div style="text-align: center;">
                <br>
            <?php

                echo "<img class='rounded img-fluid' src='" . ROOT . "$user_data[profile_image]'  >";
            ?>
                <br>
          </div>
       
      <!-- Modal feed footer -->
      <div class="modal-footer row justify-content-between">
          
        <!-- Button -->
        <div class=" text-sm-end">
          <button id="post_button" value="Change" type="submit" class="btn btn-success-soft">Save Edit</button>
        </div>
      </div>
      <!-- Modal feed footer -->
          </form>
        </div>
    </div>
  </div>
</div>
<!-- Modal create feed END -->


<!-- Modal create Feed photo START -->
<div class="modal fade" id="feedActionPhoto" tabindex="-1" aria-labelledby="feedActionPhotoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal feed header START -->
      <div class="modal-header">
        <h5 class="modal-title" id="feedActionPhotoLabel">Add post photo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal feed header END -->

        <!-- Modal feed body START -->
        <div class="modal-body">
            <form class="w-100"  method="post" enctype="multipart/form-data">
                <!-- Add Feed -->
                <div class="d-flex mb-3">
                  <!-- Avatar -->
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
          <div class="avatar avatar-xs me-2">
            <img class="avatar-img rounded-circle" src="<?php echo ROOT . $image ?>" alt="">
          </div>
          <!-- Feed box  -->

            <textarea name="post" class="form-control pe-4 fs-3 lh-1 border-0" rows="4" placeholder="Share your thoughts..." autofocus></textarea>
                </div>

                <!-- Dropzone photo START -->
                <div>
                  <label class="form-label">Upload attachment</label>
                <input type="file" name="file" class="form-control">
                </div>
                <!-- Modal feed body END -->

                <!-- Modal feed footer -->
                <div class="modal-footer ">
                  <!-- Button -->
                    <button type="button" class="btn btn-danger-soft me-2" data-bs-dismiss="modal">Cancel</button>
                    <button id="post_button" type="submit" value="Post" class="btn btn-success-soft">Post</button>
                </div>
                <!-- Modal feed footer -->
            </form>
        </div>
  </div>
</div>
<!-- Modal create Feed photo END -->  