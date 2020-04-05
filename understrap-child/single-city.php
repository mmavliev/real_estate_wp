<?php
/**
 * The template for displaying all single posts
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
		<div class="row">


			<main class="site-main" id="main">
            <?php while ( have_posts() ) : the_post(); ?>
            <h1>Последние объявления в городе <?php the_title(); ?></h1>
            <div class="col-md-8">
            <?php
            $objects = get_posts(array( 'post_type'=>'real-estate', 'post_parent'=>get_the_ID(), 'posts_per_page'=>10, 'orderby'=>'date', 'order'=>'DESC' ));
            if( $objects ){
                foreach( $objects as $post ){
                    setup_postdata($post);
                    get_template_part( 'template-parts/single-estate'); 
                }
            }
            else
                echo 'В этом городе нет недвижимости';
            ?> 

			<?php endwhile; // end of the loop. ?>
            </main><!-- #main -->
        </div>
        <div class="col-md-4">
            
        </div>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer();
