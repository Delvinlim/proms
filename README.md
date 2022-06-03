# Project Management System
Project Management System Project built as a Final Sistem Basis Data Project for my second semester at college, this project has made halfway before using Node, React, and Express and was transfered into PHP because of the requirement.
# How to run
### `Prerequisite` 
- Xampp or any other related

### `Stack`
- PHP Native

### `Database`
- MySQL

### `Step`
- Start Apache Server & MySQL in XAMPP
- Check Apache Server port number by see the Port(s) written in the Xampp and take the second one or by click on Apache Config "Apache (httpd.conf)" and find (ctrl + f) "Listen" until you found a port number.
- Open up the source code and navigate to app -> config -> config.php
- Edit the BASEURL with your server port number. 
	e.g : define('BASEURL', 'http://localhost:80/Second Semester Project/public');
- Edit also DB_NAME with the database name you've created.
	e.g : define('DB_NAME', 'sbd_db');
- Next go to browser and open up http://localhost:< PORT NUMBER >/Second Semester Project/public
- The App should be working now.
### `Note`
- Please make sure the port number passed is the same as your apache server port number as because that is the important thing.
