<div id="post" class=" border-0 pb-0">
  <?php 

    $image = "images/user_male.jpg";
    if($ROW_USER['gender'] == "Female")
    {
        $image = "images/user_female.jpg";
    }

    if(file_exists($ROW_USER['profile_image']))
    {
        $image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
    }
    ?>
<div class="d-flex align-items-center justify-content-between">
  <div class="d-flex align-items-center">
    <!-- Avatar -->
    <div class="avatar avatar-story me-2">
      <a href="#!"> <img class="avatar-img rounded-circle" src="<?php echo ROOT . $image ?>" alt=""> </a>
    </div>
    <!-- Info -->
    <div>
      <div class="nav nav-divider">
        <h6 class="nav-item card-title mb-0"> <a href="<?=ROOT?><?php echo $ROW_USER['type']; ?>/<?php echo $ROW_USER['userid']; ?>"><?php echo htmlspecialchars($ROW_USER['first_name']) . " " . htmlspecialchars($ROW_USER['last_name']); ?> </a></h6>
        <span class="nav-item small"><?php echo Time::get_time($ROW_USER['date']) ?></span>
      </div>
      <p class="mb-0 small">
        <?php 
          echo"@" . $ROW_USER['tag_name'];
          
          if($ROW['is_profile_image'])
            {
                $pronoun = "his";
                if($ROW_USER['gender'] == "Female")
                {
                    $pronoun = "her";
                }
                echo "<span style='font-weight:normal;color:#aaa;'> updated $pronoun profile image</span>";
            }

            if($ROW['is_cover_image'])
            {
                $pronoun = "his";
                if($ROW_USER['gender'] == "Female")
                {
                    $pronoun = "her";
                }
                echo "<span style='font-weight:normal;color:#aaa;'> updated $pronoun cover image</span>";

            }
        ?>
     </p>
     </div>
   </div>
      <!-- Card feed action dropdown START -->
    <?php if(i_own_content($ROW)):?>
        <div class="dropdown">
        <a href="#" class="text-secondary btn btn-secondary-soft-hover py-1 px-2" id="cardFeedAction" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-three-dots"></i>
        </a>
        <!-- Card feed action dropdown menu -->
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="cardFeedAction">
                <li><?php echo "<a class='dropdown-item' href='".ROOT."edit/$ROW[postid]'>Edit</a>"; ?></li>
                <li><?php echo "<a class='dropdown-item' href='".ROOT."delete/$ROW[postid]'>Delete</a>"; ?></li>
            </ul>
      </div>
    <?php endif; ?>
    
      <!-- Card feed action dropdown END -->
 </div>
</div>
<!-- Card header END -->
<!-- Card body START -->
<div class="card-body">
<p><?php echo check_tags($ROW['post']) ?></p>
<!-- Card img -->
    <?php 
        if(file_exists($ROW['image']))
        {

            $ext = pathinfo($ROW['image'],PATHINFO_EXTENSION);
            $ext = strtolower($ext);

            if($ext == "jpeg" || $ext == "jpg"){
                $post_image = $image_class->get_thumb_post($ROW['image']);

                echo "<a href='" . ROOT . $post_image . "' data-gallery='image-popup' data-glightbox=''>";
                echo "<img class='card-img' src='" . ROOT . "$post_image' style='width:100%;' />";
                echo '</a>';

            }elseif($ext == "mp4"){
                echo "<video controls style='width:100%' >
                    <source src='" . ROOT . "$ROW[image]' type='video/mp4' >
                </video>";
            }
        }
    ?>
      </div>