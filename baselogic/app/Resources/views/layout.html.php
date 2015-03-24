<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Base Logic</title>

<link href="<?php echo $view['assets']->getUrl('bundles/userbundle/style/css/style.css') ?>" rel="stylesheet"  />
<link href="<?php echo $view['assets']->getUrl('bundles/userbundle/style/css/jquery-ui-tab.css')?>" rel="stylesheet"  />
<link href="<?php echo $view['assets']->getUrl('bundles/userbundle/style/css/jquery.loader.css')?>" rel="stylesheet"  />

<link href="<?php echo $view['assets']->getUrl('bundles/userbundle/css/admin.css')?>" rel="stylesheet"  />

<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/js/jquery-1.7.2.min.js')?>"></script>

<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/js/jquery-ui-tab.js')?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/js/jquery.loader.js')?>"></script>

<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/js/jquery.validate.min.js')?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/js/validMultipler.js')?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/js/jquery-ui.js')?>"></script>
  <!--<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
<script type="text/javascript">
$("#accordion").accordion();
	var currentTab = 0;
	$(function () {
		$("#tabs").tabs({ 
		disabled: [1,2,3,4],  //disable tabs.
		activate: function(event, ui) {$(ui.oldPanel).empty();}
		});
	});
	

    $("#btnNext").live("click", function () {
        var tabs = $('#tabs').tabs();
        var c = $('#tabs').tabs("length");
        currentTab = currentTab == (c - 1) ? currentTab : (currentTab + 1);
        tabs.tabs('select', currentTab);
        $("#btnPrevious").show();
        if (currentTab == (c - 1)) {
            $("#btnNext").hide();
        } else {
            $("#btnNext").show();
        }
    });

	
	
	$("#tabs").tabs({ 
    disabled: [1,2,3,4]  //disable tabs.
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("input:text:visible:first").focus();
	$(".zipcode_pop").css('display', 'none');
	$(".shipping_pop").css('display','none');
});

 
</script>
  
  <script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/js/popup.js')?>"></script>
  <script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/js/jquery.collapse.js')?>"></script>


</head>

<body >
<div id="wrapper">
  <!--<div ></div>-->
  <!--<div id="header">
    <div class="container">
      <!--<div class="logo"><a href="<?php //echo $view['router']->generate('_get_started')?>"><img src="<?php //echo $view['assets']->getUrl('bundles/userbundle/style/images/logo.png')?>" alt="baseLOGIC" title="baseLOGIC" /></a></div>-->
    <!--</div>-->
     <!-- <div class="nav">
    <div class="container">
        <ul>
          <li><a href="<?php echo $view['router']->generate('_get_started')?>">Home</a></li>

          <li><a href="<?php echo $view['router']->generate('fos_user_registration_register')?>" onclick="setFocus()">Dealer Registration</a></li>
        </ul>
      </div> 
    </div>-->
  <!--</div>-->                
<div id="content">
   <?php $view['slots']->output('body') ?>
</div>
<div id="footer">
	<div class="container">Copyright © <?php echo date('Y');?> All rights reserved.</div>
</div>
</div>
    
</body>
</html>
