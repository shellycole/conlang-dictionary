<?php
include('class_db_functions.php');
include('class_dictionary_functions.php'); 

$db = new Database();
$db->connect();

$func = new Dictionary_Functions();

// defaults
$master = 'dictionary';
$error  = false;
$output = '';

// session data
session_start();

// Escape any input before insert
if($func->get_page('edit') !== NULL) {
      $word  = $db->escapeString($func->get_page('edit'));
} else {
      $word  = $db->escapeString($_POST['word']); 
}
$type        = $db->escapeString($_POST['type']); 
$popularity  = $db->escapeString($_POST['popularity']); 
$definition  = $db->escapeString($_POST['definition']); 
$part  		   = $db->escapeString($_POST['part']); 
$translation = $db->escapeString($_POST['translation']); 
$action		   = $db->escapeString($_POST['submit']);

if( !empty($word) ) {
    //check to see if word already exists in the database
    $db->sql('SELECT * FROM dictionary WHERE word = "' . $word . '"');
    $res = $db->getResult();

    if($res) {
    	$func->error = true;

    	if($action === 'Submit') {
    		$output .= '<p><strong>"' . ucfirst($word) . '" already exists.</strong> <br />The values in the database have been pre-populated for you so you can edit, if you wish.<br />  If you don\'t wish to edit, just hit the "reset" button and work with another word. <br />(The reset button WILL NOT delete the word, it just clears all the form fields for you.)';
    	}

    } else {
    	$error = false;
    	if($action === 'Submit') {
    		$output .= '<p>"' . ucfirst($word) . '" successfully added.';
    	}
    }

	  if($action === 'Update') {
	    // if the word already exists, update it
	    $db->update($master, array('type'        => $type,
		                             'popularity'  => $popularity,
		                             'part'		     => $part,
		                             'definition'  => $definition,
		                             'translation' => $translation
		                          ),
		    		      'word="' . $word . '"'
		    );

	    $output .= '<p>"' . ucfirst($word) . '" successfully updated.</p>';

  	} elseif($action === 'Reset') {
  		  header('Location: ' . $func->get_home());
  	    exit();

    } elseif($action === 'Delete') {
        $db->delete($master, 'word="' . $word . '"');
        $_SESSION['msg'] ='<p>"' . ucfirst($word) . '" successfully deleted from the database.</p>';
        header('Location: ' . $func->get_home());
        exit;

  	} elseif($action === 'Submit') {
      	// Insert new data into database
          $db->insert($master, array('word'        => $word,
                                     'type'        => $type,
                                     'popularity'  => $popularity,
  		                               'part'		     => $part,
                                     'definition'  => $definition,
                                     'translation' => $translation
                                    )
          ); 

  	    // debug
  	    // $output .= $db->getSql();
    }

} else if(!empty($action)) { // if any submit action is taken (except "reset") without setting the required "word" field
    $func->error = true;
    if ($action !== 'Reset')
	     $output .= '<p>A word is required. How can you add a word without...adding a word?';

}  else { // default initial load of fresh form
  $_SESSION['msg'] ='<p>This for is here to add a new word to the database, or to edit an existing one.</p><p>It is highly recommended you check to see if the word exists in your database before adding a new one. If a word already exists, and you hit "submit", everything you enter here will be overwritten by what\'s in the database so you can edit the existing word.</p><p>If you are unsure that a word already exists in the database, then head on over to the word list and search for it first.';
}

$db->disconnect();
