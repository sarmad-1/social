<div class="card" id="post_bar">
<div id="post" class="card-header border-0 pb-0">
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
    <p class="mb-0 small">
        <?php 
				$i_liked = false;

				if(isset($_SESSION['mybook_userid'])){

					$DB = new Database();

					$sql = "select likes from likes where type='post' && contentid = '$ROW[postid]' limit 1";
					$result = $DB->read($sql);
					if(is_array($result)){

						$likes = json_decode($result[0]['likes'],true);

						$user_ids = array_column($likes, "userid");
		 
						if(in_array($_SESSION['mybook_userid'], $user_ids)){
							$i_liked = true;
						}
					}

				}

			 	echo "<a id='info_$ROW[postid]' href='".ROOT."likes/post/$ROW[postid]'>";
			 	
			 	if($ROW['likes'] > 0){

			 		echo "<br/>";

			 		if($ROW['likes'] == 1){

			 			if($i_liked){
			 				echo "<div style='text-align:left;'>You liked this post </div>";
			 			}else{
			 				echo "<div style='text-align:left;'> 1 person liked this post </div>";
			 			}
			 		}else{

			 			if($i_liked){

			 				$text = "others";
			 				if($ROW['likes'] - 1 == 1){
			 					$text = "other";
			 				}
			 				echo "<div style='text-align:left;'> You and " . ($ROW['likes'] - 1) . " $text liked this post </div>";
			 			}else{
			 				echo "<div style='text-align:left;'>" . $ROW['likes'] . " other liked this post </div>";
			 			}
			 		}
			 	}
			 	echo "</a>";
			?>
    </p>
<!-- Feed react START -->
<ul class="nav nav-pills nav-pills-light nav-fill nav-stack small border-bottom py-1 my-3">
  <li class="nav-item">
      <?php 
			$likes = "";

			$likes = ($ROW['likes'] > 0) ? " " .$ROW['likes']. " " : "" ;

		?>
    <a class="nav-link mb-0 active" onclick="like_post(event)" href="<?=ROOT?>like/post/<?php echo $ROW['postid'] ?>"> <i class="bi bi-heart pe-1"></i>Like<?php echo $likes ?></a>
  </li>
  <li class="nav-item">
      <?php 
			$comments = "";

			if($ROW['comments'] > 0){
				$comments = " " . $ROW['comments'] . "";
			}
		?>
    <a href="<?=ROOT?>comments_list/<?php echo $ROW['postid'] ?>">Comment<?php echo $comments ?></a>
  </li>
  <!-- Card share action menu START -->
</ul>
    <ul class="nav nav-pills nav-pills-light nav-fill nav-stack small border-bottom py-1 my-3">
      <li class="nav-item d-flex mb-3">
          <!-- Avatar -->
      <div class="avatar avatar-xs me-2">
        <a href="#!"> <img class="avatar-img rounded-circle" src="<?php echo ROOT . $image ?>" alt=""> </a>
      </div>
    <form method="post" class="position-relative w-100">
      <!-- Comment box  -->
        <textarea name="post" class="form-control pe-4 bg-light" data-autoresize rows="1" placeholder="Add a comment..." ></textarea>
        <input type="hidden" name="parent" value="<?php echo $ROW['postid'] ?>">
        <div class="position-absolute top-0 end-0">
          <button class="btn btn-success-soft" type="submit">Add</button>
        </div>
    </form>
        </li>
    </ul>
    <!-- Feed react START -->

    <!-- list comment -->
    <div class="d-flex mb-3">
    <!-- Comment wrap START -->
    <ul class="comment-wrap list-unstyled">
      <!-- Comment item START -->
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
      <!-- Comment item END -->
    </ul>
    <!-- Comment wrap END -->
        </div>
      </div>
    </div>
<!-- Card body END -->

<script type="text/javascript">
	

	function ajax_send(data,element){

		var ajax = new XMLHttpRequest();

		ajax.addEventListener('readystatechange', function(){

			if(ajax.readyState == 4 && ajax.status == 200){

				response(ajax.responseText,element);
			}
			
		});

  		data = JSON.stringify(data);

		ajax.open("post","<?=ROOT?>ajax.php",true);
		ajax.send(data);

	}

	function response(result,element){

		if(result != ""){

			var obj = JSON.parse(result);
			if(typeof obj.action != 'undefined'){

				if(obj.action == 'like_post'){

					var likes = "";

					if(typeof obj.likes != 'undefined'){
						likes = (parseInt(obj.likes) > 0) ? "Like(" +obj.likes+ ")" : "Like" ;
						element.innerHTML = likes;
					}

					if(typeof obj.info != 'undefined'){
						var info_element = document.getElementById(obj.id);
						info_element.innerHTML = obj.info;
					}
				}
			}
		}
	}

	function like_post(e){

		e.preventDefault();
		var link = e.target.href;

		var data = {};
		data.link = link;
		data.action = "like_post";
		ajax_send(data,e.target);
	}

</script>