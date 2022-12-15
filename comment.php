<!-- Comment item START -->
<li class="comment-item">
  <div class="d-flex">
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
    <!-- Avatar -->
    <div class="avatar avatar-xs">
      <a href="#!"><img class="avatar-img rounded-circle" src="<?php echo ROOT . $image ?>" alt=""></a>
    </div>
    <div class="ms-2">
      <!-- Comment by -->
      <div class="bg-light rounded-start-top-0 p-3 rounded">
        <div class="d-flex justify-content-between">
          <h6 class="mb-1"> <a href="#!"> <?php echo $ROW_USER['first_name'] . "<t> " . $ROW_USER['last_name'] ?> </a></h6>
          <small class="ms-2"><?php echo $COMMENT['date'] ?></small>
        </div>
        <p class="small mb-0"><?php echo check_tags($COMMENT['post']) ?></p>

        <?php 
            if($COMMENT['has_image']){
                echo "<div class='card p-2 border border-2 rounded mt-2 shadow-none'>";
                echo "</div>";
            }
        ?>

      </div>
      <!-- Comment react -->
      <ul class="nav nav-divider py-2 small">
        <li class="nav-item">
            <?php 
                $likes = "";

                $likes = ($COMMENT['likes'] > 0) ? "(" .$COMMENT['likes']. ")" : "" ;
            ?>
          <a class="nav-link" href="<?=ROOT?>like/post/<?php echo $COMMENT['postid'] ?>">Like<?php echo $likes ?></a>
        </li>
        <?php 

            $post = new Post();
                if($post->i_own_post($COMMENT['postid'],$_SESSION['mybook_userid'])){
                    echo "<li class='nav-item'>
                      <a class='nav-link' href='".ROOT."delete/$COMMENT[postid]'>Delete</a>
                    </li>";
                }

                if(i_own_content($COMMENT)){
                    echo "<li class='nav-item'>
                      <a class='nav-link' href='".ROOT."edit/$COMMENT[postid]'>Edit</a>
                    </li>";
                    }
                 ?>

      </ul>
    </div>
  </div> 
 </li>
<!-- Comment item END -->


