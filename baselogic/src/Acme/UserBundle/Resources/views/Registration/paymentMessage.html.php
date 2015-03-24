<!-- src/Acme/BlogBundle/Resources/views/Blog/index.html.twig.-->
<?php $view->extend('::layout.html.php') ?>
<?php //$view->extend('::layout.html.php') ?>

<script type="text/javascript">
$(document).ready(function(){
  $("#form").validate();
});
</script>
<style>
.field_label{
font-size:25px;
}
</style>

<?php $view['slots']->start('body') ?>



<div id="middle">
    <div class="container">
      <h2><a href="http://phpdemo2.quagnitia.com/baselogic/web/home">Get Started</a></h2>
      <div id="tabs">
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
              <h3>Measuring for your windows</h3>
              <img src="<?php echo $view['assets']->getUrl('bundles/userbundle/style/images/window.jpg')?>" align="right" alt="" style="margin-left:10px;" />
              <p>Taking accurate measurement of your window poenings is the vital firest step in successfully buying  replacement windows. You will take theree measurements each of the width (at the top, middle and bottom) and of the height (at the left, center and right) using the smallest results as your replacement window  dimensions. If the three measurements for either dimension differ greatly, the opening may not be square.</p>
              <h3>Width</h3>
              <p>The width is given first when reading replacement window dimensions. Measure the width between the inner jambs as shown. Be sure to measure the existing window’s frame at its widest points, rather than the narrower distance between inside trim piecces.</p>
              <h3>Height</h3>
              <p>For the height, you will measure from the point where the inside sill meets the outside sill stool, up to where the header meets the inside stop (head) at the top of the frame.</p>
			  <form action="<?php echo $view['router']->generate('_add_window')?>" method="POST" id="getStartedForm">
              <div class="tabfirstbox">
                <h4>Please provide your window measurements</h4>
                <div class="tabfirstrow">
                 
                    
					
					<div id="repeatDiv" class="tabfirstrepeat">
					<div class="tabfirstrow_left">
					<form id="form">
                      <label>Width</label>
                      <input class="smallinpt rounded inseshadow" type="text" id="windowWidth" name="windowWidth" class="required"/>
                      <span>Inches</span></div>
                    <div class="tabfirstrow_right">
                      <label>Height</label>
                      <input class="smallinpt rounded inseshadow" type="text" id="windowHeight" name="windowHeight" class="required"/>
                      <span>Inches</span></div>
					  <input type="hidden" id="path" value="<?php echo $view['router']->generate('_add_window')?>" >
					  <input type="hidden" id="path2" value="<?php echo $view['router']->generate('_save_window_style')?>" >
					   <input type="hidden" id="zipcod" value="<?php echo $view['router']->generate('_save_zipcode')?>" >
					   <input type="hidden" id="cartUrl" value="<?php echo $view['router']->generate('_add_to_cart')?>" >
					   <input type="hidden" id="confirmOrd" value="<?php echo $view['router']->generate('_confirm_order')?>" >
					   <input type="hidden" id="autopopulateReg" value="<?php echo $view['router']->generate('_autopopulate_user_reg')?>" >
					   <div id="loadDiv"></div>
                  </div>
                  <div class="tabfirstrepbtn"><a id="btnClone" class="registerlink">Add More</a></div>
                </div>
              </div>
              <div class="clear"></div>
              <p><a class="loginbtn rounded hirebtn" href="#">Next</a>
			  <!--<input type="submit" value="Next">-->
			  
			  </p>
			  </form>
			   
              <!-- default_popup-configuration start -->
             <div class="default_popup" id="windowMeasurements">
              </div>	
              <!-- default_popup end -->
              <!-- zipcode_pop start -->
          
              <!-- zipcode_pop end -->
            </div>
          </div>
          <div class="clear"></div>
        </div>
        <div id="tabs-2">
		<!--Display of top three quotes and edit configuration -->
        </div>
        <div id="tabs-3">
          <!-- cart-->
        </div>
		
        <div id="tabs-4">
          <!--Confirm order-->
        </div>
        <div id="tabs-5">
          <div class="tabbongcontent" style="align:center">

			<div class="loginbox rounded">
        <h2 id="greet"></h2>
		<p id="thanks"></p>
        </div>
          </div>
          <div class="clear"></div>
		  <script>
		  </script>
          <div class="clear"></div>
        </div>
      </div>
    </div>
  </div>
<?php $view['slots']->stop() ?>

