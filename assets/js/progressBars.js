let container = document.getElementById("barDiv");

let barPos = document.createElement('div');
barPos.style.backgroundColor = "green";
barPos.style.width = "60%";

let barNeg = document.createElement('div');
barNeg.style.backgroundColor = "red";
barNeg.style.width = "40%";


let paragraphPos = document.createElement("span");
let textPos = document.createTextNode("some text");
paragraphPos.appendChild(textPos);


let paragraphNeg = document.createElement("span");
let textNeg = document.createTextNode("some text");
paragraphNeg.appendChild(textNeg);




barPos.appendChild(paragraphPos);
barNeg.appendChild(paragraphNeg);


container.appendChild(barPos);
container.appendChild(barNeg);