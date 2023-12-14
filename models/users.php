<?php
require_once('C:/xampp/htdocs/QL_LV_TL/db.php');
require_once('iuser.php');
class Users extends DB implements Iusers
{
    const tableName = 'user';
    public function __construct()
    {
        parent::__construct();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    // ==================================== Start page user ==================================
    // insert user sv
    function insert($payload) {
        try {
            $usercode = $payload['user_code'];
            $username = $payload['user_name'];
            //$address = $payload['user_address'];
            $phone = $payload['user_phone'];
            //$city = $payload['city'];
            $pass = $payload['user_pass'];
            $cf_pass = $payload['user_cf_pass'];
            $full_name = $payload['user_fname'];
            //$birth = $payload['user_birth'];
            $email = $payload['user_email'];
            $user_position = $payload['user_permit'];
            if ($pass = $cf_pass) {
                $check = self::check_User_Email($username, $email, $usercode);
                if ($check == 'OK') {
                    $stm = $this->db->prepare('INSERT INTO ' .
                        self::tableName . '(user_code, user_account, user_tel, user_password, user_email, user_name, user_position, user_date_add)
                               VALUES(:usercode, :username, :phone, :pass, :email, :full_name, :position, :date_add)');
                    $stm->execute(array(
                        ':usercode' => $usercode,
                        ':username' => $username,
                        //':address' => $address,
                        ':phone' => $phone,
                        ':email' => $email,
                        ':pass' => md5($pass),
                        //':birth' => $birth,
                        ':full_name' => $full_name,
                        ':position' => $user_position,
                        ':date_add' => date('y/m/d')
                    ));
                } else return $check;
            } else return 'Hai mật khẩu không khớp';
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        //tra ve so ban ghi
        return $stm->rowCount();
    }

    // check username, email tồn tại trước khi đăng ký
    function check_User_Email($username, $email, $usercode)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE user_account=:username");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(":username" => $username));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Tài khoản đã tồn tại';
        }
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE user_email=:email");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(':email' => $email));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Email đã tồn tại';
        }
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE user_code=:usercode");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(":usercode" => $usercode));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'MSSV đã tồn tại';
        }
        return 'OK';
    }
    // Check đăng nhập
    function check_login($payload)
    {
        $username = $payload['user_name'];
        $password = $payload['user_pass'];
        $stm =  $this->db->prepare('SELECT * FROM ' . self::tableName . " WHERE user_account = :username AND user_password = :password ");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(':username' => $username, ':password' =>  md5($password)));
        return  $stm->fetch();
    }
    //all user ngoại trừ admin
    function getAll($offset, $count)
    {
        $stm = $this->db->prepare("SELECT * FROM ".self::tableName." WHERE user_position != 3 LIMIT $offset, $count");
        $stm->execute();
        return $stm->fetchAll();
    }
    // count user 
    function getCountUser()
    {
        $stm = $this->db->prepare("SELECT COUNT(*) as count FROM ".self::tableName." WHERE user_position != 3");
        $stm->execute();
        return $stm->fetch();
    }

    // delete user by id 
    function delete($id)
    {
            $stm = $this->db->prepare("DELETE FROM " . self::tableName . " WHERE user_id =" . $id);
            $stm->execute();
            return $stm->rowCount();
    }
    // search by code, name, username limit 10
    function searchAll($search, $offset, $count){
        $stm = $this->db->prepare("SELECT * FROM " .self::tableName. " WHERE user_position != 0 AND (user_code LIKE '%". $search . "%' OR user_account LIKE '%". $search . "%' OR user_name LIKE '%". $search . "%') LIMIT $offset, $count");
        $stm->execute();
        return $stm->fetchAll();
    }
    // search count 
    function CountSearch($search){
        $stm = $this->db->prepare("SELECT COUNT(*) as count FROM ( SELECT * FROM " .self::tableName. " WHERE user_position != 0 AND 
        (user_code LIKE '%". $search . "%' OR user_account LIKE '%". $search . "%' OR user_name LIKE '%". $search . "%')) as user");
        $stm->execute();
        return $stm->fetch();
    }
    //Get user sihh viên
    function getUserSV(){
        $stm = $this->db->prepare("SELECT * FROM ". self::tableName ." WHERE user_position = 2");
        $stm->execute();
        return $stm->fetchAll();
    }
    //get count user sv
    function getCountSV()
    {
        $stm = $this->db->prepare("SELECT COUNT(*) as count FROM (SELECT * FROM ". self::tableName ." WHERE user_position = 2) as user  ");
        $stm->execute();
        return $stm->fetch();
    }
    //Get user giang viên
    function getUserGV(){
        $stm=$this->db->prepare("SELECT * FROM ". self::tableName ." WHERE user_position = 1");
        $stm->execute();
        return $stm->fetchAll();
    }
    //get count gv
    function getCountGV()
    {
        $stm = $this->db->prepare("SELECT COUNT(*) as count FROM (SELECT * FROM ". self::tableName ." WHERE user_position = 2) as user  ");
        $stm->execute();
        return $stm->fetch();
    }
    // ==================================== end page user ==================================

    // ==================================== start page edit user ==================================
    // get user by id
    function getById($id)
    {
        $stm = $this->db->prepare("SELECT * FROM ". self::tableName ." WHERE user_id = $id");
        $stm->execute();
        return $stm->fetch();
    }
    // update user
    function updateUser($payload)
    {
        try {
            $user_id = $payload['userid'];
            $user_code = $payload['usercode'];
            $username = $payload['username'];
            $full_name = $payload['fullname'];
            $email = $payload['email'];
            $phone = $payload['phone'];
            // $email = $payload['email'];
            $check = self::check_User_Email_code_edit($username, $email, $user_code, $user_id);
            if ($check == 'OK') {
                $stm = $this->db->prepare('UPDATE  ' .
                    self::tableName .
                    ' SET user_code=:usercode, user_account=:username, user_name=:fullname, user_email=:email, user_tel=:phone, user_date_update=:date_update WHERE user_id = :id');
                $stm->execute(array(
                    ':usercode' => $user_code,
                    ':username' => $username,
                    ':fullname' => $full_name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':date_update' => date('y/m/d'),
                    ':id' => $user_id
                    
                ));
            } else return $check;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $stm->rowCount();
    }
    // update new password
    function updatePass($payload)
    {
        try {
            $username = $payload['n_username'];
            $password = $payload['n_password'];
            // $email = $payload['email'];
            $stm = $this->db->prepare('UPDATE  ' .
                self::tableName .
                ' SET user_password =:password WHERE user_account = :username');
            $stm->execute(array(
                ':password' => md5($password),
                ':username' => $username
                
            ));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $stm->rowCount();
    }
    // check tồn tại trước khi edit
    function check_User_Email_code_edit($username, $email, $usercode, $id)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE user_account=:username AND user_id != $id");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(":username" => $username));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Username đã tồn tại';
        }
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE user_email=:email AND user_id != $id");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(':email' => $email));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Email đã tồn tại';
        }
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE user_code=:usercode AND user_id != $id");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(":usercode" => $usercode));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'User Code đã tồn tại';
        }
        return 'OK';
    }
    //===================================== end page edit user ====================================
}