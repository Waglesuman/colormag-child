	/* A regular expression that checks if the email is valid. */
	const email_regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

	function validateForm() {
	/* Getting the value of the input fields. */
		var fullName = document.getElementById("full-name").value;
		var email = document.getElementById("email").value;
		var bio = document.getElementById("bio").value;
		var location = document.getElementById("location").value;
	  var profilepicture = document.getElementById("profilePicture").value;
	/* Checking if the input fields are empty. If they are empty, it will alert the user that the field
	must be filled out. */
		if (fullName == "") {
			alert("Full name must be filled out");
			return false;
		}
		if (bio == "") {
			alert("Bio must be filled out");
			return false;
		}
		if (location == "") {
			alert("Location must be filled out");
			return false;
		}

		if (profilepicture == ""){
			alert("Choose the profile picture");
			return false;
		}

		if (!(email_regex.test(email)) || (email == "")) {
			alert('Please enter a valid email address');
			return false;
		}


		return true;
	}
