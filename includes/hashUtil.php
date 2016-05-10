<?php
function gen_hash($passwd) {
	$options = [
		'cost' => 12,
	];
	return password_hash($passwd, PASSWORD_BCRYPT, $options);
}
