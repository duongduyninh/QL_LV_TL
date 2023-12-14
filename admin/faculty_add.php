<?php
require_once './commons/header.php';
require_once '../models/faculty.php';
$facultys = new Facultys();
//insert
if(isset($_POST['submit'])){
    $result = $facultys->insert($_POST);
    if($result== 1){
		$alert_edit = 'Thêm thành công!';
        $class='alert alert-success';
    }
	else {
        $alert_edit = $result;
        $class='alert alert-danger';
    }
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
                        <div class="ibox-title">ADD Faculty</div>
                        <?php //var_dump($user); ?>
                        <div class="ibox-tools">
                            <!-- <a class="ibox-collapse"><i class="fa fa-minus"></i></a> -->
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
                                <div class="form-group row">
                                    <!-- user code  -->
                                    <div class="col-sm-3"></div>
                                    <label class="col-sm-1 col-form-label">Name</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="faculty_name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!-- user code  -->
                                    <div class="col-sm-3"></div>
                                    <label class="col-sm-1 col-form-label">Code</label>
                                    <div class="col-sm-8">
                                        <input class="form-control" type="text" name="faculty_code" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-4 ml-sm-auto">
                                        <button class="btn btn-info" type="submit" name="submit" >Submit</button>
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