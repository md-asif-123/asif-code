
        <?php
		   require_once('config.php');
		   session_start();
		if(!isset($_SESSION['user'])){
			 header('location:loginpage.php');
		   }
		 
		 $id=$_REQUEST['id'];
		 echo $id;
		 $sql="DELETE FROM register WHERE id=$id";
		 mysql_query($sql);
		 header('location:list.php');