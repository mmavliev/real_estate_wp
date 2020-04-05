<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper" id="index-wrapper">

    <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">


        <main class="site-main" id="main">

            <div class="row">
                <div class="col-lg-8">
                    <h2>Недвижимость</h2>

                    <?php
                    $args = array(  
                        'post_type' => 'real-estate',
                        'posts_per_page' => 10, 
                        'orderby' => "date", 
                        'order' => 'DESC', 
                    );
                
                    $loop = new WP_Query( $args ); 
                        
                    while ( $loop->have_posts() ) : $loop->the_post(); 

                        get_template_part( 'template-parts/single-estate'); 

                    endwhile;
                    wp_reset_postdata(); 
                    ?>

                </div>


                <div class="col-lg-4">
                    <h2>Города</h2>
                    <ul>
                    <?php
                    $args = array(  
                        'post_type' => 'city',
                        'posts_per_page' => -1, 
                        'orderby' => "date", 
                        'order' => 'DESC', 
                    );
                
                    $loop = new WP_Query( $args ); 
                        
                    while ( $loop->have_posts() ) : $loop->the_post(); ?>

                <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

                    <?php 
                    endwhile;
                    wp_reset_postdata(); 
                    ?>
                    </ul>
                </div>

            </div><!-- #content -->

        </main><!-- #main -->

    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer();