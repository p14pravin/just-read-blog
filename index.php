<?php
session_start();
#this is used to start session of user. if he logged. than session have some session veriable with data.
include('database.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Brand</title>
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
					<?php 
					#if any user is logged in then it will show following 3 options of IF blog
					#else it will show only 1 option of loggin
					if(isset($_SESSION["ID"])){
						?>
						<li class="nav-item" role="presentation"><a class="nav-link text-dark" href="add_post.php">ADD POST</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link text-dark" href="profile.php">PROFILE</a></li>
						<li class="nav-item" role="presentation"><a class="nav-link text-dark" href="logout.php">LOG OUT</a></li>
						<?php
					}
					else{
						?>
						<li class="nav-item" role="presentation"><a class="nav-link text-dark" href="login.php">LOG IN</a></li>
						<?php
					}
					?>
				</ul>
        </div>
        </div>
    </nav>
    <header class="masthead" style="background-image:url('assets/img/home-bg.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <div class="site-heading">
                        <h1>Clean Blog</h1><span class="subheading">A Blog Theme by nDROID Tech</span></div>
                </div>
            </div>
        </div>
    </header>
    <div class="article-dual-column">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h1 class="text-center" style="padding-top: 20px;">Post's</h1>
                    <div class="intro"></div>
                </div>
            </div>
			<?php
			$get_posts = mysqli_query($conn,"SELECT * FROM post");
				#here we are getting all posts of logged in user. $ID is a varible in session.php we include session.php here check top of the code.
			
				#here we use assoc function to get all posts. 
				#in some other pages of code we user "mysqli_fetch_array" this is use to access only one one row.
				#here we use mysqli_fetch_assoc to get more than on row.
			while($post_data = mysqli_fetch_assoc($get_posts))
			{
			?>
				<!--this all code below upto closing curly bracket cursor is in while loop to disply all posts of user one by one-->
				<div class="row">
					<div class="col-md-10 col-lg-7 offset-md-1 offset-lg-0" style="max-width: 100%;min-width: 100%;">
						<h1 class="text-center" style="padding-top: 10px;"><?php echo $post_data['post_title'];?><br></h1>
						<div class="text">
							<p><?php echo substr(nl2br($post_data['post_content']),0,98)."...";?></p>
							<ul>
								<?php 
									#query to get user of current post.
									#we have user_id row in post table.
									#by using that reference we get user details.
									#here $post_row['user_id'] using this condition we get user data from user table.
									$user_data = mysqli_query($conn, "SELECT * FROM user WHERE user_id = ".$post_data['user_id']);
									$user_row = mysqli_fetch_array($user_data);
								?>
									<li>Written By : <?php echo $user_row['user_name']?></li>
									<li>Category : <?php echo $post_data['post_category']?></li>
									<li>Date : <?php echo $post_data['post_date']?></li>
							</ul>
							<div class="row">
								<div class="col">
									<div class="row">
										<div class="col text-right">
											<button  onClick="parent.location='post.php?id=<?php echo $post_data['post_id'];?>'" class="btn btn-primary" style="filter: blur(0px) brightness(97%) grayscale(0%);width: 160px;height: 43px;padding: 10px;padding-top: 10px;" type="button">Read Continue</button>
										</div>
									</div>
									<hr>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			#here is end of while loop
			
			?>
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