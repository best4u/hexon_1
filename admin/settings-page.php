<div class="wrap">
    <h1>Informatie</h1>

    <form method="post" action="options.php">


        <?php settings_fields( 'autotrack-settings-fields' ); ?>
        <?php do_settings_sections( 'autotrack-settings-fields' ); ?>


        <label for="new_option_name">New Option Name</label>
        <input type="text" name="new_option_name" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" />

        <label for="some_other_option">Some Other Option</label>
        <input type="text" name="some_other_option" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" />


        <label for="option_etc">Options, Etc.</label>
        <input type="text" name="option_etc" value="<?php echo esc_attr( get_option('option_etc') ); ?>" />


        <?php
        $ch = curl_init("https://www.autotrack.nl/api/advertenties?pageNumber=50&pageSize=1&sort%5Bprijs%5D=desc");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, "best4u:VZipAyJKHfxe");
        $output = curl_exec($ch);
        if(curl_error($ch)){
            echo '<pre>';
            var_dump(curl_error($ch));
            echo '</pre>';
        }
        curl_close($ch);
            echo '<pre>';
//                    var_dump(json_decode($output, true));
            echo '</pre>';
        //            echo $output;  ?>
        <?php submit_button('Opslaan'); ?>


    </form>
</div>
