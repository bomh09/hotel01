<?php get_header(); get_template_part('breadcrums');?>
<section class="single-post-section">
	<div class="container">
		<div class="row">
			<!----Single Post Content-------->
			<div class="col-md-8">
				<div class="blog-detail">
					<?php 
					if(have_posts()):while(have_posts()):the_post();
					get_template_part('pages/post','content'); 
					hotel_galaxy_posts_nav();
					get_template_part('pages/author','intro');
					endwhile;
					endif;
					comments_template('', true );
					?>	
					<?php
						/*
						* Code hiển thị bài viết liên quan trong cùng 1 category
						*/
						$categories = get_the_category(get_the_ID());
						if ($categories){
							echo '<div class="relatedcat sidebar-widget animate" data-anim-type="fadeInUp" data-anim-delay="800">';
							$category_ids = array();
							foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
							$args=array(
								'category__in' => $category_ids,
								'post__not_in' => array(get_the_ID()),
								'posts_per_page' => 5, // So bai viet dc hien thi
							);
							$my_query = new wp_query($args);
							if( $my_query->have_posts() ):
								echo '<div class="widget-title">';
								echo '<h2 >Bài viết cùng chuyên mục</h2></div><ul>';
								while ($my_query->have_posts()):$my_query->the_post();
									?>
									<li><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
									<?php
								endwhile;
								echo '</ul>';
							endif; wp_reset_query();
							echo '</div>';
						}
					?>
				</div>		
			</div>			
			<!-------Blog Right Sidebar-------------------->
			<?php get_sidebar(); ?>	
			<!-------End Blog Right Sidebar------>	
		</div>
	</div>	
</section>
<div class="clearfix"></div>
<?php get_footer(); ?>