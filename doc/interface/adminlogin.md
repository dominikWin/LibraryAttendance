## adminlogin

adminlogin takes a username and password for an admin and checks if they can login, if they can it returns a session key.

Example: `interface/adminlogin.php` with POST `uname` and `passwd`.

### Arguments

Takes two arguments, `uname` and `passwd`.
Both need to be alphanumeric.

### Return

Every returned value returns a status object, an integer that contains the status of the request.
If the status is not 0 then an error is added with an error message.

If the status is 0 then extra variables are added:

Name | Value
---- | -----
key | Session Key (Random SHA1)
timestamp | Current time (UNIX)
expireIn | Seconds until key expires

Status codes:

Code | Status
---- | ------
0 | Success
5 | uname and/or passwd are not alphanumeric.
6 | Failed authentication
10 | No uname passed
11 | No passwd passed
30 | Error connecting to database
