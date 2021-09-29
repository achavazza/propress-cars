<?php get_header(); ?>
<?php include('inc/slider.php'); ?>
<div class="container">
    <div class="search-panel">
		<?php echo get_search_form(); ?>
    </div>
</div>
<div class="container">
    <?php the_breadcrumb(); ?>
	<?php include('inc/notfound.php') ?>
    <br />
    <br />
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
