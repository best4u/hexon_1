<?php
$server_name = $_SERVER['SERVER_NAME'];
$url_param = $_SERVER['REQUEST_URI'];
$url = "http://".$server_name."/".$url_param."";

?>
<form method="post" enctype="multipart/form-data" target=""
          class="autotrack_contact_form" action="<?php echo plugins_url('send_form.php',dirname(__FILE__)); ?>">
        <div class="form-group">
           <textarea name="text" class="textarea medium form-control" tabindex="1" aria-invalid="false" rows="10" cols="50">

            </textarea>
        </div>
            <br>
        <div class="form-group">
            <input name="name" id="input_2_2" type="text" value="" class="medium form-control" tabindex="2" placeholder="Uw naam">
        </div>
            <br>
        <div class="form-group">
        <input name="email" id="input_2_3" type="email" value="" class="medium form-control" tabindex="3"
                       placeholder="Uw e-mailadres">
        </div>
        <br>
        <div class="form-group">
        <input name="phone" id="input_2_4" type="text" value="" class="medium form-control" tabindex="4" placeholder="Telefoonnummer (optioneel)">
        </div>
        <input type="hidden" name="occasion_id" value="<?$_GET['overview']?>">
        <input type="hidden" name="redirect_back" value="<?=$url?>">
        <button class="button_at1 button_color form-control" type="submit">Verzenden</button>

    </form>