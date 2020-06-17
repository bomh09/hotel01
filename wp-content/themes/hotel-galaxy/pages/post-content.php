<div class="blog-area animate" data-anim-type="fadeInUp" data-anim-delay="400">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="<?php echo esc_attr((is_single())?'':'home-room-col') ?>">
			<div class="home-room-img">
				<?php if(has_post_thumbnail()){
					$arg =array('class' =>"img-responsive"); 
					the_post_thumbnail('',$arg); 
				} ?>
				<div class="showcase-inner">
					<div class="showcase-icons">
						<a href="<?php the_permalink(); ?>" class="gallery-icon"><i class="fa fa-plus"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="blog-inner-left" style="display: inline-flex">
			<ul>
				<li> <i class="fa fa-clock"></i> <?php echo esc_attr(get_the_date('d-m-Y')); ?> </li>
				<?php if(get_the_tag_list() != '') { ?>
				<li> <i class="fa fa-tags"></i><?php the_tags('', ', ', '<br />'); ?> </li>
				<?php } ?>				
			</ul>
			<?php the_category() ?>
		</div>
		<h2>
			<?php 		
			if(is_single()){
				the_title();
			}else{
				?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php
			} ?>
		</h2>	
		<div class="single-post-content">
			<?php if(!is_single() ){
				the_excerpt(__('more','hotel-galaxy'));
			}else{ 
				the_content();
			}?>
		</div>
		<?php
		$defaults = array(
			'before'           => '<p class="abc">' . __( 'Pages:','hotel-galaxy' ),
			'after'            => '</p>',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'number',
			'separator'        => ' ',
			'nextpagelink'     => __( 'Next page','hotel-galaxy' ),
			'previouspagelink' => __( 'Previous page','hotel-galaxy' ),
			'pagelink'         => '%',
			'echo'             => 1
			);

		wp_link_pages( $defaults );

		?>			
		<div class ="clearfix"></div>
	</div>	
</div>