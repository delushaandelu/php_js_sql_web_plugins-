<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>PayPal Pro payment gateway integration in PHP by CodexWorld</title>
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.creditCardValidator.js"></script>
<script type="text/javascript">
function cardFormValidate(){
    var cardValid = 0;
      
    //Card validation
    $('#card_number').validateCreditCard(function(result) {
        var cardType = (result.card_type == null)?'':result.card_type.name;
        if(cardType == 'Visa'){
            var backPosition = result.valid?'2px -163px, 260px -87px':'2px -163px, 260px -61px';
        }else if(cardType == 'MasterCard'){
            var backPosition = result.valid?'2px -247px, 260px -87px':'2px -247px, 260px -61px';
        }else if(cardType == 'Maestro'){
            var backPosition = result.valid?'2px -289px, 260px -87px':'2px -289px, 260px -61px';
        }else if(cardType == 'Discover'){
            var backPosition = result.valid?'2px -331px, 260px -87px':'2px -331px, 260px -61px';
        }else if(cardType == 'Amex'){
            var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
        }else{
            var backPosition = result.valid?'2px -121px, 260px -87px':'2px -121px, 260px -61px';
        }
        $('#card_number').css("background-position", backPosition);
        if(result.valid){
            $("#card_type").val(cardType);
            $("#card_number").removeClass('required');
            cardValid = 1;
        }else{
            $("#card_type").val('');
            $("#card_number").addClass('required');
            cardValid = 0;
        }
    });
      
    //Form validation
    var cardName = $("#name_on_card").val();
    var expMonth = $("#expiry_month").val();
    var expYear = $("#expiry_year").val();
    var cvv = $("#cvv").val();
    var regName = /^[a-z ,.'-]+$/i;
    var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    var regYear = /^2016|2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
    var regCVV = /^[0-9]{3,3}$/;
    if (cardValid == 0) {
        $("#card_number").addClass('required');
        $("#card_number").focus();
        return false;
    }else if (!regMonth.test(expMonth)) {
        $("#card_number").removeClass('required');
        $("#expiry_month").addClass('required');
        $("#expiry_month").focus();
        return false;
    }else if (!regYear.test(expYear)) {
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").addClass('required');
        $("#expiry_year").focus();
        return false;
    }else if (!regCVV.test(cvv)) {
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").addClass('required');
        $("#cvv").focus();
        return false;
    }else if (!regName.test(cardName)) {
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#name_on_card").addClass('required');
        $("#name_on_card").focus();
        return false;
    }else{
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#name_on_card").removeClass('required');
        $('#cardSubmitBtn').prop('disabled', false);  
        return true;
    }
}
    
$(document).ready(function() {
    //Demo card numbers
    $('.card-payment .numbers li').wrapInner('<a href="javascript:void(0);"></a>').click(function(e) {
        e.preventDefault();
        $('.card-payment .numbers').slideUp(100);
        cardFormValidate()
        return $('#card_number').val($(this).text()).trigger('input');
    });
    $('body').click(function() {
        return $('.card-payment .numbers').slideUp(100);
    });
    $('#sample-numbers-trigger').click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        return $('.card-payment .numbers').slideDown(100);
    });
    
    //Card form validation on input fields
    $('#paymentForm input[type=text]').on('keyup',function(){
        cardFormValidate();
    });
    
    //Submit card form
    $("#cardSubmitBtn").on('click',function(){
        if (cardFormValidate()) {
            var formData = $('#paymentForm').serialize();
            $.ajax({
                type:'POST',
                url:'payment_process.php',
                dataType: "json",
                data:formData,
                beforeSend: function(){  
                    $("#cardSubmitBtn").val('Processing....');
                },
                success:function(data){
                    if (data.status == 1) {
                        $('#paymentSection').slideUp('slow');
                        $('#orderInfo').slideDown('slow');
                        $('#orderInfo').html('<p>Order <span>#'+data.orderID+'</span> has been submitted successfully.</p>');
                    }else{
                        $('#paymentSection').slideUp('slow');
                        $('#orderInfo').slideDown('slow');
                        $('#orderInfo').html('<p>Wrong card details given, please try again.</p>');
                    }
                }
            });
        }
    });
});
</script>
</head>
<body>
<div class="card-payment">
    <h3 id="try-it">Try it</h3>
    <div id="paymentSection">
    <form method="post" id="paymentForm">
          <h4>Payable amount: $10 USD</h4>
          <ul>
              <input type="hidden" name="card_type" id="card_type" value=""/>
              <li>
                  <label for="card_number">Card number (<a href="javascript:void(0);" id="sample-numbers-trigger">try one of these</a>)</label>
                  <div class="numbers" style="display: none;">
                      <p>Try some of these numbers:</p>
              
                      <ul class="list">
                          <li><a href="javascript:void(0);">4000 0000 0000 0002</a></li>
                          <li><a href="javascript:void(0);">5018 0000 0009</a></li>
                          <li><a href="javascript:void(0);">5100 0000 0000 0008</a></li>
                          <li><a href="javascript:void(0);">6011 0000 0000 0004</a></li>
                      </ul>
                  </div>
                  <input type="text" placeholder="1234 5678 9012 3456" id="card_number" name="card_number" class="">
  
                  <small class="help">This demo supports Visa, American Express, Maestro, MasterCard and Discover.</small>              </li>
  
              <li class="vertical">
                  <ul>
                      <li>
                          <label for="expiry_month">Expiry month</label>
                          <input type="text" placeholder="MM" maxlength="5" id="expiry_month" name="expiry_month">
                      </li>
                      <li>
                          <label for="expiry_year">Expiry year</label>
                          <input type="text" placeholder="YYYY" maxlength="5" id="expiry_year" name="expiry_year">
                      </li>
                      <li>
                          <label for="cvv">CVV</label>
                          <input type="text" placeholder="123" maxlength="3" id="cvv" name="cvv">
                      </li>
                  </ul>
              </li>
              <li>
                  <label for="name_on_card">Name on card</label>
                  <input type="text" placeholder="Codex World" id="name_on_card" name="name_on_card">
              </li>
              <li><input type="button" name="card_submit" id="cardSubmitBtn" value="Proceed" class="payment-btn" disabled="true" ></li>
              <p style="color:#EA0075;">Note that: This demo will working with PayPal sandbox accounts.</p>
          </ul>
      </form>
  </div>
    <div id="orderInfo" style="display: none;"></div>
</div>
</body>
</html>