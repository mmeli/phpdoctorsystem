$(document).ready(function(){
    // $(document).on('click','#btnSupplementUpdate', function(){
    //     alert("im clicked");
    // });
    $(document).on('click','#btnAddSupplier', function(){

        var supplier_id = $("#supplier_id").val();
        var contact_person = $("#contact_person").val();
        var supplier_tel = $("#supplier_tel").val();
        var supplier_email = $("#supplier_email").val();
        var bank = $("#bank").val();
        var bank_code = $("#bank_code").val();
        var supplier_BankNum = $("#supplier_BankNum").val();
        var supplier_type_bank_acc = $("#supplier_type_bank_acc").val();
        if(supplier_id == "" || contact_person == "" || supplier_tel == "" || supplier_email == "" || bank == ""|| supplier_BankNum == ""|| supplier_type_bank_acc == ""){
            $('.toast').toast('show');
        }else{
            obj={
                supplier_id,
                contact_person,
                supplier_tel,
                supplier_email,
                bank,
                bank_code,
                supplier_BankNum,
                supplier_type_bank_acc
            }

            $.post("controller/add_supplier.php",obj,function(res){
                console.log(res);
                alert(res);
                var delay = 2000; 
                var url = 'index.php?report=suppliers'
                setTimeout(function(){ window.location = url; }, delay);
            
            });
        }
        
        
      
    });
    
    });