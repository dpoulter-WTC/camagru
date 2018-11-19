(function() {
	var register = null;
	function startup() {
		register = document.getElementById('register');
		register.addEventListener('click', function(ev){
			check();
		}, false);
	}
	function check() {
		var pass = document.getElementById('passwd').value;
		var cpass = document.getElementById('cpasswd').value;
		if (pass.match("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})"))
		{
			if (pass === cpass)
				document.getElementById("form").submit();
			else {
				alert("Please enter the same password");
			}
		} else {
			alert("Please enter a secure password, \n\u2022 Between 8-20 characters \n\u2022 At least 1 lowercase \n\u2022 At least 1 upercase \n\u2022 At least 1 number");
		}
	}
	window.addEventListener('load', startup, false);
})();
