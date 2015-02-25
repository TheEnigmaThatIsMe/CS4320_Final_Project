function userNamePassCheckAlert() {
	alert("Invalid Username/Password");
}

function registrationPassCheckAlert(){
	alert("Passwords do not match!");
}

function usernameRegistrationAlert(){
	alert("That username has already been registered! Please try another.");
}

function resetForm() {
    document.getElementById("register").reset();
}

function invalidLobby(){
	confirm("You have entered an invalid lobby name or that lobby already exists, please try another name!");
}

function validLobby(){
	alert("You have successfully joined the lobby");
}
function alreadyIn(){
	alert("You are Already Part of that lobby, redirecting you to lobby page!");
}
function cant(){
	alert("There is to many players in that lobby!");
}
