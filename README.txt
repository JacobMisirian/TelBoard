TelBoard is a simple, public chat notification system. To install, first you must
create a mysql database called db_Tel with two tables, messages and users.
The messages table should be created with:
CREATE TABLE messages ( id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, nickname VARCHAR(30) NOT NULL, message VARCHAR (100) );
The users table should be created with:
CREATE TABLE users ( username VARCHAR(30) NOT NULL, password VARCHAR(255) NOT NULL );

Then you can make a directory in your WebRoot (mine is /var/www/html/tel) for tel and
extract all of the PHP files into it.

There are also some places in the PHP where it specifically links to misiriansoft.com/tel.
When you install this on your own site you replace that URL with the one relative to your
site. Any questions can be directed to misirianrule@gmail.com.
