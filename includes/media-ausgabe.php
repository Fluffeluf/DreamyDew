<?php 
    // PRODUCTION MODE: Datenbank wird geöffnet und alle Einträge die vorhanden sind ausgelesen
    $mydb = db_oeffnen();
    $medienAbruf = "select multimedia.ueberschrift,
                       multimedia.text,
                       multimedia.filename,
                       date_format(multimedia.erstelldatum, '%d.%m.%Y %H:%i:%s') as ordererstelldatum,
                       date_format(multimedia.erstelldatum, '%d.%m.%Y %H:%i') as erstelldatumFormat,
                       multimedia.farbe,
                       benutzer.benutzername
                       from multimedia
                       inner join benutzer on multimedia.idbenutzer = benutzer.idbenutzer
                       order by ordererstelldatum desc;";
    $cursorMedia=$mydb->query($medienAbruf);
    $medien=$cursorMedia->fetch(PDO::FETCH_ASSOC);

    // Ordner in dem die Uploads gespeichert werden als Variable festlegen
    $ordner = '../uploads/media/';
    // Start des speziellen 'Containers' für die Einträge-Cards
    echo("<div class='container'><section><div class='card-div-mother'>");
    while($medien)
    {
        // Den Dateipfad der Bilder zusammenstellen mit Ordner und
        // dem Dateinamen aus der Datenbank
        $targetFile = $ordner . $medien['filename'];

        // Ausgabe der individuellen Cards mit Bildern
        echo("<div class='card-div-daughter'>
				<div class='card' style='width:300px;max-width:300px;background:$medien[farbe];border:none'>
					<div class='card-body'>
						<div class='card-title'>
							<p class='h4'>$medien[ueberschrift]</p>
						</div>
                        <img src='$targetFile' width='250' height='150' style='border-radius:5px'>
                        <p></p>
						<div class='card-text'>
							<p class='h6' style='color:#555555'>$medien[benutzername] am $medien[erstelldatumFormat]</p>
						</div>
						<div class='card-text'>
							<p class='h6'>$medien[text]</p>
						</div>
						<br>
					</div>
				</div>
			</div>");
		$medien=$cursorMedia->fetch(PDO::FETCH_ASSOC);
    }
    echo("</div></section></div>");
?>