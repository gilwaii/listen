<?php
class Database
{

    public $conn;

    public function connect(){

        $this->conn = new mysqli("localhost","root","","listenandwrite");

        if(mysqli_connect_errno()){
            printf("Connecet failed %s",mysqli_connect_error());
            exit(0);
        }
        $this->conn->set_charset('utf8');

        return $this->conn;
    }

    public function InsertDatabase($table,$data){
        $this->connect();
        //danh sach luu các trường và giá trị tương ứng
        $field_list  ='';
        $values_list ='';

        foreach($data as $key => $value){
            $field_list .= ",$key";
            $values_list .= ",'".mysqli_escape_string($this->connect(),$value)."'";//Ham tranh loi cu phap;
        }
        //thừa một dấu , nên ta sẽ dùng hàm trim để xóa đi
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($values_list, ',').')';

        return($this->conn->query($sql));


    }

    public function UpdateDatabase($table, $data,$where){
            $this->connect();
            $sql="";

            foreach($data as $key => $values){
                $sql .= "$key = '".mysqli_escape_string($this->connect(),$values)."'";
        }

        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;

        return($this->conn->query($sql));
    }
    public function DeleteDatabase($table,$where){
            $this->connect();
            $sql = 'DELETE FROM '.$table. ' WHERE '.$where;

        return($this->conn->query($sql));
    }

    public function getRow($query){
        $this->connect();

        $result = $this->conn->query($query);

        if (!$result){
            die("Câu truy vấn sai!!");
        }
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row){
            return $row;
        }
    }
    public function getAllList($query){
        $this->connect();
        $result = $this->conn->query($query);

        if (!$result){
            die ("Câu truy vấn sai!!");
        }
        $return = array();

        if ($result->num_rows){
            while ($rows = $result->fetch_array(MYSQLI_ASSOC)){
                $return[] = $rows;
            }
        }

        return $return;
    }
    public function count($query){
        $this->connect();
        $count = $this->conn->query($query);
        $result = $count->fetch_array(MYSQLI_ASSOC);

        return $result;

    }

}
