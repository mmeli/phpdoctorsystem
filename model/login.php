<?php


class Login{
    
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }
    public function login($client_ID, $dob){
        $sql = "SELECT * FROM tblclientinfo WHERE client_ID= '$client_ID' AND SUBSTR(client_ID,1,6) = '$dob' LIMIT 1 ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result == true){
            $_SESSION['c_email'] = $result['c_email'];
            $_SESSION['client_ID'] = $result['client_ID'];
            
            echo '<script>window.location="supplements.php"</script>';
        }else{
            echo "<div  style='color: red; align:center'>"."Incorrect credintials!"."</div>";
        }
    }
}


?>