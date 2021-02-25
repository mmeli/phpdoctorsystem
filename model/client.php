<?php
class Client{
    //DB staff
    private $conn;
    private $table = 'tblclientinfo';

    //Clients properties
    public $c_name;
    public $c_surname;
    public $client_ID;
    public $address;
    public $code;
    public $c_tel_h;
    public $c_tel_w;
    public $c_tel_cell;
    public $c_email;
    public $reference_id;
    

    public function __construct($db){
        $this->conn = $db;
    }

    public function insert(){
        $c_name = $_POST['c_name'];
        $c_surname = $_POST['c_surname'];
        $client_ID = $_POST['client_ID'];
        $address = $_POST['address'];
        $code = $_POST['code'];
        $c_tel_h = $_POST['c_tel_h'];
        $c_tel_w = $_POST['c_tel_w'];
        $c_tel_cell = $_POST['c_tel_cell'];
        $c_email = $_POST['c_email'];
        $reference_id = $_POST['reference_id'];
     

        $sql = "SELECT * FROM ".$this->table." WHERE c_email= '$c_email' ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        if(count($result) > 0){
            echo "<script>alert('This user is already existing, please sign in!')</script>";
            echo '<script>window.location="signin.php"</script>';
        }else{
            $sql = "INSERT INTO `tblclientinfo`(`client_ID`,`c_name`, `c_surname`, `address`, `code`, `c_tel_h`, `c_tel_w`, `c_tel_cell`, `c_email`, `reference_id`) VALUES ('$client_ID','$c_name','$c_surname','$address','$code','$c_tel_h','$c_tel_w','$c_tel_cell','$c_email','$reference_id')";
            $query = $this->conn->prepare($sql);
            $query->execute();
            if($query){
                echo "<script>alert('Registered successfully')</script>";
                echo '<script>window.location="signin.php"</script>';
            }
        }
        
        
    }
    
    public function selectAll(){
        $sql = "SELECT * FROM tblclientinfo ORDER BY client_ID ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function select_by_email($email){
        $sql = "SELECT * FROM tblclientinfo WHERE c_email = '$email' ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function reference(){
        $sql = "SELECT * from tblreference ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function id_validation($id, $error){
        $correct = true;
        if(strlen($id) !== 13 || !is_numeric($id)){
           echo '<span style="color:red;">Please enter valid South African ID</span>';
            $correct = false; die();
        }
        $id_year = substr($id, 0,2);
        $id_month = substr($id, 2,2);
        $id_day = substr($id, 4,2);
        $gender = substr($id,6,4);
        $get_gender = '';
        $sa = substr($id, 10,1);
        if($id_month > 12 || $id_day > 31 || $sa > 0){
            echo '<span style="color:red;">ID number does not appear to be authentic</span>';
            $correct = false; die();
        }

        if($gender >= 5000){
            $get_gender = 'Male';
        }else{
            $get_gender = 'Female';
        }
        if($correct){
            //echo " You were born in $id_year / $id_month / $id_day and you are $get_gender ";
        }

    }

    public function email_validation($email){
        $correct = true;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "<span style='color:red;'>Enter valid email address</span>";
            echo $emailErr;
            $correct = false; die();
          }
    }



}

?>