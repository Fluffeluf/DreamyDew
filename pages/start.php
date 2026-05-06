<html>
	<head>
		<title>DreamyDew</title>
		<meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../assets/css/blog-start.css?v=1.0">
		<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
		<script src="../assets/js/toggle-aside.js" defer></script>
	</head>
	<body>
    <!--Form-Tag der den eingegebenen Eintrag zum Upload weitergibt-->
	<form action="../actions/eintrag-upload.php" method="post">
		<?php
		    session_start();
		          
			// Konfiguration laden
		    //include("../config.php");
		          
		    // Hier wird geschaut ob der User sich schon angemeldet hat damit er
			// weiter arbeiten darf z.B. von Medien zurück zu Start besonders hilfreich
		    if (isset($_SESSION['username']) && isset($_SESSION['id']) && $_SESSION['id'] === session_id())
		    {
				// In den Variablen die Werte aus der Session speichern
		    	$username = $_SESSION['username'];
		        $userid = $_SESSION['userid'];
		        //echo("Schon drin $username $userid");

				// Ausgelagerte PHP Seiten Zugriff
		        include("../includes/navbar-start.php");
		        include("../includes/eintrag-ausgabe.php");
		        include("../includes/eintrag-eingabe.php");
		        exit;
		    }

		    if($_SERVER['REQUEST_METHOD'] === 'POST')
		    {
		        // In den Variablen die Werte der Login.html speichern
		        $username = $_POST['username'];
		        $passwort = $_POST['passwort'];
		              
		        // Prüfen ob nicht doch irgendwie keine Eingabe stattgefunden hat
		        if($username === '' || $passwort === '')
		        {
		            echo("Benutzername und Passwort erforderlich<br><br>
		                <a href='login.html'>Hier zum login</a>");
		            exit;
		        }

		        // DEVELOPMENT MODE: Mock-Login
		        /*if(DEVELOPMENT_MODE) {
		        $mockUser = getMockUser();
		                  
		        // Einfacher Login für Testzwecke
		            if($username === $mockUser['Benutzername'] && $passwort === $mockUser['Passwort']) {
		            $_SESSION['username'] = $username;
		            $_SESSION['userid'] = $mockUser['idbenutzer'];
		            $_SESSION['id'] = session_id();
		                      
		            // Ausgelagerte PHP Seiten Zugriff
		            include("../includes/navbar-start.php");
		            include("../includes/eintrag-ausgabe.php");
		            include("../includes/eintrag-eingabe.php");
		            exit;
		        } else {
		            echo("<div style='text-align:center;margin-top:50px;'>");
		            echo("<p>DEVELOPMENT MODE: Verwenden Sie 'test' / 'test123'</p>");
		            echo("<p>Bitte überprüfen Sie Benutzername oder Passwort.</p><br>");
		            echo("<a href='login.html'>Hier zum Login</a>");
		            echo("</div>");
		            exit;
		        }*/
		    }

		    // PRODUCTION MODE: Datenbank-Login
			include("../function.php");
			$mydb = db_oeffnen();
			$sql = "select idbenutzer, Benutzername, Passwort
					from benutzer;";
			$cursor=$mydb->query($sql);
			$satz=$cursor->fetch(PDO::FETCH_ASSOC);
			$found = false;
			while($satz)
			{
		        // Wenn der Benutzer gefunden ist wird:
				if($satz['Benutzername'] == $username && $satz['Passwort'] == $passwort)
				{
		            // -> mit einem Bool bestätigt das der User gefunden ist
					$found = true;
		            // -> Session Variablen vergeben + aus der Datenbank
		            // die NutzerID ebenfalls als Session Variable vergeben (später relevant)
		        	// aktuelle Session ID speichern
		            $_SESSION['username'] = $username;
		            $_SESSION['userid'] = $satz['idbenutzer'];
		            $_SESSION['id'] = session_id();
		            //echo("Wilkommen $username $satz[idbenutzer]");

		            // -> Ausgelagerte PHP Seiten Zugriff
		            include("../includes/navbar-start.php");
		            include("../includes/eintrag-ausgabe.php");
		            include("../includes/eintrag-eingabe.php");
		            break;
		        }

		        // Weiter in der Datenbank nach dem Nutzer suchen
		        $satz=$cursor->fetch(PDO::FETCH_ASSOC);
		    }

		    // Wenn der Nutzer nicht gefunden wurde, also
		    // in der while der bool nicht auf true gesetzt wurde
		    // dann Fehlermeldung
		    if(!$found)
		    {
		        echo("Bitte überprüfen Sie ob der Benutzername und das Passwort passen.<br><br>
		            <a href='login.html'>Hier zum Login</a>");
		        exit;
		    }
		    $mydb=null;
		 ?>
	</form>
	</body>
 </html>
