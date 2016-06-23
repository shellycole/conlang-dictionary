<?php
class Dictionary_Functions {
	private $home 	 = 'http://language.dev';  // set base URL here

	public function get_home() {
		return $this->home;
	}   

	public function get_page($p = 'page') {
		return $_GET[$p];
	}      
	
	public function get_values($i, $which) { 
		global $error, $res;
		$value = '';

		if($this->error === true) {
			// test to see if the value is stored as an array
			$value = @unserialize( base64_decode($res[0][$which]) );

			if($_POST[submit] === 'Submit' || $_POST[submit] === 'Update' || $this->get_page('edit') !== NULL ) {

				if(is_array($value)) {// if it is an array
					
					if($_POST[submit] === 'Submit' || $this->get_page('edit') !== NULL) {
						$value = str_replace(array('\r\n', '\\\''), array("\r\n", "'"), $value[$i]); // pull the proper value from the array
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

	public function get_word_list() {
		$db = new Database;
		$db->connect();
	  	$db->select('dictionary', '*', '', '', 'word ASC', '');
	    $res = $db->getResult();
	    
	    if (!empty($res)) {
	    	$output = '<table id="wordlist" class="display">
	    				<thead>
	    				 <tr>
	    				 	<th>Rank</th>
	    				 	<th>Word</th>
	    				 	<th>Part of Speech</th>
	    				 	<th>Type</th>
	    				 	<th>Definition</th>
	    				 	<th>Translation</th>
	    				 </tr>
	    				</thead>
	    				<tbody>';
	    	foreach($res as $row) {
	    		$output .= '<tr>';

	    		foreach($row as $item) {
	    			$output .= '<td>';
	    			// if the cell is serialized data, unserialize it
	    			$show = @unserialize( base64_decode( $item ) );
	    			if($show !== false) {
	    				$output .= '<ol>';
	    				foreach($show as $def) {
	    					if(empty($def))  continue; //skip empty array items
	    					$def = (preg_replace( '@\[(.*?)\]@', '<em class="example">($1)</em>', $def )); // replace brackets with italic tags
	    					$output .= '<li>' . str_replace( array('\r\n','\\\''), array('<br />', '\''), $def ) . '</li>'; // convert \r\n (within string) to newline, and remove backslashes

	    				}
	    				$output .= '</ol>';

	    			} else {
	    				if($item === $row['word']) { 
	    					$output .= '<a href="' . $this->get_home() . '/?page=add&edit=' . $item . '">' . $item . '</a>';

	    				} else {
	    					$output .= $item;
	    				}
	    			}

	    			$output .= '</td>';
	    		}

	    		$output .= '</tr>';
	    	}

	    	$output .= '</tbody>
	    				</table>';

	    } else {
	    	$output = "Nothing to see here.";
	    }

	    return $output;
	}

	public function debug( $x = 'off') {
		if($x === 'on') {
			echo '<p>$_POST: ';
			print_r( $_POST );
			echo '</p>
    		  	  <p>$res[0]: ';
    		print_r( $res[0] );
    		echo '</p>
    		  	  <p>Session Message: ';
    		print_r( $_SESSION['msg'] );
    		echo '</p>';
    		
    	}
	}
}