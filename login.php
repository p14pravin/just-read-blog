<?php
include('database.php');
$popup="";
#here we inclue conn.php page in this page. this is example Inheritance.
#that mean this is common code of database connection.
#we can inherit that code in each page. no need to write in every page.
#we can access veriable of included page in this page.
# $conn is a veriable in database.php we accessed that veriable in this progam below 

	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		#declare veriable = $_POST['name of input in html form']; 
		#input is tag of html which is use to get information from user.
		#method to assign value of "HTML_form input" to "declare variable" in php
		
		$user_mail = $_POST['Mail'];
		#same here we created user mail veriable and then we assign value of "Mail" input of HTML form
		
		$user_pass = $_POST['Password'];
		
		#query to insert data into database
		$user_data = mysqli_query($conn,"SELECT * FROM user WHERE user_mail = '$user_mail' and user_pass = '$user_pass'");
			# create a veriable and assign query to it as shown above
			#here we created veriable $user_log
			
			# This is format of select query
			#"SELECT FROM 'table name' where column_name = '$condition';
			#if there  5 column then >>>>>>> 5 condition to select data from table
			
		#this is condition. if user data successfully selected from table then if statement will execute
		#otherwise else statement will execute
		#this is query to check wether data is selected or not
		if ($row = mysqli_fetch_array($user_data)) {
			#format
			#$declare veriable name = mysqli_fetch_array($select query veriable name)
			session_start();
			#session is started
			$_SESSION['ID'] = $row['user_id'];
				#creating user session to manage user data. we are storing user_id in session to mantain logged in user session.
			header("Location:index.php");
			#header is use to move another page 
			#format
			#header("Location:'Link of page where we want to move'")
		} 
		else {
			#else condition 
			$popup = "Invalid Credential";
		}
			
	}
?><!DOCTYPE html>
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
    <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
        <div class="container"><a class="navbar-brand text-warning" href="index.php">#JUST_READ</a><button data-toggle="collapse" data-target="#navbarResponsive" class="navbar-toggler" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div
                class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="#">Login</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <div></div>
    <div class="login-clean">
        <form method="post">
			<h6 class="text-center"><strong class="btn-danger"><?php echo $popup;?></strong></h6>
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
				<div class="form-group">
					<input class="form-control" type="email" name="Mail" placeholder="Email">
				</div>
            <div class="form-group">
				<input class="form-control" type="password" name="Password" placeholder="Password">
			</div>
            <div class="form-group">
				<button class="btn btn-primary btn-block" type="submit">Log In</button>
			</div>
			<a class="forgot" href="register.php">Not have account <strong>Register here</strong></a>
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