<?php
include('session.php');
#we include session.php here. it is same as we added database.php. this is example of inheritance.
#in session.php page we check wether user is logged in or not. if he logged in then he will able to stay at current page (profile.php).
#if he is not logged in then session.php will force to user to move login.php page.
#for more ref check session.php code.

include('database.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - #JUST_READ</title>
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
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="#">PROFILE</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="logout.php">LOGOUT</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <header class="masthead" style="background-image:url('assets/img/about-bg.jpg');">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-lg-8 mx-auto">
                    <div class="site-heading">
                        <h1>PROFILE</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <hr>
	<?php
		$user = mysqli_query($conn,"SELECT * FROM user where user_id = '$ID'");
		#here we created $user veriable and assign select query to it.
		#in select query $conn is veriable of database connection and it is declared in database.php. 
		#we inherit $conn veriable here. to reduce code.
		#same as $conn the $ID is variable in session.php 
		#we access that session veriable here to get id of current user
		#and using that user id we access that user data from database.
		
		$user_row = mysqli_fetch_array($user);
		#this is mysql query we get data in array format in $user_row.
		#here veriable $user_row acts as array veriable. 
	?>
    <div class="register-photo" style="margin-top: -65px;">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post">
				<div class="form-group text-center">
					<h4>MY PROFILE</h4>
				</div>
                <div class="form-group">
					<!-- from $user_row array we get name of user by this $user_row['user_name'].
					format
					$user_row['column_name']; //user_name is a column name to get user name here.
					echo is used to print on display
					-->
					<input class="form-control" type="text" name="Name" value="<?php echo $user_row['user_name']?>" readonly="" placeholder="Name">
				</div>
                <div class="form-group">
					<!-- from $user_row array we get mobile no of user by this $user_row['user_mobile'].
					format
					$user_row['column_name']; //user_mobile is a column name to get user mobile no. here.
					-->
					<input class="form-control" type="text" name="Mobile" value="+91 <?php echo $user_row['user_mobile']?>" readonly="" placeholder="Mobile">
				</div>
                <div class="form-group">
					<!--same as above here we use user_mail in $user_row to get user mobile-->
					<input class="form-control" type="email" name="Email" value="<?php echo $user_row['user_mail']?>" readonly="" placeholder="Email">
				</div>
            </form>
        </div>
    </div>
    <div class="article-dual-column">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h1 class="text-center" style="padding-top: 20px;">Post's</h1>
                    <div class="intro"></div>
                </div>
            </div>
			<?php
			$get_posts = mysqli_query($conn,"SELECT * FROM post where user_id = '$ID'");
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
							<!---substr is function to print limited charater on screen. here we print 98 char only
							n12br is a fucntion use to format text design alignment.
							-->
							<p><?php echo substr($post_data['post_content'],0,98)."...";?></p>
							<div class="row">
								<div class="col">
									<div class="row">
										<div class="col text-center">
											<button  onClick="parent.location='post.php?id=<?php echo $post_data['post_id'];?>'" class="btn btn-primary" style="filter: blur(0px) brightness(97%) grayscale(0%);width: 100px;height: 43px;padding: 10px;padding-top: 10px;" type="button">REad</button>
											<button onClick="parent.location='edit_post.php?id=<?php echo $post_data['post_id'];?>'" class="btn btn-primary text-center" style="padding-top: 10px;padding-bottom: 10px;background-color: rgb(13,111,5);padding-right: 15px;padding-left: 15px;" type="button">UPDATE</button>
											
											<form class="btn" action="delete.php" method="post">
												<button name="post_id" value="<?php echo $post_data['post_id'];?>" class="btn btn-primary" style="filter: blur(0px) brightness(97%) grayscale(0%);background-color: rgb(161,0,0);padding-top: 10px;padding-bottom: 10px;padding-right: 14px;padding-left: 15px;" type="submit">DELETE</button>
											</form>
										</div>
									</div>
									<hr>
								</div>
							</div>
						</div>
					</div>
					<hr>
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
                    <p class="text-muted copyright" style="color: rgb(255,15,0);">Copyright&nbsp;?? Made with&nbsp;???&nbsp;ndroid 2020</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>

</html>