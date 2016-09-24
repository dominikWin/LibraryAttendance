## LibraryAttendance Permissions

Any user with access to the site may attempt to sign in, only valid student ids will be added.

### Logging In

Administrators may attempt to log in to the serice to access the dashboard.

If the authentication fails then the server prints 'Rejected login request from `<client ip>`' to the server error log.

### Session Keys
If the authentication is successfull a session key is generated.
The session key is sent to the client and stored as a cookie.
By default the session key will 3600 seconds (1 hour) after being generated.

If the administrator logs out the session key is revoked and the cookie is removed from the client.

If someone tries to access an admin-exclusive page without the proper session key they will be returned the contents of index.html.
This will redirect the user to the login page.
This test is the first check ran at the start of every admin-exclusive page.

### Root Administrator

Every administrator has an id.
One administrator must have the id of 1, this is the root administrator.
This user should be named root, but doesn't need to be.

Following UNIX design philosophy the root user has permission to do all tasks on the system.
The root admin is allowed the exclusive permission to manage other administrators.
The root admin can change passwords of administrators, including itself; delete non-root administrators; and add new administrators.

For security reasons the root user should not be used unless needed.
