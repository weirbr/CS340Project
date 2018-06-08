//maybe add 2 more inputs for login???
function validate(pswd, user){
    
	re1 = /[0-9]/;
	re2 = /[a-z]/;
	re3 = /[A-Z]/;
	
    if( ! re1.test(pswd.value) || ! re1.test(user.value)) {
		alert("Passwords and usernames must contain at least one digit");
		return false;
    }
    if( ! re3.test(pswd.value)) {
		alert("Passwords must contain at least one uppercase letter");
		return false;
    }	
    if( ! re2.test(pswd.value)) {
		alert("Passwords must contain at least one lowercase letter");
		return false;
    }
	if( pswd.value.length < 6 || user.value.length < 6) {
		alert("Passwords and usernames must have at least 6 characters");
		return false;
    }		
}

function isBlank(inputField){
    if(inputField.type=="checkbox"){
		if(inputField.checked)
			return false;
		return true;
    }
    if (inputField.value==""){
		return true;
    }
    return false;
}

//function to highlight an error through colour by adding css attributes tot he div passed in
function makeRed(inputDiv){
   	inputDiv.style.backgroundColor="#AA0000";
	//inputDiv.parentNode.style.backgroundColor="#AA0000";
	inputDiv.parentNode.style.color="#FFFFFF";		
}

//remove all error styles from the div passed in
function makeClean(inputDiv){
	inputDiv.parentNode.style.backgroundColor="#FFFFFF";
	inputDiv.parentNode.style.color="#000000";		
}

//the main function must occur after the page is loaded, hence being inside the wondow.onload event handler.
window.onload = function(){
    var myForm = document.getElementById("addForm");

    //all inputs with the class required are looped through 
    var requiredInputs = document.querySelectorAll(".required");
    for (var i=0; i < requiredInputs.length; i++){
	requiredInputs[i].onfocus = function(){
		this.style.backgroundColor = "#EEEE00";
	}
    }
    myForm.onsubmit = function(e){

	var pswd = document.getElementById('password');
	var user = document.getElementById('username');
	var temp = validate(pswd,user);

	    	//if inputs are not validated...
		if(temp == false ){
			e.preventDefault();
			makeRed(requiredInputs[i]);
		}
	    	//if good inputs, make clean
		else{
			makeClean(requiredInputs[i]);
		} 
	}   
}
