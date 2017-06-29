<?php

    if($thx_mess == "thx_page"){
        $url = " ";
        $url = $at_link_to_thx_page;
        
        header('Location: '.$url);
    }else{

        header('Location: '.$redirect_back);
        $_SESSION["thx_text"] = "true";
    }
 
?>