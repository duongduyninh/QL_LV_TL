<?php
require_once './commons/header.php';
require_once '../models/users.php';



$mysqli = new mysqli("localhost","root","","da3_demo");
    if ($mysqli -> connect_errno) {
        echo "Kết nối MYSQLi lỗi " . $mysqli->connect_error;
        exit();
    }

if(isset($_POST['submit'])){
    $name = $_POST['Name'];
    $file = $_FILES['fileUpload']['name'];
    $description = $_POST['Description'];
    $detail = $_POST['Description'];
    $code = date("YmdHis");
    $faculty_input = $_POST['Faculty'];
    $user = $_SESSION['login_id'];
    $date = date('Y-m-d');
    
    move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'uploads/' . $_FILES['fileUpload']['name']);
    // $insert = "";
    $handle_insert = mysqli_query($mysqli, "INSERT INTO topic(topic_name, topic_file, topic_description, topic_detail, topic_type, topic_date_add, topic_date_updata, topic_code, faculty_id, user_id) VALUES ('$name', '$file', '$description', '$detail', '1', '$date', '$date', '$code', '$faculty_input', '$user')");
    header("location: ./essay_index.php");
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

                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Add essay</div>
                        <?php //var_dump($user); ?>
                        <div class="ibox-tools">
                            <!-- <a class="ibox-collapse"><i class="fa fa-minus"></i></a> -->
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form class="form-horizontal" id="form-sample-1" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                                <!-- user code  -->
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="Name" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Faculty</label>
                                <div class="col-sm-8">
                                    <select name="Faculty" id="" required>
                                        <?php 
                                            $faculty = mysqli_query($mysqli, "SELECT * FROM faculty");
                                            while($item = mysqli_fetch_assoc($faculty)){
                                                ?><option value="<?php echo $item['faculty_id'] ?>"><?php echo $item["faculty_name"] ?></option><?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>                          
                            <!-- email  -->
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="Description" required>
                                </div>
                            </div>
                            <!-- Phone  -->
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">Detail</label>
                                <div class="col-sm-8">
                                    <input class="form-control" type="text" name="Detail" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <label class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-3">
                                <input type="file" name="fileUpload" value="" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-4 ml-sm-auto">
                                    <button class="btn btn-info" type="submit" name="submit">Submit</button>
                                </div>

                                <?php
                                    // echo "<pre>";
                                    // var_dump();
                                    // // var_dump($_POST);
                                    // echo "<br>";
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>