<!doctype html>
<html>
  <head>
    <meta charset='utf-8' />

    <!-- jQuery -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js'></script>

    <!-- Firebase -->
    <script src='https://cdn.firebase.com/js/client/2.0.2/firebase.js'></script>

    <!-- Firechat -->
    <link rel='stylesheet' href='https://cdn.firebase.com/libs/firechat/2.0.1/firechat.min.css' />
    <script src='https://cdn.firebase.com/libs/firechat/2.0.1/firechat.min.js'></script>
  </head>
  <body>
    <script type='text/javascript'>
      // Create a new Firebase reference, and a new instance of the Login client
      var chatRef = new Firebase('https://concurrent-chat.firebaseio.com');
	  chatRef.createUser({
		  email    : <?php echo '"' . $email . '"'; ?>,
		  password : "correcthorsebatterystaple"
		}, function(error, userData) {
		  if (error) {
			console.log("Error creating user:", error);
		  } else {
			console.log("Successfully created user account with uid:");
		  }
		});
		
		chatRef.authWithPassword({
		  email    : <?php echo '"' . $email . '"'; ?>,
		  password : "correcthorsebatterystaple"
		}, function(error, authData) {
		  if (error) {
			console.log("Login Failed!", error);
		  } else {
			console.log("Authenticated successfully with payload:", authData);
		  }
		});
		
      chatRef.onAuth(function(authData) {
        // Once authenticated, instantiate Firechat with our user id and user name
        if (authData) {
          var chat = new FirechatUI(chatRef, document.getElementById('firechat-wrapper'));
		  authData[authData.provider].displayName = <?php echo '"' . $name . '"'; ?>;
          chat.setUser(authData.uid, authData[authData.provider].displayName);
        }
      });
      function login(provider) {
        chatRef.authWithOAuthPopup(provider, function(error, authData) {
          if (error) {
            console.log(error);
          }
        });
      }
    </script>
    <div id='firechat-wrapper'>

    </div>
  </body>
</html>