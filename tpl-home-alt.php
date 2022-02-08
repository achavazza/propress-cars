<?php
/*
Template Name: Home - Alternativa
*/
get_header();
?>
<?php
//$home  = get_option('page_on_front');
//$img   = get_the_post_thumbnail_url($home, 'slide');
//$data  = get_post_meta($home);
$steps_title = get_post_meta( get_the_ID(), 'steps_title', true );
$steps = get_post_meta( get_the_ID(), 'cmb_steps_metabox', true );

$reviews_title = get_post_meta( get_the_ID(), 'reviews_title', true );
$reviews = get_post_meta( get_the_ID(), 'cmb_reviews_metabox', true );


$news_title = get_post_meta( get_the_ID(), 'news_title', true );
$news_tax = get_post_meta( get_the_ID(), 'home_news_taxonomy', true );
$news_tax = $news_tax ? intval($news_tax) : null;
$news_cant = get_post_meta( get_the_ID(), 'home_news_cant', true );
$news_cant = $news_cant ? intval($news_cant) : -1;

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

<?php
$args = array(
//'cat' => $news_tax,
'post_type' => 'post',
'posts_per_page' => $news_cant,
'tax_query' => array(
    array(
        'taxonomy' => 'category',
        'terms'    => $news_tax,
    ),
),
);
$loop = new WP_Query( $args );
if ( $loop->have_posts() ) : ?>
<div class="section">
    <div class="container">
        <?php
        if($news_title) {
            echo sprintf('<h3 class="title title-alt is-secondary has-text-centered is-4 py-4">%s</h3>', $news_title);
        }
        ?>
        <div class="swiper-container swiper-carousel">
            <div class="swiper-wrapper">
            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                <div class="swiper-slide">
                    <?php get_template_part('parts/blog','loop') ?>
                </div>
            <?php endwhile; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</div>

<?php wp_enqueue_script('swiperjscarousel-init', true); ?>

<?php endif ?>
<div class="section">
    <div class="container">
        <div class="columns is-desktop is-centered is-multiline">
            <?php if($steps): ?>
            <div class="block column is-half-desktop">
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
        </div>
        <div class="columns is-centered is-multiline is-relative">
            <?php get_sidebar('home-alt'); ?>
        </div>
        <?php if($reviews): ?>
        <div class="columns is-centered is-multiline">
            <div class="column">
            <div class="review-content home-alt has-background-white">
                <?php
                if($reviews_title) {
                    echo sprintf('<h3 class="title title-alt is-secondary has-text-centered is-4 py-4">%s</h3>', $reviews_title);
                }
                ?>
            <ul class="review-list columns is-centered is-multiline">
            <?php foreach($reviews as $review): ?>
                <li class="review column is-one-third">
                    <div class="content has-text-centered">
                        <?php // sprintf('<span>%s</span>', $review['review_value']); ?>
                        <?= sprintf('<div class="text">%s</div>', wpautop($review['review_desc'])); ?>
                    </div>
                    <div class="user">
                        <?= sprintf('<div class="picture image is-64x64 mb-3"><img class="is-rounded" src="%s" /></div>', $review['review_picture']); ?>
                        <?= sprintf('<div class="name">%s</div>', $review['review_name']); ?>
                    </div>
                </li>
            <?php endforeach; ?>
            </ul>
            </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php //wp_reset_postdata(); ?>

<?php get_footer(); ?>
