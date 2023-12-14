<?php
require_once('C:/xampp/htdocs/QL_LV_TL/db.php');
class Facultys extends DB
{
    const tableName = 'faculty';
    public function __construct()
    {
        parent::__construct();
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    //============= start page index =========================
    //get all faculty
    function getAll($offset, $count)
    {
        $stm = $this->db->prepare("SELECT * FROM ". self::tableName ." LIMIT $offset, $count" );
        $stm->execute();
        return $stm->fetchAll();
    }
    // count all
    function getCountFaculty()
    {
        $stm = $this->db->prepare("SELECT COUNT(*) as count FROM ". self::tableName);
        $stm->execute();
        return $stm->fetch();
    }
    //delete
    function delete($id)
    {
            $stm = $this->db->prepare("DELETE FROM " . self::tableName . " WHERE faculty_id =" . $id);
            $stm->execute();
            return $stm->rowCount();
    }
    //===========start page edit ===========================================
    //get by id
    function getFacultyById($id) {
        $stm = $this->db->prepare("SELECT * FROM ". self::tableName ." WHERE faculty_id = $id");
        $stm->execute();
        return $stm->fetch();
    }
    // update 
    function updateFaculty($payload)
    {
        try {
            $faculty_id = $payload['faculty_id'];
            $faculty_name = $payload['faculty_name'];
            $faculty_code = $payload['faculty_code'];
            $check = self::check_Faculty_Name_Code_edit($faculty_name, $faculty_code, $faculty_id);
            if ($check == 'OK') {
                $stm = $this->db->prepare('UPDATE  ' .
                    self::tableName .
                    ' SET faculty_name=:f_name, faculty_code=:f_code WHERE faculty_id = :f_id');
                $stm->execute(array(
                    
                    'f_name' => $faculty_name,
                    'f_code' => $faculty_code,
                    'f_id' => $faculty_id
                ));
            }else return $check;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        return $stm->rowCount();
    }
    //kiểm tra tồn tại trước khi edit
    function check_Faculty_Name_Code_edit($faculty_name, $faculty_code, $id)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE faculty_name=:faculty_name AND faculty_id != $id");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(":faculty_name" => $faculty_name));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Name đã tồn tại';
        }
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE faculty_code=:faculty_code AND faculty_id != $id");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(':faculty_code' => $faculty_code));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Code đã tồn tại';
        }
       
        return 'OK';
    }
    //============start page add ========================
    //insert
    function insert($payload) {
        try {
            $faculty_name = $payload['faculty_name'];
            $faculty_code = $payload['faculty_code'];
      
            $check = self::check_Faculty_Name_Code_add($faculty_name, $faculty_code,);
            if ($check == 'OK') {
                $stm = $this->db->prepare('INSERT INTO ' .
                    self::tableName . '(faculty_name, faculty_code)
                        VALUES(:faculty_name, :faculty_code)');
                $stm->execute(array(
                    ':faculty_name' => $faculty_name,
                    ':faculty_code' => $faculty_code
                    ));
            } else return $check;
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }

        //tra ve so ban ghi
        return $stm->rowCount();
    }
    // Kiểm tra tồn tại trước khi thêm
    function check_Faculty_Name_Code_add($faculty_name, $faculty_code)
    {
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE faculty_name=:faculty_name");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(":faculty_name" => $faculty_name));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Name đã tồn tại';
        }
        $stm = $this->db->prepare("SELECT * FROM " . self::tableName . " WHERE faculty_code=:faculty_code");
        $stm->setFetchMode(PDO::FETCH_ASSOC);
        $stm->execute(array(':faculty_code' => $faculty_code));
        $check = $stm->fetch();
        if (!empty($check)) {
            return 'Code đã tồn tại';
        }
       
        return 'OK';
    }
}