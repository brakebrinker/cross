<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package realistic
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

	</div>

	<footer id="colophon" class="site-footer mdl-mega-footer" role="contentinfo">
		<div class="site-info mdl-mega-footer--bottom-section">

			<div id="copyright-note">
				<div class="left">
                    <div class="social-icons">
                        <div class="social-vk">
                            <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" title="Vk" href="https://vk.com/amachampionship" target="_blank" data-upgraded=",MaterialButton,MaterialRipple" style="width: 36px">
                                <i class="icon-vkontakte"></i>
                                <span class="mdl-button__ripple-container">
                                        <span class="mdl-ripple is-animating" style="width: 132.108px; height: 132.108px; transform: translate(-50%, -50%) translate(18px, 27px);"></span>
                                    </span>
                            </a>
                        </div>
                    </div>
				</div>
				<div class="right">
                    <?php echo realistic_sanitize_text( do_shortcode( get_theme_mod( 'footer_left', REALISTIC_FOOTER_TEXT ) ) ); ?>
                </div>
			</div>

		</div><!-- .site-info -->	
	</footer><!-- #colophon -->
</div><!-- .mdl-layout -->

<?php wp_footer(); ?>

</body>
</html>