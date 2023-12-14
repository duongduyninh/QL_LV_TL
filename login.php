<?php session_start();
require_once('db.php');
require_once('models/users.php');


if(isset($_POST['submit']))
{
	$users = new users();
	$user = $users->check_login($_POST);
	if($user != null)
	{	
		$_SESSION['login_id'] = $user['user_id'];
		$_SESSION['login_login'] = $user['user_account'];
		//$_SESSION['user_id'] = $user['user_id'];
		$_SESSION['login_permit'] = $user['user_position'];
		if($_SESSION['login_permit']==3){
			header('Location: ./admin/index.php');
		} else {
			header('Location: # ');
		}

	} else 
	$alert_login = 'Sai tên đăng nhập hoặc mật khẩu !';
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Login</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Login, sign in" />
<!-- <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script> -->
<!-- Meta tag Keywords -->
<!-- css files -->
<link
      rel="icon"
      type="image/jpg"
      sizes="16x16"
      href="./images/logo.png"
    />
	<!-- -----  -->
<link rel="stylesheet" href="css/style.css" type="text/css" media="all" /> <!-- Style-CSS --> 
<link rel="stylesheet" href="css/font-awesome.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->
<!-- online-fonts -->
<!-- <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet"> -->
<!-- //online-fonts -->
</head>
<body>
<!-- main -->
<div class="center-container">
	<!--header-->
	<div class="header-w3l">
		 <h1>Login</h1> 
	</div>
	<!--//header-->
	<div class="main-content-agile">
		<div class="sub-main-w3">	
			<!-- <div class="wthree-pro">
				<h2>Login</h2>
			</div> -->
			<div class="input-group mb-3">
                    <?php
                         if (isset($alert_login)) echo '<div class="alert alert-primary" role="alert">' . " $alert_login " . "</div>";
						 
                        ?>
                </div>
			<!-- form  -->
			<form action="#" method="post">
				<!-- username  -->
				<div class="pom-agile">	
					<input placeholder="Username" name="user_name" class="user" type="text" pattern="\w{4,20}" 
                      	title="Tên đăng nhập phải từ 4 đến 20 ký tự, là ký tự in hoa, thường không dấu, số hoặc dấu gạch ngang!" required="">
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
				<!-- password  -->
				<div class="pom-agile">
					<input  placeholder="Password" name="user_pass" class="pass" type="password" pattern="^([A-Za-z]){1}([\w_\.!@#$%^&*()]+){5,31}$"
                      				title="Mật khẩu phải có độ dài 6-32 ký tự, bắt đầu bằng chữ" required="">
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
				</div>
				<div class="sub-w3l">
					<h6><a href="register.php">Register?</a></h6>
					<div class="right-w3l">
						<input type="submit" name="submit" value="Login">
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php //var_dump($_SESSION['user_permit']);?>
	<!--//main-->
	<!--footer-->
	<div class="footer">
		<p>&copy; H & H & P </p>
	</div>
	<!--//footer-->
</div>
</body>
</html>