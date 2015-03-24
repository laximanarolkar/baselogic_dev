	
	// define global variables
	var cartPrice = new Array();
	var cartStyle = new Array();
	var cartLine = new Array();
	var cartMan = new Array();
	var cartWidth = new Array();
	var cartHeight = new Array();
	var cartWindowNumber = new Array();
	var cartOptions = new Array();
	var cartLocation = new Array();
	var numOfItems = 0;
	var windowNumber = 0;
	var newWindowNumber = 0;
	var brands = {};
	var brandshow = {}; // [brand][level]
	var maxlevel = 0;
	var Global = {'th':24};
	var levelData = {};
	//create operation object 
	var operationsObj= new operations();
	
 //create window object 
 function populateWindow()
{
	 var selectorId;
		//store user input values in window object
	this.selectedDropdownValue=function(selectorId)
		  {
		  var MySelector='';
		  var seperator='';
		  var StringResult='';
		  var ArrResult=new Array();
			this.MySelector=document.getElementById(selectorId);  // the selected dropdown
			
			for(var i=0;i<this.MySelector.length;i++)
			{
			if(this.MySelector[i].selected)
				{        
						
					     				   
						//return array of values selected in dropdown
						   ArrResult[i]=this.MySelector[i].value;	
						   
				}
				
			} 
			return ArrResult;
		  }
		  

	
	  
}