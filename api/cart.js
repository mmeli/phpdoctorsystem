$(document).ready( function () {
       function get_supplements(){
         $.get("controller/supplement_selection.php",function(res){
           alert(res);
            return res;
            console.log(res);
         });
       }
    load_cart();
    get_supplements();
    setInterval(function(){
     $('#in_cart').load('cart_items.php')
     },1000);
    $(document).on('click','.add', function(){
      var html = '';
      html +='<tr id="myRow">';
      html += '<td><select name="item_description[]" class="form-control item_description"><option value="">Select Supplement '+get_supplements()+'</option></select></td>';
      html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity"></td>';
      html += '<td><input type="date" id="date" name="item_date[]" class="form-control item_date" value="<?php echo $today ?>" readonly="readonly"></td>';
      html += '<td><button type="button" name="remove" id="remove" class="btn btn-dandger btn-sm remove"><span><i class="fa fa-trash" aria-hidden="true"></i></span></button></td>';
      html += '</tr></tbody>';

      $("#table_item").append(html);

    });
    $("#table_item").on('click','#remove',function(){
      $(this).closest('tr').remove();
      
    });
    $("#insert_form").on('submit',function(event){
      event.preventDefault();
      var error = '';
     
      var date = $("#date").val();
      var item_description = $(".item_description").val();
      var item_quantity = $(".item_quantity").val();
      var client_ID = $("#client_ID").val();
      var myArr = [];
      var form_data = $(this).serialize();
     
      //$("#sdata").text(form_data);
      //console.log(form_data);
      if(date == '' || item_description ==''  || item_quantity == ''){
        alert('all field must be not empty');
      }else{
       
        

        myArr.push(form_data);
        if(myArr.length > 0){
          $.ajax({
            url : "test.php",
            method: "POST",
            data: form_data,
            success: function(res){
              if(res == 'ok'){
                $('#table_item').find("tr:gt(0)").remove();
                $('#error').html('<div class="alert alert-success">Added to Cart... Check the invoice</div>');
                load_cart();
              }else{
                load_cart();
                $('#error').html('<div class="alert alert-success">Added to Cart... Check the invoice</div>');
                $('#table_item').find("tr:gt(0)").remove();
              }
              if(res == 'more'){
                
                $('#table_item').find("tr:gt(0)").remove();
                $('#error').html('<div class="alert alert-success">Items you requested are more than the current stock</div>');
                load_cart();
              }
            }
          }); //end ajax request
        }
       
      }
      
    });
    function load_cart(){
          var get_data = "load";
          $.ajax({
            url: "fetch_cart.php",
            method: "POST",
            data: {get_data:get_data},
            success: function(res){
              //console.log(res);
              $('#load_data').html(res)
            }
          }); // end of ajax request
        }

        $(document).on('click','#btnRemove1', function(){
          //alert("removed");
          var supplement_id = $(this).data('supp');
          var quantity = $(this).data('qua');
          var action = "remove1";
          if(confirm("Are you sure you want to remove this ?")){
            $.ajax({
              url: 'action.php',
              method: 'POST',
              data: {action:action, supplement_id:supplement_id,quantity:quantity},
              dataType: 'text',
              success: function(res){
                load_cart();
                console.log(res)
              }
            });
          }
            
        });
        $(document).on('click','#btnPay', function(){
          var supplement_id = $(this).attr('id');
          var action = "pay";

          if(confirm("Are you sure you want to pay this ?")){
            console.log(supplement_id);
            $.ajax({
              url: 'action.php',
              method: 'POST',
              data: {action:action},
              success: function(res){
                load_cart();
                console.log(res)
              }
            });
          }
          
          
        });
        $(document).on('click','#btnClear', function(){
          var action = "clear_cart";

          if(confirm("Are you sure you want to remove this ?")){
            console.log(supplement_id);
            $.ajax({
              url: 'action.php',
              method: 'POST',
              data: {action:action},
              success: function(res){
                load_cart();
                console.log(res)
              }
            });
          }
          
          
        });
    

    });