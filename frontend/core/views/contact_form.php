<?php
$server_name = $_SERVER['SERVER_NAME'];
$url_param = $_SERVER['REQUEST_URI'];
$url = "http://".$server_name."/".$url_param."";
$thx_mess = get_option('thx_mess');
$at_link_to_thx_page = get_option('at_link_to_thx_page');
$site_url = get_site_url();
$page_slug = get_option("at_url_page_adverts");
$url_param = $_SERVER['REQUEST_URI'];
$url_param = explode('/',$url_param);
$occasion_id = (int)$url_param[3];
?>
<form method="post" enctype="multipart/form-data" target=""
          class="autotrack_contact_form" action="<?php echo plugins_url('send_form.php',dirname(__FILE__)); ?>">
        <div class="form-group">
           <textarea name="text" class="textarea medium form-control" tabindex="1" aria-invalid="false" rows="10" cols="50">

            </textarea>
        </div>
            <br>
        <div class="form-group">
            <input name="name" id="input_name" type="text" value="" class="medium form-control" tabindex="2" placeholder="Uw naam">
        </div>
            <br>
        <div class="form-group">
        <input name="email" id="input_email" type="email" value="" class="medium form-control" tabindex="3"
                       placeholder="Uw e-mailadres">
        </div>
        <br>
        <div class="form-group">
        <input name="phone" id="input_2_4" type="text" value="" class="medium form-control" tabindex="4" placeholder="Telefoonnummer (optioneel)">
        </div>
        <input type="hidden" name="occasion_id" value="<?=$occasion_id?>">
        <input type="hidden" name="redirect_back" value="<?=$url?>">
        <input type="hidden" name="thx_mess" value="<?=$thx_mess?>">
        <input type="hidden" name="at_link_to_thx_page" value="<?=$at_link_to_thx_page?>">
        <button class="button submitButton" type="submit">Verzenden</button>
    </form>