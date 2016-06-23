<?php include('includes/header.php'); ?>

<div id="wrap" class="row">

    <?php include('includes/navigation.php'); ?>

    <?php if( $func->get_page() === NULL ) {
                include('includes/welcome.php'); 
          
          } elseif( $func->get_page() === 'add' ) {
                include('includes/add-word.php'); 
          
          } elseif( $func->get_page() === 'list' ) {
                include('includes/word-list.php');

          } elseif( $func->get_page() === 'resource' ) {
                include('includes/resources.php'); 
          } 
    ?>

</div>

<?php include('includes/footer.php'); ?>
