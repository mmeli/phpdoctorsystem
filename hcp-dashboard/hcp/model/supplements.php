<?php
class Supplements{
    
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function get_supplements(){
        $sql = "SELECT * FROM tblsupplements WHERE supplement_description <> '' AND current_stock_levels > 0 ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }


    public function supplement_per_selection($supplement_id){
        $sql = "SELECT * FROM tblsupplements WHERE supplement_description <> '' AND current_stock_levels > 0 AND supplement_id ='$supplement_id'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    public function update_to_supplements($supplement_id,$min_levels,$current_stock_levels){
        $sql = "UPDATE tblsupplements SET min_levels = '$min_levels', current_stock_levels = '$current_stock_levels' WHERE supplement_id ='$supplement_id' ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        if($query){
            echo "<script>alert('updated')</script>";
            echo '<script>window.location="index.php?report=supplements"</script>';
        }
    }


    public function get_supplements_selection(){
        $output = '';
        $sql = "SELECT *, REPLACE(`supplement_description`, '\'','') As supp_description FROM `tblsupplements`  WHERE supplement_description <> '' AND current_stock_levels > 0 ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        foreach ($result as $supplement) {
            $output .='<option value="'.$supplement['supplement_id'].'" >'.$supplement['supp_description'].'</option>';
        }

        return $output;
    }
  
    public function add_suppliments($supplement_id,$supplier_id,$supplement_description,$cost_excl,$cost_incl,$min_levels,$current_stock_levels,$nappi_code){
        $sql = "INSERT INTO `tblsupplements`(`supplement_id`, `supplier_id`, `supplement_description`, `cost_excl`, `cost_incl`, `min_levels`, `current_stock_levels`, `nappi_code`) VALUES ('$supplement_id','$supplier_id','$supplement_description','$cost_excl','$cost_incl','$min_levels','$current_stock_levels','$nappi_code')";
        $query = $this->conn->prepare($sql);
        $query->execute();
        if($query){
            echo "Supplement added successfully";
            
        }
        
    }

    function in_cart($client_ID){
        $sql = "SELECT * FROM cart WHERE client_ID = '$client_ID'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return count($result);
    }


    function minus_item($supplement_ID, $quantity){
        $sql = "UPDATE tblsupplements SET current_stock_levels= current_stock_levels-$quantity WHERE supplement_id = '$supplement_ID' ";
        $query = $this->conn->prepare($sql);
        $query->execute();
    }
    function add_removed_item($supplement_ID, $quantity){
        $sql = "UPDATE tblsupplements SET current_stock_levels= current_stock_levels+$quantity WHERE supplement_id = '$supplement_ID' ";
        $query = $this->conn->prepare($sql);
        $query->execute();
    }

    function add_to_cart($client_ID,$supplement_ID,$item_quantity,$date){
        $sql = "SELECT current_stock_levels FROM  tblsupplements WHERE supplement_id = '$supplement_ID'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        if(count($result)){
            foreach($result as $row){
                extract($row);
                if($item_quantity > $current_stock_levels){
                    echo "more";
                    //die();
                }else{
                    $sql = "INSERT INTO `cart`(`client_ID`, `supplement_ID`, `item_quantity`, `date`) VALUES ('$client_ID','$supplement_ID','$item_quantity','$date')";
                    $query = $this->conn->prepare($sql);
                    $query->execute();
                    if($query){
                        echo 'ok';
    
                    }
                }

            }
            
        }
        
    }

    function clear_cart(){
        $sql = "DELETE FROM cart";
        $query = $this->conn->prepare($sql);
        $query->execute();
    }
    function remove_cart($supplement_id, $quantity){
        $sql = "DELETE FROM cart WHERE supplement_ID = '$supplement_id' AND item_quantity = '$quantity'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        if($query){
            echo "removed";
        }

    }
   
    function cart_description($supplement_id, $quantity){
        $sql = "SELECT C.supplement_ID, S.supplement_id, S.supplement_description 
                FROM cart C, tblsupplements S WHERE C.supplement_ID  = S.supplement_id";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->execute();
        if(count($result)>0){
            foreach($result as $row){
                extract($row);
                $sql = "DELETE FROM cart WHERE supplement_ID = '$supplement_id' AND item_quantity = '$quantity'";
                $query = $this->conn->prepare($sql);
                $query->execute();
            }
        }

    }
    

    public function fetch_cart($client_ID){
        $output = '';
        $sql = "SELECT C.client_ID, C.supplement_ID, C.item_quantity, S.supplement_id, S.supplement_description, S.cost_incl, S.min_levels,S.current_stock_levels
                FROM cart C, tblsupplements S 
                WHERE C.supplement_ID = S.supplement_id AND C.client_ID = '$client_ID'
        ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        if(count($result) > 0){
            $total = 0;
            foreach ($result as $row) {
                $output.='
                    <tr>
                        <td id="supplement_id" data-supp_id="'.$row['supplement_ID'].'">'.$row['supplement_description'].'</td>
                        <td id="quantity" data-quantity="'.$row['item_quantity'].'">'.$row['item_quantity'].'</td>
                        <td id="cost_incl">R '.$row['cost_incl'].'</td>
                        <td>R '.number_format($row['cost_incl'] * $row['item_quantity'],2).'</td>
                        <td><button name="remove" data-supp="'.$row['supplement_ID'].'" data-qua="'.$row['item_quantity'].'" class="btn btn-xs btn-danger" id="btnRemove1">Remove</button>
                    </tr>
                ';
                $total = $total + ($row['cost_incl'] * $row['item_quantity']);
                
            }
            $output.='
                        <td colspan="3" align="right">Total</td>
                        <td align="right">R '.number_format($total,2).'</td>
                ';
                $output.='
                        <td colspan="5" ><button name="pay" class="btn btn-success" id="btnPay">Payment</button></td>
                        
                ';
        }else{
            $output.='
            <td colspan="5" align="center">Your cart is empty</td>
            ';
        }
        
        return $output;
    }
    function last_inserted_id(){
        $sql = "select * from tblinv_info where `inv_num`=(SELECT LAST_INSERT_ID()) ORDER BY `inv_num` DESC
        LIMIT 1 ";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        foreach($result as $row){
            
        }
        return $row['inv_num'];
        
    }
    public function invoice($inv_num,$client_ID,$date){
        
        $sql = "INSERT INTO `tblinv_info` (`inv_num`, `client_ID`, `inv_date`, `inv_paid`, `inv_paid_date`, `comments`) VALUES ('$inv_num', '$client_ID', '$date', 'N', '', '')";
        $query = $this->conn->prepare($sql);
        $query->execute();
    }

    public function invoice_item($inv_num,$supplement_ID,$price,$quantity){
        $sql = "INSERT INTO `tblinv_items`(`inv_num`, `supplement_id`, `item_price`, `item_quantity`) VALUES ('$inv_num','$supplement_ID','$price','$quantity')";
        $query = $this->conn->prepare($sql);
        $query->execute();
    }
    public function get_price($supplement_ID){
        $sql = "SELECT cost_incl FROM tblsupplements WHERE supplement_id = '$supplement_ID'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        foreach($result as $row){
            return $row['cost_incl'];
        }
        
    }

    public function get_description($supplement_ID){
        $sql = "SELECT supplement_description FROM tblsupplements WHERE supplement_id = '$supplement_ID'";
        $query = $this->conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        foreach($result as $row){
            return $row['supplement_description'];
        }
        
    }

    
}

?>