<?php
class HCP{
    //DB staff
    private $conn;
    private $table = 'hcp';

    //Clients properties
    public $name;
    public $email;
    public $username;
    public $address;
    public $tel;
    private $password;
   

    public function __construct($db){
        $this->conn = $db;
    }

    
    public function select_hcp(){
        $sql = "SELECT * FROM hcp LIMIT 1";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    function logged_hcp($id){
        $sql = "SELECT * FROM hcp WHERE id = '$id' LIMIT 1";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public function update_hcp($id,$name,$email,$tel,$password){
        $sql = "UPDATE hcp SET name = '$name', email = '$email', tel = '$tel', password = '$password' WHERE id = $id";
        $query = $this->conn->prepare($sql);
        $query->execute();
        if($query){
            echo "<script>alert('updated')</script>";
            echo '<script>window.location="pages-profile.php"</script>';
        }
       
    }

    public function hcp_login($email,$password){
        $sql = "SELECT * FROM hcp WHERE email = '$email' AND password = '$password'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $data = $query->fetch();
        if($data == false ){
            echo "<script>alert('Incorrect username or password')</script>";
            echo '<script>window.location="hcp-signin.php"</script>';
          }else{
                  
                    $_SESSION['hcp_email'] = $data['email'];
                    $_SESSION['hcp_name'] = $data['name'];
                    $_SESSION['hcp_username'] = $data['username'];
                    $_SESSION['hcp_address'] = $data['address'];
                    $_SESSION['hcp_id']=$data['id'];
                    $_SESSION['hcp_tel']=$data['tel'];
                    $_SESSION['hcp_pass']=$data['password'];
                  echo '<script>window.location="hcp-dashboard/hcp/index.html"</script>';
          }
        //return $result;
    }


}

?>