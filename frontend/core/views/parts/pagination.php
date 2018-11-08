    <div class="bottomNPaginationWrapp">
        <div class="centerDiv">


            <?php if($cars->total > 6 && $cars->total != 0): ?>

                <ul class="ulPagination">

                    <?php
                    if(count($pagination) > 1){
                        if(isset($_GET['pagina']) && $_GET['pagina'] > 1){
                            ?>
                            <li class="prevPage"><a href="<?php echo $filterService->get_query_filter_pagination($_GET['pagina'] - 1); ?>"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i></span> Vorige</a></li>
                            <?php
                        }elseif(isset($_GET['pagina']) && $_GET['pagina'] != 1){

                            ?>
                            <li class="prevPage"><a href="#"><span><i class="fa fa-angle-double-left" aria-hidden="true"></i></span> Vorige</a></li>
                            <?php
                        }

                        if(isset($_GET['pagina']) && $_GET['pagina'] >= "4"){
                            ?>
                            <li><a href="<?php echo $filterService->get_query_filter_pagination($_GET['pagina'] - 3); ?>">...</a></li>
                            <?php
                        }

                        foreach($pagination as $page){
                            ?>
                            <li <?php if( isset($_GET['pagina']) && $_GET['pagina'] == $page){  echo 'class="activePage"'; }elseif(!isset($_GET['pagina']) && $page == '1'){ echo 'class="activePage"'; } ?>><a href="<?php echo $filterService->get_query_filter_pagination($page); ?>"><?php echo $page; ?></a></li>
                            <?php
                        }


                        if(isset($_GET['pagina']) && $_GET['pagina'] < ceil($number_of_page) / 6){

                            ?>
                            <li><a href="<?php echo $filterService->get_query_filter_pagination($_GET['pagina'] + 3); ?>">...</a></li>
                            <li class="nextPage"><a href="<?php echo $filterService->get_query_filter_pagination($_GET['pagina'] + 1); ?>">Volgende <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a></li>

                            <?php
                        }elseif(!isset($_GET['pagina'])){
                            ?>
                            <li><a href="?pagina=<?php echo '2'; ?>">...</a></li>
                            <li class="nextPage"><a href="<?php echo $filterService->get_query_filter_pagination(2); ?>"">Volgende <span><i class="fa fa-angle-double-right" aria-hidden="true"></i></span></a></li>
                            <?php
                        }
                    }

                    ?>

                </ul>
            <?php endif; ?>
        </div>
    </div>