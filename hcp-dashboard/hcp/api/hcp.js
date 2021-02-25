$(document).ready(function(){
$.get("controller/hcp_details.php",function(res){
    var obj = JSON.parse(res);
    obj.forEach((element)=>{
        $("#hcp_tel").html(element.tel);
        $("#hcp_email").html(element.email);
        $("#hcp_address").html(element.address);
        $("#hcp_name").html(element.name);


    })
    
});
});