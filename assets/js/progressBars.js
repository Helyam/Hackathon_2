var container = document.getElementById("body");

var barPos = document.createElement('DIV');
barPos.style.backgroundColor = "green";
barPos.style.height = "60%";

var barNeg = document.createElement('DIV');
barNeg.style.backgroundColor = "red";
barNeg.style.height = "40%";

container.appendChild(barPos);
container.appendChild(barNeg);