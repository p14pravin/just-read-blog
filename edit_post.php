<?php
include('session.php');
#we include session.php here. it is same as we added database.php. this is example of inheritance.
#in session.php page we check wether user is logged in or not. if he logged in then he will able to stay at current page (profile.php).
#if he is not logged in then session.php will force to user to move login.php page.
#for more ref check session.php code.

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

$popup="";
#here we inclue database.php page in this page. this is example Inheritance.
#that mean this is common code of database connection.
#we can inherit that code in each page. no need to write in every page.
#we can access veriable of included page in this page.
# $conn is a veriable in database.php we accessed that veriable in this progam below 

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		#declare veriable = $_POST['name of input in html form']; 
		#input is tag of html which is use to get information from user.
		#method to assign value of "HTML_form input" to "declare variable" in php
		
		$title = $_POST['title'];
		#here we created php veriable $user_name and assign value to it of "Name" input of HTML_form element 
		
		$category = $_POST['category'];
		#same here we created user mail veriable and then we assign value of "Mail" input of HTML form
		
		$content = $_POST['content'];
		
		$date = date("Y-m-d")." ". date("h:i:s") ;
		#date is a function by that we are getting date in format of timestemp ex. 2020-10-03 23:59:59
		
		#query to insert data into database
		$new_post = "UPDATE post SET post_title = '$title', post_category = '$category', post_content = '$content', post_date = '$date' where post_id = '$post_id' and user_id = '$ID'";
			# create a veriable and assign query to it as shown above
			#here we created veriable $new_post
			
			# This is format of insert query
			#"INSERT INTO 'table name' (column 1 of table, column 2  of table) VALUE ('$value for column 1', '$value for column 2')
			#if there  5 column then >>>>>>> value have 5 variable to insert data into cloumn
			
		#this is condition. if user data successfully insertd into table then if statement will execute
		#otherwise else statement will execute
		#this is query to check wether data is inserted or not
		if (mysqli_query($conn, $new_post)) {
			#if condition
			$popup ="Successfully Updated your post...!</br> redirect to Profile <a href='profile.php'>click here</a> or wait 5 Sec.";
			header( "refresh:5;url=profile.php" );
		} 
		else {
			#else condition 
			$popup =' Fail to Add Your Post Please Refresh your page...! ';
		}
			
	}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>About us - Brand</title>
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
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="profile.php">PROFILE</a></li>
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
                        <h1>EDIT POST</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <hr>
    <div class="article-dual-column">
		<form method="post">
			<div class="container">
				<div class="row">
					<div class="col-md-10 offset-md-1">
					
						<!-- $popup is variable of php initially it have null value and after submit there are two condition by that condition we assign one value to it-->
						<?php
								$get_data = mysqli_query($conn,"SELECT * from post where post_id ='$post_id' and user_id = '$ID'");
								if($get_row = mysqli_fetch_array($get_data)){
						?>
						<h4 class="text-center"><strong class="btn-danger"> <?php echo $popup;?> </strong></h4>
						
						<p style="margin-bottom: 00px;"><strong>Post Title</strong></p><input type="text" required="" minlength="4" maxlength="50" value="<?php echo $get_row['post_title']?>" name="title">
						<p style="margin-bottom: 00px;"><strong>Post Category (story/blog/poem/conversation)</strong></p><input type="text" required="" minlength="4" maxlength="20" value="<?php echo $get_row['post_category']?>" name="category">
						<div class="intro"></div>
						<p style="margin-bottom: 00px;"><strong>Post Content</strong></p><textarea style="max-width: 100%; min-width: 100%; min-height: 400px;" required="" minlength="48" name="content" maxlength="65000"><?php echo $get_row['post_content']?></textarea>
						<div class="row">
							<div class="col text-center" style="padding-top: 15px;">
								<button class="btn btn-primary text-center" value="submit" type="submit">UPDATE</button>
							</div>
						</div>
								<?php }
								else{
									echo '<p style="margin-bottom: 00px;"><strong>ACCESS DENIED</strong>';
									header( "refresh:5;url=profile.php" );
								}
								?>
					</div>
				</div>
			</div>
		</form>
    </div>
    <footer>
        <hr>
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