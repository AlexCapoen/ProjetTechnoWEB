let onButtonAnimals=function(elem){
	let button=document.getElementById("quizzAnimals")
	console.log(button)
	if (button.classList.contains("notAvailable")){
		button.classList.add("available")
		button.classList.remove("notAvailable")
		console.log("on mets le button")
	}
}

let onButtonHistory=function(elem){
	let button=document.getElementById("quizzHistory")
	console.log(button)
	if (button.classList.contains("notAvailable")){
		button.classList.add("available")
		button.classList.remove("notAvailable")
		console.log("on mets le button")
	}
}

let offButton=function(elem){
    event.stopPropagation();
	console.log('on est dans le content')
	let buttonAnimals=document.getElementById("quizzAnimals")
	let buttonHistory=document.getElementById("quizzHistory")
	if (buttonAnimals.classList.contains("available")){
		buttonAnimals.classList.add("notAvailable")
		buttonAnimals.classList.remove("available")
		console.log("on enleve le button")
	}
	if (buttonHistory.classList.contains("available")){
		buttonHistory.classList.add("notAvailable")
		buttonHistory.classList.remove("available")
		console.log("on enleve le button")
	}

}



