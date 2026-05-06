<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DreamyDew</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../assets/css/login.css?v=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        // Daten werden von der Regestrierung.html angenommen
        $user = $_POST["username"];
        $pw = $_POST["passwort"];

        // Datenbank öffnen
        include("../functions.php");
        $mydb = db_oeffnen();

        // Max ID aus Datenbank holen für den neuen Nutzer
        $sql1 = "select max(idbenutzer) as maxId from benutzer;";
        $cursor1 = $mydb->query($sql1);
        $satz1 = $cursor1->fetch(PDO::FETCH_ASSOC);
        //ID um 1 erhöhen
        $id = $satz1["maxId"]+1;
        
        // Neuen Nutzer in die Datenbank einfügen
        $sql = "insert into benutzer (idbenutzer, Benutzername, Passwort)
                    values($id, '$user', $pw);";
        $cursor = $mydb->exec($sql);
       
        // Benutzer zur Login-Seite schicken
        echo("<div class='form-wrapper'>
                <div class='login-form'>");
        echo("<p class='h4'>Ihr Benutzer $user wurde erfolgreich angelegt und DreamyDew heißt sie herlich willkommen.</p>");
        echo("<br><a href='../pages/login.html'>Zurück zum Login</a>
                </div>
              </div>");
        
        $mydb = null;
    ?>
</body>
</html>