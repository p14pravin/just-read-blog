<?php
include('database.php');
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
		
		$user_name = $_POST['Name'];
		#here we created php veriable $user_name and assign value to it of "Name" input of HTML_form element 
		
		$user_mail = $_POST['Mail'];
		#same here we created user mail veriable and then we assign value of "Mail" input of HTML form
		
		$user_mobile = $_POST['Mobile'];
		$user_pass = $_POST['Password'];
		
		#query to insert data into database
		$new_user = "INSERT INTO user (user_name, user_mail, user_mobile, user_pass) value ('$user_name','$user_mail', '$user_mobile', '$user_pass')";
			# create a veriable and assign query to it as shown above
			#here we created veriable $new_user
			
			# This is format of insert query
			#"INSERT INTO 'table name' (column 1 of table, column 2  of table) VALUE ('$value for column 1', '$value for column 2')
			#if there  5 column then >>>>>>> value have 5 variable to insert data into cloumn
			
		#this is condition. if user data successfully insertd into table then if statement will execute
		#otherwise else statement will execute
		#this is query to check wether data is inserted or not
		if (mysqli_query($conn, $new_user)) {
			#format
			#mysql_query ($Database connection veriable, $Veriable of insert query)
			header("Location:login.php");
			#header is use to move another page 
			#format
			#header("Location:'Link of page where we want to move'")
		} 
		else {
			#else condition 
			$popup =' Fail to Create Account ';
		}
			
	}
?>
<!DOCTYPE html>
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
                    <li class="nav-item" role="presentation"><a class="nav-link text-dark" href="login.php">Login</a></li>
                </ul>
        </div>
        </div>
    </nav>
    <div class="register-photo">
        <div class="form-container">
            <div class="image-holder"></div>
            <form method="post">
				<h6 class="text-center"><strong class="btn-danger"><?php echo $popup;?></strong></h6>
                <h2 class="text-center"><strong>Create</strong> an account.</h2>
				<input class="form-control" type="text" name="Name" required="" placeholder="Name (should be 3 char)" minlength="3" maxlength="30">
				<input class="form-control" type="email" style="margin-top: 18px;" name="Mail" placeholder="Email" required="">
				<input class="form-control" type="tel" style="margin-top: 19px;" name="Mobile" placeholder="Mobile (10 Digit)" minlength="10" maxlength="10"  required="">
				<input class="form-control" type="password" style="margin-top: 18px;" name="Password" placeholder="Password (Should be 6 char)" required="" minlength="6" maxlength="10">
                <div class="form-group">
                    <div class="form-check" style="margin-top: 18px;">
						<label class="form-check-label">
							<input class="form-check-input" type="checkbox" required="">I agree to the license terms.
						</label>
					</div>
                </div>
                <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Sign Up</button></div><a class="already" href="login.php">You already have an account? <strong>Login here</strong>.</a>
			</form>
        </div>
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