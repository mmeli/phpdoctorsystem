<?php

class Suppliers{
    
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function get_suppliers(){
        $sql = "SELECT * FROM tblsupplierinfo ORDER BY supplier_id";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public function per_supplier($supplier_id){
        $sql = "SELECT * FROM tblsupplierinfo WHERE supplier_id = '$supplier_id' ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function update_to_suppliers($supplier_id,$contact_person,$supplier_tel,$supplier_email,$bank,$bank_code,$supplier_BankNum,$supplier_type_bank_acc){
        $sql = "UPDATE tblsupplierinfo SET contact_person = '$contact_person', supplier_tel = '$supplier_tel', supplier_email = '$supplier_email', bank = '$bank', bank_code = '$bank_code', supplier_BankNum = '$supplier_BankNum', supplier_type_bank_acc = '$supplier_type_bank_acc' WHERE supplier_id ='$supplier_id' ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        if($query){
            echo "<script>alert('updated')</script>";
            echo '<script>window.location="index.php?report=suppliers"</script>';
        }
    }

    public function add_supplier($supplier_id,$contact_person,$supplier_tel,$supplier_email,$bank,$bank_code,$supplier_BankNum,$supplier_type_bank_acc){
        $sql = "INSERT INTO `tblsupplierinfo`(`supplier_id`, `contact_person`, `supplier_tel`, `supplier_email`, `bank`, `bank_code`, `supplier_BankNum`, `supplier_type_bank_acc`) VALUES ('$supplier_id','$contact_person','$supplier_tel','$supplier_email','$bank','$bank_code','$supplier_BankNum','$supplier_type_bank_acc')";
        $query = $this->conn->prepare($sql);
        $query->execute();
        if($query){
            echo "Supplier added successfully";
            
        }
        
    }
  
   


    

    
}

?>