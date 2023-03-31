<?php
class Database{
    private  $dsn = "mysql:host=localhost;dbname=php_oop_cruds";
    private $user = "root";
    private $pass = "";
    private $conn;
    public function __construct()
    {
        try {
            $this->conn = new PDO($this->dsn,$this->user, $this->pass);
            // echo "Connection Successfull";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insertRecord($fname,$lname,$email,$phone){
        $sql = "INSERT INTO users (first_name,last_name,email,phone) VALUES (:fname,:lname,:email,:phone)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['fname' => $fname,'lname' => $lname,'email' => $email,'phone' => $phone]);
        return true;
    }
    public function getRecord(){
        $data = array();
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $rows){
            $data[] = $rows;
        }
        return $data;
    }
    public function getRecordById($id){
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function updateRecord($id,$fname,$lname,$email,$phone,){
        $sql = "UPDATE users SET 
        first_name = :fname, last_name = :lname, email = :email, phone = :phone
        WHERE id =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['fname' => $fname,'lname' => $lname,'email' => $email,'phone' => $phone,'id' => $id]);
        return true;
    }
    public function deleteRecord($id){
        $sql = "DELETE FROM users where id =:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=> $id]);
        return true;
    }
    public function totalRowCount(){
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $total_rows = $stmt->rowCount();
        return $total_rows;
    }

}

?>