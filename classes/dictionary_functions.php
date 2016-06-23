<?php
// get values stored in database to display in form fields
function get_values($i, $which) {
	global $error, $res;
	$value = '';
	if($error === true) {
		// test to see if the value is stored as an array
		$value = @unserialize( base64_decode($res[0][$which]) );
		if($_POST[submit] === 'Submit' || $_POST[submit] === 'Update') {

			if(is_array($value)) {// if it is an array
				
				if($_POST[submit] === 'Submit') {
					$value = str_replace('\r\n', "\r\n", $value[$i]); // pull the proper value from the array
				} else {
					$value = $_POST[$which][$i];
				}
			
			} else { // if it's not an array, but a string
				$value = $res[0][$which]; // pull the proper string from the DB result
			}
		} 
	}

	return $value;
}


function get_word_list() {
	global $db;
  	$db->sql('SELECT * FROM dictionary WHERE word = "be"');
    $res = $db->getResult();
    return $res;
}