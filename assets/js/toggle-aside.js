/**
 * Toggle Aside - Ausklappbare Eingabemaske für mobile Geräte
 * Zeigt einen Floating Button, der die Eingabemaske ein-/ausblendet
 */

document.addEventListener('DOMContentLoaded', function() {
    // Nur für Bildschirme < 1200px aktivieren
    function initToggleAside() {
        if (window.innerWidth <= 1199) {
            // Prüfen ob Button bereits existiert
            if (document.querySelector('.toggle-aside-btn')) return;
            
            // Floating Button erstellen
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'toggle-aside-btn';
            toggleBtn.innerHTML = '✏️';
            toggleBtn.setAttribute('aria-label', 'Eingabemaske öffnen');
            toggleBtn.setAttribute('title', 'Neuen Eintrag schreiben');
            document.body.appendChild(toggleBtn);
            
            // Overlay erstellen (dunkler Hintergrund)
            const overlay = document.createElement('div');
            overlay.className = 'aside-overlay';
            document.body.appendChild(overlay);
            
            // Aside Element finden
            const aside = document.querySelector('aside');
            if (!aside) return;
            
            // Close Button zum Aside hinzufügen
            const closeBtn = document.createElement('button');
            closeBtn.className = 'aside-close-btn';
            closeBtn.innerHTML = '✕';
            closeBtn.setAttribute('aria-label', 'Schließen');
            closeBtn.setAttribute('title', 'Schließen');
            aside.insertBefore(closeBtn, aside.firstChild);
            
            // Button Click - Öffnen
            toggleBtn.addEventListener('click', function() {
                aside.classList.add('active');
                overlay.classList.add('active');
                toggleBtn.style.display = 'none';
                document.body.style.overflow = 'hidden'; // Scrollen verhindern
            });
            
            // Overlay Click - Schließen
            overlay.addEventListener('click', function() {
                closeAside();
            });
            
            // Close Button Click
            closeBtn.addEventListener('click', function() {
                closeAside();
            });
            
            // ESC Taste - Schließen
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && aside.classList.contains('active')) {
                    closeAside();
                }
            });
            
            // Funktion zum Schließen
            function closeAside() {
                aside.classList.remove('active');
                overlay.classList.remove('active');
                toggleBtn.style.display = 'flex';
                document.body.style.overflow = ''; // Scrollen wieder erlauben
            }
        } else {
            // Bei größeren Bildschirmen: Button und Overlay entfernen
            const btn = document.querySelector('.toggle-aside-btn');
            const overlay = document.querySelector('.aside-overlay');
            const closeBtn = document.querySelector('.aside-close-btn');
            
            if (btn) btn.remove();
            if (overlay) overlay.remove();
            if (closeBtn) closeBtn.remove();
            
            // Aside zurücksetzen
            const aside = document.querySelector('aside');
            if (aside) {
                aside.classList.remove('active');
            }
            document.body.style.overflow = '';
        }
    }
    
    // Initial ausführen
    initToggleAside();
    
    // Bei Fenster-Resize neu initialisieren
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            initToggleAside();
        }, 250);
    });
});