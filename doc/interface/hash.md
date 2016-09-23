## hash

hash returns a bcrypt hash of the passed password argument.

Example: `interface/hash.php/text`

### Arguments

hash takes one argument, the password to be hashed.

### Return

Every returned value returns a status object, an integer that contains the status of the request.
If the status is not 0 then an error is added with an error message.

If the status is 0 then extra variables are added:

Name | Value
---- | -----
passwd | Password to be hashed
length | passwd length
hash | Bcrypt hash of passwd

Status codes:

Code | Status
---- | ------
0 | Success
40 | No password given
11 | Extra data given
