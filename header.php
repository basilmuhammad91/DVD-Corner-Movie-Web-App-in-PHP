<?php

// All Session Work
session_start();

// My Database Connection:
include('database_connection.php');

// For Sign Up 
if(isset($_POST['signup']))
{
	$name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($con, "insert into tbl_user_registration (tbl_user_name, tbl_user_email,tbl_user_password) values('$name','$email','$password')");

    if($query)
    {
        // echo "<script>alert('Data Inserted');</script>";
        header("location:index.php#login-content");
    }
    else
    {
        echo "<script>alert('Not Inserted');</script>";
    }
}

// For Login
if(isset($_POST['login']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$query = mysqli_query($con,"select * from tbl_user_registration where tbl_user_email = '$email' and tbl_user_password = '$password'");

	if($row = mysqli_fetch_array($query))
	{
		$_SESSION['id'] = $row[0];
		$_SESSION['Email'] = $email;
        $_SESSION['Name'] = $row[1];

        $id = $_SESSION['id'];

        // echo "<script>alert('Logged in Successfully');</script>";

		
	}
	else
	{
		echo "<script>alert('Invalid email and password');</script>";
	}

}

// For Sign Out
if(isset($_POST['signout']))
{
	unset($_SESSION['Email']);
	unset($_SESSION['Name']);

	header("location: index.php");

}

?>


<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<!-- Basic need -->
	<title>Open Pediatrics</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
		<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">

    <!--Google Font-->
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<!-- Mobile specific meta -->
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone-no">

	<!-- CSS files -->
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style.css">

	 <!-- Script Files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script>
		// $(document).ready(function(){
		// 	$('#search_text').on('keyup',function(){
		// 		// alert("Hello");
		// 		var txt = $(this).val(); 
		//         if(txt != '')
		//         {
		//             $.ajax({
		//                 url: "fetch.php",
		//                 method: "post",
		//                 data: {search:txt},
		//                 dataType: "text",
		//                 success: function(data){
		//                     $('#result').html(data);
		//                 }
		//             });
		//         }
		// 		else
		// 		{
		// 			$('#result')..html("");
		// 		}
		// 	});
		// });
	</script>
</head>
<body>

<!--login form popup-->
<div class="login-wrapper" id="login-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>Login</h3>
        <form method="post" action="#">
        	<div class="row">
        		 <label for="Email">
                    Email:
                    <input type="email" name="email" placeholder="Enter your email" required="required" />
                </label>
        	</div>
           
            <div class="row">
            	<label for="password">
                    Password:
                    <input type="password" name="password" id="password" placeholder="******"  required="required" />
                </label>
            </div>
            <div class="row">
            	<div class="remember">
					<div>
						<input type="checkbox" name="remember" value="Remember me"><span>Remember me</span>
					</div>
            		<a href="#">Forget password ?</a>
            	</div>
            </div>
           <div class="row">
           	 <button type="submit" name="login">Login</button>
           </div>
        </form>
        <div class="row">
        	<p>Or via social</p>
            <div class="social-btn-2">
            	<a class="fb" href="#"><i class="ion-social-facebook"></i>Facebook</a>
            	<a class="tw" href="#"><i class="ion-social-twitter"></i>twitter</a>
            </div>
        </div>
    </div>
</div>
<!--end of login form popup-->
<!--signup form popup-->
<div class="login-wrapper"  id="signup-content">
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>sign up</h3>
        <form method="post" action="index.php">
            <div class="row">
                 <label for="username-2">
                    Username:
                    <input type="text" name="username" id="username-2" placeholder="Enter your name or username" required="required" />
                </label>
            </div>
           
            <div class="row">
                <label for="email-2">
                    Your email:
                    <input type="email" name="email" id="email-2" placeholder="Enter your email" required="required" />
                </label>
            </div>
             <div class="row">
                <label for="password-2">
                    Password:
                    <input type="password" name="password" id="password-2" placeholder="Enter your password" required="required" />
                </label>
            </div>
             <div class="row">
                <label for="repassword-2">
                    Re-type Password:
                    <input type="password" name="password" id="repassword-2" placeholder="Confirm your password" required="required" />
                </label>
            </div>
           <div class="row">
             <button type="submit" name="signup">Sign Up</button>
           </div>
        </form>
    </div>
</div>

<!--end of signup form popup-->

<header class="ht-header">

	<div class="container">
		<nav class="navbar navbar-default navbar-custom">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header logo">
				    <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					    <span class="sr-only">Toggle navigation</span>
					    <div id="nav-icon1">
							<span></span>
							<span></span>
							<span></span>
						</div>
				    </div>
				    <a href="index.php"><img class="logo" src="images/logo1.png" alt="" width="119" height="58"></a>
			    </div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav flex-child-menu menu-left">
						<li class="hidden">
							<a href="#page-top"></a>
						</li>
						<li>
							<li><a href="index.php">Home</a></li>
							
						</li>
						<li class="dropdown first">
							<a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
							movies<i class="fa fa-angle-down" aria-hidden="true"></i>
							</a>
							<ul class="dropdown-menu level1">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" >Movie grid<i class="ion-ios-arrow-forward"></i></a>
									<ul class="dropdown-menu level2">
										<li><a href="moviegrid.php">Movie grid</a></li>
										<li><a href="moviegridfw.php">movie grid full width</a></li>
									</ul>
								</li>			
								<li><a href="movielist.php">Movie list</a></li><!-- 
								<li><a href="moviesingle.php">Movie single</a></li>
								<li class="it-last"><a href="seriessingle.php">Series single</a></li> -->
							</ul>
						</li>
						<!-- <li class="dropdown first">
							<a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
							celebrities <i class="fa fa-angle-down" aria-hidden="true"></i>
							</a>
							<ul class="dropdown-menu level1">
								<li><a href="celebritygrid01.php">celebrity grid 01</a></li>
								<li><a href="celebritygrid02.php">celebrity grid 02 </a></li>
								<li><a href="celebritylist.php">celebrity list</a></li>
								<li class="it-last"><a href="celebritysingle.php">celebrity single</a></li>
							</ul>
						</li> -->
						<li>
							<li><a href="bloglist.php">News</a></li>
							
						</li>
						
					</ul>
					<ul class="nav navbar-nav flex-child-menu menu-right">
						<li class="dropdown first">
							<a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
							pages <i class="fa fa-angle-down" aria-hidden="true"></i>
							</a>
							<ul class="dropdown-menu level1">
								<li><a href="landing.php">Landing</a></li>
								<li><a href="404.php">404 Page</a></li>
								<li class="it-last"><a href="comingsoon.php">Coming soon</a></li>
							</ul>
						</li>
						<li><a href="feedback.php">Feedback</a></li>                
						<li><a href="#">Help</a></li>
						<?php
						if(!isset($_SESSION['Email']))
						{
						?>
						<li class="loginLink"><a href="#">LOG In</a></li>
						<li class="btn signupLink"><a href="#">sign up</a></li>
						<?php
						}
						else
						{
							?>
							<li class="dropdown first">
							<a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
								<!-- Fetch User Name through Session -->
							<?php echo $_SESSION['Name'] ?> <i class="fa fa-angle-down" aria-hidden="true"></i>
							</a>
							<ul class="dropdown-menu level1">
								<li><a href="userfavoritegrid.php">Your favorite grid</a></li>
								<li><a href="userfavoritelist.php">Your favorite list</a></li>
								<li><a href="userprofile.php">Your profile</a></li>
								<li class="it-last"><a href="userrate.php">Your rate</a></li>
								<li class="it-last">
									<form action="#" method="post">
										<li class="btn submit"><input type="submit" name="signout" value="Sign Out" class="btn submit" style="margin-left: 25px; background-color: #DD003F; color: white; height: 37px; width: 100px; border: none; border-radius: 30px;font-family: 'Dosis', sans-serif; font-size: 14px; font-weight: bold; text-transform: uppercase; cursor: pointer;"></li>
									</form>
								</li>
							</ul>
						</li>
							<?php
						}
						?>

					</ul>
				</div>
			<!-- /.navbar-collapse -->
	    </nav>
	    
	    <!-- top search form -->
	   <!--  <div class="top-search">
	    	<select>
				<option value="united">TV show</option>
				<option value="saab">Others</option>
			</select>
			<input type="text" placeholder="Search for a movie, TV Show or celebrity that you are looking for" id="search_text" name="search_text">
	    </div>
	    <div id="result"></div> -->
	</div>
</header>
</body>
</html>

<style>
	
	a
	{
		display: block;
	}
</style>