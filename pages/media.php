<html>
	<head>
		<title>DreamyDew</title>
		<meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/blog-media.css?v=1.0">
		<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
		<script src="../assets/js/toggle-aside.js" defer></script>
	</head>
	<body>
	<form action="../actions/media-upload.php" method="post" enctype='multipart/form-data'>
		<?php
			// Prüfung ob der User noch in der selben Session ist 
		    session_start();
            //include("../config.php");
            //include("../../funktionen.php");
            if(!isset($_SESSION['id']) || $_SESSION['id']!=session_id())
            {
                echo("Bitte zuerst einloggen<br><br>
                  <a href='login.html>Hier zum login</a>");
            	exit;
            }
			// Session Variablen weitergeben
            $username = $_SESSION['username'];
            $userid = $_SESSION['userid'];
			$id=$_SESSION['id'];

			// Ausgelagerte PHP Seiten Zugriff für Media
            include("../includes/navbar-media.php");
            include("../includes/media-ausgabe.php");
            include("../includes/media-eingabe.php");
		 ?>
	</form>
	</body>
 </html>