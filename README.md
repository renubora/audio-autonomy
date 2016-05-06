# groundhog
A VoiceXML application for seniors with early stage dementia

## Directions ##
You must have a server with LAMP running. This code can be dropped into the web server directory.

You can call the MySQL database 'groundhog' which is what we used, or else change the name in our code.

You can run groundhog.sql to populate the groundhog database to start with.

uses fullcalender.io, which has a great API and documentation


on fc/submit.php, line 53, database password 'abc123' should be updated:
 = new PDO('mysql:host=localhost;dbname=groundhog', 'root', 'abc123');
