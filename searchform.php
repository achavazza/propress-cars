<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get" class="form">
    <input type="hidden" name="s" value="<?= get_search_query() ?>" />
    <input type="hidden" name="post_type" value="vehicle" />
    <?php //if(!is_front_page()): ?>
        <?php /*
        <div class="panel-head">
            <h3 class="h4">Buscador de propiedades</h3>
        </div>
        */ ?>
        <?php //endif; ?>
            <ul class="search-fields">
                <?php
                $inputContent  = '<label class="label" for="s">Buscar</label>';
                $inputContent .= '<div class="control">';
                $inputContent .= '<input class="input" type="text" id="s" name="s" value="'. get_search_query() .'" placeholder="Buscar"/>';
                $inputContent .= '<input type="hidden" name="post_type" value="vehicle" />';
                //$inputContent .= '<input type="hidden" name="search" value="advanced">';
                $inputContent .= '</div>';
            /*
            if($_GET['search'] == 'advanced'){
                echo '<input class="invisible" type="hidden" name="search" value="advanced">';
            }
            */

            //echo sprintf('<li class="field field-search">%s</li>', $inputContent);

            $taxonomies = array('condition','brand','type');
            $args = array('order'=>'DESC','hide_empty'=>true);
            echo get_terms_dropdown($taxonomies, $args);

            function get_terms_dropdown($taxonomies, $args){
                foreach($taxonomies as $taxonomy){
                    $label     = '';
                    $thisQuery = get_query_var($taxonomy);
                    $terms     = get_terms($taxonomy, $args);
                    switch($taxonomy){
                        case 'condition';
                        $empty = 'Condicion';
                        $label = 'Condicion';
                        $plural = 'Condiciones';
                        break;

                        case 'brand';
                        $empty = 'Marca';
                        $label = 'Marca';
                        $plural = 'Marcas';
                        break;

                        case 'type';
                        $empty = 'Tipo';
                        $label = 'Tipo';
                        $plural = 'Tipos';
                        break;
                    }

                    $inputContent = '';
                    //$inputContent .= '<label for="'.$taxonomy.'" class="label">'.$label.'</label>';
                    $inputContent .= '<div class="control">';
                    $inputContent .= '<span class="select is-fullwidth">';
                    $inputContent .= '<select id="'.$taxonomy.'" name="'.$taxonomy.'">';
                    $inputContent .= '<option value="" disabled selected>'.$label.'</option>';
                    //$inputContent .= '<option value="">Todas las '.$plural.'</option>';
                    //<option value="">'.$empty.'</option>';
                    foreach($terms as $term){
                        $selected = '';
                        if($thisQuery == $term->slug){
                            $selected = 'selected';
                        }
                        $inputContent .=  '<option name="'.$term->slug.'" value="'.$term->slug.'" '.$selected.'>'.$term->name.'</option>';
                    }
                    $inputContent .= '</select>';
                    $inputContent .= '</span>';
                    $inputContent .= '</div>';
                    echo sprintf('<li class="field flex-1">%s</li>', $inputLabel.$inputContent);

                }
            }
            ?>
            <?php /*
            <li class="field">
                <?php
                $price_low  = $price_low ? $_GET['price_low'] : 0;
                $price_high = $price_high ? $_GET['price_high'] : 100000;
                //pr($price_low);
                //pr($price_high);
                $step = $price_high / 20;
                ?>
                <input type="range" multiple min="<?= $price_low ?>" max="<?= $price_high ?>" step="<?= $step ?>" value="<?php //printf('%s,%s', $price_low, $price_high) ?>" class="" style="--low:0; --high:100%;">
            </li>
            */ ?>
            <li class="field flex-2 is-flex is-flex-direction-column">
                <label>Rango de precios</label>
                <div class="slider-container">
                    <?php
                    $price_low  = $_GET['price_low'] ? $_GET['price_low'] : 0;
                    $price_high = $_GET['price_high'] ? $_GET['price_high'] : 15000;
                    $step = ($price_high - $price_low) / 20;
                    //echo $step;
                    //pr($price_high);
                    ?>
                    <div id="range-slider"></div>
        			<input value="<?= intval(round($price_low, 0))  ?>" name="price_low"  type="hidden" id="lower-value" />
        			<input value="<?= intval(round($price_high, 0)) ?>" name="price_high" type="hidden" id="upper-value" />
                </div>
            </li>
            <?php /*
            <li>
                <div class="wrap" role="group" aria-labelledby="multi-lbl" style="--a: -30; --b: 20; --min: -50; --max: 50">
                    <?php // <div id="multi-lbl">Multi thumb slider:</div> ?>

                    <?php // <label class="sr-only" for="a">Value A:</label> ?>
                    <input id="a" type="range" min="-50" value="-30" max="50"/>
                    <output for="a" style="--c: var(--a)"></output>

                    <?php //<label class="sr-only" for="b">Value B:</label> ?>

                    <input id="b" type="range" min="-50" value="20" max="50"/>
                    <output for="b" style="--c: var(--b)"></output>
                </div>
            </li>
            */ ?>
            <?php /*
            <li class="field">
                <?php
                $price_low  = $price_low ? $_GET['price_low'] : 0;
                $price_high = $price_high ? $_GET['price_high'] : 100000;
                $step = $price_high / 20;
                ?>
                <div slider>
                 <div>
                   <div inverse-left style="width:70%;"></div>
                   <div inverse-right style="width:70%;"></div>
                   <div range style="left:30%;right:40%;"></div>
                   <span thumb style="left:30%;"></span>
                   <span thumb style="left:60%;"></span>
                   <div sign style="left:30%;">
                     <span id="value">30</span>
                   </div>
                   <div sign style="left:60%;">
                     <span id="value">60</span>
                   </div>
                 </div>
                 <input id="priceLow" name="price_low" value="" type="range" min="<?= $price_low ?>" max="<?= $price_high ?>" step="<?= $step  ?>" tabindex="0" _oninput="min()" />
                 <input id="priceHigh" name="price_low" value="" type="range" min="<?= $price_low ?>" max="<?= $price_high ?>" step="<?= $step  ?>" type="range" _oninput="max()" />
                </div>
            </li>
            <?php /*
            <li class="col-auto flex-fill">
                <label for="priceLow" class="form-label">Example range</label>
                <input id="priceLow" type="range" class="form-range" min="0" max="5000" step="1000" placeholder="Ej. 1100000" name="price_low"  value="<?php echo $_GET['price_low'] ?>">
            </li>
            <li class="col-auto flex-fill">
                <label for="priceHigh" class="form-label">Example range</label>
                <input for="priceHigh" type="range" class="form-range" min="0" max="5000" step="1000" placeholder="Ej. 2200000" name="price_high" value="<?php echo $_GET['price_high'] ?>">
            </li>
            */ ?>


            <li class="field flex-1 field-button">
                <span class="control">
                <button type="submit" id="searchsubmit" class="button is-primary is-fullwidth">
                    <i class="qs-icon icon-search"></i>
                    <?php echo __('Buscar') ?>
                </button>
                </span>
            </li>
        </ul>
        <div class="field-body is-align-items-flex-end">
            <?php
            /*wp_nav_menu( array(
            'theme_location'  => 'search-menu',
            'container'       => false,
            'menu_class'      => 'flush',
            'fallback_cb'     => false,
        ));*/
        $i = 0;
        $menuName = get_term(get_nav_menu_locations()['search-menu'], 'nav_menu')->name;
        $items   = wp_get_nav_menu_items($menuName);
        if($items):
            $count   = count($items);
            if($menuName):
                ?>
                <ul class="search-menu row">
                    <?php foreach($items as $item): ?>
                        <?php $i++; ?>
                        <li class="col-auto flex-fill">
                            <a href="<?php echo $item->url; ?>">
                                <?php echo $item->title; ?>
                            </a>
                            <?php echo ($i < $count) ? '<span class="center">|</span>' : '' ; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</form>
