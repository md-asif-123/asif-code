<?php 
/**
* Video screen Template
*/
session_start();

include('../db-config.php');
include('../srb-function.php');
?>

<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php 
			$partial_url = explode("/", $_SERVER['REQUEST_URI']); 
			$post_slug = $partial_url[1];
		?>
		<title><?php echo $post_slug ;?></title>
		<style type="text/css">
			.container-iframe {
			  position: relative;
			  overflow: hidden;
			  width: 100%;
			  padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
			}

			/* Then style the iframe to fit in the container div with full height and width */
			.responsive-iframe {
			  position: absolute;
			  top: 0;
			  left: 0;
			  bottom: 0;
			  right: 0;
			  width: 100%;
			  height: 100%;
			}
		</style>
	</head>

	<body>
		<?php 
			//$currentuser = wp_get_current_user(); 
			$user_displayname = ( isset ( $_SESSION["name"] ) ? $_SESSION["name"] : "unauthorized user" );
			$user_email = ( isset ( $_SESSION["email"] ) ? $_SESSION["email"] : "why@you.here" );
			// get video url from Wordpress page admin 
			//sample url format: https://www.youtube.com/embed/W4frFktuGbg
			$video_url = "https://www.youtube.com/embed/_wmOOkOaLs4";?>			
					<div class="container-iframe">
						<iframe class="responsive-iframe" src="<?php echo $video_url; ?>?name=<?php echo $user_displayname;?>&email=<?php echo $user_email;?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>		
		<?php 
			$dt = new DateTime("now", new DateTimeZone('Asia/Kolkata')); 
			$arg = array('username' => $user_displayname, 'email' => $user_email, 'home_url' => $_SERVER['SERVER_NAME'],'page_slug' => $post_slug ,'record_time' => $dt->format('Y-m-d H:i:s'));
			//print_r($partial_url);
			srb_mark_attendence($arg , $analytics_connection );
		?>		
	</body>

	<!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> -->
</html>

