<?php
    // PRODUCTION MODE: Datenbank wird geöffnet und alle Einträge die vorhanden sind ausgelesen
    $mydb = db_oeffnen();
    $eintraegeAbruf = "select eintraege.ueberschrift,
                       eintraege.eintrag,
                       date_format(eintraege.erstelldatum, '%d.%m.%Y %H:%i:%s') as ordererstelldatum,
                       date_format(eintraege.erstelldatum, '%d.%m.%Y %H:%i') as erstelldatumFormat,
                       eintraege.farbe,
                       benutzer.benutzername
                       from eintraege
                       inner join benutzer on eintraege.idbenutzer = benutzer.idbenutzer
                       order by ordererstelldatum desc;";
    $cursorEintraege=$mydb->query($eintraegeAbruf);
    $eintrag=$cursorEintraege->fetch(PDO::FETCH_ASSOC);
    // Start des speziellen 'Containers' für die Einträge-Cards
    echo("<div class='container'><section><div class='card-div-mother'>");
    while($eintrag)
    {
      // Ausgabe der individuellen Cards
        echo("<div class='card-div-daughter'>
				<div class='card' style='width:300px;max-width:300px;background:$eintrag[farbe];border:none'>
					<div class='card-body'>
						<div class='card-title'>
							<p class='h4'>$eintrag[ueberschrift]</p>
						</div>
            <p></p>
						<div class='card-text'>
							<p class='h6' style='color:#555555'>$eintrag[benutzername] am $eintrag[erstelldatumFormat]</p>
						</div>
						<div class='card-text'>
							<p class='h6'>$eintrag[eintrag]</p>
						</div>
						<br>
					</div>
				</div>
			</div>");
		  $eintrag=$cursorEintraege->fetch(PDO::FETCH_ASSOC);
    }
    echo("</div></section></div>");
?>