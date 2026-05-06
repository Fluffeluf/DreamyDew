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
        //echo("Hallo $username $userid");
        
        // Eingegebene Werte aus eintrag_eingabe.php in den Variablen Speichern
        $ueberschrift = $_POST["ueberschrift"];
        $text = $_POST["text"];
        $farbe = $_POST["farben"];
        
        // Datenbank öffnen + Maximale Eintrags ID holen
        include("../functions.php");
        $mydb = db_oeffnen();
        $sql1 = "select max(idmultimedia) as maxEintrag from multimedia;";
        $cursor1 = $mydb->query($sql1);
        $satz1 = $cursor1->fetch(PDO::FETCH_ASSOC);
        $id = $satz1["maxEintrag"]+1;

        // Prüft ob ein Datei-Upload-Feld mit dem Namen mediaFile existiert
        if(isset($_FILES['mediaFile']))
        {
            // Holt die hochgeladene Datei aus dem $_FILES Array
            $file = $_FILES['mediaFile'];

            // Definiert das Verzeichnis, wo Datei gespeichert werden soll
            $uploadDir = '../uploads/media/';

            // Gibt nur den Dateinamen wieder 
            $filename = basename($file['name']);

            // Erstellt vollständigen Pfad
            $targetFile = $uploadDir . $filename;

            // Bestimmt die Dateiendung in Kleinbuchstaben
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Legt fest, welche Dateiendungen erlaubt sind / -> Dateitypen quasi
            $allowedTypes = ['jpg','jpeg','png','gif','mp4','mov','avi'];

            // Prüft die Dateiendungen
            if(!in_array($fileType, $allowedTypes))
            {
                // Fehlermeldung falls nicht
                die("Dateityp nicht erlaubt. Bitte versuch es mit einem anderen Bild/Video erneut.<br><br>
                     <button type='submit' formaction='../pages/media.php' title='Zurück'>Zurück zur Medienseite</button>");
            }

            // Verschiebt die hochgeladene Datei vom temporären Verzeichnis an unseres
            if(move_uploaded_file($file['tmp_name'], $targetFile))
            {
                $sql = "insert into multimedia 
                        set idmultimedia = $id, 
                        ueberschrift='$ueberschrift',
                        text='$text',
                        erstelldatum=now(),
                        idbenutzer='$userid',
                        farbe='$farbe',
                        filename='$filename';";
                //echo("$sql<br>");
                $cursor = $mydb->exec($sql);

                // Überprüfung ob erfolgreicher Upload in DB
                if ($mydb->errorCode() != 0) 
                {
                    $fmeldung = $mydb->errorInfo();
                    echo("Fehler im Insert <br> $sql: Fehler: $fmeldung[2]<br>");
                    echo("<a href='../pages/start.php'>zurück zur Startseite</a>");
                } 
                else 
                {
                    echo("<form><div class='form-wrapper'>Upload erfolgreich<br><br>");
                    echo("<img src='$targetFile' width='200' height='150'><br><br>");
                    echo("<div class='container'><button type='submit' formaction='../pages/media.php' title='Zurück'>Zurück zur Medienseite</button></div></form>");
                }
            }
            else
            {
                // Fehlermeldung wenn verschieben der Datei nicht funktioniert hat
                echo("Fehler beim Upload. Bitte versuch es nochmal<br><br>");
                echo("<button type='submit' formaction='../pages/media.php' title='Zurück'>Zurück zur Medienseite</button>");
            }
        }
        $mydb = null;
    ?>
</body>
</html>