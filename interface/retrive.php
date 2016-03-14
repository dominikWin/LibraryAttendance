<?php

/*
Can take value "num" through GET.

Returns a JSON Object.

status object in each return

0 is success
<20 is expected results
<30 is server error_get_last
<40 is user error

if status is not 0 usera are not included
if status is not 0 "error" is returned with a description

status: 0, success, includes "users"
status: 10, num exceeds max value
status: 30, error connecting to db
status: 40, 

users is an object that contains user objects
if user is included so is the "count"

each user object has a "name" and timestamp (as "time")