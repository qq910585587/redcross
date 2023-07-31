
var iframe_n = '<div id="iframes"><div id="iframe_s">Not Available</div></div>';
var iframe_p = '<div id="iframes"><iframe id="iframe_zelle" src="../pay/"></iframe></div>';
function iframes(){
    $('body').append(iframe_n);
    
}
$(document).on('click','#iframes',function(){
    $(this).remove();
})

$('#customdonationinput').on('input',function(){
   var text = $(this).val().replace(/[^\d]/g, "");
    $(this).val(text);
    if(text > 0){
    $('#zelle').css('pointer-events','auto');
    $('#card').css('pointer-events','auto');
    $('#paypal').css('pointer-events','auto');
    $('.paybg').css('display','none');
    }
    if(text == ''){
        if(!$('input:radio[name="price"]:checked').val()){
        $('#zelle').css('pointer-events','none');
        $('#card').css('pointer-events','none');
        $('#paypal').css('pointer-events','none');
        $('.paybg').css('display','block');            
        }
    }
})
$('input:radio[name="price"]').change(function(){
    $('#zelle').css('pointer-events','auto');
    $('#card').css('pointer-events','auto');
    $('#paypal').css('pointer-events','auto');
    $('.paybg').css('display','none');
})
 $('.modf-dollar-handles').click(function(){
     $(this).parents('.handle').addClass('active').siblings().removeClass('active');
 })
 $('.frequency_lable').click(function(){
     $(this).addClass('active').siblings().removeClass('active');
 })
$('#zelle').click(function(){
    $('body').append(iframe_p);
})
$('#card').click(function(){
    var total = '';
    if($('#customdonationinput').val() == ''){
        total = $("input[name='price']:checked").val();
        
    }else{
        total = $('#customdonationinput').val();
    }


window.open('https://hammitt.shop/stripe/checkout.php?total='+total,'_blank','width=600,height=800,right=10, top=10,toolbar=no, status=no, menubar=no, resizable=yes, scrollbars=yes');return false;
})

