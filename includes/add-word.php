    
    <h2 class="text-center">Dictionary Management</h2>
    <?php if(!empty($output)) { 
            echo '<h6 class="text-center">' . $output . '</h6>';
            unset($_SESSION['msg']);
    }?>

    <form method="post" role="form" class="form-horizontal col-md-12">

        <!-- Word-->
        <div class="col-md-12 form-group">
            <label class="col-md-2" for="word"><span class="req"></span>Word</label>

            <div class="col-md-10 input-group">
                <div class="input-group-addon">
                    <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" 
                       title="Usage" 
                       data-content="Enter in the word in your native tongue that you'd like to define. Be sure to ONLY use a root/base word, or prefix/suffix. (For example, use 'be' instead of 'being'.) If the word already exists in the database, the form will be populated with what's already there so you can edit it. This field is the only one that is required.">
                       <span class="glyphicon glyphicon-question-sign"></span>
                    </a>
                </div>

                <input class="input_fn form-control" type="text" name="word" id="word" value="<?php echo isset($_POST['word']) ? $_POST['word'] : $func->get_values('', 'word'); ?>" />
            
            </div>
        </div>

        <!-- Conlang-->
        <div class="col-md-12 form-group">
            <label class="col-md-2" for="translation">Translation</label>

            <div class="col-md-10 input-group">
                <div class="input-group-addon">
                    <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" 
                       title="Usage" 
                       data-content="Enter in the conlang translation of the word above.">
                       <span class="glyphicon glyphicon-question-sign"></span>
                    </a>
              </div>

                <input class="input_fn form-control" type="text" name="translation" id="translation" value="<?php echo (isset($_POST['translation']) && $_POST['translation'] !== '') ? $_POST['translation'] : $func->get_values('', 'translation'); ?>" />
            
            </div>
        </div>

        <!-- Popularity -->
        <div class="col-md-12 form-group">
            <label class="col-md-2" for="popularity">Popularity</label>

            <div class="col-md-10 input-group">
                <div class="input-group-addon">
                    <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" 
                       title="Usage" 
                       data-content="There are words that are used more frequently than others.  There's many sites out there that list the most frequently-used words (one is in the "Resources" section). You can use those to input a numerical value for how this word is ranked.">
                       <span class="glyphicon glyphicon-question-sign"></span>
                    </a>
              </div>

                <input class="input_fn form-control" type="text" name="popularity" id="popularity" value="<?php echo (isset($_POST['popularity']) && $_POST['popularity'] !== '') ? $_POST['popularity'] : $func->get_values('', 'popularity'); ?>">
            
            </div>
        </div>

        <!-- begin dynamic/cloned section -->
        <?php $num = 4;
          for($i=0; $i<$num; $i++) {

            echo '<div id="entry' . $i . '" class="clonedInput' .  ( (isset( $_POST['submit'] ) || ($func->get_page('edit') !== NULL ) && ( !empty($func->get_values($i, 'type')) || !empty($func->get_values($i, 'part')) || !empty($func->get_values($i, 'definition')) ) ) ? ' filled' : '') . '">

                <!-- Type -->
                <div class="col-md-12 form-group">
                    <label class="col-md-2" for="type' . $i . '" >Type</label>

                    <div class="col-md-10 input-group">';

                    if($i === 0) {
                        echo '<div class="input-group-addon">
                            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" 
                               title="Usage" 
                               data-content="This is where you supply the type of word this is. You can add in a prefix or suffix, but more often than not, you\'ll probably be using \'root\'. This is in your native tongue, not the conlang. For example, if you want to add \'ing\', set this field as \'suffix\'.">
                               <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                        </div>';
                    }

                        $type_options = array( '', 'prefix', 'root', 'suffix' );

                        echo '<select name="type[]" id="type' . $i . '" class="select_ttl form-control">';
                            foreach($type_options as $option) {
                                    echo '<option value="' . $option . '" ' . ( isset($_POST['type'][$i]) && $_POST['type'][$i] === $option ? 'selected' : ( $func->get_values($i, 'type') === $option ? 'selected' : '' ) ) . '>' . ucfirst($option) . '</option>';
                            }
                        echo '</select>
                    </div>
                </div>

                <!-- Part of Speech -->
                <div class="col-md-12 form-group">
                    <label class="col-md-2" for="part' . $i . '">Part of Speech</label>

                    <div class="col-md-10 input-group">';

                    if($i === 0) {
                        echo '<div class="input-group-addon">
                            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" 
                               title="Usage" 
                               data-content="Note that some words have multiple types, but here you can only choose one. You will define it below. If you want to define a second type, you can click the \'+\' button below. For example, \'have\' is a verb AND (can be) a noun. So initially, you want to set it as \'verb\', and put the verb definitions below. Then click \'+\' and set the new field as \'noun\', and define the noun versions of the word.">
                               <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                        </div>';
                    }

                                  $parts = array( '', 'verb', 'noun', 'adjective', 'adverb', 'preposition', 'conjunction','article', 'interjection', 'prefix', 'suffix' ); 

                        echo '<select name="part[]" id="part' . $i . '" class="select_ttl form-control">';
                            foreach($parts as $option) {
                                echo '<option value="' . $option . '" ' . ( isset($_POST['part'][$i]) && $_POST['part'][$i] === $option ? 'selected' : ( $func->get_values($i, 'part') === $option ? 'selected' : '' ) ) . '>' . ucfirst($option)  . '</option>';
                            } 
                        echo '</select>
                    </div>
                </div>

                <!-- Definition -->
                <div class="col-md-12 form-group">
                    <label class="col-md-2" for="definition' . $i . '">Definition</label>

                    <div class="col-md-10 input-group">';

                    if($i === 0) {
                        echo '<div class="input-group-addon">
                            <a tabindex="0" role="button" data-toggle="popover" data-trigger="focus" 
                               title="Usage" 
                               data-content="Here is where you place your definitions. Because some words can be multiple types (example: \'have\' is a verb, but can also be a noun; \'be\' can be a standalone word, but can also be a prefix) be sure you place ONLY definitions here that match the part of speech you selected above. If you want to supply examples, wrap them in brackets (using \'have\' as an example, put \'possess, own, or hold [he must have that]\'. Additional definitions must go on a new line, but do not number them.">
                               <span class="glyphicon glyphicon-question-sign"></span>
                            </a>
                        </div>';
                    }
                        echo '<textarea name="definition[]" rows="10" id="definition' . $i . '" class="form-control">' . ( isset( $_POST['definition'][$i]) ? $_POST['definition'][$i] : $func->get_values($i, 'definition' ) ) . '</textarea>
                    </div>
                </div>

                <div class="btn-group btn-toggle">';
                if($i !== 3) {
                    echo '<button type="button" name="btnAdd" class="btn btn-success btn-xs btn-open"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>';
                } 

                if($i !== 0) {
                    echo '<button type="button" name="btnDel" class="btn btn-danger btn-xs btn-close" data-toggle="tooltip" data-placement="left" title="Clicking this button does not simply close this section, it will also delete any data contained within. Be absolutely sure you want to erase this section before clicking."><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>';
                }

                echo '</div>

            </div>';

          } ?>
        <!-- end dynamic section -->

        <div id="submit_buttons" class="buttons">
            <input type="hidden" name="submission" value="<?php echo $res[0][submission]; ?>" />
            <?php if( $func->error !== false && !empty($word) ) { ?>
                <input class="btn btn-info btn-lg" type="submit" value="Reset"  name="submit" id="reset"> 
                <input class="btn btn-info btn-lg" type="submit" value="Update" name="submit" id="update">
                <input class="btn btn-info btn-lg" type="submit" value="Delete" name="submit" id="delete">
            <?php } else { ?>
                <input type="submit" value="Submit" name="submit" id="submit" class="btn btn-primary btn-lg">
            <?php } ?>
        </div>
    </form>