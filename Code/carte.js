
var tour=1;
function click(image){
	alert("ok");
	if (tour==1){
		image.src="fond1.png";

	}
	else{
		image.src="fond2.png";
	}
	
	tour=0;
}