const signInBtn = document.getElementById("signIn");
const signUpBtn = document.getElementById("signUp");
const fistForm = document.getElementById("form1");
const secondForm = document.getElementById("form2");
const container = document.querySelector(".container");

signInBtn.addEventListener("click", () => {
	container.classList.remove("right-panel-active");
});

signUpBtn.addEventListener("click", () => {
	container.classList.add("right-panel-active");
});

fistForm.addEventListener("submit", (e) => e.preventDefault());
secondForm.addEventListener("submit", (e) => e.preventDefault());

function validateC(){
	var username = document.getElementById("usernameC").value;
	var password = document.getElementById("passwordC").value;
	if ( username == "Conductor" && password == "12345678"){
	alert ("Login successfully");
	window.location = "../../Conductor_DashBoard/conductorDashboard.html"; // Redirecting to other page.
	return true;
	}
	else 
	{
		alert("incorrect password or username");
		return false
	}
	}
	
	function validateD(){
		var username = document.getElementById("usernameD").value;
		var password = document.getElementById("passwordD").value;
		if ( username == "Driver" && password == "12345678"){
		alert ("Login successfully");
		window.location = "../../Conductor_DashBoard/Driver_Dashboard.html"; // Redirecting to other page.
		return true;
		}
		else 
		{
			alert("incorrect password or username");
			return false
		}
		}