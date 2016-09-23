## fetchlast

fetchlast returns the last n students who logged in to the system.

Example: `interface/fetchlast.php/10`

### Arguments

fetchlast takes one argument, the number of users to return.
The number must be an integer between 1 and 100.

### Return

Every returned value returns a status object, an integer that contains the status of the request.
If the status is not 0 then an error is added with an error message.

Status codes:

Code | Status
---- | ------
0 | Success
11 | Unknown arguments
30 | Error connecting to database
40 | No number given
41 | Argument is not a number
42 | Num not in proper range
