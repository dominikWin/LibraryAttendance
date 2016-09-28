## Changing db1

Database 1 can be changed to be anyting that can verify an ID.

### Requirements

Whatever method used needs to support three things:

1.  Verify if an ID exists
2.  If it exists, return the name
3.  If it exists and has an image, Return a link to an imgae (can be local on server or remote server)

If no image exists an empty string will cause no image to be displayed.

### Changes

Four functions need to be replaced to change the db1 type.

All of these are in `includes/database.php`.

Function | Description
-------- | -----------
db1_connect | Connect database
db1_close | Close connection to database
is_valid_id | Check if ID exists, return needed information
get_name | Gets name by ID, used by another database function
