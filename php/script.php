<?php

/**
* JSON Webhook writer.
* @author: bluestella
* @version: 1.0
*/

$obj = json_decode(file_get_contents('php://input'), true);
 
$json_obj = file_get_contents('php://input');

$file = 'titolist.json';


// Open the file to get existing content
$current = file_get_contents($file);

if ($current != '') {
	// Remove ] at the end of file and add comma if there is already an entry
	$modified = substr_replace($current, ',', -2, 2);
} else {
	// Add [ to start an array
	$modified = '{"attendees": [';
}

// Append a new person to the file
$completeList = $modified . $json_obj;

// add ] to close the array
$completeList .= ']}';

// Write the contents back to the file
if($obj['state_name'] == 'complete'){
	file_put_contents($file, $completeList);
}

?>