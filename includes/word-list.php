
    <h2 class="text-center">Dictionary List</h2>
    <?php if(!empty($output)) { 
            echo '<h6 class="text-center">' . $output . '</h6>';
            unset($_SESSION['msg']);
    }?>

    <?php echo $func->get_word_list(); ?>
