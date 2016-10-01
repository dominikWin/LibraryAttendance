# LibraryAttendance

LibraryAttendance is a rewrite of [LibraryAttendanceProgram](https://github.com/DCHSProgrammingClub/LibraryAttendanceProgram).

## Install

The name of the program by default is libraryattendance and is hosted from the `libraryattendance/` inside the hosted directory.
You can change this name in the Makefile; if you do all parts of the program will use the new name.

### Packages

Requires apache2, mysql-server, php5, and php5-mysql (Debian packages).

### MySQL

Run the `scripts/install.sql` on the mysql server.
This will add a root acount with password "password", make sure to change it.

(Optional) Fill in example students with `scripts/sample_students.sql`.

### Configuration

Setup the file `/etc/libraryattendance.json`.
An example is provided at `docs/libraryattendance.json`

### Source Code

Get a released archive (Github release tab) and decmpress it in the hosted directory.
Any production installs should come from a released archive.

The git repository should not be on any server.

#### Manual

The source can be deployed from the repository with the makefile.
This directly mirrors the release install.

`make deploy SERVER=<SERVER>`

### Example Install
Example install (excluding MySQL setup).

```
cd /var/www
wget (archive)
tar xf (archive)
rm (archive)

cd /etc
wget (libraryattendance.json)
(editor) (libraryattendance.json)
```

## Dependencies

This project uses Bootstrap, jQuery, js-cookie, and sb-admin.
There are all in compressed forms in `js/` and `css/`.
