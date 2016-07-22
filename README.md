# LibraryAttendance

LibraryAttendance is a rewrite of [LibraryAttendanceProgram](https://github.com/DCHSProgrammingClub/LibraryAttendanceProgram).

## Install

### Apache

Requires apache2, mysql-server, php5, and php5-mysql (Debian packages).

The apache site configuration needs a slash after the www folder. ("`/var/www/`")

(Optional) If you run the deploy script at this point you will be able to see the login screen, but there will be an error message.

### MySQL

Run the `scripts/install.sql` on the mysql server.
This will add a root acount with password "password", make sure to change it.

(Optional) Fill in example users with `scripts/sample_students.sql`.

### Source Code

Setup config file `config/dbconf.php` from the example, this relies on having a database user setup.
The username and password must be added.

(Optional) Setup the deploy script to use different server root directory, default is `/var/www/`.

To send the files site use `deploy <ip>` and set the server.
This will assume the current user is also a user on the server and has write permissions.
If you do not have an ssh key it will prompt for a password multiple times.

## Dependencies

This project uses Bootstrap, jQuery, js-cookie, and sb-admin.
There are all in compressed forms in `js/` and `css/`.
