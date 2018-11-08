<div class="video">
    <div class="video-wrapper">
        <?php
        
        $link = $car->data->videos[0]->url;

        if($link[strlen($link) - 1] == '/'){
            $link = substr_replace($link ,"",-1);
        }

        $video_link = explode('/', $link);
        $video_link = end($video_link);
        $video_link = explode('=', $video_link);
        $video_link = end($video_link);

        
        $resourceLink = '';
        ?>

        <?php
        if(strpos($link, 'youtube') !== false){
            $resourceLink = 'https://www.youtube.com/embed/'.$video_link.'';
        }elseif (strpos($link, 'vimeo') !== false) {
            $resourceLink = 'https://player.vimeo.com/video/'.$video_link.'';
        }elseif(strpos($link, 'taggle') !== false){
            $resourceLink = 'https://taggleauto.movieplayer.nl/tg/'.$video_link.'';
        }else{
            $resourceLink = $video_link;
        }

        ?>

        <iframe width="560" height="315"
        src="<?php echo $resourceLink; ?>"
        frameborder="0"
        allowfullscreen>
    </iframe>
</div>   

</div>