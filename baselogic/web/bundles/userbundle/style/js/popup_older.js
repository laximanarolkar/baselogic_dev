
function test(){//window measurement's onclick of next


	$(".zipcode_pop").animate({width: 'show'}, 'slow');
	$(".default_popup").css('display','none');

	var path=$('#path2').val();

	var style=$('#style').val();
	var material=$('#material').val();
	var frame=$('#frame').val();
	var option=$('#option').val();
	//-------get windows
	var checkboxes = document.getElementsByName('s1');
	var vals = "";
	for (var i=0, n=checkboxes.length;i<n;i++) 
		{
			if (checkboxes[i].checked) vals += ","+checkboxes[i].value;
		}
	//-----end

	//if (val) val = val.substring(1); 
	var trimWin = vals.replace(/(^,)|(,$)/g, "")

	//var window=$('s1').val();


	var winStyle=JSON.stringify(style);
	var winMaterial=JSON.stringify(material);
	var winFrame=JSON.stringify(frame);
	var winOption=JSON.stringify(option);
	var win=JSON.stringify(trimWin);



	//call to controller method to save windows in sessioon

	$.post(path,{

		style:winStyle,
		material:winMaterial,
		frame:winFrame,
		option:winOption,
		wind:win,

	},function(data){
	//the response is in the data variable

		if(data.responseCode==200 ){  
		// $("#tabs").tabs({disabled: false });
		$("#tabs").tabs({ 
		disabled: [2,3,4]  //disable third tab.
		});
		$('#disp').html(data.display);


		}
		else if(data.responseCode==400){//bad request
		// $('#disp').html(data.greeting); 
		}
		else{
		//if we got to this point we know that the controller
		//did not return a json_encoded array. We can assume that           
		//an unexpected PHP error occured
		alert("An unexpeded error occured.");

		//if you want to print the error:
		$('#disp').html(data);
		}

	});
	//$("#tabs").tabs({disabled: false });
	
}//window measurement's onclick of next--end	



function closeWindowMeasurement()
{
	$(".default_popup").css('display', 'none');
}

function saveChanges()
{
	//alert("in save changes");
	//Take new values of configuration to edit 
	var style=$('#editstyle').val();
	var material=$('#editmaterial').val();
	var frame=$('#editframe').val();
	var option=$('#editoption').val();
	//var window=$('#s2').val();

	var checkboxes = document.getElementsByName('s2');
	var vals = "";
	for (var i=0, n=checkboxes.length;i<n;i++)
		{
			if (checkboxes[i].checked) vals += ","+checkboxes[i].value;
		}
	//-----end

	//if (val) val = val.substring(1); 
	var trimWin = vals.replace(/(^,)|(,$)/g, "")
	// alert(vals);
	// alert(trimWin);



	var winStyle=JSON.stringify(style);
	var winMaterial=JSON.stringify(material);
	var winFrame=JSON.stringify(frame);
	var winOption=JSON.stringify(option);
	var win=JSON.stringify(trimWin);

	//End Take new values of configuration to edit 
	var path=$('#path2').val();
	//alert(winStyle+" "+winMaterial+" "+winFrame+" "+winOption+" "+win);
	//alert(path);
	//call to controller method to save windows in sessioon

	$.post(path,{

	style:winStyle,
	material:winMaterial,
	frame:winFrame,
	option:winOption,
	wind:win,

	},function(data){
	//the response is in the data variable

		if(data.responseCode==200 ){  
		$('#disp').html(data.display);
		//alert("success save changes in session");
		updateQuotes();

		}
		else if(data.responseCode==400){//bad request
		// $('#disp').html(data.greeting); 
		}
		else{
		//if we got to this point we know that the controller
		//did not return a json_encoded array. We can assume that           
		//an unexpected PHP error occured
		alert("An unexpeded error occured.");

		//if you want to print the error:
		$('#disp').html(data);
		}

	});
	
			
			
}

function updateQuotes()
{
	var tabs = $('#tabs').tabs();
	var saveZipcode=$('#zipcod').val();

	//---disable click of tab
	// $tabs.tabs('enable', 1)
	// .tabs('select', 1)
	// .tabs("option","disabled", [0,1, 2]);//---disable click of tab end

	//alert("in update quote"+saveZipcode);
	$.post(saveZipcode,{

	},function(data){
		//the response is in the data variable
		//alert("inajx function");

		if(data.responseCode==200 ){  
		//alert("inp2");

			//$("#tabs").tabs({disabled: false });	
			$('#tabs').tabs('enable', 1)
			$('#tabs-2').html(data.display);



			//alert("hi");
			$("#s2").dropdownchecklist();


		}
		else if(data.responseCode==400){//bad request
		//$('#disp').html(data.greeting);
		// alert(data.display);

		}
		else{
		//if we got to this point we know that the controller
		//did not return a json_encoded array. We can assume that           
		//an unexpected PHP error occured
		alert("An unexpeded error occured.");

		//if you want to print the error:
		//alert(data.display);
		}

	});
}


function showWindow(id,view)
{
//alert("in function"+document.getElementById(view).innerHTML);
 if(document.getElementById(view).innerHTML=='[+]')
 {
   document.getElementById(id).style.display = 'block';
   document.getElementById(view).innerHTML ='[-]';
   }else{
     document.getElementById(id).style.display = 'none';
	 document.getElementById(view).innerHTML='[+]';}
  /* $(".view").click(function() {
        $(this).next('.windowNum').toggle('slow');
    }); */
}


function toggle(thisname,id) {

           tr=document.getElementsByTagName('tr')

           for (i=0;i<tr.length;i++){ 
	
               if (tr[i].className == thisname){
                 if ( tr[i].style.display=='none'){ 
                    tr[i].style.display = '';
					 document.getElementById(id).innerHTML = 'Less';
                 }
              else {
                 tr[i].style.display = 'none';
				  document.getElementById(id).innerHTML = 'More';
                 }
				
				
              }
           }
		   
        }
		


		
function toggleEditConfig() {

   if(document.getElementById('editConfig').style.display == 'none')
  // document.getElementById('editConfig').style.visibility = 'hidden';
 // document.getElementById('editConfig').style.display == 'block'}
  $('#editConfig').show();
   else
    $('#editConfig').hide();
     //document.getElementById('editConfig').style.visibility = 'visible'; 
	 
 }
				

function addToCart()
{
	//alert("to cart");

	if (!$("input[name='manufacturer']").is(':checked')) {
		alert('Please select manufacturer.');
		
	}
	else {
		//-------
		//alert('radio button checked!');
		var myRadio = jQuery("input[name=manufacturer]");
		var selectedRadio = myRadio.filter(":checked");
		var manufact= selectedRadio.val();
		//alert(manufact);
		
		
		var manNameArr = manufact.split(",");
		var manName = manNameArr['0'];

 
	 //get window and base
	  var arPrice= new Array();
	$("[name="+manName+"]").each(function(key,value){
			 arPrice.push($(this).val());
		})  
	 
	 var winManuf=JSON.stringify(manufact);
	 var winPrice=JSON.stringify(arPrice);
	
	var cartUrl=$('#cartUrl').val();
		//Call ajax to save manufacturer and window details in session
		$.post(cartUrl,{
		manufacturerSelected:winManuf,
		priceOfWindow:winPrice,
       },function(data){
           //the response is in the data variabl
$('#tabs').tabs('enable', 2);
            if(data.responseCode==200 ){ 
			//alert("inp2 cart");
             // $('#tabs-3').html(data.display);
			  //-----next tab
			
        var tabs = $('#tabs').tabs();
        var c = $('#tabs').tabs("length");
        currentTab = 2;
        tabs.tabs('select', currentTab);   
        $("#btnPrevious").show();
       
   
			  //----end next tab
			  
			   $('#tabs-3').html(data.display);
			  }
           else if(data.responseCode==400){
		   
			
             
           }
           else{
              //if we got to this point we know that the controller
              //did not return a json_encoded array. We can assume that           
              //an unexpected PHP error occured
              alert("An unexpeded error occured.");
			     //alert(data.display);

              //if you want to print the error:
           //alert(data.display);
           }
		  
       });
		
		//call to ajax end
		
		//------
		} 
	
}

function shippingPopup()
{
	$(".shipping_pop").animate({width: 'show'}, 'slow');
	var tabs = $('#tabs').tabs();
        currentTab = 3;
        tabs.tabs('select', currentTab);
}

function userRegistration()
{
	$(".userReg").animate({width: 'show'}, 'slow');
}


function confirmOrder()
{
//alert ("in confirm");
//$('#error-messageShip').html("");
 var checkbox = $("input[name=shippingType]:checked");
    
    if( checkbox .length > 0 ){

		var tab=document.getElementById('tabId').value;
		
		var pathOrder=$('#confirmOrd').val();
		var shipType=$("input[name=shippingType]:checked").val();


		var shType=JSON.stringify(shipType);
	
		
	  //Call ajax to save shipping type and load confirm order tab
		$.post(pathOrder,{
			shippingType:shType,
			
			},function(data){
			//the response is in the data variabl
$('#tabs').tabs('enable', 3);
			if(data.responseCode==200 ){  
			//alert("inp2 order");
			//alert(data.display);
			if(tab=='tab-3'){
			//---------nxt tab
			var tabs = $('#tabs').tabs();
        var c = $('#tabs').tabs("length");
        currentTab = 3;
        tabs.tabs('select', currentTab);
       }
		document.getElementById('tabId').value='tab-4';
		//-----------nxt tab end
			$('#tabs-4').html(data.display);
			$(".shipping_pop").css('display', 'none');
			
			
			}
			else if(data.responseCode==400){//bad request
			//$('#disp').html(data.greeting);
			//alert("inp2 car2");
			// $('#cartShow').html(data.display);


			}
			else{
			//if we got to this point we know that the controller
			//did not return a json_encoded array. We can assume that           
			//an unexpected PHP error occured
			alert("An unexpeded error occured.");
			//alert(data.display);

			//if you want to print the error:
			//alert(data.display);
			}

			}); 
//alert( checkbox.val() );
    } else {
	//$('#error-messageShip').html("Please select shipping type.")
        alert('Please select shipping type');
    }
			//call to ajax end 
}

function autopopulateUserReg()
{
 var autoUrl=$('#autopopulateReg').val();
//alert(autoUrl); 
 var mail=$('#fos_user_registration_form_email').val();
 //alert(mail);
 
 var userMail=JSON.stringify(mail);
//Call ajax to autopopulate user registration form
		 $.post(autoUrl,{
			email:userMail,
       },function(data){
           //the response is in the data variabl

            if(data.responseCode==200 ){  
			
			  $('#fos_user_registration_form_first_name').val(data.fname);
			 $('#fos_user_registration_form_last_name').val(data.lname);
			  $('#fos_user_registration_form_address').val(data.address);
			$('#fos_user_registration_form_phone').val(data.phone); 
			   
			  }
           else if(data.responseCode==400){//bad request
               //$('#disp').html(data.greeting);
			   	//alert("inp2 car2");
               // $('#cartShow').html(data.display);
			
             
           }
           else{
              //if we got to this point we know that the controller
              //did not return a json_encoded array. We can assume that           
              //an unexpected PHP error occured
              alert("An unexpeded error occured.");
			     //alert(data.display);

              //if you want to print the error:
           //alert(data.display);
           }
		  
       });
		
		//call to ajax end
 
}


$(document).ready(function(){  
//for validation if last repeat div is removed
/* if($('#repeatDiv:hidden')){ 
 $('#repeatDiv').find("input:text").removeClass('error'); 
} */
/* if($('#repeatDiv:hidden')){ 
 //$('#repeatDiv').find("input:text").removeClass('error'); 
 //$(this).find("div.tabfirstrow_left").removeClass('tabfirstrow_left');//$target.removeClass('error');
$(this).find("label.error").removeClass('error');
 */
/* 
 $next = $target;

while ($next.length) {
    $target = $next;
    $next = $next.children();
}

$target.removeClass('error');
 */
 //$(this).children("input")
 //find("input.error").removeClass('error');

 //}
 /* @@if($('#repeatDiv:hidden')){ 
 //$('#repeatDiv').find("input:text").removeClass('error'); 
 $('div.tabfirstrow_left *').removeAttr('style');
//$(this).find("div.tabfirstrow_left").removeClass('tabfirstrow_left');//$target.removeClass('error');
//$(this).find("label.error").removeClass('error');
}
 */
$(".zipcode_pop").css('display', 'none');
$(".shipping_pop").css('display','none');

	jQuery.validator.addMethod("lettersonly", function(value, element) {
  return this.optional(element) || /^[a-z\s]*$/i.test(value);
}, "Letters only please");

jQuery.validator.addMethod(
  "phone",
  function(phone_number, element) {
   return this.optional(element) || /^\d{2,}$/.test(phone_number.replace(/\s/g, ''));
  },
    "Please enter numbers only"
);

   $.validator.addMethod("loginRegex", function(value, element) {
        return this.optional(element) || /^[A-Z0-9\-]+$/.test(value);
    }, "Username must contain only letters, numbers, or dashes.");

var validator1=$("#userRegis").validate( {
invalidHandler: function(form, validator1) {
			
            var errors = validator1.numberOfInvalids();
			//alert(errors);
            if (errors) {
                $("#error-messageUser").show().text("You missed " + errors + " field(s).");
            } else {
                $("#error-messageUser").hide();
            }
        },
		rules: {
					"fos_user_registration_form[email]":{
					required: true,
					email:true
					},
					"#fos_user_registration_form_first_name":{
					required: true
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
				messages: {
					"fos_user_registration_form[email]": {
					required: "",
					digits:"Enter num",
					},
					"#fos_user_registration_form_first_name": {
					required: "",
					digits:"Enter",
					}
				}
		

} );



var currentUrl=window.location.href;
//alert(currentUrl);
var paymentSuccess="http://localhost/baselogic/web/app_dev.php/paymentSuccess";
var orderCancel="http://localhost/baselogic/web/app_dev.php/paymentCancel";
if (currentUrl==paymentSuccess || currentUrl==orderCancel)
{
$('#tabs').tabs('enable', 4);
var tabs = $('#tabs').tabs('select', 4); 

if (currentUrl==paymentSuccess)
{$('#thanks').html("Thank you for placing an order with us. We have received it. Our staff will contact you in next 24 hours.");
$('#greet').html("Thank you!");
var tabs=$("#tabs").tabs({ 
    disabled: [0,1,2,3]  });//disable third tab.

}
else{
$('#thanks').html("The order was canceled.");
var tabs=$("#tabs").tabs({ 
    disabled: [0,1,2,3]  });//disable third tab.
}

} 
else{

			// validate width height
			var validator=$("#myform").validate({
			
				ignore: '#repeatDiv *',
			
			invalidHandler: function(form, validator) {
			
            var errors1 = validator.numberOfInvalids();
			//alert(errors1);
            if (errors1) {
                $("#error-message").show().text("You missed " + errors1 + " field(s).");
            } else {
                $("#error-message").hide();
            }
        },
	

			
			});
			//validate width height end
			// Add in the delete <a>
// Keep a single clone of the original
/*     main = $('#main');
var clonedField = $('.repeatDiv').clone(), */ 

/* // Add in the delete <a>
$('<a>', {
    text: 'delete', 
    class: 'icon-delete', 
    href: '#',
    click: function(){
        $(this).parent().remove();
        return false;
    }
}).appendTo(clonedField);

// Clone the cloned original and append it back to the list
$('#add-input').click(function() {
    main.append(clonedField.clone());
    return false;
}); */
//---------------------------------------			
					
			//-----------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------		
			
		 var count=1;	
$('#btnClone').on('click', function () {
    var section = $('#repeatDiv').clone().find("input:text").val("").removeClass('error').end().attr({
    style:"display:block", 
   id: function () {
        return 'section' + (count);}
});
	
	
	//if($('#repeatDiv2').attr is style is none then remove class

	
    section.find('#windowHeight').attr('name', function () {
        return 'windowHeight' + (count);
    });
    section.find('#windowWidth').attr('name', function () {
        return 'windowWidth' + (count);
    });
    section.insertAfter('#repeatDiv');
    count++;
/*  // Add in the delete <a>
	$('<a>', {
    text: 'delete', 
    class: 'del', 
    href: '#',
    click: function(){
        $(this).parent().remove();
        return false;
    }
}).appendTo(section);
//-----------------------	 */ 
	
	/* $('<a class="del delete registerlink" href="#">Remove</a>').appendTo(section); */
	
	}); 


 $("body").on('click',".delete", function() {
        $(this).parent().remove().attr('style', 'display:none');
        return false;
    });

			$(".default_popup").css('display','none');
			$(".hirebtn").click(function(){
			
				if ($("#myform").valid()) {
					
					
					
					var url=$('#path').val();
					

					$.loader({className:"blue-with-image-2", content:''});

					var arWidth= new Array();
					var arHeight=new Array();
					$("[id=windowWidth]").each(function(key,value){
						arWidth.push($(this).val());
					})

					$("[id=windowHeight]").each(function(key,value){
						arHeight.push($(this).val());
					})

					jsonWinObj=JSON.stringify(arWidth);
					jsonWinHeightObj=JSON.stringify(arHeight);

					// alert(url);

					//save the width and height in session 
					$.post(url,{

					widthWindow:jsonWinObj,
					HeightWindow:jsonWinHeightObj,

					},function(data){
					//the response is in the data variable
					$('#loadDiv').fadeIn(900, function(){$.loader('close');});


					if(data.responseCode==200 ){   
					 $("#error-message").hide();
					$('#windowMeasurements').html(data.popup);
					$("#s1").dropdownchecklist();
					}
					else if(data.responseCode==400){//bad request
					$('#windowMeasurements').html(data.popup);
					$('#windowMeasurements').css("color","red");
					}
					else{
					//if we got to this point we know that the controller
					//did not return a json_encoded array. We can assume that           
					//an unexpected PHP error occured
					alert("An unexpeded error occured.");

					//if you want to print the error:
					$('#windowMeasurements').html(data);
					}


					});
					$(".default_popup").animate({width: 'show'}, 'slow');
					$(".zipcode_pop").css('display','none');
				}
				else
              validator.focusInvalid();

        return false;
			})


			$(".closeBtn").click(function(){
			$(".default_popup").css('display', 'none');
			})




			$(".zipcode_pop").css('display','none');
			$(".contibtn").click(function(){

			$(".zipcode_pop").animate({width: 'show'}, 'slow');
			$(".default_popup").css('display','none');
			})

			$(".closeBtn").click(function(){
			$(".zipcode_pop").css('display', 'none');
			})
			
			var validator=$("#zipcodeForm").validate({
			
			invalidHandler: function(form, validator) {
			
            var errorsZip = validator.numberOfInvalids();
			//alert(errors);
            if (errorsZip) {
                $("#error-messageZip").show().text("Zipcode can contain only capital letters and numbers");
            } else {
                $("#error-messageZip").hide();
            }
        },
			
				rules: {
					"zip":{
					required: true,
					loginRegex:true,
						}
					},
				messages: {
					"zip": {
					required:"Enter zipcode please.",
					}
				}
				
			
			});
			
			
			
			
			$("#btnNext").click(function(){
			//alert("click");
			
			if ($("#zipcodeForm").valid()) {
			//alert("valid");
			
			var zipcode=$('#zip').val();

			var saveZipcode=$('#zipcod').val();


			var code=JSON.stringify(zipcode);
			//---------------code to save zipcode in session and retrieve manufacturers based on quote 
			$.post(saveZipcode,{

			zipcode:code, 

			},function(data){
			//the response is in the data variable


			if(data.responseCode==200 ){  
			 $("#error-messageZip").hide();
			 //enable tab2 
			 $('#tabs').tabs('enable', 1);
			 //select
			 var tabs = $('#tabs').tabs();
        var c = $('#tabs').tabs("length");
        currentTab = 1;
        tabs.tabs('select', currentTab);
			 // then display
			$('#tabs-2').html(data.display);
			$("#s2").dropdownchecklist();
			}
			else if(data.responseCode==400){//bad request
			//$('#disp').html(data.greeting);
			// alert(data.display);

			}
			else{
			//if we got to this point we know that the controller
			//did not return a json_encoded array. We can assume that           
			//an unexpected PHP error occured
			alert("An unexpeded error occured.");

			//if you want to print the error:
			//alert(data.display);
			}

			});
			//-------------------------------------------end

}//end valid
else
{
              validator.focusInvalid();
			  return false;}
//alert("after valid");
			$(".zipcode_pop").css('display', 'none');
			})

			$(".userReg").css('display', 'none');


			$(".shipping_pop").css('display','none');
			
			$(".editlink").click(function(){
			$(".shipping_pop").animate({width: 'show'}, 'slow');
			})

			$(".closeBtn").click(function(){			
			$(".shipping_pop").css('display', 'none');
			})

			$(".closeBtn").click(function(){			
			$(".userReg").css('display', 'none');
			})
			$(".default_popup").animate({width: 'show'}, 'slow');	
	
	
	}
	//$(".userReg").animate({width: 'show'}, 'slow');
})