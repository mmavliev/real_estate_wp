<article class="py-3">
    <header class="entry-header">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <img src="<?php the_post_thumbnail_url(); ?>" class="w-100">

        <div class="entry-meta">
            <p><span class="price"><?php the_field("стоимость", get_the_ID()); ?></span></p>
        </div><!-- .entry-meta -->


    </header><!-- .entry-header -->


    <div class="entry-content">

    <ul>
            <li>Площадь: <?php the_field("площадь", get_the_ID()); ?> м2</li>
            <li>Адрес: <?php the_field("адрес", get_the_ID()); ?></li>
            <li>Жилая площадь: <?php the_field("жилая_площадь", get_the_ID()); ?>м2</li>
            <li>Этаж: <?php the_field("этаж", get_the_ID()); ?></li>
        </ul>
        <p><a class="btn btn-primary understrap-read-more-link" href="<?php the_permalink(); ?>">Посмотреть</a></p>
        <span class="posted-on">Опубликовано: <time class="entry-date published updated"
                    datetime="2016-02-25T13:45:43+00:00"><?php echo human_time_diff( get_post_time('U'), current_time('timestamp') ); ?></time>
                назад


    </div><!-- .entry-content -->

</article>