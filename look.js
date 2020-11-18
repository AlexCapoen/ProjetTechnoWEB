let onButtonAnimals=function(elem){
	let img=document.getElementById("quizzAnimalsImg");
	if (img.classList.contains("noOpacity")){
		img.classList.add("Opacity");
		img.classList.remove("noOpacity");
	}
}

let onButtonHistory=function(elem){
	let img=document.getElementById("quizzHistoryImg");

	if (img.classList.contains("noOpacity")){
		img.classList.add("Opacity");
		img.classList.remove("noOpacity");
	}
}

let outImg=function(elem){
	elem.classList.add("noOpacity");
	elem.classList.remove("Opacity");	
}




