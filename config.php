<?php
/**
 * DreamyDew Konfigurationsdatei
 * Setzen Sie DEVELOPMENT_MODE auf true für Testdaten ohne Datenbank
 */

// Development Mode aktivieren für Testdaten
define('DEVELOPMENT_MODE', true);

// Mock-Daten für Entwicklung
function getMockEintraege() {
    return [
        [
            'ueberschrift' => 'Willkommen bei DreamyDew!',
            'eintrag' => 'Dies ist ein Test-Eintrag. Die Seite läuft im Entwicklungsmodus ohne Datenbankverbindung.',
            'benutzername' => 'TestUser',
            'erstelldatumFormat' => date('d.m.Y H:i'),
            'farbe' => '#EEC0DA'
        ],
        [
            'ueberschrift' => 'Zweiter Eintrag',
            'eintrag' => 'Hier könnte Ihr Gästebucheintrag stehen. Im Produktivmodus werden echte Daten aus der Datenbank geladen.',
            'benutzername' => 'DemoUser',
            'erstelldatumFormat' => date('d.m.Y H:i', strtotime('-1 hour')),
            'farbe' => '#F0C6A4'
        ],
        [
            'ueberschrift' => 'Dritter Test-Eintrag',
            'eintrag' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Dies ist ein längerer Beispieltext.',
            'benutzername' => 'TestUser',
            'erstelldatumFormat' => date('d.m.Y H:i', strtotime('-2 hours')),
            'farbe' => '#FEF4AC'
        ],
        [
            'ueberschrift' => 'Vierter Eintrag',
            'eintrag' => 'Noch ein Beispiel-Eintrag für die Entwicklung.',
            'benutzername' => 'AdminTest',
            'erstelldatumFormat' => date('d.m.Y H:i', strtotime('-3 hours')),
            'farbe' => '#B3DECD'
        ],
        [
            'ueberschrift' => 'Fünfter Eintrag',
            'eintrag' => 'Die Farben wechseln automatisch zwischen den verschiedenen Pastelltönen.',
            'benutzername' => 'DemoUser',
            'erstelldatumFormat' => date('d.m.Y H:i', strtotime('-5 hours')),
            'farbe' => '#BAE8F4'
        ],
        [
            'ueberschrift' => 'Letzter Test-Eintrag',
            'eintrag' => 'Dies ist der letzte Mock-Eintrag. Schalten Sie DEVELOPMENT_MODE auf false für echte Daten.',
            'benutzername' => 'TestUser',
            'erstelldatumFormat' => date('d.m.Y H:i', strtotime('-1 day')),
            'farbe' => '#C8B3F9'
        ]
    ];
}

function getMockMedia() {
    return [
        [
            'ueberschrift' => 'Test-Bild 1',
            'text' => 'Dies ist ein Platzhalter für ein Medienelement.',
            'filename' => 'placeholder.jpg',
            'benutzername' => 'TestUser',
            'erstelldatumFormat' => date('d.m.Y H:i'),
            'farbe' => '#EEC0DA'
        ],
        [
            'ueberschrift' => 'Test-Bild 2',
            'text' => 'Im Produktivmodus werden hier echte Bilder angezeigt.',
            'filename' => 'placeholder.jpg',
            'benutzername' => 'DemoUser',
            'erstelldatumFormat' => date('d.m.Y H:i', strtotime('-2 hours')),
            'farbe' => '#F0C6A4'
        ]
    ];
}

// Mock-User für Login
function getMockUser() {
    return [
        'idbenutzer' => 1,
        'Benutzername' => 'test',
        'Passwort' => 'test123' // Im echten System: password_hash('test123', PASSWORD_DEFAULT)
    ];
}
?>

// Made with Bob
