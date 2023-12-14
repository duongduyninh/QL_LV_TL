<?php session_start();
require_once('db.php');
require_once('models/users.php');


//------ Register -------
//var_dump($_SESSION['user_permit']);
if(isset($_POST['submit']))
{

	$users = new users();
	$result = $users->insert($_POST);
		if($result== 1)
				$alert_register = 'Đăng kí thành công!';
		else $alert_register = $result;
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<title>Register</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Register, sign up" />
<!-- <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script> -->
<link
      rel="icon"
      type="image/jpg"
      sizes="16x16"
      href="./images/logo.png"
    />
<!-- css files -->
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
		<?php if(isset($_SESSION['login_permit'])&& $_SESSION['login_permit']==3) echo '<h1>LECTURER REGISTER </h1>' ; else echo '<h1>STUDENT REGISTER </h1>;'
				?>
	</div>
	<!--//header-->
	<div class="main-content-agile">
		<div class="sub-main-w3">	
			<!-- <div class="wthree-pro">
				
			</div>  -->
			<div class="input-group mb-3">
                    <?php
                         if (isset($alert_register)) echo '<div class="alert alert-primary" role="alert">' . " $alert_register " . "</div>";
						 //$alert_register=null;
                        ?>
                </div>
			<!-- form register -->
			<form action="#" method="post">
				<!-- user code  -->
				<div class="pom-agile">
					<input placeholder="User Code" name="user_code" class="user_code" type="text" pattern="\d{7,10}" 
						title="Vui lòng nhập đúng MSSV!" required>
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
				<!-- user name -->
				<div class="pom-agile">
					<input placeholder="Username" name="user_name" class="user" type="text" pattern="\w{4,20}" 
                      	title="Tên đăng nhập phải từ 4 đến 20 ký tự, là ký tự in hoa, thường không dấu, số hoặc dấu gạch ngang!" required>
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
				<!-- user password -->
				<div class="pom-agile">
					<input  placeholder="Password" name="user_pass" class="pass" type="password" pattern="^([A-Za-z]){1}([\w_\.!@#$%^&*()]+){5,31}$"
                      				title="Mật khẩu phải có độ dài 6-32 ký tự, bắt đầu bằng chữ" required>
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
				</div>
				<!-- user confirm password -->
				<div class="pom-agile">
					<input  placeholder="Confirm Password" name="user_cf_pass" class="pass" type="password" pattern="^([A-Za-z]){1}([\w_\.!@#$%^&*()]+){5,31}$"
                      				title="Mật khẩu phải có độ dài 6-32 ký tự, bắt đầu bằng chữ" required>
					<span class="icon2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
				</div>
				<!-- user full name -->
				<div class="pom-agile">
					<input placeholder="Full Name" name="user_fname" class="user_fullname" type="text" pattern="[aAàÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬbBcCdDđĐeEèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆfFgGhHiIìÌỉỈĩĨíÍịỊjJkKlLmMnNoOòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢpPqQrRsStTuUùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰvVwWxXyYỳỲỷỶỹỸýÝỵỴzZ\s]{5,50}" 
                     				title="Họ tên nhập phải từ 5 đến 50 ký tự, chỉ gồm chữ cái và khoảng trắng" required>
					<span class="icon1"><i class="fa fa-user" aria-hidden="true"></i></span>
				</div>
				<!-- user email -->
				<div class="pom-agile">
					<input placeholder="Example@ctuet.edu.vn" name="user_email" class="user" type="email" 
					title="Vui lòng nhập đúng định dạng email!" required>
					<span class="icon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
				</div>
				<!-- user phone -->
				<div class="pom-agile">
					<input placeholder="Phone Number" name="user_phone" class="user_phone" type="text" pattern="\d{10}" 
						title="Số điện thoại bao gồm 10 số!" required>
					<span class="icon1"><i class="fa fa-phone-square" aria-hidden="true"></i></span>
				</div>
				<!-- GV or SV  -->
				<input type="hidden" name="user_permit" <?php if(isset($_SESSION['login_permit'])&& $_SESSION['login_permit']==3) echo 'value="1"'; else echo 'value="2"'; ?> >
				<div class="sub-w3l">
					 <h6><a href="login.php">Login?</a></h6>
					 <?php if(isset($_SESSION['login_permit'])&& $_SESSION['login_permit']==3){ ?>
					 <h6><a href="./admin/index.php">ADMIN</a></h6>
					 <?php } ?>
					<div class="right-w3l">
						<input type="submit" name="submit" value="Register">
					</div>
				</div>
			</form>
		</div>
	</div>
	<!--//main-->
	<!--footer-->
	<div class="footer">
		<p>&copy; H & H & P </p>
	</div>
	<!--//footer-->
</div>
</body>
</html>