<?php 
require_once './commons/header.php';
require_once '../models/faculty.php';
$facultys = new Facultys();

 // Delete 
 if(isset($_GET['action'])&& $_GET['action']=='delete')
 {
     // if (is_numeric($_GET['id'])) {
         $faculty = $facultys->delete($_GET['id']);
         if($faculty == 1)
         {
             $alert_del = 'Xóa thành công!';
         }else
         {
             $alert_del = "Xóa thất bại!";
         }
     // }
 }
 //views
try {
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = $_GET['page'];
        $faculty = $facultys->getCountFaculty();
        $allRows = $faculty['count'];
    } else {
        $page = 1;
        $faculty = $facultys->getCountFaculty();
        $allRows = $faculty['count'];
    
    }
     $count = 10;
     $offset = ($page - 1) * $count;
     $list = $facultys->getAll($offset, $count);
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

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
                                <div class="ibox-head">
                                    <div class="ibox-title">ACCOUNT</div>
                                   <?php //echo $CountSearch['count'];  ?>
                                </div>
                            </div>
                            
                            <div class="col-sm-12 col-md-2 " >
                                <div class="btn-group" style="position: relative; top: 20%;">
                                <button  onclick="location.href='faculty_add.php'" class="btn btn-info" name="add">ADD</button>  
                                </div>
                            </div>
                        </div>
                    <div class="ibox-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="50px">ID</th>
                                        <th>Faculty Name</th>
                                        <th>Faculty Code</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <?php
                                foreach($list as $l)
                                    { 
                                    ?>
                                <tbody>
                                    <tr>
                                        <td><?php echo $l['faculty_id']; ?></td>
                                        <td><?php echo $l['faculty_name']; ?></td>
                                        <td><?php echo $l['faculty_code']; ?></td>   
                                        <td>
                                            <button onclick="location.href='faculty_edit.php?action=edit&id=<?php echo $l['faculty_id']; ?>'" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                                            <button onclick="location.href='?action=delete&id=<?php echo $l['faculty_id']; ?>'" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                                <?php } ?>
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