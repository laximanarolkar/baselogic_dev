
//  getter and setter
function windowClass() {
    this.id;
     this.manufacturer= new Array();
     this.line;
     this.frame;
     this.width;
     this.height;
     this.style= new Array();
	 this.material;
	 this.options= new Array();

	  /**
     * Setter methods
     */
    this.setManufacturer=function(ArgManufacturer) { 
	for(var i=0;i<ArgManufacturer.length;i++)
		{
		this.manufacturer.push(ArgManufacturer[i]);
		}
	}	
	this.setLine=function(line) { this.line = line; }
	
	 this.setFrame=function(frame){this.frame = frame; }
	
	this.setWidth=function(width) {this.width = width;}

	
	this.setHeight=function(height) { this.height = height;}

	
	this.setStyle=function(ArgStyle){ 
		for(var i=0;i<ArgStyle.length;i++)
		{
		this.style.push(ArgStyle[i]);
		}
	}
	
		
	this.setMaterial=function(material){this.material = material;}
	

	
	 this.setOptions=function(ArgOptions){ 
		for(var i=0;i<ArgOptions.length;i++)
		{
		this.options.push(ArgOptions[i]);
		}
		
	}
    /**
     * Getter
    
     */
	this.getManufacturer=function(){return this.manufacturer;}
	this.getId=function(){return this.id;}
	this.getLine=function(){return this.line;}
	this.getFrame=function(){return this.frame;}
	this.getWidth=function(){return this.width;}
	this.getHeight=function(){ return this.height; }
	this.getStyle=function() {return this.style;}
	this.getMaterial=function(){return this.material;}
	this.getOptions=function(){return this.options;}

		
}