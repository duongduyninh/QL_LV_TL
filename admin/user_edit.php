<?php
require_once './commons/header.php';
require_once '../models/users.php';

$users = new Users();
//update
if(isset($_POST['submit_1'])){
    $result = $users->updateUser($_POST);
    if($result== 1){
		$alert_edit = 'Cập nhật thành công!';
        $class='alert alert-success';
    }
	else {
        $alert_edit = $result;
        $class='alert alert-danger';
    }
}
//update new password
if(isset($_POST['submit_2'])){
    $result = $users->updatePass($_POST);
    if($result== 1)
		$alert_edit = 'Cập nhật thành công!';
	else 
        $alert_edit = 'Cập nhật thất bại!';
}
// views
if(isset($_GET['action'])&& $_GET['action']=='edit')
{
    // if (is_numeric($_GET['id'])) {
    $user = $users->getById($_GET['id']);
    // }
}

?>
<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <?php require_once './commons/top_nav.php'; ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php 
        require_once './commons/nav_menu.php';
        ?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <!-- Thông báo  -->
                <?php 
                if(isset($alert_edit) && $alert_edit != 0){ ?>
                    <div class="<?php echo $class; ?>">
                    <?php echo $alert_edit ;?>
                    </div>
                <?php } ?>
                <!-- end thông báo  -->
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit Account</div>
                        <?php //var_dump($user); ?>
                        <div class="ibox-tools">
                            <!-- <a class="ibox-collapse"><i class="fa fa-minus"></i></a> -->
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
                        <div class="form-group row">
                                <!-- user code  -->
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">User ID</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="userid" value="<?php echo $user['user_id'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <!-- user code  -->
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">User Code</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="usercode" value="<?php echo $user['user_code'] ?>" pattern="\d{7,10}" 
						            title="Vui lòng nhập đúng MSSV!" required>
                                </div>
                            </div>
                            <!-- user name   -->
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="username" value="<?php echo $user['user_account'] ?>" pattern="\w{4,20}" 
                      	            title="Tên đăng nhập phải từ 4 đến 20 ký tự, là ký tự in hoa, thường không dấu, số hoặc dấu gạch ngang!" required>
                                </div>
                            </div>
                            <!-- full name   -->
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="fullname" value="<?php echo $user['user_name'] ?>" pattern="[aAàÀảẢãÃáÁạẠăĂằẰẳẲẵẴắẮặẶâÂầẦẩẨẫẪấẤậẬbBcCdDđĐeEèÈẻẺẽẼéÉẹẸêÊềỀểỂễỄếẾệỆfFgGhHiIìÌỉỈĩĨíÍịỊjJkKlLmMnNoOòÒỏỎõÕóÓọỌôÔồỒổỔỗỖốỐộỘơƠờỜởỞỡỠớỚợỢpPqQrRsStTuUùÙủỦũŨúÚụỤưƯừỪửỬữỮứỨựỰvVwWxXyYỳỲỷỶỹỸýÝỵỴzZ\s]{5,50}" 
                     				title="Họ tên nhập phải từ 5 đến 50 ký tự, chỉ gồm chữ cái và khoảng trắng" required>
                                </div>
                            </div>
                            <!-- email  -->
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">E-mail</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="email"value="<?php echo $user['user_email'] ?>" title="Vui lòng nhập đúng định dạng email!" required>
                                </div>
                            </div>
                            <!-- Phone  -->
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="phone" value="<?php echo $user['user_tel'] ?>" pattern="\d{10}" 
						            title="Số điện thoại bao gồm 10 số!" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Position</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="position" value="<?php if($user['user_position']==3) echo 'Admin';
                                     else if($user['user_position']==1) echo 'Giảng Viên'; else echo 'Sinh viên';  ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Add Date</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="position" value="<?php echo $user['user_date_add']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Newest Update Date</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="position" value="<?php echo $user['user_date_update'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-4 ml-sm-auto">
                                    <button class="btn btn-info" type="submit" name="submit_1">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">New Password</div>
                        <div class="ibox-tools">
                            <!-- <a class="ibox-collapse"><i class="fa fa-minus"></i></a> -->
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
                            <!-- user name   -->
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-1 col-form-label">Username</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="n_username" value="<?php echo $user['user_account'] ?>" readonly>
                                </div>
                            </div>
                            <!-- new password -->
                            <div class="form-group row">
                                <div class="col-sm-3"></div>
                                <label class="col-sm-1 col-form-label">New Pass</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="password" name="n_password" pattern="^([A-Za-z]){1}([\w_\.!@#$%^&*()]+){5,31}$"
                      				title="Mật khẩu phải có độ dài 6-32 ký tự, bắt đầu bằng chữ" style="Width:40%;" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-4 ml-sm-auto">
                                    <button class="btn btn-info" type="submit" name="submit_2" >Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13"><b>H & H & P</b></div>
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>
<?php
require_once './commons/footer.php'; 
?>