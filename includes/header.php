<?php include_once('classes/dictionary_form.php'); 
      $output .= $_SESSION['msg']; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Conlang Dictionary</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <?php if( $func->get_page() === 'list' ) { 
    	// include datatables cdn for sortable tables 
    	// https://datatables.net ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/bs/dt-1.10.11,r-2.0.2,sc-1.4.1/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/t/bs/dt-1.10.11,r-2.0.2,sc-1.4.1/datatables.min.js"></script>
    <?php } ?>
    <script src="scripts/scripts.js"></script>
    <link rel="stylesheet" href="styles.css" />
</head>

<body>

<?php $func->debug(); // 'on' or empty ?>

