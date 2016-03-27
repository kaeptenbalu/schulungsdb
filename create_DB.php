<?php
//mach db uff
$db = new SQLite3('./SchulungsDB.db');
//$dbhandle = sqlite_open('db/test.db', 0666, $error);

//tabelle uffrume
$db->exec('DROP TABLE If EXISTS Teilnehmer');
$db->exec('DROP TABLE If EXISTS Schulungen');
$db->exec('DROP TABLE If EXISTS Teilnehmer_Schulungen');
$db->exec('DROP TABLE If EXISTS Betriebe');
$db->exec('DROP TABLE If EXISTS Bildungsbeauftrager');


//tabelle Teilnehmer erstellen
$db->query('CREATE TABLE Teilnehmer (ID INTEGER PRIMARY KEY, vorname varchar(255), nachname varchar(255), mailadresse varchar(255), firma varchar(255), betrieb varchar(255))');
echo "Tabelle 'person' wurde erstellt \n";

//tabelle Schulungen
$db->exec('CREATE TABLE Schulungen (ID INTEGER PRIMARY KEY, name varchar(255), bezeichnung varchar(255), datum date, schulungsort varchar(255))');
echo "Tabelle 'Schulung' wurde erstellt \n";

//tabelle Teilnehmer_Schulung
$db->exec('CREATE TABLE Teilnehmer_Schulungen (teilnehmer_id INTEGER NOT NULL, schulung_id INTEGER NOT NULL, FOREIGN KEY(teilnehmer_id) REFERENCES teilnehmer(ID) ON DELETE CASCADE, FOREIGN KEY(schulung_id) REFERENCES Schulungen(ID) ON DELETE CASCADE)');
echo "Tabelle 'Teilnehmer_Schulung' wurde erstellt \n";

//tabelle Bildungsbeauftragter
$db->exec('CREATE TABLE Bildungsbeauftrager (ID INTEGER PRIMARY KEY, name varchar(255), vorname varchar(255), email varchar(255), telefonnumer varchar(15))');
echo "Tabelle 'Bildungsbeauftrager wurde erstellt \n";

//tabelle Betriebe
$db->exec('CREATE TABLE Betriebe (betriebsnummer INTEGER PRIMARY KEY, firma varchar(255), strasse varchar(255), plz varchar(10), ort varchar(100), bildungsbeauftrager_id INTEGER NOT NULL, FOREIGN KEY(bildungsbeauftrager_id) REFERENCES Bildungsbeauftrager(ID) ON DELETE CASCADE )');
echo "Tabelle 'Betriebe' wurde erstellt \n";
?>
