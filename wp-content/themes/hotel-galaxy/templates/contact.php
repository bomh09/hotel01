<?php 

/*
Template Name: Contact Page
*/

 ?>

 <?php get_header(); ?>

<?php 
$hotel_galaxy_default_setting=hotel_galaxy_default_setting(); 
$hotel_galaxy_settings = wp_parse_args(get_option( 'hotel_galaxy_option', array() ), $hotel_galaxy_default_setting ); 

if(!is_front_page()){
	get_template_part('breadcrums');
}
?>
<section class="home-shortcode animate" data-anim-type="fadeInUp" data-anim-delay="800">
	<div class="container">
		<div class="row">
			<div class="col-md-8 blog-area animate" data-anim-type="fadeInUp" data-anim-delay="900">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title" style="margin: 0;">
                            <h1 class="heading head-m feature-title">
                                <?php 
                                if($hotel_galaxy_settings['shortcode_title']){
                                    echo wp_kses_post($hotel_galaxy_settings['shortcode_title']);
                                }else{
                                    echo _e('Contact Us','hotel-galaxy');
                                } 
                                ?>
                            </h1>
                            <div class="pagetitle-separator"></div>
                        </div>
                    </div>
                </div>		
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 hotel-g-contact-form">
                        <?php 
                        if($hotel_galaxy_settings['shortcode_echo']!=''){
                            echo do_shortcode($hotel_galaxy_settings['shortcode_echo']);
                        }else{
                            ?>
                            <div class="caption">						
                                <p class="description text-center"><?php echo _e('1.  Go to Customizer ->Hotel Galaxy Setting -> Shortcode Section','hotel-galaxy'); ?></p>	
                            </div>
                            <?php
                        }
                        
                        ?>
                        <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4550.042869712686!2d107.59081855779567!3d16.46972685715659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3141a13cd1fb6a3d%3A0xb69ec59e61660f7a!2sMoonlight%20Hotel%20Hue!5e0!3m2!1svi!2s!4v1592472489058!5m2!1svi!2s" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                    </div>
                    
                </div>
            </div>    

            <?php get_sidebar(); ?>		
		</div>		
	</div>
</section>
<div class="clearfix"></div>
<?php get_footer(); ?>