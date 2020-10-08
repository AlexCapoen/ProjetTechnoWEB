let onButtonAnimals=function(elem){
	console.log(elem)
	let img=document.getElementById("quizzAnimalsImg")
	console.log(img)
	if (img.classList.contains("noOpacity")){
		img.classList.add("Opacity")
		img.classList.remove("noOpacity")
		console.log("on mets le button")
	}
}

let onButtonHistory=function(elem){
	let img=document.getElementById("quizzHistoryImg")
	console.log(img)
	if (img.classList.contains("noOpacity")){
		img.classList.add("Opacity")
		img.classList.remove("noOpacity")
		console.log("on mets le button")
	}
}

let outImg=function(elem){
	console.log(elem)
	elem.classList.add("noOpacity")
	elem.classList.remove("Opacity")
		
}




