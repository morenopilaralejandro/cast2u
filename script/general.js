function clearInput(id) {
	var input = document.getElementById(id);
	input.value= "";
}

function showNav(){
    var nav = document.getElementById("headerNav");
    if(nav.className==="hideNav"){
        nav.className="showNav";
    }else{
        nav.className="hideNav";
    }
}
