# groundhog
A VoiceXML application for seniors with early stage dementia.

Uses fullcalender.io, which has a great API and documentation. It is front-end only, so we connected it to our own back-end system.

NOTE: as a proof of concept, there is virtually no security implemented, so do not use for any actual sensitive data.


## Directions ##
1) You must have a web server with LAMP running. This code can be dropped into the web server directory.

2) You can call the MySQL database 'groundhog' which is the name we used, or else change the name in our code.

3) You can run groundhog.sql to populate the groundhog database initially.
- the 'caregiver' table allows different people who login to each have their own calendar
- the 'patients' table allows different patients to have their own VoiceXML programming, to phone into the voxeo system, have a pin#, to recieve calls, and to have a phone # for emergency help calls.
- the 'events' table holds all the event data for questions and answeres


in funk.php (which has utility functions), line 34, the database password 'abc123' should be updated

on fc/submit.php, line 53, the database password 'abc123' should be updated

