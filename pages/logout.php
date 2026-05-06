<html>
	<head>
		<title>DreamyDew</title>
		<meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/login.css">
		<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
	</head>
	<body>
		<?php 
		 session_start();
		 session_destroy();
		 echo("<div class='logoout'>");
		 echo("<img src='../assets/images/logo-mit-text.png' height='350px'>");
		 echo("<div class='form-wrapper'><form class='login-form'>Ihr Logout war erfolgreich und DreamyDew verabschiedet sich. <br><br>");
		 echo("<div class='container'><button type='submit' formaction='../pages/login.html' title='Login'>Login</button></form></div>");
		 echo("</div>");
		 ?>
	</body>
 </html>