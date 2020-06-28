<?php get_header(); ?>
<?php 
$hotel_galaxy_default_setting=hotel_galaxy_default_setting(); 
$option = wp_parse_args(get_option( 'hotel_galaxy_option', array() ), $hotel_galaxy_default_setting ); 
?>
<?php 
get_template_part('templates/slider'); 
?>

<section id="about" class="feature-section animate" data-anim-type="fadeInLeft" data-anim-delay="800" style="padding-top: 20px; background: #f6f6f6">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title animate fadeInLeft">
					<h1 class="heading head-m feature-title">
						Khách sạn Moonlight
					</h1>
					<div class="pagetitle-separator"></div>
				</div> 
				<div class="about-desc">
					<p>
					Một khách sạn thương hiệu cao cấp mới tại thành phố Huế, được khai trương từ ngày 15 tháng 4 năm 2013. Nằm trong khoảng cách đi bộ đến sông Hương và trung tâm thành phố Huế, vị trí của Khách sạn Moonlight Huế thật sự lý tưởng cho những ai muốn trải nghiệm các điểm đến thu hút du khách của Huế.
					</p>
				</div>
			</div>
		</div>
	</div>
</section> 
<?php

if($option['service_rooms_show']==1){
	get_template_part( 'templates/home-widget-room' );
}

if($option['room_sec_position']=='S_top'){
	if($option['service_show']==1){
		get_template_part('templates/home-widget');
	}	

	if($option['room_sec_show']==1){
		get_template_part('templates/home-room');
	}	
}else{
	if($option['room_sec_show']==1){
		get_template_part('templates/home-room');
	}	
	if($option['service_show']==1){
		get_template_part('templates/home-widget');
	}	
}


if($option['blog_show']==1){
	get_template_part('templates/home-blogs');
}
if($option['shortcode_show']==1){
	get_template_part('templates/home-shortcode');
}
?>

<?php get_footer(); ?>