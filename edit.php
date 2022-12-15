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
	
	$Post = new Post();

	$ERROR = "";
	if(isset($URL[1])){

		 $ROW = $Post->get_one_post($URL[1]);

		 if(!$ROW){

		 	$ERROR = "No such post was found!";
		 }else{

		 	if($ROW['userid'] != $_SESSION['mybook_userid']){

		 		$ERROR = "Accesss denied! you cant delete this file!";
		 	}
		 }

	}else{

		$ERROR = "No such post was found!";
	}

	if(isset($_SERVER['HTTP_REFERER']) && !strstr($_SERVER['HTTP_REFERER'], "/edit/")){

		$_SESSION['return_to'] = $_SERVER['HTTP_REFERER'];
	}

	//if something was posted
	if($_SERVER['REQUEST_METHOD'] == "POST"){

		$Post->edit_post($_POST,$_FILES);


		header("Location: ".$_SESSION['return_to']);
		die;
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
                        <div class="d-flex mb-3">

                            <form method="post" enctype="multipart/form-data">

                                    <?php

                                        if($ERROR != ""){

                                            echo $ERROR;
                                        }else{

                                            echo "Edit Post<br><br>";

                                            echo '<textarea class="form-control pe-4 border-0" name="post" placeholder="Whats on your mind?">'.$ROW['post'].'</textarea><input class="form-control" type="file" name="file">';

                                            echo "<input type='hidden' name='postid' value='$ROW[postid]'>";

                                            if(file_exists($ROW['image']))
                                            {
                                                $image_class = new Image();

                                                $ext = pathinfo($ROW['image'],PATHINFO_EXTENSION);
                                                $ext = strtolower($ext);

                                                if($ext == "jpeg" || $ext == "jpg"){

                                                    $post_image = $image_class->get_thumb_post($ROW['image']);

                                                    echo "<br><br><div style='text-align:center;'><img class='card-img'  src='$post_image' style='width:50%;' /></div>";

                                                }elseif($ext == "mp4"){

                                                    echo "<video controls style='width:100%' >
                                                        <source src='" . ROOT . "$ROW[image]' type='video/mp4' >
                                                    </video>";

                                                }
                                            }
                                            echo "<button id='post_button' type='submit' class='btn btn-success-soft'>Save Edit</button>";
                                        }
                                    ?>


                                <br>
                            </form>
                        </div>
 					</div>
 				</div>
			</div>
	 	 </div>
        </main>
	</body>
</html>