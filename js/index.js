//responsive-nav-bar-script


	function openNav(){
		document.getElementById("mysidenav").style.width = "250px";
		document.getElementById('main').style.marginLeft= '0px';
		document.body.style.backgroundColor = 'rgba(0,0,0,0.4)';
	}
	function closeNav(){
		 document.getElementById("mysidenav").style.width = "0";
		 document.getElementById('main').style.marginLeft= '0';
		 document.body.style.backgroundColor = 'white';
	}

	//counter-script
$(document).ready(function(){
	$(".counter").counterUp({
		delay: 10,
		time: 1200
	});
});

//  script for back to top scroll

var toTop = document.querySelector(".to-top");
window.addEventListener("scroll",() =>{
    if(window.pageYOffset>100){
        toTop.classList.add("effect");
    }else{
        toTop.classList.remove("effect")
    }
})




var overlay = document.getElementById("overlay");

windows.addEventListener ('load',function(){
	overlay.style.display = 'none';
})
