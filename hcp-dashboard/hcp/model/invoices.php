<?php
class Invoices{
    
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    
    function view_invoices($client_ID){
        $sql = "SELECT * FROM tblinv_info WHERE client_ID = '$client_ID'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    function view_invoice($inv_num){
        $sql= "SELECT tblinv_info.inv_num, tblinv_items.inv_num, tblinv_info.client_ID, tblinv_info.inv_date,
        tblinv_items.item_price, tblinv_items.item_quantity, tblinv_items.supplement_id
        FROM tblinv_items
        INNER JOIN tblinv_info ON tblinv_info.inv_num = tblinv_items.inv_num
        WHERE tblinv_items.inv_num = '$inv_num'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        if(count($result)>0){
            return $result;
        }else{
            $sql = "DELETE FROM tblinv_info WHERE inv_num = '$inv_num'";
            $query = $this->conn->prepare($sql);
            $query->execute();
            if($query){
                echo "<script>alert('Opps there were some changes occurred')</script>";
                echo '<script>window.location="invoice-list.php"</script>';
            }
        }
        
    }

    function client_info($client_ID){
        $sql = "SELECT * FROM `tblclientinfo` WHERE client_ID='$client_ID'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    function unpaid_invoices(){
        $sql="SELECT tblclientinfo.client_ID AS 'CLIENT ID', CONCAT(c_name,' ',c_surname) AS CLIENT, inv_num AS 'INVOICE NUMBER', inv_date AS 'INVOICE DATE'
        FROM tblclientinfo
        INNER JOIN tblinv_info ON tblclientinfo.client_ID = tblinv_info.client_ID
        WHERE inv_paid <> 'Y' AND YEAR(Inv_Date) < YEAR(CURRENT_DATE())
        ORDER BY tblinv_info.inv_date ASC
        ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    function birthdays(){
        $sql = "SELECT tblclientinfo.Client_ID AS 'CLIENT ID', CONCAT(c_name,' ', c_surname) AS 'CLIENT NAME'
        FROM `tblclientinfo` 
        WHERE SUBSTR(tblclientinfo.client_ID,3,2) = MONTH(CURRENT_DATE()) 
        AND SUBSTR(tblclientinfo.client_ID,5,2) = DAY(CURRENT_DATE())
        ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    function below_level(){
        $sql = "SELECT tblsupplements.supplement_id AS 'SUPPLEMENT', CONCAT(tblsupplierinfo.supplier_id,' ',tblsupplierinfo.contact_person,' ', tblsupplierinfo.supplier_tel) AS 'SUPPLIER INFORMATION', tblsupplements.min_levels AS 'MIN LEVELS', tblsupplements.current_stock_levels AS 'CURRENT STOCK'
        FROM `tblsupplements` 
        INNER JOIN tblsupplierinfo ON tblsupplierinfo.supplier_id = tblsupplements.supplier_id
        WHERE tblsupplements.Min_levels > tblsupplements.current_stock_levels
        ORDER BY tblsupplements.current_stock_levels ASC
        ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    function top_10(){
        $sql="SELECT CONCAT(tblclientinfo.client_ID,' ',tblclientinfo.c_name,' ',tblclientinfo.c_surname) AS 'CLIENT', count(*) AS 'FREQUENCY' 
        FROM tblclientinfo 
        INNER JOIN tblinv_info ON tblinv_info.client_ID = tblclientinfo.client_ID AND YEAR(tblinv_info.Inv_Date) BETWEEN 2018 AND 2019 
        GROUP BY tblinv_info.client_ID 
        ORDER BY FREQUENCY DESC LIMIT 10
        ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    function frequency(){
        $sql = "SELECT COUNT(MONTHNAME(tblinv_info.inv_date)) AS 'NUM OF PURCHASES', MONTHNAME(tblinv_info.inv_date) AS 'MONTH'
        FROM tblinv_info 
        WHERE YEAR(tblinv_info.inv_date) >= '2012'
        GROUP BY MONTHNAME(tblinv_info.inv_date) 
        ORDER BY FIELD(MONTHNAME(tblinv_info.inv_date),'January','February','March','April','May','June','July','August','September','October','November')
        ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    function client_contact(){
        $sql= "SELECT tblclientinfo.client_ID AS 'CLIENT', tblclientinfo.c_tel_h AS 'HOME',tblclientinfo.c_tel_w AS 'WORK', tblclientinfo.c_tel_cell AS 'CELL', tblclientinfo.c_email AS 'EMAIL' FROM tblclientinfo 
        WHERE tblclientinfo.c_tel_cell = '' 
        AND tblclientinfo.c_email = ''";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    function send_email($to,$subject,$msg){
        mail($to,$subject,$msg,'FROM: imza@gmail.com');
    }
}

?>