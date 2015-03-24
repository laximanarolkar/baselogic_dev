 function operations(){ 
  
//get the window number
this.windowNumberFunction=function(number){
	windowNumber = number;
	console.log(windowNumber);
}
//add a new window
this.newWindowFunction=function(){
	var theWindowLocation = ("#windowLocation"+windowNumber);
	cartLocation[windowNumber] = ($(theWindowLocation).val());
	newWindowNumber++;	
	windowNumber = newWindowNumber;
	displayStuff();
}

//remove a window from the cart
this.removeCartItem=function(index){

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

//display the second and third widget
var displayStuff=function(){

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
      success: function(data){
       $("#cartStuff").html(data);    
	 manCartDisplay();
       }
    });
	
}

var manCartDisplay=function(){

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

//add the selected window to the cart
this.addToCart=function(price, style, line, man, options){

	var doIAdd = 0;
	
	
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
numOfItems++;
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
	
// load/reload the second and third widget 
var updateTable=function(divId) { 
	 var s = "";
	function write(text) {
	  s = s + text;
	}  
	//create the html page to be displayed
	write('<div style="float:left; margin-top:45px;" id="price_data" class="drkgraybg"><table style="margin-top:45px;">');
	for(var lv=0; lv<=maxlevel; lv++) { 
		if(levelData[lv])
		{
		var ld = levelData[lv]; 
		var ww = ld[0][0]+'"x'+ld[0][1]+'" '+ld[1]+' '+ld[2];
		write('<tr><td><div style="height:31px">'+(lv+1)+ww+"</div></td></tr>");
		  }
		  else
			write('<tr><td><div style="height:31px"></div></td></tr>');
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

		//Depending on whether widget is merged or expanded use the class
		if(curbrand.merged)
		  var id = 'popup_'+lv+"_"+brand+"_"+style;
		else
		  var id = 'brandshow_'+brand+'_'+lv+'_'+style;
		if(curbrand.merged===false && brandshow[brand][lv] == style)
		  var bclass = 'highbutton';
		else
		  var bclass = 'unhighbutton';
		
		if(!curbrand.merged)
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
		
		// give the 2 div's i.e the pirce and the div which shows the details of window the same height..
		var divh = document.getElementById('mult_price').offsetHeight;
		document.getElementById('price_data').style.height=divh+"px";
		
 }

//
var writeDataToDiv=function(data, divId) {    
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
	  brands[brand]['style2price'][style][level] = price;
		  
		
	if(!levelData[level])
		levelData[level] = [dim, opt, picSlide];

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
  
this.clickbutton=function(e) {
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
	$('#popup').css({visibility: 'hidden'});
	brandshow[field[1]][field[2]] = field[3];
	}
	updateTable("pricetable");
}
  

 
}