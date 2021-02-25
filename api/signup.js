$(document).ready(function(){
    $("#c_tel_h").mask("(999)-(999)-(9999)");
    $("#c_tel_w").mask("(999)-(999)-(9999)");
    $("#c_tel_cell").mask("(999)-(999)-(9999)");
    $(document).on('click','#btnSignup', function(){

        var c_name = $("#c_name").val();
        var c_surname = $("#c_surname").val();
        var client_ID = $("#client_ID").val();
        var address = $("#address").val();
        var code = $("#code").val();
        var c_tel_h = $("#c_tel_h").val();
        var c_tel_w = $("#c_tel_w").val();
        var c_tel_cell = $("#c_tel_cell").val();
        var c_email = $("#c_email").val();
        var reference_id = $("#reference_id").val();

        $('input').each(function() {
            if(!$(this).val()){
                $("#empty_fields").html("<span style='color:red;'>Please ensure all the fields are not empty<span>")
               return false;
            }
            
        });
    });
    
    });