<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Base Logic</title>


<link href={{ asset('bundles/userbundle/style/css/style.css') }} rel="stylesheet"  />
<link href={{ asset('bundles/userbundle/style/css/jquery-ui-tab.css') }} rel="stylesheet"  />



<script type="text/javascript" src="{{ asset('bundles/userbundle/style/js/jquery-1.7.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('bundles/userbundle/style/js/jquery-ui-tab.js') }}"></script>


<script type="text/javascript">
    var currentTab = 0;
    $(function () {
        $("#tabs").tabs({
            select: function (e, i) {
                currentTab = i.index;
            }
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
    $("#btnPrevious").live("click", function () {
        var tabs = $('#tabs').tabs();
        var c = $('#tabs').tabs("length");
        currentTab = currentTab == 0 ? currentTab : (currentTab - 1);
        tabs.tabs('select', currentTab);
        if (currentTab == 0) {
            $("#btnNext").show();
            $("#btnPrevious").hide();
        }
        if (currentTab < (c - 1)) {
            $("#btnNext").show();
        }
    });
</script>
<script type="text/javascript">
   $(document).ready(function(){
        $('#btnClone').click(function(){
          $('#repeatDiv').clone().find("input:text").val("").end()
                          .appendTo('.tabfirstrow:last');
          return false;
        });
    });
  </script>
<script src="{{ asset('bundles/userbundle/style/js/popup.js') }}" type="text/javascript" ></script>
<script src="{{ asset('bundles/userbundle/style/js/jquery.collapse.js') }}" type="text/javascript"></script>

</head>

<body>

     
			<div id="wrapper">
  <div id="image"></div>
  <div id="header">
    <div class="container">
      <div class="logo"><a href="index.html"><img src="{{ asset('bundles/userbundle/style/images/logo.png') }}" alt="baseLOGIC" title="baseLOGIC" /></a></div>
    </div>
    <div class="nav">
      <div class="container">
        <ul>
          <li><a href="index.html">Home</a></li>

          <li><a href="{{ path('fos_user_registration_register') }}">Dealer Registration</a></li>
        </ul>
      </div>
    </div>
  </div>

			 {#------------------------------------------#}
			
                  
		<div id="content">
            <?php $view['slots']->output('body') ?>
        </div>
          <div id="footer">
    <div class="container">Copyright © 2013. All rights reserved.</div>
  </div>
			</div>
        </div>
    </div>
</body>
</html>
