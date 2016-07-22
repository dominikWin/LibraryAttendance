# LibraryAttendance

LibraryAttendance is a rewrite of [LibraryAttendanceProgram](https://github.com/DCHSProgrammingClub/LibraryAttendanceProgram).

## Install

Requires apache2, mysql-server, php5, and php5-mysql (Debian packages).

The apache site configuration needs a slash after the www folder. ("`/var/www/`")

Run the `scripts/install.sql` on the mysql server.

(Optional) Fill in example users with `scripts/sample_students.sql`.

Setup config file `config/dbconf.php` from the example.
At minimum the username and password must be added.

(Optional) setup the deploy script to use different server root directory, default is `/var/www/`.

To send the files site use `deploy <ip>` and set the server.
This will assume the current user is also a user on the server and has write permissions.
If you do not have an ssh key it will prompt for a password multiple times.

## Dependencies

This project uses Bootstrap, jQuery, js-cookie, and sb-admin.
There are all in compressed forms in `js/` and `css/`.
