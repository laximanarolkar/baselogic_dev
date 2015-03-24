
function applyToPopup()
{
	var style=$('#editstyle').val();
	var material=$('#editmaterial').val();
	var frame=$('#editframe').val();
	var option=$('#editoption').val();

	//-------get checked windows
	var checkboxes = document.getElementsByName('s2');
	var vals = "";
	for (var i=0, n=checkboxes.length;i<n;i++) 
	{
		if (checkboxes[i].checked) 
		vals += ","+checkboxes[i].value;
	}
	//-----end
	
	//Remove ending comma from array of checked checkboxes
	var trimWin = vals.replace(/(^,)|(,$)/g, "");
	
	var defaultConfig=document.getElementById('default').value;
	var arrayWindow = trimWin.split(',');
	var str=style+","+material+","+frame+","+option;
	var strDisp="-"+style+"-"+"("+option+")";

	$.each(arrayWindow, function(index, value) 
	{
		document.getElementById(value).value = str;
		document.getElementById("config"+value).innerHTML = strDisp;
		if(str!=defaultConfig)
		$("#remove"+value).show();
	});

} 

function removeClick(id)
{
	var defaultConfig=document.getElementById('default').value;
	
	var removeId=id;
	var thenumId = removeId.replace(/^.*(\d+).*$/i,'$1');

	document.getElementById("config"+thenumId).innerHTML = "-picture-(flat)";
	document.getElementById(thenumId).value = defaultConfig;
	$("#remove"+thenumId).hide();
	
}


function conigurationEditPopup()
{
	$(".configPopup").animate({width: 'show'}, 'slow');
	//var defaultConfig=document.getElementById('default').value;
	var inputTags = document.getElementsByTagName('input');
	var checkboxCount = 0;
	for (var i=0, length = inputTags.length; i<length; i++)
	{
		if (inputTags[i].type == 'checkbox') 
		{
			checkboxCount++;
		}
	}

	for(var i=1;i<=checkboxCount;i++)
	{
		var configUser=document.getElementById(i).value;
		var configDefault=document.getElementById('default').value;
		if(configUser!=configDefault)
		$("#remove"+i).show();
	}

}


function closeConfigurationEdit()
{
	$(".configPopup").css('display', 'none');
}

function saveChanges()
{
	var inputTags = document.getElementsByTagName('input');
	var checkboxCount = 0;
	
	$.loader({className:"blue-with-image-2", content:''});
	
	for (var i=0, length = inputTags.length; i<length; i++) 
	{
		 if (inputTags[i].type == 'checkbox') 
		 {
			 checkboxCount++;
		 }
	}

	var eachWinConfig = new Array();
	for(var i=1;i<=checkboxCount;i++)
	{
		eachWinConfig.push(document.getElementById(i).value);
	}

	var winConfigSet=JSON.stringify(eachWinConfig);

	var path=$('#path2').val();

	$.post(path,{
	configurationFinal:winConfigSet
	},function(data){
		if(data.responseCode==200 )
		{  
		
			$('#disp').html(data.display);
			updateQuotes();
		}
		else
		{
			//did not return a json_encoded array. An unexpected PHP error occured        
			alert("An unexpeded error occured.");
		}

	});		
			
}

function updateQuotes()
{
	var tabs = $('#tabs').tabs();
	var saveZipcode=$('#zipcod').val();

	$.post(saveZipcode,{
	},function(data){
		if(data.responseCode==200 )
		{  
			$('#loadDiv').fadeIn(900, function(){$.loader('close');});
			$('#tabs').tabs('enable', 1)
			
			$('#tabs-2').html(data.display);
			
			$("#accordion").append(data).accordion();
			
		}
		else
		{
		//did not return a json_encoded array. An unexpected PHP error occured        
		alert("An unexpeded error occured.");
		}

	});
}


function showWindow(id,view)
{
	if(document.getElementById(view).innerHTML=='[+]')
	{
		document.getElementById(id).style.display = 'block';
		document.getElementById(view).innerHTML ='[-]';
	}else
	{
		document.getElementById(id).style.display = 'none';
		document.getElementById(view).innerHTML='[+]';
	}

}


function toggle(clsname,id) 
{
//alert(window.location.href);

 /*  tr=document.getElementsByTagName('tr')

   for (i=0;i<tr.length;i++)
   { 
	   if (tr[i].className == thisname)
	   {
		 if ( tr[i].style.display=='none')
		 { 
			tr[i].style.display = '';
			document.getElementById(id).innerHTML = 'Less';
		 }
		else 
		{
			tr[i].style.display = 'none';
			document.getElementById(id).innerHTML = 'More';
		}
	  }
   }*/
   
  // 	var moreBtn=document.getElementById('more');

//var trs = document.getElementsByClassName('yes');
var downbtn = document.getElementById('down').value;
var upbtn = document.getElementById('up').value;
var trs=document.getElementsByTagName('tr');

  for(var i=0;i<trs.length;i++)
{ 
	   if (trs[i].className == 'yes')
	   {
		 if ( trs[i].style.display=='none')
		 { 
			trs[i].style.display = '';
			//document.getElementById('more').innerHTML = 'Less';
			document.getElementById('more').src = upbtn;
			document.getElementById('more').title = 'Less';
		 }
		else 
		{
			trs[i].style.display = 'none';
			//document.getElementById('more').innerHTML = 'More';
			document.getElementById('more').src = downbtn;
			//document.getElementById('more').title = 'More';
			document.getElementById('more').title = 'View more manufacturers';
		}
	  }

} 
		   
}


function toggleWindowMore(thisname,id,windowNo) 
{

	var moreBtn=document.getElementById('moreWin'+windowNo);


var elements = document.getElementsByClassName("show"+windowNo);

  for(var i=0;i<elements.length;i++)
{
	
	
	   if (moreBtn.className == thisname)
	   {
		 if ( elements[i].style.display=='none')
		 { 
			elements[i].style.display = '';
			document.getElementById('moreWin'+windowNo).innerHTML = 'Less';
		 }
		else 
		{
			elements[i].style.display = 'none';
			document.getElementById('moreWin'+windowNo).innerHTML = 'View more manufacturers';
		}
	  }

}  
 
}
				

function addToCart()
{

	if (!$("input[name='manufacturer']").is(':checked')) 
	{
		$(document).scrollTop(0);
		 $("#selectMessageManuf").show().text("Please select manufacturer.");
	}
	else 
	{
		$("#selectMessageManuf").hide();
		$("#checkDisplayType").val("manufacturer");//to check the type of display to handle shipping popup's next
		var myRadio = jQuery("input[name=manufacturer]");
		var selectedRadio = myRadio.filter(":checked");
		var manufact= selectedRadio.val();
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
			},function(data)
			{
			$('#tabs').tabs('enable', 2);
			if(data.responseCode==200 )
			{ 
				//-----next tab
				var tabs = $('#tabs').tabs();
				var c = $('#tabs').tabs("length");
				currentTab = 2;
				tabs.tabs('select', currentTab);   
				$("#btnPrevious").show();
			   //----end next tab
					  
				 $('#tabs-3').html(data.display);
			}
			   
			else
			{
				alert("An unexpeded error occured.");
			}		  
       });
	} 
	
}



function addToCartWindoWise(winNum)
{


var manufact1= new Array();
var manufact2= new Array();

/* foreach ($_POST['attending'] as $id => $value) {  
        if ($value == 0) {
            echo 'You need to vote for all entries'; 
            exit; 
        }  
    }   */
    //echo "success!";  

var flag=1;
for(var i=1;i<=winNum;i++)
		{
			if (!$("input[name='manufacturer"+i+"']").is(':checked')) 
			{
			   //alert('Nothing is checked! Pls select manufacturer for window'+i);
			   flag=0;
			}
			else 
			{
				//alert('One of the radio buttons is checked!');
				flag=1
			}
		
		}
if (flag==0) 
	{
		$(document).scrollTop(0);
		 $("#selectMessageManuf").show().text("Please select manufacturer.");
	}
	else 
	{
	$("#selectMessageManuf").hide();
		for(var i=1;i<=winNum;i++)
		{
			
			$("#checkDisplayType").val("window");//to check the type of display to handle shipping popup's next
						var myRadio = jQuery("input[name='manufacturer"+i+"']");
						var selectedRadio = myRadio.filter(":checked");
						var value=selectedRadio.val();
						manufact=value.split(" ");
						manufact1.push(manufact[0]);
						manufact2.push(manufact[1]);

			}
			
			 var winManuf=JSON.stringify(manufact1);
					 var winPrice=JSON.stringify(manufact2);
			
			var cartUrlWindow=$('#cartUrlWindow').val();

			//Call ajax to save manufacturer and window details in session
			$.post(cartUrlWindow,{
				manufacturer:winManuf,
				price:winPrice,
				},function(data)
				{
				$('#tabs').tabs('enable', 2);
				if(data.responseCode==200 )
				{ 
					//-----next tab
					var tabs = $('#tabs').tabs();
					var c = $('#tabs').tabs("length");
					currentTab = 2;
					tabs.tabs('select', currentTab);   
				   //----end next tab
						  
					 $('#tabs-3').html(data.display);
				}
				   
				else
				{
					alert("An unexpeded error occured.");
				}		  
		   });
		
	}
}



function shippingPopup()
{
	$(".shipping_pop").animate({width: 'show'}, 'slow');
	var tabs = $('#tabs').tabs();
	currentTab = 3;
	tabs.tabs('select', currentTab);
}

function editZipcodePopup() //new
{
$(".default_popup_two").css('display', 'block');

var openZipcodeEditPath=$('#changeZipcode').val();

 //Call ajax to save new changed zipcode in session 
	 	$.post(openZipcodeEditPath,{
			//shippingType:shType,
			
			},function(data)
			{
				if(data.responseCode==200 )
				{  
					//$('#windowMeasurements').html("");
					//alert(data.popup);
					$('#windowMeasurements_two').html(data.popup);
					//alert(data.popup);
				}
				else
				{
					alert("An unexpeded error occured.");
				}
			});  
//$(".zip_popup").animate({width: 'show'}, 'slow');
	
}

function closeZipcodeChange()
{
	$(".default_popup_two").css('display', 'none');
}

/* function editZipcodeNextBtn()
{
	if($("#checkDisplayType").val()=="manufacturer")
	confirmOrderEditZip();
	else
	confirmOrderWindowwiseEditZip();
}
 */
function editZipcodeNextBtn() {
var validator=$("#zipcodeFormEdit").validate({	
		rules: 
		{
			"zip_new":{
			required: true,
			loginRegex:true,
			}
		},
		messages:
		{
			"zip_new": {
			required:"Enter zipcode please.",
			loginRegex: "Zipcode should contain only capital letters,numbers or dashes"
			}
		},
		
	});
	
	if ($("#zipcodeFormEdit").valid()) {
	shippingNextBtn();
	}
	else {
		 validator.focusInvalid();
		return false;
	}

}



function shippingNextBtn()
{

	if($("#checkDisplayType").val()=="manufacturer")
	confirmOrder();
	else
	confirmOrderWindowwise();

}

function userRegistration()
{
	$(".userReg").animate({width: 'show'}, 'slow');
	var user = document.getElementById('fos_user_registration_form_email');
	user.focus();
}


function confirmOrder()
{
	$("#selectMessageShipping").hide();
	var checkbox = $("input[name=shippingType]:checked");
	
	var zipcodeNew = $("#zip_new").val();
	var zipNew=JSON.stringify(zipcodeNew);
	
	if( checkbox .length > 0 ) 
	{
		var tab=document.getElementById('tabId').value;
		var pathOrder=$('#confirmOrd').val();
		var shipType=$("input[name=shippingType]:checked").val();
		var shType=JSON.stringify(shipType);

	  //Call ajax to save shipping type and load confirm order tab
		$.post(pathOrder,{
			shippingType:shType,
			changedZipcode:zipNew
			},function(data)
			{
				$('#tabs').tabs('enable', 3);
				if(data.responseCode==200 )
				{  
					if(tab=='tab-3')
					{
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
					$(".default_popup_two").css('display', 'none');
				}
				else
				{
					alert("An unexpeded error occured.");
				}
			}); 
    } 
	else 
	$("#selectMessageShipping").show().text("Please select shipping type.");

}

//Comfirm order for window wise selection of manufacturers
function confirmOrderWindowwise()
{
	$("#selectMessageShipping").hide();
	var checkbox = $("input[name=shippingType]:checked");
	
	var zipcodeNew = $("#zip_new").val();
	var zipNew=JSON.stringify(zipcodeNew);
    
	if( checkbox .length > 0 ) 
	{
		var tab=document.getElementById('tabId').value;
		var pathOrder=$('#confirmOrdWindow').val();
		var shipType=$("input[name=shippingType]:checked").val();
		var shType=JSON.stringify(shipType);

	  //Call ajax to save shipping type and load confirm order tab
		$.post(pathOrder,{
			shippingType:shType,
			changedZipcode:zipNew
			},function(data)
			{
				$('#tabs').tabs('enable', 3);
				if(data.responseCode==200 )
				{  
					if(tab=='tab-3')
					{
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
					$(".default_popup_two").css('display', 'none');
				}
				else
				{
					alert("An unexpeded error occured.");
				}
			}); 
    } 
	else 
	$("#selectMessageShipping").show().text("Please select shipping type.");

}



function autopopulateUserReg()
{
	var autoUrl=$('#autopopulateReg').val();
	var mail=$('#fos_user_registration_form_email').val();
	var userMail=JSON.stringify(mail);
 
	//Call ajax to autopopulate user registration form
	$.post(autoUrl,{
			email:userMail,
			},function(data)
			{
				if(data.responseCode==200 )
				{  
					$('#fos_user_registration_form_first_name').val(data.fname);
					$('#fos_user_registration_form_last_name').val(data.lname);
					$('#fos_user_registration_form_address').val(data.address);
					$('#fos_user_registration_form_phone').val(data.phone);   
				}
				else
				{
					alert("An unexpeded error occured.");
				}
       }); 
}

function zipcodeNextClick()
{
	var style=$('#style').val();
	var material=$('#material').val();
	var frame=$('#frame').val();
	var option=$('#option').val();

	var winStyle=JSON.stringify(style);
	var winMaterial=JSON.stringify(material);
	var winFrame=JSON.stringify(frame);
	var winOption=JSON.stringify(option);
 
	var validator=$("#zipcodeForm").validate({	
		 /* invalidHandler: function(form, validator) 
		{		
			var errorsZip = validator.numberOfInvalids();
			
			if (errorsZip)
			{
				$("#error-messageZip").show().text("Zipcode1 can contain only capital letters and numbers");
			} 
			else 
			{
				$("#error-messageZip").hide();
			}
		},  */
		
		rules: 
		{
			"zip":{
			required: true,
			loginRegex:true,
			}
		},
		messages:
		{
			"zip": {
			required:"Enter zipcode please.",
			loginRegex: "Zipcode should contain only capital letters,numbers or dashes"
			}
		},
		
	});

	if ($("#zipcodeForm").valid()) 
	{
		var zipcode=$('#zip').val();
		var saveZipcode=$('#zipcod').val();
		var code=JSON.stringify(zipcode);
		
		$.loader({className:"blue-with-image-2", content:''});
		//alert(saveZipcode);
		//Code to save zipcode in session and retrieve manufacturers based on quote 
		$.post(saveZipcode,{
				zipcode:code, 
				},function(data)
				{ 
					if(data.responseCode==200 )
					{  
						$("#error-messageZip").hide();
						
						$('#loadDiv').fadeIn(900, function(){$.loader('close');});
						
						//enable tab2 
						$('#tabs').tabs('enable', 1);
						//$("#accordion").append(data).accordion();
						//select tab
						var tabs = $('#tabs').tabs();
						var c = $('#tabs').tabs("length");
						currentTab = 1;
						tabs.tabs('select', currentTab);
						// then display
						$('#tabs-2').html(data.display);
						$(".default_popup").css('display', 'none'); //To close zip code popup on back 
						//var data1="tab";
						  //$("#accordion").append(data).accordion();
						 // $("#accordion").append(data).accordion('destroy').accordion();
						 $("#accordion").append(data).accordion();
							//setTimeout('$("#accordion").accordion({collapsible: true, clearStyle: true, autoHeight: true })', 1000);
					}
					else
					{
						alert("An unexpeded error occured.");
					}

			}); 
			//end code to save zipcode in session and retrieve manufacturers based on quote 

	}//end valid
	else
	{
	  validator.focusInvalid();
	  return false;
	}
	//$(".zipcode_pop").css('display', 'none');
}

function closeZipcode()
{
	$(".default_popup").css('display', 'none');
}


$(document).ready(function()
{  
	$(".zipcode_pop").css('display', 'none');
	$(".shipping_pop").css('display','none');
	$(".editlink").click(function(){
				$(".shipping_pop").animate({width: 'show'}, 'slow');
				})

	jQuery.validator.addMethod("lettersonly", function(value, element) {
	return this.optional(element) || /^[a-z\s]*$/i.test(value);
	}, "Letters only please");

	jQuery.validator.addMethod("phone",function(phone_number, element) {
	return this.optional(element) || /^\d{2,}$/.test(phone_number.replace(/\s/g, ''));
	},"Please enter numbers only");

	$.validator.addMethod("loginRegex", function(value, element) {
	return this.optional(element) || /^[A-Z0-9\-]+$/.test(value);
	}, "Username must contain only letters, numbers, or dashes.");

	$(function() {
	//alert("hii");
	//var validator1=$("#userRegis").validate({
	$("#userRegis").validate({
	
		/* invalidHandler: function(form, validator1) 
		{
			var errors = validator1.numberOfInvalids();
			if (errors) 
			{
					$("#error-messageUser").show().text("You missed " + errors + " field(s).");
			}
			else 
			{
				$("#error-messageUser").hide();
			}
		}, */
		rules: 
		{
			"fos_user_registration_form[email]":{
			required: true,
			email:true
			},
			"fos_user_registration_form[first_name]":{
			lettersonly: true,
			
			},
			"fos_user_registration_form[phone]":{
			digits:true,
			minlength : 10
			},
			"fos_user_registration_form[last_name]":{
			lettersonly: true,
			required: true
			},
			"fos_user_registration_form[password]" : {
			minlength : 5
			},
			"fos_user_registration_form[plain_password]" : {
			minlength : 5,
			equalTo : "#fos_user_registration_form_password"
			}
		},
		messages: 
		{
			/* "fos_user_registration_form[email]": "Please enter email address" */
			/* required: "Enter mail",
			email: "Enter mail valid" } */
			"fos_user_registration_form[email]" : {
				required: "Please enter email",
				},
			"fos_user_registration_form[first_name]" : {
				required: "Please enter first name",
				},
			"fos_user_registration_form[phone]" : {
				required: "Please enter contact number",
				minlength:"Please enter at least 10 digits."
				},
			"fos_user_registration_form[last_name]" : {
				required: "Please enter last name",
				},
			"fos_user_registration_form[address]" : {
				required: "Please enter address",
				},
			"fos_user_registration_form[password]" : {
				required: "Please enter password",
			},
			"fos_user_registration_form[plain_password]" : {
				required: "Please enter password again",
				equalTo: "Password not matching"
			}
			
		},

		submitHandler: function(form) {
            form.submit();
        }	

		});
	});

	var currentUrl=window.location.href;
	
	if (currentUrl.indexOf('paymentSuccess') >= 0 || currentUrl.indexOf('paymentCancel') >= 0)
	{
		$('#tabs').tabs('enable', 4);
		var tabs = $('#tabs').tabs('select', 4); 

		if (currentUrl.indexOf('paymentSuccess') >=0 )
		{
			$('#thanks').html("Thank you for placing an order with us. We have received it. Our staff will contact you in next 24 hours.");
			$('#greet').html("Thank you!");
			var tabs=$("#tabs").tabs({ 
			disabled: [0,1,2,3]  });//disable tabs.
		}
		else
		{
			$('#thanks').html("The order was canceled.");
			var tabs=$("#tabs").tabs({ 
			disabled: [0,1,2,3]  });//disable tabs.
		}

	} 
	else
	{
		// validate width height
		var validator=$("#myform").validate({
			ignore:[],
			messages:{
			windowHeight : {
				required: "Please enter the height",
				lettersonly: "Please enter only digits"},
			windowWidth : {
				required: "Please enter the width",
				lettersonly: "Please enter only digits"}
			}, 
			
			showErrors: function(errorMap, errorList) {
				//$("#error-message").html("All fields must be completed before you submit the form.");
				 if(errorList.length) {
					$("#error-message").html(errorList[0].message);
					//errorList[0].attr('border:1px solid red;');
				} 
				
			},
			invalidHandler: function(form, validator) 
			{							
				var errors1 = validator.numberOfInvalids();
				
				if (errors1) 
				{
					$("#error-message").show().text("You missed " + errors1 + " field(s).");
				} else 
				{
					$("#error-message").hide();
				}
			},
		});
		
		
		var totalDiv =$(".tabfirstrow div").length; 
		//alert(totalDiv + "ss");
		//if(totalDiv==7)
		if(totalDiv==9)
		$(".delete").css("display", "none"); 
		var count=1;	
		
		$('#btnClone').on('click', function () {
			$(".delete").css("display", "block"); 

			var section = $('#repeatDiv').clone().find("input:text").val("").removeClass('error').addClass('required').end().attr({
				style:"display:block", 
				id: function () {
				return 'section' + (count);}
			});

			/* section.find('#windowHeight').attr('name', function () {
				return 'windowHeight' + (count);
			}); */
			
			/* section.find('#windowHeight').attr('id', function () {
				return 'windowHeight' + (count);
			}); */
			
			section.find('#windowHeight').attr('id', function () {
				return 'windowHeight' + (count);
			});
			
			section.find('#windowWidth').attr('id', function () {
				return 'windowWidth' + (count);
			});
			
			section.insertAfter('#repeatDiv');
			count++;
		}); 


		$("body").on('click',".delete", function() {
			totalDiv=$(".tabfirstrow div").length;
			//alert( totalDiv+"tt");
			//if(totalDiv==10)
			if(totalDiv==12)
			{
				$(".delete").css("display", "none");
				$(this).parent().remove();
				return false;
			}
			else
			{
				$(this).parent().remove();
				return false;
			}
		});

		$(".default_popup").css('display','none');
		$(".hirebtn").click(function(){
		
					if ($("#myform").valid()) {
						
						var url=$('#path').val();
						//alert(url);
						
						$.loader({className:"blue-with-image-2", content:''});

						var arWidth= new Array();
						var arHeight=new Array();
						$("[name=windowWidth]").each(function(key,value){
							if($(this).val()!="")
							arWidth.push($(this).val());
						})


						$("[name=windowHeight]").each(function(key,value){
							if($(this).val()!="")
							arHeight.push($(this).val());
						})

						jsonWinObj=JSON.stringify(arWidth);
						jsonWinHeightObj=JSON.stringify(arHeight);
					

						//save the WIDTH and HEIGHT in session 
						$.post(url,{

						widthWindow:jsonWinObj,
						HeightWindow:jsonWinHeightObj,

						},function(data){
					
						$('#loadDiv').fadeIn(900, function(){$.loader('close');});

						if(data.responseCode==200 ){   
						 $("#error-message").hide();
						$('#windowMeasurements').html(data.popup);
						$("#zip").focus();
					
						}
						else if(data.responseCode==400){//bad request
						$('#windowMeasurements').html(data.popup);
						$('#windowMeasurements').css("color","red");
						}
						else{
						alert("An unexpeded error occured.");
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
					
			
				$(".default_popup").css('display','none');
				})

				$(".closeBtn").click(function(){
				$(".zipcode_pop").css('display', 'none');
				})

				$(".userReg").css('display', 'none');

				$(".shipping_pop").css('display','none');
				
				

				$(".closeBtn").click(function(){			
				$(".shipping_pop").css('display', 'none');
				})

				$(".closeBtn").click(function(){			
				$(".userReg").css('display', 'none');
				})
				$(".default_popup").animate({width: 'show'}, 'slow');						
			
	}

})