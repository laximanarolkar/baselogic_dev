 function validateMultipler()
{
//alert("in mult");

// $("#dealerReg").validate(
// alert("dfgh")
// );
var mal=$('#fos_user_registration_form_email').val();


//alert(mal); 

jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z]+$/i.test(value);
}, "Letters only please");

jQuery.validator.addMethod(
  "phone",
  function(phone_number, element) {
   return this.optional(element) || /^\d{2,}$/.test(phone_number.replace(/\s/g, ''));
  },
    "Please enter numbers only"
);
/* 
var rules = new Object();
var messages = new Object();
$('input[id^=multId]:text').each(function() {
    rules[this.name] = { required: true };
   // messages[this.name] = { required: 'This field is required' };
});

var rules1 = "rules:{fos_user_registration_form[email]:{required: true , email:true},";
$('input[id^=markId]:text').each(function() {
    rules1+= '"'+this.name+'"'+":{required: true , digits:true},";
});
rules1+="}";
alert(rules1);
 */
var validator = $("#dealerReg").validate({
   
rules: {
	"1":{ digits:true},
	"2":{ digits:true},
	"3":{ digits:true},
	"4":{ digits:true},
	"5":{ digits:true},
	"6":{ digits:true},
	"7":{ digits:true},
	"8":{ digits:true},
	"9":{ digits:true},
	"markup11":{ digits:true},
	"markup2":{ digits:true},
	"markup3":{ digits:true},
	"markup4":{ digits:true},
	"markup5":{ digits:true},
	"markup6":{ digits:true},
	"markup7":{ digits:true},
	"markup8":{ digits:true},
	"markup11":{ digits:true},
	"fos_user_registration_form[email]":{
					required: true,
					email:true
					},
					"#fos_user_registration_form_first_name":{
					lettersonly: true
					},
					"fos_user_registration_form[phone]":{
					phone:true
					},
					"fos_user_registration_form[last_name]":{
					lettersonly: true
					},
					"fos_user_registration_form_password" : {
                    minlength : 3
					},
					"fos_user_registration_form[plain_password]" : {
                    minlength : 3,
                    equalTo : "#fos_user_registration_form_password"
					}
				
},
   
   invalidHandler: function(form, validator) {
			
            var errors = validator.numberOfInvalids();
			//alert(errors);
            if (errors) {
                $("#mulError").show().text("You missed " + errors + " field(s).");
            } else {
                $("#mulError").hide();
            }
    }
});

// $("man[]").rules("add", {"digits": true });

}


/* 
function validateCustomer()
{
alert("dfhkh");

$("#userRegis").validate();
if ($("#myform").valid()){
alert("user valid");
}else
alert("invalid user");

} */