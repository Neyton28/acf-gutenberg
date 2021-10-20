
add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style( 'your-handle-here', get_stylesheet_directory_uri() . "/assets/css/main.css", false, '1.0', 'all' );
} );

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a testimonial block
		acf_register_block(array(
			'name'				=> 'testimonial',
			'title'				=> __('Testimonial'),
			'description'		=> __('A custom testimonial block.'),
			'render_callback'	=> 'my_acf_block_render_callback',
			'category'			=> 'formatting',
			'icon'				=> 'admin-comments',
			'keywords'			=> array( 'testimonial', 'quote' ),
		));
	}
}

function my_acf_block_render_callback( $block ) {
	
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);

    var_dump($slug);
	
    ?>
		<section class="section__download pl">
			<?php 
				$files = get_field('files');
				if($files){
					foreach($files as $file){
						if($file['file']){
							?>
								<div class="download__item">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/btn-load.svg" alt="alt">
									<a href="<?php echo $file['file']['url'] ?>" download=""><?php echo $file['file_title'] ?></a>
								</div>
							<?php
						}
					}
				}
			?>
		</section>
    <?php
}
