<?php 
require_once './commons/header.php';
require_once '../models/faculty.php';

$mysqli = new mysqli("localhost","root","","da3_demo");
if ($mysqli -> connect_errno) {
    echo "Kết nối MYSQLi lỗi " . $mysqli->connect_error;
    exit();
}
$sql = mysqli_query($mysqli, "SELECT * FROM topic WHERE topic_type = 1");
?>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <?php 
        require_once './commons/top_nav.php'; 
        ?>
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
                if(isset($alert_del) && $alert_del == 'Xóa thành công!'){ ?>
                    <div class="alert alert-success">
                    <?php echo $alert_del ?>
                    </div>
                <?php } if(isset($alert_del) && $alert_del == 'Xóa thất bại!') { ?>
                    <div class="alert alert-danger">
                    <?php echo $alert_del ?>
                    </div>
                <?php } ?>
                <!-- end thông báo  -->
                <div class="ibox">
                <div class="row">
                            <div class="col-sm-12 col-md-1" >
                                <div class="ibox-head" style="width: 123px;">
                                    <div class="ibox-title">TIỂU LUẬN</div>
                                   <?php //echo $CountSearch['count'];  ?>
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-md-2" style="margin-left: 30px;">
                                <div class="btn-group" style="position: relative; top: 20%;">
                                <button  onclick="location.href='essay_add.php'" class="btn btn-info" name="add">ADD</button>  
                                </div>
                            </div>
                        </div>
                    <div class="ibox-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>File</th>
                                        <th>Descripstion</th>
                                        <th>Faculty</th>
                                        <th>Add By</th>
                                        <th>Date Add</th>
                                        <th>Date Updata</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                $i = 0;
                                while($item = mysqli_fetch_assoc($sql)){ ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $item["topic_id"]; ?></td>
                                        <td><?php echo $item["topic_code"]; ?></td>
                                        <td><?php echo $item["topic_name"]; ?></td>
                                        <td><a href="./topic_download.php?name=<?php echo $item["topic_file"]; ?>"><?php echo $item["topic_file"]; ?></a></td>
                                        <td><?php echo $item["topic_description"]; ?></td>
                                        <?php $faculty = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `faculty` WHERE faculty_id =".$item['faculty_id'])) ?>
                                        <td><?php echo $faculty["faculty_name"]; ?></td>
                                        <?php $user = mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT * FROM `user` WHERE user_id =".$item['user_id'])) ?>
                                        <td><?php echo $user["user_name"]; ?></td>
                                        <td><?php echo $item["topic_date_add"]; ?></td>
                                        <td><?php echo $item["topic_date_updata"]; ?></td>
                                        <td>
                                            <form action="./topic_delete.php" method="post">
                                                <input name="topic_id" type="hidden" value="<?php echo $item['topic_id'] ?>">
                                                <button name="submit" type="submit"><i class="fa fa-trash font-14"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                                <?php 
                                    $i++;
                                    } 
                                ?>
                            </table>
                        </div>
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

    <!-- BEGIN PAGA BACKDROPS-->
  <?php 
  require_once './commons/footer.php';
  ?>