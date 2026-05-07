<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/login.css?v=1.0">
    <title>DreamyDew</title>
</head>
<body>
<?php
        // Prüfung ob der User noch in der selben Session ist
        session_start();

        if(!isset($_SESSION['userid'])) {
        echo("Bitte zuerst einloggen<br><br>
              <a href='login.html'>Hier zum login</a>");
        exit;   
        }

$username = $_SESSION['username'];
$userid   = $_SESSION['userid'];
        //echo("Hallo $username $userid");
        
        // Eingegebenen Werte aus eintrag_eingabe.php in den Variablen Speichern
        $ueberschrift = $_POST["ueberschrift"];
        $text = $_POST["text"];
        $farbe = $_POST["farben"];

        include("../function.php");


        // Datenbank öffnen + Maximale Eintrags ID holen
        $mydb = db_oeffnen();
        $sql1 = "select max(ideintrag) as maxEintrag from eintraege;";
        $cursor1 = $mydb->query($sql1);
        $satz1 = $cursor1->fetch(PDO::FETCH_ASSOC);
        // EintragsID um 1 erhöhen
        $id = $satz1["maxEintrag"]+1;

        // Eintrag in die Datenbank speichern
        $sql = "insert eintraege (ueberschrift, eintrag, idbenutzer, farbe)
                values ('$ueberschrift', '$text', '$userid', '$farbe');";
        //echo("$sql");
        $cursor = $mydb->exec($sql);

        // Überprüfung ob erfolgreicher Upload
        if ($mydb->errorCode() != 0)
		{
			$fmeldung = $mydb->errorInfo();
			echo("Fehler im Insert <br> $sql: Fehler: $fmeldung[2]<br>");
            echo("<a href='../pages/start.php'>zurück zur Startseite</a>");
		}
		else
	    {
            echo("<form><div class='form-wrapper'>Upload erfolgreich<br><br>");
		    echo("<div class='container'><button type='submit' formaction='../pages/start.php' title='Zurück'>Zurück zum Gästebuch</button></div></form>");
		}
					

        $mydb = null;
    ?>
</body>
</html>
