<?php
/*
Template Name: Page - Financiacion
*/
get_header();
?>
<?php
//$home  = get_option('page_on_front');
//$img   = get_the_post_thumbnail_url($home, 'slide');
//$data  = get_post_meta($home);
$steps_title = get_post_meta( get_the_ID(), 'steps_title', true );
$steps = get_post_meta( get_the_ID(), 'cmb_steps_metabox', true );

//$reviews_title = get_post_meta( get_the_ID(), 'reviews_title', true );
//$reviews = get_post_meta( get_the_ID(), 'cmb_reviews_metabox', true );

$reviews = get_post_meta( get_the_ID(), 'cmb_reviews_metabox', true );

$wa_phone = get_post_meta($post->ID,'_prop_wa_phone', true);
$wa_text  = get_post_meta($post->ID,'_prop_wa_text', true);



/*
$title = $data['_home_title'][0];
$subt  = $data['_home_subtitle'][0];

if($img){
	$bg = ' style="background:url('.$img.')" ';
}*/
?>

<?php include('inc/slider.php'); ?>
<div class="container search-overlap">
    <div class="search-panel">
		<?php echo get_search_form(); ?>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="columns is-desktop is-centered is-multiline">
        <div class="column">

        <?php
            $link = sprintf('https://api.whatsapp.com/send?phone=%s&text=%s', $wa_phone, $wa_text);
        ?>
        <div class="has-text-centered mb-6">
            <a class="button is-medium is-primary is-uppercase" href="<?php echo $link ?>" target="_blank">
                Comunicarse con un asesor
            </a>
        </div>

        <?php
        // detalles
        // descripcion de servicios y detalles de la propieadd
        get_template_part('parts/props/prop','finance')
        ?>
        <?php if($steps): ?>
        <div class="block column">
            <?php
                if($steps_title) {
                    echo sprintf('<h3 class="title title-alt is-secondary has-text-centered is-4 py-4">%s</h3>', $steps_title);
                }
            ?>
        <div class="block-content">
        <ul class="steps">
        <?php foreach($steps as $step): ?>
            <li>
                <?php if($step['step_link']): ?>
                    <?= sprintf('<a href="%s">', $step['step_link']) ?>
                    <?= sprintf('<div><img src="%s" /></div><span>%s</span>', $step['step_icon'], $step['step_desc']); ?>
                    <?= sprintf('</a>') ?>
                <?php else: ?>
                    <?= sprintf('<div><img src="%s" /></div><span>%s</span>', $step['step_icon'], $step['step_desc']); ?>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
        </ul>
        </div>
        </div>
        <?php endif; ?>
        <div class="stacked-widgets">
            <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Page Financiacion')) : else : ?>
            <?php endif; ?>
        </div>
        </div>
        </div>
    </div>
</div>

<?php //wp_reset_postdata(); ?>

<?php get_footer(); ?>
