<?php 

	include("classes/autoload.php");
 
	$login = new Login();
	$user_data = $login->check_login($_SESSION['mybook_userid']);
    $image_class = new Image();

 
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
 
			$post = new Post();
			$id = $_SESSION['mybook_userid'];
			$result = $post->create_post($id, $_POST,$_FILES);
			
			if($result == "")
			{
				header("Location: ". ROOT."home");
				die;
			}else
			{

				echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
				echo "<br>The following errors occured:<br><br>";
				echo $result;
				echo "</div>";
			}
 			
	}

	$Post = new Post();
	$ROW = false;

	$is_group_post = false;

	$ERROR = "";
	if(isset($URL[1])){

		$ROW = $Post->get_one_post($URL[1]);
		if($ROW['owner'] > 0){

			$user_class = new User();
			$group_data = $user_class->get_user($ROW['owner']);
			if($group_data['type'] == "group"){
				$is_group_post = true;
			}
		}
	}else{

		$ERROR = "No post was found!";
	}

 
?>

<!DOCTYPE html>
	<html>
	<head>
		<title>Edit Post</title>
        <?php
        include("look_css.php");
      ?>
	</head>

	<body style="font-family: tahoma;">
        
        <!-- =======================
        Header START -->
        <?php
            include("header.php");
        ?>
        <!-- =======================
        Header END -->
<main>
		<!--cover area-->
		<div class="container" style="width: 800px;margin:auto;min-height: 400px;">
		 
			<!--below cover area-->
			<div class="row g-4">	

				<!--posts area-->
 				<div class="card " >
 					
 					<div class=" card-body">
                        <div class="mb-3">
                            <?php 
  					 		$user = new User();
  					 		$image_class = new Image();
                            if(is_array($ROW)){
 	 					 		$ROW_USER = $user->get_user($ROW['userid']);
  					 			if($ROW['parent'] == 0){
  					 				include("post_list.php");
  					 			}else{
  					 				$COMMENT = $ROW;
  					 				include("comment.php");
  					 			}
  					 		}
                        ?>
                        </div>
 					</div>
 				</div>
			</div>
	 	 </div>
        </main>
	</body>
</html>