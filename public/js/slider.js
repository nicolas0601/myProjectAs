var slider = document.getElementById("slider");
var leftPos = 0;
var currentPicture ;
var interval;
function animatePicture()
{
	leftPos += currentPicture.width /1000;
	currentPicture.style.left = leftPos + "px";
	if (leftPos >= currentPicture){
		window.clearInterval(interval);
        //cette fonction déplace la derniere photo juste avant la premiere, dans le slider
	    slider.insertBefore(currentPicture, slider.firstChild);
		currentPicture.style.left = 0;
		leftPos = 0;
		window.setTimeout(changePicture, 10000);
    }
}	

function changePicture()
{
    //console.log("changing picture");
	//console.log(slider.lastElementChild);
	//ceci est l'image visible (le dernier élément dans le slider)
	currentPicture = slider.lastElementChild;
	interval = window.setInterval(animatePicture, 1);	
}
window.setTimeout(changePicture, 10000);







