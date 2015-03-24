 this.cartPrice = new Array();
this.cartStyle = new Array();
this.cartLine = new Array();
this.cartMan = new Array();
this.cartWidth = new Array();
this.cartHeight = new Array();
this.cartWindowNumber = new Array();
this.cartOptions = new Array();
this.cartLocation = new Array();
this.numOfItems = 0;
this.windowNumber = 0;
this.newWindowNumber = 0;
    this.brands = {};
   this.brandshow = {}; // [brand][level]
   this.maxlevel = 0;
   this.Global = {'th':24};
    this.levelData = {};
  
  function selectedDropdownValue(selectorId)
  {
  this.MySelector='';
  this.MyOptions='';
  this.seperator='';
  this.StringResult='';
  this.ArrResult=new Array();
  	this.MySelector=document.getElementById(selectorId);
	
	for(var i=0;i<this.MySelector.length;i++)
	{
	if(this.MySelector[i].selected)
		{        
				  if(this.StringResult.length>0 && i<this.MySelector.length)
				  {
				  this.seperator="','";
				  }
				  if(this.StringResult!=undefined)
					{ 
					this.StringResult=this.StringResult+this.seperator+this.MySelector[i].value;
				
					this.ArrResult.push(this.MySelector[i].value);	
				
					}
			
		}
        
	}
	
	
  }
   

  selectedDropdownValue.prototype.getOptions=function()
  {
  return this.StringResult;
  }
  
  selectedDropdownValue.prototype.getOptionsArray=function()
  {
  return this.ArrResult;
  
  }
  

function windowNumberFunction(number){
	windowNumber = number;
	console.log(windowNumber);
}

function newWindowFunction(){
	var theWindowLocation = ("#windowLocation"+windowNumber);
	cartLocation[windowNumber] = ($(theWindowLocation).val());

	newWindowNumber++;	
	windowNumber = newWindowNumber;
	displayStuff();
}

function removeCartItem(index){

	numOfItems--;
	cartPrice.splice(index,1); 
	cartStyle.splice(index,1);
	cartLine.splice(index,1);
	cartMan.splice(index,1);
	cartWidth.splice(index,1);
	cartHeight.splice(index,1);
	cartOptions.splice(index,1);
	cartWindowNumber.splice(index,1);
	cartLocation.splice(index,1);
	
	displayStuff();
	
}

function displayStuff(){

	this.path=document.getElementById('cartPath').value;
	var jsoncartPrice=JSON.stringify(this.cartPrice);
	var jsoncartStyle=JSON.stringify(this.cartStyle);
	var jsoncartLine=JSON.stringify(this.cartLine);
	var jsoncartMan=JSON.stringify(this.cartMan);
	var jsoncartOptions=JSON.stringify(this.cartOptions);
	var jsoncartWidth=JSON.stringify(this.cartWidth);
	var jsoncartHeight=JSON.stringify(this.cartHeight);
	var jsoncartWindowNumber=JSON.stringify(this.cartWindowNumber);
		var jsoncartLocation=JSON.stringify(this.cartLocation);
	
	  $.ajax({
	type: "POST",
      url:this.path,
	  data: "numOfItems="+this.numOfItems+"&cartPrice="+jsoncartPrice+"&cartMan="+jsoncartMan+"&cartLine="+jsoncartLine+"&cartStyle="+jsoncartStyle+"&cartOptions="+jsoncartOptions+"&cartWidth="+jsoncartWidth+"&cartHeight="+jsoncartHeight+"&cartWindowNumber="+jsoncartWindowNumber+"&cartLocation="+jsoncartLocation+"&newWindowNumber="+this.newWindowNumber, 
      //cache: "false",
      //dataType: "html",
       success: function(data){
       $("#cartStuff").html(data);    
	 manCartDisplay();
       }
    });
	
}

function manCartDisplay(){

	var cartMan2 = new Array(); 
	
	for(k=0;k<cartMan.length;k++){
		
		cartMan2[k] = cartMan[k]+"_"+k;
		
	}
	cartMan2.sort();j=0;
	newarr5= new Array()
	for(var l=0;l<cartMan2.length;l++){
	newarr5[l]=cartMan2[l];j++;
		if((l>0)&&(cartMan2[l]==cartMan2[l-1])){
		newarr5.pop();j--
		}
	}	
	var html='';
	for(f=0; f<cartMan2.length; f++){
		for (g=0;g<newarr5.length;g++){
		var num = newarr5[g].substr(newarr5[g].indexOf('_')+1);

var newcartOptions="";
var test2=cartOptions[num].split(",");
for(var z=0;z<test2.length;z++)
{
newcartOptions=newcartOptions+test2[z]+"*";
}


			if (cartMan2[f]==newarr5[g]){	
				html+=cartWindowNumber[num]+ " ";
				html+=cartWidth[num]+ " ";
				html+=cartHeight[num]+ " [";
				html+=newcartOptions+ "] ";
				html+=cartStyle[num]+ " ";
				html+=cartMan[num]+ ",";
				html+=cartLine[num]+ ",";
				html+=cartPrice[num]+ ";";

			}
			
		}
	}	
	document.getElementById('pricetable').innerHTML = html;
	//alert(html);
	var data = html;
	 var ndata = "";
  	 var incol=false;
  for(var c=0; c<data.length; c++) {
	if(data[c]==='[') incol=true;
	if(data[c]===']') incol=false;
	if(incol && data[c] == ',') ndata = ndata + '+';
	else ndata = ndata + data[c];
	
  }
	writeDataToDiv(html,"pricetable");
	updateTable("pricetable"); 
}	
function addToCart(price, style, line, man, options){

	var doIAdd = 0;
	numOfItems++;
	
	for(i=0; i<numOfItems; i++){ //this loop checks if the item is already in the cart and deletes it if it is
		if(cartStyle[i] == style && cartMan[i] == man && cartLine[i] == line && cartWindowNumber[i] == windowNumber){
			doIAdd = 1; //1 means do not add
			alert("already in cart");
		}
		if(cartWindowNumber[i] == windowNumber){
			if(cartStyle[i] != style || cartWidth[i] != $("#width").val() || cartHeight[i] != $("#height").val()){
				doIAdd = 1; //1 means do not add if the style, width, or height, is different from this window type
				alert("wrong window type");
			}
		}
	}
		
if(doIAdd == 0){ //if doIAdd is 0 then it is not in the cart so add it now

		cartPrice.push(price);
		cartStyle.push(style);
		cartLine.push(line);
		cartMan.push(man);
		cartOptions.push(options);
		cartWidth.push($("#width").val());
		cartHeight.push($("#height").val());
		cartWindowNumber.push(windowNumber);
		
		var theWindowLocation = ("#windowLocation"+windowNumber);
		cartLocation[windowNumber] = ($(theWindowLocation).val());
		
	}
	
	displayStuff();
	}
	
  function updateTable(divId) {      
    //consolelog(brands.toSource());
 /* this.pricePath=document.getElementById('pricePath').value;
	    $.ajax({
	type: "POST",
      url:this.pricePath,
	 data: "maxlevel="+maxlevel+"&brands="+brands,
      //cache: "false",
      //dataType: "html",
       success: function(data){
       $("#priceDisplay").html(data);    
	
       }
    });*/
	  
	 
var s = "";
    function write(text) {
      s = s + text;
    }  

	  write('<div style="float:left; margin-top:45px;" id="price_data" class="drkgraybg"><table style="margin-top:45px;">');
	 for(var lv=0; lv<=maxlevel; lv++) {
			var ld = levelData[lv]; 
			var ww = ld[0][0]+'"x'+ld[0][1]+'" '+ld[1]+' '+ld[2];
			write('<tr><td><div>'+(lv+1)+ww+"</div></td></tr>");
			
		}
	write('</table></div>');		
	var firstbrand = false;
	  for(brand in brands) { 
        var curbrand = brands[brand]; 
        var cls = curbrand.merged ? 'drkgraybg' : 'graybg';
        
        write("<div id='mult_price'  style='float:left;margin-top:45px;'>");
          var buttons = curbrand.merged ? 'Expand' : 'Merge';
          
		  if(!firstbrand) {
			Global.firstBrand = 'brand_'+brand;
			firstbrand = true;
		  }
		 
          write('<table id="brand_'+brand+'" class="'+cls+' mytb total_tbl">');
            write('<tr><td colspan="2" class="'+cls+'"><strong>'+brand+'</strong> <a id="all_'+brand+'" class="brandtitle" href="javascript:void(0);">'+buttons+'</a></td></tr>');
		
            
            function eachstyle(lvl, func) {
              if(curbrand.merged)
                func(brandshow[brand][lvl]);
              else {
                for(style in curbrand.style2price)
                  func(style);
              }
            }
            
			var total = 0;
		
            for(var lv=0; lv<=maxlevel; lv++) { 
          
			  total += parseInt(curbrand.style2price[brandshow[brand][lv]][lv]);
              eachstyle(lv, function(style) {
                
                console.log('<br>tried'+style+' '+lv+' '+brand);
                var data = curbrand.style2price[style][lv];
                
                
                if(!data) data = 'n/a';

                if(curbrand.merged)
                  var id = 'popup_'+lv+"_"+brand+"_"+style;
                else
                  var id = 'brandshow_'+brand+'_'+lv+'_'+style;
                if(curbrand.merged===false && brandshow[brand][lv] == style)
                  var bclass = 'highbutton';
                else
                  var bclass = 'unhighbutton';
				//var title = curbrand.merged ? 'title='+style : '' ;
				
                if(!curbrand.merged)
					//data = "<button id='"+id+"' title='"+style+"' class='"+bclass+"'>"+data+"</button>";
					data = "<input type='radio' id='"+id+"'   title='"+style+"' class='customClass'>"+data;
                else
					data = '<p>'+data+'</p>';
				write("<td "+cls+">"+data+"</td>");
              });
              write("</tr>");
            }
			
		  if(curbrand.merged)
			write('<tr><th class="'+cls+' addtbor">Total</th> <td align="right" class="'+cls+' addtbor">'+total+'</td></tr>');
		  else
			write('<tr><th class="'+cls+'  addtbor">Total</th> <td class="'+cls+' addtbor">N/A</td></tr>');
          write('</tr></table>');
          
        write("</div>");
      }
	    
    write("</div");
    
    var div = document.getElementById(divId);
    div.innerHTML = s;
	// give the 2 div's the same height..
	var divh = document.getElementById('mult_price').offsetHeight;
	document.getElementById('price_data').style.height=divh+"px";
	
 }



  
  function writeDataToDiv(data, divId) {    
      var array = data.split(";");

      for(var i=0; i<array.length; i++) {  
          var text = array[i].split(","); 
          if(text.length == 0) continue;
          var key = text[0].split(" ");  
          if(!key) continue;
          var level = parseInt(key[0]);
		  //consolelog('key=<'+key+'>');
          if(level===NaN) continue;
          if(maxlevel < level) maxlevel = level;
          //var brand = key[1]+text[1];
		
          var brand = key[5]; 
		  var dim = [key[1], key[2]];
		  var opt = key[3];
		  var picSlide = key[4];
		  
          var style = text[1];
          var price = text[2];
          
	
		  
          if(!brand) continue;
          
          if(!brands[brand])
              brands[brand] = {'style2price':{}, 'merged':false, 'show':'', 'style2data':{}};
          if(!brands[brand]['style2price'][style])
            brands[brand]['style2price'][style] = {};
          //if(!brands[brand]['style2data'][style])
          //  brands[brand]['style2data'][style] = {};		  	
          brands[brand]['style2price'][style][level] = price;
		  
		 
		  if(!levelData[level])
			levelData[level] = [dim, opt, picSlide];
			
		  //brands[brand]['style2data'][style][level] = [dim, opt, picSlide];
      }
      
      for(var brand in brands) {
        brandshow[brand] = {} 
        var style;
		var nstyle = 0;
        for(var st in brands[brand].style2price) {       
          style = st;
		  nstyle++;
		}
        for(var lv=0; lv<=maxlevel; lv++) {
          brandshow[brand][lv] = style;
        }
		if(nstyle == 1) {
			brands[brand].merged = true;
		}
      }
      updateTable(divId);
      
  }
  
    function clickbutton(e) {
	  if(e.target.className === 'body' && $('popup').attr('visibility') === 'visible') {
		$('#popup').css({visibility: 'hidden'});
		return;
	  }
		
      var field = $(this).attr('id').split('_');
      consolelog(field + "<br>");
	  
      if(field[0] == 'style') {
        brands[field[1]].merged = true;
        brands[field[1]].show = field[2];
      }
      else if(field[0] == 'all') {
        brands[field[1]].merged = !brands[field[1]].merged;
      }
	 
      else if(field[0] == 'brandshow') {
	//document.getElementById($(this).attr('id')).src="http://localhost/baselogic/web/bundles/userbundle/images/radio_off.jpg";
        $('#popup').css({visibility: 'hidden'});
        brandshow[field[1]][field[2]] = field[3];
      }
	  updateTable("pricetable");
  }
  $("button").live('click', clickbutton);
  
  
  
$(document).ready(function(){ 
$("#search_results").slideUp(); 
    $("#search_button").click(function(e){ 
        e.preventDefault(); 
        ajax_search(); 
    }); 
}); 
  /*
  function reorder () {
		var j = 0;
		$('table#sample tbody tr').each(function () {
			
			if (j%2==0 ){$(this).removeClass();}
			else{
			$(this).removeClass();
			$(this).addClass('odd');
			 
			}
			j += 1;
			
		});
	
// sorting function for the headers
    function th_sorter(a, b) {
       // just compare the text	   
	  if ($(a).text()) 
		   var cmp = $(a).text() > $(b).text();
		   if (cmp) {
			 return 1;
		   }
		  else if ($(a).text() < $(b).text()) {
		  return -1;
		  }
		   else {
			 return 0;	 
		   }
    }
    */
function ajax_search(){ 


  var ObjManufacturer=new selectedDropdownValue('s5');
  var ObjStyles=new selectedDropdownValue('s7');
  var ObjOptions=new selectedDropdownValue('s8');
 
  var search_val = ObjManufacturer.getOptionsArray();
  var search_style = ObjStyles.getOptionsArray();
  var search_options = ObjOptions.getOptionsArray();
  
  var search_term_names = new Array();
  var search_style_names = new Array();
  var search_option_names = new Array();
 
   
 
	
  var search_frame=$("#frame").val(); 
  var search_height=$("#height").val();
  var search_width=$("#width").val();
 /* 
  if (!search_frame || !search_height || !search_width || !search_style_names[0] || !search_term_names[i] ){
  alert("You are missing one or more pieces of data for a search.\n Width, Height, Manufacturer and Style are needed.");
  }
    
 
		function sortArray(term){
		oldarr3= new Array();
		for (i=0;i<data.count;i++){	
		eval("oldarr3.push(data."+ term +"["+i+"])");
		}
		
		oldarr3.sort();j=0;
		newarr3= new Array()
		for(var i=0;i<oldarr3.length;i++){
		newarr3[j]=oldarr3[i];j++;
		if((i>0)&&(oldarr3[i]==oldarr3[i-1])){
		newarr3.pop();j--
		}}
		return newarr3;
	}
	
	pricearr = new Array();
	var newarr = new Array();
	newarr = sortArray("style");
	var newarr2 = new Array();
	newarr2 = sortArray("line");
	
	for (j=0;j<newarr.length;j++){
		eval ("var pricearr"+ j+ "= new Array();");
		//pricearr.push(newarr[j])
		for (b=0;b<newarr2.length;b++){
			for (i=0;i<data.count;i++){
				if (data.style[i] == newarr[j] && data.line[i] == newarr2[b]){
				eval("pricearr" + j + "["+b+"]=" + data.base[i] );
				}
			}
		} 
	}
	
	var price_sort = new Array();
	for (b=0;b<newarr2.length;b++){
	price_sort[b] = pricearr0[b]+":"+newarr2[b]+":";
	}
	
	price_sort.sort();
	var price_split = "";
	
	for (b=0;b<newarr2.length;b++){price_split = price_split + price_sort[b];}
 	var price_sort_line = new Array();
	var price_sort_price = new Array();
	var price_sort = new Array();
	
	for (b=0;b<price_split.length;b++){
		price_sort = price_split.split(":");
	}
	
	for (i=0;i<price_sort.length;i++){
	
		if (i%2==0 ){price_sort_price.push(price_sort[i]);}
		else{price_sort_line.push(price_sort[i]);}
		
	}
	newarr2 = price_sort_line;
	for (j=0;j<newarr.length;j++){
		eval ("var pricearr"+ j+ "= new Array();");
		for (b=0;b<newarr2.length;b++){
			for (i=0;i<data.count;i++){
				if (data.style[i] == newarr[j] && data.line[i] == newarr2[b]){
				eval("pricearr" + j + "["+b+"]=" + data.base[i] );
				}
			}
		} 
	}
	var heading = new Array();
	var obscure_price = new Array();
	var lowe_price = new Array();
	
	for (b=0;b<newarr2.length;b++){
			for (i=0;i<data.count;i++){
				if (data.line[i] == newarr2[b]){
					heading[b]= "<img width=50 src=" + data.logo[i] + "><br \>";
					heading[b]= heading[b] + data.manufacturer[i];
					obscure_price[b] = data.obscure[i];
					lowe_price[b] = data.lowe[i]
					}
				}
			}
  
	

	for (i=0;i<heading.length;i++){
	heading[i]}
	
	for (i=0;i<newarr2.length;i++){
	newarr2[i]}
	for (j=0;j<newarr.length;j++){
		
		for (b=0;b<newarr2.length;b++){
			var newstring = eval("pricearr"+ j +"["+b+"]");
			if (isNaN (newstring)){newstring = 'n/a';}
			
			if (isNaN (newstring)){ newstring }
			else {
				var string = heading[b]; 
				var start = string.indexOf('<br >') + 5;
				var length = string.length;
				var manufact = string.substr(start,length);
				

			}
				}
	
	
	}	
	
	
	for (i=0;i<obscure_price.length;i++){
obscure_price[i] ;
	}
	html = html + "<td align='right'><div class='obscure'>Obscure</div></td>";
	html =  html +"</tr>";
	
	if (j%2==0 ){html = html + "<tr>";}
		else{html = html + "<tr class='odd'>";}
		 
	for (i=0;i<lowe_price.length;i++){
		html = html + "<td align ='right' ><div class='lowe' ><a id = 'toggleit"+ i +"' >"+ lowe_price[i] + "</a></div></td>";
	}
	html = html + "<td align='right'><div class='lowe'>Lowe</div></td>";
	html =  html +"</tr>";
	
	html =  html +"</tbody></table></div>";
	$('#search_results').html(html);
	$('.obscure').toggle();
	$('.lowe').toggle();
	$("table#sample tbody tr td:first").css("background","#FACDC9");

});
*/
}