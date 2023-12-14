<?php
    $mysqli = new mysqli("localhost","root","","da3_demo");
    if ($mysqli -> connect_errno) {
        echo "Kết nối MYSQLi lỗi " . $mysqli->connect_error;
        exit();
    }

    if(isset($_POST['topic_id']) && isset($_POST['submit'])){
        $delete = mysqli_query($mysqli, "DELETE FROM topic WHERE topic_id = ".$_POST['topic_id']);
        if(mysqli_affected_rows($mysqli)){
            ?>
                <script>
                    document.location='essay_index.php';
                    alert("Xóa thành công");
                </script>
            <?php
            
        }
        else{
            ?>
                <script>
                    document.location='essay_index.php';
                    alert("Xóa thất bại");
                </script>
            <?php
        }
    }

?>