		<footer id="footer" class="mt-5">
			<div class="section">
			<div class="container">
				<div class="columns is-multiline">
					<div class="column is-4 is-12-mobile">
						<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 1')) : else : endif;?>
					</div>
					<div class="column is-4 is-12-mobile">
						<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 2')) : else : endif;?>
					</div>
					<div class="column is-4 is-12-mobile">
						<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer 3')) : else : endif;?>
					</div>
				</div>
			</div>
			</div>
            <div id="copyright">
                <div class="section">
                <div class="container">
                <div class="columns is-multiline is-vcentered">
                    <div class="column is-9">
                        <?php echo get_bloginfo('name').' '.get_bloginfo('description').' &mdash; &copy; ' . date("Y"); ?>
                    </div>
                    <div class="column is-3">
                    <div class="loungelogo">
                        <a href="http://www.loungemedia.com.ar" target="_blank">
                            <img src="<?php echo get_template_directory_uri().'/img/loungemedia.png' ?>" title="LoungeMedia" alt="" />
                        </a>
                    </div>
                    </div>
                </div>
                </div>
                </div>
            </div>
		</footer>

	</div>

	<?php wp_footer(); ?>

	<!-- Don't forget analytics -->

</body>

</html>
