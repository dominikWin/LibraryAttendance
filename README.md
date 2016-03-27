# LibraryAttendance

LibraryAttendance is a rewrite of [LibraryAttendanceProgram](https://github.com/DCHSProgrammingClub/LibraryAttendanceProgram), write might be a better word though.

## Database Setup

Under the current setup this project uses two databases: one for users (should be read only) and the second one is to store login data and administrators.

### DB1 Structure

DB1 only needs one table for students.

1.  `id` - int
2.  `fname` - varchar(32)
3.  `lname` - varchar(32)

### DB2 Structure

DB2 needs three tables, one for visits, admins, and admin_sessions.

visits:

1.  `id` - int
2.  `student_id` - int
3.  `timestamp` - int

admins:

1.  `id` - int
2.  `uname` - varchar(32)
3.  `passwd` - char(60) [for bcrypt hash]

admin_sessions:

1.  `user_id` - int
2.  `hash` - char(40) [for random SHA1]
3.  `timestamp` - int
4.  `expire` - int [lease time, not expire timestamp]

## Build

To build the site use `deploy <server>` and set the server.
This will write to localhost.

Before building the php files in `config/` need to be created from the examples.

## Dependencies

This project uses Bootstrap, jQuery, js-cookie, and sb-admin.
There are all in compressed formes in `js/` and `css/`.
