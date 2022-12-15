<!-- Connection item START -->
<div class='hstack gap-2 mb-3'>
    <?php 

        $image = "images/user_male.jpg";
        if($FRIEND_ROW['gender'] == "Female")
        {
            $image = "images/user_female.jpg";
        }

        if(file_exists($FRIEND_ROW['profile_image']))
        {
            $image = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']);
        }
    ?>
  <!-- Avatar -->
  <div class="avatar">
    <a href="<?=ROOT?><?php echo $FRIEND_ROW['type']; ?>/<?php echo $FRIEND_ROW['userid']; ?>">
    <img class="avatar-img rounded-circle" id="friends_img" src="<?php echo ROOT . $image ?>"></a>
  </div>
  <!-- Title -->
  <div class="overflow-hidden">
    <a class="h6 mb-0" href="<?=ROOT?><?php echo $FRIEND_ROW['type']; ?>/<?php echo $FRIEND_ROW['userid']; ?>"><?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name'] ?> </a>
      <?php 
        $online = "Last seen: <br> Unknown";
        if($FRIEND_ROW['online'] > 0){
            $online = $FRIEND_ROW['online'];

            $current_time = time();
            $threshold = 60 * 2;//2 minutes

            if(($current_time - $online) < $threshold){
                $online = "<span style='color:green;'>Online</span>";
            }else{
                $online = "Last seen: <br>" . Time::get_time(date("Y-m-d H:i:s",$online));
            }
        }
      ?>  
    <p class="mb-0 small text-truncate"><?php echo $online ?></p>
  </div>
    <?php 
        $frlikes = "";
        if($FRIEND_ROW['likes'] > 0){
            $frlikes = $FRIEND_ROW['likes'] . " Followers";
        }else{
            $frlikes = "Follow";
        }
    ?>
  <!-- Button -->
  <?php   
    $following = $user_class->get_following($user_data['userid'],"user");
    $follow ="";
    if(is_array($following)){

        foreach ($following as $follower) {
            if($follower['userid'] == $FRIEND_ROW['userid']){
                $follow ="unFollw";
                break;
            }
        else{
                $follow ="Follw";
        }  
        }    
    }
    ?>
  <a class="btn btn-primary-soft rounded-circle icon-md ms-auto" href="<?=ROOT?>like/user/<?php echo $FRIEND_ROW['userid'] ?>"><i class=""><?php echo $follow ?></i></a>
</div>
<!-- Connection item END -->