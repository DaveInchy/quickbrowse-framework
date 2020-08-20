var navbar = (scrollDown) => {
	
	//Set variables.
	var header = document.getElementsByTagName("HEADER");
	var nav = document.getElementsByClassName("navbar");
	var brand = document.getElementsByClassName("navbar-brand");
	var collapse = document.getElementsByClassName("navbar-collapse");
	var position = window.scrollY;
	var ismobile = false;
	
	if( //check for matched userAgent.
		navigator.userAgent.match(/Android/i)
		|| navigator.userAgent.match(/webOS/i)
		|| navigator.userAgent.match(/iPhone/i)
		|| navigator.userAgent.match(/iPad/i)
		|| navigator.userAgent.match(/iPod/i)
		|| navigator.userAgent.match(/BlackBerry/i)
		|| navigator.userAgent.match(/Windows Phone/i)
	){
		ismobile = true;
	}
	
	if( header.length == 0 || ismobile ){
		//Making navbar non-transparent.
		collapse[0].classList.remove("scrolled-false");
		collapse[0].classList.add("scrolled-true");

		brand[0].classList.remove("scrolled-false");
		brand[0].classList.add("scrolled-true");

		nav[0].classList.add("navbar-light");
		nav[0].classList.add("text-dark");
		nav[0].classList.remove("nav-fade-out");
		nav[0].classList.add("nav-fade-in");
		return true;
	}else{
		if( position >= (header[0].clientHeight - nav[0].clientHeight) ){
			//Making navbar non-transparent.
			collapse[0].classList.remove("scrolled-false");
			collapse[0].classList.add("scrolled-true");

			brand[0].classList.remove("scrolled-false");
			brand[0].classList.add("scrolled-true");

			nav[0].classList.add("navbar-light");
			nav[0].classList.add("text-dark");
			nav[0].classList.remove("nav-fade-out");
			nav[0].classList.add("nav-fade-in");
			return true;
		}else{
			//Making navbar transparent.
			collapse[0].classList.remove("scrolled-true");
			collapse[0].classList.add("scrolled-false");
			
			brand[0].classList.remove("scrolled-true");
			brand[0].classList.add("scrolled-false");
			
			nav[0].classList.remove("navbar-light");
			nav[0].classList.remove("text-dark");
			
			if(nav[0].classList.contains("nav-fade-in")){
				nav[0].classList.remove("nav-fade-in");
				nav[0].classList.add("nav-fade-out");
			}
			return true;
		}
	}
}

//Listen for Events.
bootstrapNavbar = navbar();
window.addEventListener('scroll', navbar);