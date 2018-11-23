<!DOCTYPE html>
<html>
<head>
	<title>App con notificaciones</title>
	<link rel="manifest" href="manifest.json">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
	</script>
	<script src="https://www.gstatic.com/firebasejs/5.5.9/firebase.js"></script>

	<script>
		// Initialize Firebase
		var config = {
		  apiKey: "AIzaSyBfMu1BXLS78XzMrYXB9Bn2Oqm0j1BOyEc",
		  authDomain: "practica5-sanchez.firebaseapp.com",
		  databaseURL: "https://practica5-sanchez.firebaseio.com",
		  projectId: "practica5-sanchez",
		  storageBucket: "",
		  messagingSenderId: "62966924922"
		};
		firebase.initializeApp(config);

		// Retrieve Firebase Messaging object
		const messaging = firebase.messaging();

		function getRegToken(){
		  messaging.getToken().then(function(currentToken) {
		    if (currentToken) {

		      console.log(currentToken)

		      if (isTokenSentToServer()){
		      	console.log("Ya fue enviado");
		      } else {
		      	console.log("Enviando token");
		      	saveToken(currentToken)
		      	setTokenSentToServer(true);
		      }
		      
		    } else {
		        // Show permission request.
		        setTokenSentToServer(false);
		        console.log('No Instance ID token available. Request permission to generate one.');
		    }
		  }).catch(function(err) {
		  	setTokenSentToServer(false);
		    console.log('An error occurred while retrieving token. ', err);
		  });
		}

		function setTokenSentToServer(sent) {
		    window.localStorage.setItem('sentToServer', sent ? 1 : 0);
		}

		function saveToken(currentToken){
			$.ajax({
				url:'action.php',
				method:'post',
				data: 'token=' + currentToken
			}).done(function(result){
				console.log(result)
			})
			setTokenSentToServer(true);
		}

		function isTokenSentToServer() {
			return window.localStorage.getItem('sentToServer') == 1;
		}

		messaging.requestPermission().then( function() {
		  console.log('Notification permission granted.');
		  getRegToken();
		}).catch(function(err){
		  console.log('Unable to get permission to notify.',err);
		});

		messaging.onMessage(function(payload){
		var title = payload.data.title;
		var options = {
			body: payload.data.body,
			icon: payload.data.icon
		}

		var myNotification = new Notification(title, options);
			console.log('Mensaje recibidio', payload)
		})
	</script>
</head>
<body>
	<h1> App con notificaciones </h1>
</body>
</html>