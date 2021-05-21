<?php 
include('database.php');

	#in if condition we check wether it have post id in URL or not.
	#in URL not contain post_id parameter in URL then else will execute.
	if(isset($_GET['id'])){
		#getting URL parameter id in veriable $post_id 
		$post_id = $_GET['id'];
	}
	else{
		#if url not contain post id parameter then we will move to index page.
		header("Location:index.php");
	}
	
	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blog Post - Brand</title>
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
    <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand text-warning" href="index.php">#JUST_READ</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div
                class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="add_post.php">ADD Post</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="profile.php">PROFILE</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="logout.php">LOGOUT</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <header class="masthead" style="background-image:url('assets/img/post-bg.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <div class="site-heading">
                        <h1>POST</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <article></article>
    <div class="article-dual-column">
		<?php 
			#here we write a query to get post from database.
			#$post_id veriable contain post id of post to access post from database.
			$get_post = mysqli_query($conn,"SELECT * FROM post where post_id = '$post_id'");
			
			#if condtion will execute if URL contain correct post id.
			#if URL contain wrong post id then else condition will execute.
			
			if($post_row = mysqli_fetch_array($get_post)){
		?>
			<div class="container">
				<div class="row">
					<div class="col-md-10 offset-md-1">
						<div class="intro">
							<!-- print title of post -->
							<h1 class="text-center"><?php echo $post_row['post_title']?><br></h1>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10 col-lg-7 offset-md-1 offset-lg-0" style="min-width: 100%;max-width: 100%;">
						<div class="text">
							<!-- print content of post -->
							<!---substr is function to print limited charater on screen. here we print 98 char only
							n12br is a fucntion use to format text design alignment it work like as <br> tag of HTML.
							-->
							<p><?php echo nl2br($post_row['post_content']);?></p>
							<hr>
							<ul>
								<?php 
									#query to get user of current post.
									#we have user_id row in post table.
									#by using that reference we get user details.
									#here $post_row['user_id'] using this condition we get user data from user table.
									$user_data = mysqli_query($conn, "SELECT * FROM user WHERE user_id = ".$post_row['user_id']);
									$user_row = mysqli_fetch_array($user_data);
								?>
									<li>Written By : <?php echo $user_row['user_name']?></li>
									<li>Date : <?php echo $post_row['post_date']?></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php
			}
			#end of if condition
			else{
				#else condition will disply no post found message with id.
				echo "<center><h1>No Post Found with ID ".$post_id."</h1></center>";
			}
		?>
    </div>
    <div class="team-clean">
        <div class="container">
            <div class="intro"></div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <p class="text-muted copyright" style="color: rgb(255,15,0);">Copyright&nbsp;© Made with&nbsp;❤&nbsp;ndroid 2020</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>