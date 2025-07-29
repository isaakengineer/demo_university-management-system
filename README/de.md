# Universität Management System

## Überblick

Diese Hauptanwendung dient als Platzhalter für ein vollständiges Universität-Management-System. Sie wurde entwickelt, um ein bestimmtes Paket (Multi-Level Approval System) innerhalb einer Laravel-Umgebung zu testen und zu demonstrieren. Die Anwendung bietet keine vollständigen Verwaltungsfunktionen, sondern enthält lediglich Beispieldatensätze und einige Seiten für Demonstrationszwecke.

## Technische Merkmale

- **Laravel Version:** 12
- **Authentifizierung:** Integrierte Laravel-Auth
- **Frontend:** Livewire für interaktive Komponenten
- **Datenbank:** Migrationen und Seeder für Beispieldaten

## Funktionen

1. **Nutzerverwaltung:**
   - Rollen: Student, Professor, Studiengangsleiter, Administrator
   - Automatische Anmeldung für Demonstrationszwecke
2. **Livewire-Komponenten:**
   - Übersicht der Nutzer nach Rollen
   - Semester- und Kursverwaltung für Studenten
   - Kursdetails für Professoren
3. **Datenmodell:**
   - Erweiterte User-Modelle mit Rollen und Departments
   - Semester- und Kursanmeldungen

## Installation

1. Klonen Sie das Repository; lieber mit `--recursive` Fahne durch `git` Befehl.
2. Führen Sie `composer install` aus.
3. Konfigurieren Sie die `.env`-Datei mit Ihren Datenbankeinstellungen.
4. Führen Sie die Migrationen und Seeder aus:
   ```bash
   php artisan migrate --seed
   ```
5. Starten Sie den Entwicklungsserver:
   ```bash
   php artisan serve
   ```

## Verwendung

- Navigieren Sie zur Hauptseite (`/`), um eine Liste aller Nutzer nach Rollen zu sehen.
- Klicken Sie auf einen Nutzer, um sich automatisch anzumelden und die entsprechende Rolle zu übernehmen.

## Lizenz

Diese Anwendung steht unter der AGPL-3.0 Lizenz.
