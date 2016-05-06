# groundhog
A VoiceXML application for seniors with early stage dementia.

Uses fullcalender.io, which has a great API and documentation. It a front-end interface, so we connected it to our own back-end system. It also uses Aspect.com's free VoiceXML IVR platform service "Prophecy"  (originally a Voxeo product, before Aspect purchased Voxeo).

NOTE: as a proof of concept, there is virtually no security implemented, so do not use for any actual sensitive data. See "Security Issues" below.


## Instructions ##
1) You must have a web server with LAMP running. This code can be dropped into the web server directory. index.html is the initial login page, which uses the 'caregiver' table to identify the user/password.

2) You can call the MySQL database 'groundhog' which is the name we used, or else change the name in our code.

3) You can run groundhog.sql to populate the groundhog database initially.
- the 'caregiver' table allows different people who login to each have their own calendar
- the 'patients' table allows different patients to have their own VoiceXML programming, to phone into the voxeo system, have a pin#, to recieve calls, and to have a phone # for emergency help calls.
- the 'events' table holds all the event data for questions and answeres

4) Database credentials
- in funk.php (which has utility functions), line 34, the database password 'abc123' should be updated
- in fc/submit.php, line 53, the database password 'abc123' should be updated
- in fc/events.php, line 66, the database password 'abc123' should be updated

Security Issues:

Every instance of an HTTP connection needs to be replaced
with an HTTPS connection. This goes for both the server to
VoiceXML browser, and server to web browser. Currently the
sytem stores both the web and voice passwords as unencrypted
strings. It should store all password information as an
encrypted hash with a per-user salt. Because the database is
susceptible to MySQL injection attacks, the input fields need to
properly filter all incoming and outgoing data, as well as
dynamically generate security tokens for all form submissions.
Cookie/session handling should be reviewed to determine if
there are cross-site scripting vulnerabilities. If an attacker
builds their own VoiceXML browser and engages in ANI
spoofing they could possibly login as an arbitrary patient, or
capture a patient's password. AJAX calls from web browsers to
our server are unencrypted, and unauthenticated.
It is generally understood that privacy is dependent on
security; no system can adequately ensure privacy if it is
insecure. Below, privacy concerns are enumerated assuming a
perfectly secure system.

Audio Autonomy generates and stores individually
identifiable Protected Health Information (PHI) as defined by
the Health Insurance Portability and Accountability Act
(HIPAA) [22]. The log files are not de-identified from the
patients or caregivers, and the database stores information on
all patients and caregivers unencrypted. Specifically, Audio
Autonomy stores phone numbers, names, dates, and IP
addresses. In addition, voice recordings of patients might be
considered biometric identifiers and qualify as PHI.
Any rollout of Audio Autonomy to real patients would
require a complete review of its data use and retention. It
would also require the generation of a privacy and data
retention policy. Both of these would be a significant
undertaking.

