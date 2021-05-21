<?php
include('database.php');
include('session.php');

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$post_id = $_POST['post_id'];
		
		$delete = mysqli_query($conn, "DELETE FROM post where post_id = '$post_id'");
		if($delete){
			$popup = "your post id deleted Successfully";
		}
		else{
			$popup = "Fail to delete post. please try again later.";
		}
	}
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<title>JustRead</title>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
		<link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
		<link rel="stylesheet" href="assets/fonts/ionicons.min.css">
		<link rel="stylesheet" href="assets/css/styles.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	</head>
	<body>
		<div class="login-clean">
			<form method="post">
				<h6 class="text-center"><strong class="btn-danger"><?php echo "ID is ".$post_id.".  ". $popup;?></strong></h6>
			</form>
			<p class="text-center">return to profile <a href="profile.php">click here</a></p>
		</div>
	</body>
</html>