<?php 
require_once './commons/header.php';
require_once '../models/users.php';

$users = new users();
 // Delete 
 if(isset($_GET['action'])&& $_GET['action']=='delete')
 {
     // if (is_numeric($_GET['id'])) {
         $user = $users->delete($_GET['id']);
         if($user == 1)
         {
             $alert_del = 'Xóa thành công!';
         }else
         {
             $alert_del = "Xóa thất bại!";
         }
     // }
 }
// }else{
//     $alert=null;
// }

// page 
try {
    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
        $page = $_GET['page'];
        $user = $users->getCountUser();
        $allRows = $user['count'];
    } else {
        $page = 1;
        $user = $users->getCountUser();
        $allRows = $user['count'];
    
    }
     $count = 10;
     $offset = ($page - 1) * $count;
     $list = $users->getAll($offset, $count);
    
} catch (PDOException $e) {
    echo $e->getMessage();
}

// search 
    if(isset($_POST['btn_search']))
    {
        $search_users = new Users();
        $search_user = $search_users->searchAll($_POST['search'], $offset, $count);
        $CountSearch = $search_users->CountSearch($_POST['search']);
        $allRows = $CountSearch['count'];
        $list = $search_user;
        //$CountSearch = $search_users->CountSearch($_POST['search']);

    }
// position 
    if(isset($_GET['position']))
    {
        $position = $_GET['position'];
        if($position == 2)
        {
            $p_sv = $users->getUserSV();
            $count_sv = $users->getCountSV();
            $allRows = $count_sv['count'];
            $list = $p_sv;
        }else 
        {
            if($position == 1)
            {
                $p_gv = $users->getUserGV();
                $count_gv = $users->getCountGV();
                $allRows = $count_gv['count'];
                $list = $p_gv;
            }
        }
    }
// //logout
//     if(isset($_GET['logout']) && $_GET['logout']=='true'){
//         $_SESSION['user_login']=="";
//         $_SESSion['user_permit']=="";
//         header("Location:../login.php");
//     }

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
                            <div class="col-sm-12 col-md-4" >
                                <div class="ibox-head">
                                    <div class="ibox-title">ACCOUNT</div>
                                   <?php //echo $CountSearch['count'];  ?>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 " >
                                <div class="search" id="search">
                                    <form action="?page=1" method="post">
                                    <input type="text" name="search" placeholder="Search..." autocomplete="off">
                                    <button name="btn_search" class="btn btn-info btn-fix">Search</button>
                                        
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-2 " >
                            <div class="btn-group" style="position: relative; top: 20%;">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Position
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="?page=1&&position=2">Sinh Viên</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="?page=1&&position=1">Giảng Viên</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="50px">ID</th>
                                            <th>User Code</th>
                                            <th>Username</th>
                                            <th>Full Name</th>
                                            <th>E-mail</th>
                                            <th>Phone</th>
                                            <th>Position</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    foreach($list as $l)
                                    { 
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $l['user_id'] ?>
                                                <!-- <label class="ui-checkbox">
                                                    <input type="checkbox">
                                                    <span class="input-span"></span>
                                                </label> -->
                                            </td>
                                            <td><?php echo $l['user_code'] ?></td>
                                            <td><?php echo $l['user_account'] ?></td>
                                            <td><?php echo $l['user_name'] ?></td>
                                            <td><?php echo $l['user_email'] ?></td>
                                            <td><?php echo $l['user_tel'] ?></td>
                                            <td><?php if ($l['user_position']==1) echo "Giảng Viên"; else echo "Sinh Viên"; ?></td>
                                            <td>
                                                <!-- button edit &&  delete  -->
                                                <button onclick="location.href='user_edit.php?action=edit&id=<?php echo $l['user_id'] ?>'" class="btn btn-default btn-xs m-r-5" data-toggle="tooltip" data-original-title="Edit"><i class="fa fa-pencil font-14"></i></button>
                                                <button onclick="location.href='?action=delete&id=<?php echo $l['user_id'] ?>'" class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                                           
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php } ?>
                                    
                                </table>
                            </div>
                        </div>
                        <!-- Phân trang  -->
                        <div class="pagination">
                        <?php
                            //tinh tổng số bản ghi
                            // if(isset($_POST['btn_search'])){
                            //     $CountSearch = $search_users->CountSearch($_POST['search']);
                            //     $allRows = $CountSearch['count'];
                            // }else{
                                // $user = $users->getCountUser();
                                // $allRows = $user['count'];
                            //}
                            $allpage = ceil($allRows / $count);
                            // Phan trang 
                            for ($i = 0; $i < $allpage; $i++) {
                                $pageCount = $i + 1;    ?>
                                <a href="?page=<?php echo $pageCount ?>" class="<?php if($page == $pageCount) echo 'active';  ?>"> <?php echo $pageCount ?> </a>
                            <?php
                            }
                            ?>
                            <!-- <a href="#">&laquo;</a> -->
                            <!-- <a href="#" class="active">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a> -->
                           
                            <!-- <a href="#">&raquo;</a> -->
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