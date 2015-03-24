<!-- src/Acme/BlogBundle/Resources/views/Blog/index.html.twig.-->
<?php $view->extend('::layout.html.php') ?>
<?php //$view->extend('::layout.html.php') ?>
<link rel="stylesheet" href="http://jquery.bassistance.de/validate/demo/site-demos.css">

<script src="http://jquery.bassistance.de/validate/jquery.validate.js"></script>
<script src="http://jquery.bassistance.de/validate/additional-methods.js"></script>

<script type="text/javascript">
jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
});

$( "#myform" ).validate({
  rules: {
    windowWidth: {
      required: true,
      number: true
    }
  }
});
</script>
<script>
$(document).ready(function(){
	$(".shipping_pop").css('display','none');
	$(".zipcode_pop").css('display', 'none');
	
	$("input:text:visible:first").focus();
	
	
});
</script>

<?php $view['slots']->start('body') ?>

<!--facebook-->
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
	var topaypal=$('#toPaypal').val();
      // Logged into your app and Facebook.
	  	window.location = topaypal;
		logoutUser();
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
     // document.getElementById('status').innerHTML = 'Please log ' +
      document.getElementById('status').innerHTML = 'Sign in' +
        ' with Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  
  
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1480084228939424',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.1' // use version 2.1
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }
  
  function logoutUser() {    
    FB.logout(
        function(response) {
//Pass control to function in php where you can destroy your session and cookies.
// windows.location=PHP function
        }
    ); 
	}
</script>

<!--facebook-->
<!--Twitter login-->
<script type="text/javascript">

twttr.anywhere(function (T) {
T("#login").connectButton();
});

</script>
<!--Twitter login-->
<div id="middle">
<!--tweeter-->
<!--script type="text/javascript" async src="//platform.twitter.com/widgets.js"></script>
<a href="https://twitter.com/intent/tweet?in_reply_to=53202045288714240">Reply</a>
<a href="https://twitter.com/intent/retweet?tweet_id=53202045288714240">Retweet</a>
<a href="https://twitter.com/intent/signin?tweet_id=53202045288714240">Favorite</a-->
<!--tweeter-->
<!--<span id="login"></span>-->
<!--a href="<?php //echo $view['router']->generate('_twitter_login')?>"><img src="https://g.twimg.com/dev/sites/default/files/images_documentation/sign-in-with-twitter-gray.png" alt="Sign in with Twitter" title="Sign in with Twitter" style="cursor:pointer;"></a-->

    <div class="container">
	<h2><a href="<?php echo $view['router']->generate('_get_started')?>">Get Started</a></h2>		<div id="tabs">
			<ul>
			  <li><a href="#tabs-1">Window Measurements</a></li>
			  <li><a href="#tabs-2">Quotes</a></li>
			  <li><a href="#tabs-3">Your Cart</a></li>
			  <li><a href="#tabs-4">Confirm Order</a></li>
			  <li><a href="#tabs-5">Payment</a></li>
			</ul>
			<div id="tabs-1">
				<div class="tabbongcontent">
					<div class="tabfirst">
					<!--====================== -->
					<div id="error-message"></div>
						<form id="myform"  method="POST">
							<div class="tabfirstbox">
								<h4>Please provide your window measurements</h4>
								<div class="tabfirstrow" style="width:478px"><!--width:680px-->  
								
									<div id="repeatDiv" class="tabfirstrepeat" name="cloneDiv" style="display:none">		<!--child repeatdiv-->
										<div class="tabfirstrow_left">
											<label>Width</label>
											<input class="smallinpt rounded inseshadow  digits " type="text" id="windowWidth" name="windowWidth" />
											<span>Inches</span>
										</div>
										<div class="tabfirstrow_right">
											<label>Height</label>
											<input class="smallinpt rounded inseshadow  digits " type="text" id="windowHeight" name="windowHeight" />
											<span>Inches</span>
										</div><a class="del delete registerlink" href="#" style="display:block;padding-right:20px;">Remove</a> 
									</div>
									<!--extra div-->
									<div id="repeatDiv2" class="tabfirstrepeat" name="cloneDiv"><!--child repeatdiv-->
										<div class="tabfirstrow_left">
										  <label>Width</label>
										  <input class="smallinpt rounded inseshadow required digits" type="text" id="windowWidth" name="windowWidth" />
										  <span>Inches</span>
										</div>
										<div class="tabfirstrow_right">
										  <label>Height</label>
										  <input class="smallinpt rounded inseshadow required digits" type="text" id="windowHeight" name="windowHeight" />
										  <span>Inches</span>
										</div><a class="del delete registerlink" href="#" style="display:block">Remove</a>
									</div>
									
									<!--extra div end-->
									<div id="repeatDiv2" class="tabfirstrepeat" name="cloneDiv"></div>
									
									<!--<div class="add_section2"><p style="float:right;"><a id="validBtn"class="loginbtn rounded hirebtn" >Next</a></p></div>-->
								</div>
								
								<div class="add_section"><a id="btnClone" class="registerlink" style="clear:both; padding-right:54px;"><!--padding-right:24px;-->Add More</a></div> 
								<div class="add_section2"><p style="float:left;"><a id="validBtn"class="loginbtn rounded hirebtn" >Next</a></p></div>
								
								<!----div class="add_section2" style="margin-top:-59px;padding-right:80px;"><p style="float:right;"><a id="validBtn"class="loginbtn rounded hirebtn" >Next</a></p></div--->
								<!--<div class="tabfirstrepbtn"><a id="btnClone" class="registerlink">Add More</a></div>
								<br><br>
								<br><br>
								<p style="float:right; padding-right:40px;"><a id="validBtn"class="loginbtn rounded hirebtn" >Next</a></p>-->
							</div>
						<!--====================== -->
						  <h3>Measuring for your windows</h3>
						  <img src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/images/window.jpg')?>" align="right" alt="" style="margin-left:10px;" />
						  <p>Taking accurate measurement of your window poenings is the vital firest step in successfully buying  replacement windows. You will take theree measurements each of the width (at the top, middle and bottom) and of the height (at the left, center and right) using the smallest results as your replacement window  dimensions. If the three measurements for either dimension differ greatly, the opening may not be square.
						  </p>
						  <h3>Width</h3>
						  <p>The width is given first when reading replacement window dimensions. Measure the width between the inner jambs as shown. Be sure to measure the existing window’s frame at its widest points, rather than the narrower distance between inside trim piecces.
						  </p>
						  <h3>Height</h3>
						  <p>For the height, you will measure from the point where the inside sill meets the outside sill stool, up to where the header meets the inside stop (head) at the top of the frame.
						  </p>
						
							<input type="hidden" id="path" value="<?php echo $view['router']->generate('_add_window')?>" >
							<input type="hidden" id="path2" value="<?php echo $view['router']->generate('_save_window_style')?>" >
							<input type="hidden" id="zipcod" value="<?php echo $view['router']->generate('_save_zipcode')?>" >
							<input type="hidden" id="cartUrl" value="<?php echo $view['router']->generate('_add_to_cart')?>" >
							<input type="hidden" id="cartUrlWindow" value="<?php echo $view['router']->generate('_add_to_cart_window_wise')?>" >
							<input type="hidden" id="confirmOrd" value="<?php echo $view['router']->generate('_confirm_order')?>" >
							<input type="hidden" id="confirmOrdWindow" value="<?php echo $view['router']->generate('_confirm_order_window_wise')?>" >
							<input type="hidden" id="autopopulateReg" value="<?php echo $view['router']->generate('_autopopulate_user_reg')?>" >
							<input type="hidden" id="checkDisplayType" value="" >
							<input type="hidden" id="changeZipcode" value="<?php echo $view['router']->generate('_zip_popup')?>" >
							<div id="loadDiv"></div>
							<div class="clear"></div>
							
							<!--<p><a id="validBtn"class="loginbtn rounded hirebtn" >Next</a></p>-->
						</form>
						   
						  <!-- default_popup-configuration start -->
						 <div class="default_popup" id="windowMeasurements">
						  </div>	
						  <!-- default_popup end -->
						  
						  <!-- zipcode_pop start -->
						  <div class="zipcode_pop"id="zipcode_pop">
							
						  </div>
						  <!-- zipcode_pop end -->
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div id="tabs-2">
			<!--Display of top three quotes and edit configuration -->
				<!--<div id="accordion">
				</div>-->
			</div>
			<div id="tabs-3">
			  <!-- cart-->
			</div>
			<!-- shipping_pop start -->
			<div class="shipping_pop">
				<div class="popupGrayBg"></div>
				<div class="QTPopupCntnr_zipcode_popup_ship">
					<div class="mainpopup">
					<!--<div id="error-messageShip"style="color:solid red"></div>-->
					  <!--<div class="zipcodepop"> <a class="closeBtn">Close</a>-->
					  <div class="zipcodepop"> <a class="closeBtn">X</a>
					  <div id="selectMessageShipping" style="display:none;color:#D63333"></div><br>
						<h4>Shipping type</h4>
						<p>Please select your shipping type</p>
						<p></p>
						<p>
						  <input type="radio" name="shippingType" value="Install"/>
						  &nbsp; Install &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  <input type="radio" name="shippingType" value="Pickup"/>
						  &nbsp; Pickup 
						</p>
						<p>&nbsp;</p>
						<p><a href="#" id="btnNextship" class="loginbtn rounded" onclick="shippingNextBtn()">Next</a></p>
						<input type="hidden" id="tabId" value="tab-3" >
					  </div>
					</div>
				</div>
			</div>
			<!-- shipping_pop end -->
			<!--user registration-->
			<div class="userReg" style="display:none" >
				<div class="popupGrayBg"></div>
				<div class="QTPopupCntnr">
					<div class="mainpopup">						
						<div class="zipcodepop"> <a class="closeBtn">X</a>
						<input type="hidden" value="<?php echo $view['router']->generate('_paypal')?>" id="toPaypal">
						
						<!--Sign in-->
						<div style="height:120px;"> <!--class="main_loginbox"-->
							<div id="invalid_login" style="height:25px;color:#D63333"></div>
								<form action="<?php echo ""; /* echo "http://localhost/baselogic_phpdemo/web/app_dev.php/login_check"; */ // echo $view['router']->generate('fos_user_security_check'); ?>" method="post">
									<!--input type="hidden" name="_csrf_token" value=" <?php //echo $view['router']->generate('get_token'); ?>" /-->
									<div class="row">
										<label class="register_content_label" >Email</label>
										<input type="text" class="register_input_dealer rounded inseshadow"  id="username_cust"   />
									</div>
									<div class="row">
										<label class="register_content_label">Password</label>
										<input type="password" class="register_input_dealer rounded inseshadow"  id="password_cust"   />
									</div>
									<input type="hidden" id="signInPath" value="<?php echo $view['router']->generate('customer_login_check')?>" ><!--for ajax sign in fos_user_security_check-->
									<!--<input  type="submit" class="login_btn" value="Sign in" onclick="signIn()" /> -- id="_submit" name="_submit""-->
									<a  class="registerBtnUser" onclick="signIn()">Log in </a> <!-- id="_submit" name="_submit""--><!--login_btn-->
								</form>
							</div>
							<span style="padding-left:21px;"></span>
							<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
							</fb:login-button>
							<!--<div id="status"></div>-->
							<hr>
						<!--Sign in-->
							<div id="fos_user_registration_form">
								<h4>Create an Account</h4>
								<div id="error-messageUser" style="color:solid red"></div>
								<form action="<?php echo $view['router']->generate('user_registration')?>" method="POST" style="margin-top:0px;" class="fos_user_registration_register register_content" id="userRegis" >
									<div class="row"><?php echo $view['form']->widget($form['_token']) ?></div>
									<?php echo $view['form']->errors($form) ?>

									<div class="row">
										<label class="register_content_label" >Email</label>
										<?php echo $view['form']->errors($form['email']) ?>
										<?php echo $view['form']->widget($form['email'],array('attr'=> array('onblur'=>'autopopulateUserReg()','class'=>'register_input_dealer rounded inseshadow required') , 'required'=>false)) ?>
									</div>

									<div class="row">
										<label class="register_content_label">Password</label>
										<?php echo $view['form']->errors($form['password']) ?>
										<?php echo $view['form']->widget($form['password'],array('attr'=> array('class'=>'register_input_dealer rounded inseshadow required'), 'required'=>false )) ?>
									</div>
							
									<div class="row">
										<label class="register_content_label">Verify password</label>
										<?php echo $view['form']->errors($form['plain_password']) ?>
										<?php echo $view['form']->widget($form['plain_password'],array('attr'=> array('class'=>'register_input_dealer rounded inseshadow required'), 'required'=>false )) ?>
									</div>
							
									<div class="row">
										<label class="register_content_label">First name</label>
										<?php echo $view['form']->errors($form['first_name']) ?>
										<?php echo $view['form']->widget($form['first_name'],array('attr'=> array('class'=>'register_input_dealer rounded inseshadow required') , 'required'=>false)) ?>
									</div>
							
									<div class="row">
										<label class="register_content_label">Last name</label>
										<?php echo $view['form']->errors($form['last_name']) ?>
										<?php echo $view['form']->widget($form['last_name'],array('attr'=> array('class'=>'register_input_dealer rounded inseshadow required'), 'required'=>false )) ?>
									</div>
							
									<div class="row">
										<label class="register_content_label">Address</label>
										<?php echo $view['form']->errors($form['address']) ?>
										<?php echo $view['form']->widget($form['address'],array('attr'=> array('class'=>'register_input_dealer rounded inseshadow required'), 'required'=>false )) ?>
									</div>

									<div class="row">
										<label class="register_content_label">Phone</label>
										<?php echo $view['form']->errors($form['phone']) ?>
										<?php echo $view['form']->widget($form['phone'],array('attr'=> array('class'=>'register_input_dealer rounded inseshadow required'), 'required'=>false )) ?>
									</div>					
							
									<div class="row addtm" >
									<input type="submit" value= "Next" class="registerBtnUser" formnovalidate/>
									</div>
								</form>					 			
							</div>
						</div>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<!--user registration end-->
			<div id="tabs-4">
			  <!--Confirm order-->
			 
			</div>
			<!--Change zipcode popup-->
			<div class="default_popup_two" id="windowMeasurements_two" ></div>
			<!--Change zipcode popup-->
			<div id="tabs-5">
				<div class="tabbongcontent">
					<div class="loginbox rounded" id="thanks"></div>
				</div>
			  <div class="clear"></div>
			</div>
		</div><!--//tab div-->
    </div><!--container-->
</div><!--//midle div-->
<!--twitter login-->
<script src="http://platform.twitter.com/anywhere.js?id=KhHaIrVjjE03jGAgHcheZP8kg&v=1" type="text/javascript"></script>
<!--twitter login-->
<?php $view['slots']->stop() ?>

