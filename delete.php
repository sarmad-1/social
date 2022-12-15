<?php 

	include("classes/autoload.php");
	$image_class = new Image();

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
	
	$Post = new Post();
	

	if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "/delete/")){

		$_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
	}

	$ERROR = "";
	if(isset($URL[1])){

	 		 $ROW = $Post->get_one_post($URL[1]);

			 if(!$ROW){

			 	$ERROR = "No such post was found!";
			 }else{

			 	if(!i_own_content($ROW)){

			 		$ERROR = "Accesss denied! you cant delete this file!";
			 	}
			 }
		 }

	else{

		$ERROR = "No such post was found!";
	}


	//if something was posted
	if($ERROR == "" && $_SERVER['REQUEST_METHOD'] == "POST"){

        $Post->delete_post($_POST['postid']);

		header("Location: ". ROOT . "home");
		die;		
	}
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Delete Post</title>
        <?php
        include("look_css.php");
      ?>
	</head>

	<body style="font-family: tahoma;">
        <?php
            include("header.php");
        ?>
        <main>
            <!--cover area-->
            <div class="container" style="width: 800px;margin:auto;min-height: 400px;">

                <!--below cover area-->
                <div class="row g-4">	

                    <!--posts area-->
                    <div class="card " >

                        <div class=" card-body">
                            <div class="d-flex mb-3">
                                <form method="post">

                                    <?php

                                        if($ERROR != ""){

                                            echo $ERROR;
                                        }

                                        echo "Are you sure you want to delete this post??<br><br>";

                                        $user = new User();
                                        $ROW_USER = $user->get_user($ROW['userid']);

                                        include("post_delete.php");

                                        echo "<input type='hidden' name='postid' value='$ROW[postid]'>";
                                        echo "<button id='post_button' type='submit' value='Post' class='btn btn-success-soft'>Delete</button>";
                                    ?>
                                <br style="clear: both;">
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
	</body>
</html>