<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Base Logic</title>

<link href="<?php echo $view['assets']->getUrl('bundles/userbundle/css/searchwindow.css') ?>" rel="stylesheet"  />

    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('bundles/userbundle/css/jquery-ui-1.8.13.custom.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo $view['assets']->getUrl('bundles/userbundle/css/ui.dropdownchecklist.themeroller.css') ?>">
    <style>
table td { vertical-align: top }
dd { padding-bottom: 15px }
    </style>

    <!-- Include the basic JQuery support (core and ui) -->
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/js/jquery-1.6.1.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/js/jquery-ui-1.8.13.custom.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/js/ui.dropdownchecklist.js') ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/js/SearchWindow/baselogic.class.js') ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/js/SearchWindow/baselogic.operations.js') ?>"></script>
<script type="text/javascript" src="<?php echo $view['assets']->getUrl('bundles/userbundle/js/SearchWindow/baselogic.data.js') ?>"></script>


    <!-- Apply dropdown check list to the selected items  -->
    <script type="text/javascript">
	
	   var Global = {};
  function consolelog(text) {
    Global.log = Global.log+text;
    $("#log").html(Global.log);
  }
   if(!window.console) {
	window.console = {log: function(text) { consolelog(text);} };
  }
        $(document).ready(function() {
        	$returnS5 = $('#returnS5');
			$("#s5, #s7, #s8").dropdownchecklist({
onItemClick: function(checkbox, selector){

	var justChecked = checkbox.prop("checked");
	var checkCount = (justChecked) ? 1 : -1;
	for( i = 0; i < selector.options.length; i++ ){
		if ( selector.options[i].selected ) checkCount += 1;
	}
      if ( checkCount > 5 ) {
		alert( "Limit is 5" );
		throw "too many";
	}
}
});

        	$returnS6 = $('#returnS6');
			$("#s6").dropdownchecklist({
				onItemClick: function(checkbox, selector){
					var thisIndex = checkbox.attr("id").split('-')[2].replace('i', '');
					selector.options[thisIndex].selected = checkbox.attr("checked");

					var values = "";
					var newText = 'Checkbox ID = '+checkbox.attr('id')+'<br/><br/>';
					for( i=0; i < selector.options.length; i++ ){
						newText += 'Option i = ' +i+ ' || value = ' +selector.options[i].value+ ' || checked = ' +selector.options[i].selected+ '<br/><br/>';
						if (selector.options[i].selected && (selector.options[i].value != "")){
							if ( values != "" )
								values += ";";
							values += selector.options[i].value;
						}
					}
					newText += 'Selector Value = '+values;
					$returnS6.html( newText );
				}
			});

			$('select option').removeProp('selected');
			//for jquery < 1.6
			//$('select option').removeAttr('selected');
       });
	   
	 
    

$(document).ready(function()
	{ 

    $("#search_button").click(function(e){ 
	var path=document.getElementById('path').value;
	var selectorObj={};
	//create object 
	var OptionsObj= new populateWindow();	 
	var ManufacturerObj= new populateWindow(); 
	var StyleObj= new populateWindow();
	
	//initialize array
	var MyOptions={};
	var MyManufacturers={};
	var MyStyles={};
	
	//put all the selected values in an array
	var MyOptions=OptionsObj.selectedDropdownValue("s8");
	var MyManufacturers=ManufacturerObj.selectedDropdownValue("s5");
	var MyStyles=StyleObj.selectedDropdownValue("s7");
	//create object of woindow and set the values selected in the dropdown
	var winObj= new windowClass();
	winObj.setOptions(MyOptions);
	winObj.setManufacturer(MyManufacturers);
	winObj.setStyle(MyStyles);
	winObj.setWidth($("#width").val());
	winObj.setHeight($("#height").val());
	winObj.setFrame($("#frame").val());
	
	jsonWinObj=JSON.stringify(winObj);
// display the result page through an ajax call
		$.ajax({
			type: "POST",
			url:path,
			data:"winObj="+jsonWinObj,
			//cache: "false",
			//dataType: "html",
			success: function(data)
			{
				$("#filtered_result").html(data);    

			}
		});
		}); 
	});


$(".brandtitle").live('click', operationsObj.clickbutton);
$("button").live('click',  operationsObj.clickbutton);  
$(".customClass").live('click',  operationsObj.clickbutton); 
	
	$('a.control').live('click', function (e) {

	
	e.preventDefault();
	
	// the id of the selected <a> tag i.e the row 
	var cur_tag=$(this).attr('id');
	var cur_element=$(this).attr('id').split('_');
	var curr_id=cur_element[1]; 
var tr=$("#newarr_"+curr_id);   
var div=	$("#div_"+curr_id);   
		if ($(this).attr('rel') == 'top' )
		{
				if($(this).parent().index()>0)  // if its the first row then dont sort
				{
					tr.fadeTo('medium', 0.1, function () {
					
					tr.insertBefore('table#rows_result tr:nth-child(3)').fadeTo('slow', 1);
					
					
					});
					
					div.fadeTo('medium', 0.1, function () {
					
					div.insertBefore('td#sort_td div:first-child').fadeTo('slow', 1);
					
					
					});
					
				
				}
		}
		
		else
			//Can't do anything with these
			return false;
		return false;
	});
	
    </script>
<?php 


?>
</head>

<body id="bg">
    <div id="wrapper">
    	<div id="header">
   	    	<div class="inner_header">
            	<div class="logos"><a href="<?php echo $view['router']->generate('_welcome') ?>"><img src="<?php echo $view['assets']->getUrl('bundles/userbundle/images/logos.png') ?>" width="379" height="57" alt="logo" /></a></div>
                <div class="welcomemsg"><strong>Welcome </strong><?php echo $name;?><span>|</span> <a href="logout">Logoff</a></div>
                <div class="clear"></div>
          	</div>
        </div>
        <div id="navbg">
        	<div class="inner_nav txtrgt"><a href="<?php echo $view['router']->generate('_welcome') ?>"><img src="<?php echo $view['assets']->getUrl('bundles/userbundle/images/home_txt.png') ?>" width="94" height="22" alt="Home" /></a></div>
        </div>
        <div id="mid_wrapper">
        	<div class="inner_mid">
			<form name="search_window" method="POST">
			<input type="hidden" value="<?php echo $view['router']->generate('resultwindow')?>" id="path">
			<input type="hidden" value="<?php echo $view['router']->generate('cart')?>" id="cartPath">	
			<!--<input type="hidden" value="<?php // echo $view['router']->generate('pricetable')?>" id="pricePath">-->
            	<div class="main_content">
	            	<h1 class="page_heading">Search Windows</h1>
                    <div class="register_form">
                        <div class="lft_panel_srch">
                        	<p>Please select search parameters from the following</p>
							<div class="srch_content">
	                        <div class="srch_row">
                        		<h3 class="srch_hed">Size <span>(per inch)</span></h3>
                            	<div class="sml">Width <input type="text" class="register_input_small" id="width" value="" style="margin-left:10px" /> <span class="gray_txt"> inch </span></div>
                                <div class="sml clearrm">Height <input type="text" class="register_input_small" id="height" value="" /><span class="gray_txt"> inch </span></div>
                            	<div class="clear"></div>
                             </div>
                             <div class="srch_row">
                        		<h3 class="srch_hed fltlm">Material </span></h3>
                                <div class="fltleft">
                                	<select class="srch" id="material">
                                    	<option>Vinyl</option>
										<option>Wood</option>
										<option>Metal</option>
                                        
                                    </select>
                                </div>
                            	<div class="clear"></div>
                             </div>
                             <div class="srch_row">
                        		<h3 class="srch_hed fltlm">Frame </span></h3>
                                <div class="fltleft">
                                	<select class="srch" id="frame">
                                    	<option>Block</option>
										<option>Zbar</option>
										<option>Nail-On</option>
                                       
                                    </select>
                                </div>
                            	<div class="clear"></div>
                             </div>
                            <div class="srch_lbl">
                                <h3 class="srch_hed">Manufacturer</h3>
                                <div class="option_content">
                                	<div class="multilevel clearall">
						
                                        <select id="s5" multiple="multiple" name="manufacturers">
										<?php
										
										foreach($ArrManufacturers as $manufacturers)
										{?>
										<option value="<?php echo $manufacturers->getName();?>">
										<?php echo $manufacturers->getName();?>
										</option>
										<?php
										}
										?>
                                           
                                         
                                        </select>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                
                                <h3 class="srch_hed">Style</span></h3>
                                <div class="option_content">
                                	<div class="multilevel clearall">
                                    	<select id="s7" multiple="multiple" name="syles">
                                          <?php
										
										foreach($ArrStyles as $styles)
										{?>
										<option value="<?php echo $styles->getName();?>">
										<?php echo $styles->getName();?>
										</option>
										<?php
										}
										?>
                                        </select>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                
                                <h3 class="srch_hed">Options</span></h3>
                                <div class="option_content">
                                	<div class="multilevel clearall">
                                    	<div class="multilevel clearall">
                                    	<select id="s8" name="optionsList" multiple="multiple">
                                            <option value="obscure">Obscure</option>
                                            <option value="argon">Argon</option>
                                            <option value="lowe">Lowe</option>
                                            <option value="flat">Flat</option>
                                            <option value="tempered">Tempered</option>
                                            <option value="sculptured">Sculptured</option>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="clear"></div>
                                </div> 
                            </div>
                            <div class="form_btn"><input type="button" value="SEARCH" id="search_button" class="login_btn"/></div>
                            <div class="clear"></div>
                        </div>
                        </div>
                        <div class="rgt_panel_srch" id="filtered_result" >
                        	
                           
                          
                           
                           
                        </div>
						<div  class="rgt_panel_srch" id="cartStuff">
 
</div>	
<!--
<div  class="rgt_panel_srch" id="priceDisplay">
 
</div>			-->			
                        <div class="clear"></div>
                    </div>
                </div>
				</form>
            </div>
        </div>
        <div id="footer">
        	<div class="inner_footer">
            	<p class="copyright">Copyright © 2012. All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
</html>
