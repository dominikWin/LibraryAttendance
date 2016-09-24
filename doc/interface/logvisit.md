## logvisit

logvisit adds a visit to the database from the student id.

Example: `interface/logvisit.php/` with POST `q=<id>`

### Arguments

logvisit takes `q`, an integer, through POST.

### Return

Every returned value returns a status object, an integer that contains the status of the request.
If the status is not 0 then an error is added with an error message.

If the status is 0 then the name is returned aswell.

Status codes:

Code | Status
---- | ------
0 | Success
10 | No student with given ID
30 | Error connecting to database
40 | No ID given
41 | ID is not a valid number
