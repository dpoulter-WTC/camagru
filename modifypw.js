(function() {
	var register = null;
	function startup() {
		register = document.getElementById('button_submit');
		register.addEventListener('click', function(ev){
			check();
		}, false);
	}
	function check() {
		var newpw = document.getElementById('newpw').value;
		var cnewpw = document.getElementById('cnewpw').value;
		if (newpw.match("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})"))
		{
			if (newpw === cnewpw)
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
