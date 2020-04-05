<h1><?php the_title(); ?></h1>
<div class="row">
    <div class="col-md-8">
        <div id="carousel" class="carousel slide" data-ride="carousel" style="display:none">
            <div class="carousel-inner">
                <div class="carousel-item active text-center">
                    <img src="<?php the_post_thumbnail_url(); ?>">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="col-md-4">
    <p><span class="price"><?php the_field("стоимость", get_the_ID()); ?></span></p>
        <ul>
            <li>Площадь: <?php the_field("площадь", get_the_ID()); ?></li>
            <li>Адрес: <?php the_field("адрес", get_the_ID()); ?></li>
            <li>Жилая площадь: <?php the_field("жилая_площадь", get_the_ID()); ?></li>
            <li>Этаж <?php the_field("этаж", get_the_ID()); ?></li>
        </ul>
    </div>
    <div class="entry-content">

        <?php the_content(); ?>

    </div><!-- .entry-content -->
</div>
<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/slider.js"></script>
