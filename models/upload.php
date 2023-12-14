<?php
class upload
{
    public $realPath;
    public function upload()
    {
        if (isset($_FILES['file'])) {
            $size = $_FILES['file']['size'];
            $error = [];
            //nếu mà kích cỡ file mà lớn hơn 5mb
            if ($size > 5 * 1024 * 1024) {
                $error[] = 'Kích thuớc file phải nhỏ hơn 5mb';
            }

            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            if ($ext == 'pdf' || $ext == 'docx' || $ext == 'doc') {
            } else   $error[] = 'File phải có định dạng pdf, docx, doc';

            if (count($error) == 0) {
                // $dir = date('m', time()) . '_' . date('yy', time()) . '/'; // 3_2020 định dạng;
                // $dir = 'uploads/' . $dir; // uploads/3_2020;
                // tạo thư mục mới nếu chưa tồn tại (tạo thư mục theo tháng và năm)
                // if (!file_exists($dir) && !is_dir($dir)) {
                //     mkdir($dir, 0777); //make directory
                // }
                $tmpFile = $_FILES['file']['tmp_name'];
                global $realPath;
                $realPath =  time() . str_replace(' ', '_', $_FILES['file']['name']);
                //di chuyển file từ thư mục tạm sang thư mục thật
                $real =  'admin/uploads/' . $realPath;
                move_uploaded_file($tmpFile, $real);
                return 1;
            }
            if (isset($error) && count($error) != 0) {
                foreach ($error as $r) {
                    echo '<p>' . $r . '</p>';
                }
            }
        }
    }
    public function getRealpath()
    { // lay ten anh dc luu trong uploads
        global $realPath;
        return $realPath;
    }
}