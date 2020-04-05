<?php
add_action( 'wp_enqueue_scripts', 'enqueue_styles' );
add_action( 'init', 'create_taxonomy' );
add_action( 'init', 'register_post_types' );

function enqueue_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
   wp_enqueue_style( 'main-style', get_stylesheet_directory_uri().'/style.css' );
   wp_enqueue_script('jquery');  
}

function create_taxonomy(){
      register_taxonomy("estate-type", [ "real-estate" ], array(
			'labels' => array(
				'name' => 'Типы Недвижимости',
				'singular_name' => 'Тип Недвижимости',
				'search_items' =>  'Найти тип недвижимости',
				'popular_items' => 'Популярные типы недвижимости',
				'all_items' => 'Все типы недвижимости',
				'edit_item' => 'Редактировать тип недвижимости', 
				'update_item' => 'Обновить тип недвижимости',
				'add_new_item' => 'Добавить новый тип недвижимости',
				'new_item_name' => 'Название нового типа недвижимости',
				'separate_items_with_commas' => 'Разделяйте типы недвижимости запятыми',
				'add_or_remove_items' => 'Добавить или удалить тип недвижимости',
				'choose_from_most_used' => 'Выбрать из наиболее часто используемых типов недвижимости',
				'menu_name' => "Тип Недвижимости",
			),
			'public' => true, 
			'show_in_nav_menus' => true,
			'show_ui' => true,
			'show_tagcloud' => true,
			'hierarchical'  => true,
		)
	);
   }  
function register_post_types() {
	register_post_type('real-estate', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Недвижимость', // основное название для типа записи
			'singular_name'      => 'Объект недвижимости', // название для одной записи этого типа
			'add_new'            => 'Добавить объект недвижимости', // для добавления новой записи
			'add_new_item'       => 'Добавление объекта недвижимости', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование объекта недвижимости', // для редактирования типа записи
			'new_item'           => 'Новый объект недвижимости', // текст новой записи
			'view_item'          => 'Смотреть объект недвижимости', // для просмотра записи этого типа.
			'search_items'       => 'Искать объект недвижимости', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Недвижимость', // название меню
		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 2,
      'supports'           => array('title','editor','thumbnail'),
      'taxonomies'          => array( 'estate-type' ),
      
	) );
	register_post_type('city', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Города', // основное название для типа записи
			'singular_name'      => 'Город', // название для одной записи этого типа
			'add_new'            => 'Добавить город', // для добавления новой записи
			'add_new_item'       => 'Добавление города', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование города', // для редактирования типа записи
			'new_item'           => 'Новый город', // текст новой записи
			'view_item'          => 'Смотреть город', // для просмотра записи этого типа.
			'search_items'       => 'Искать город', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Города', // название меню
		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => true,
		'menu_position'      => 1,
      'supports'           => array('title','editor','thumbnail','excerpt'),
	) );
}

add_action('add_meta_boxes', function () {
	add_meta_box( 'palyer_team', 'Город', 'city_real_metabox', 'real-estate', 'side', 'low'  );
}, 1);

function city_real_metabox( $post ){
	$cities = get_posts(array( 'post_type'=>'city', 'posts_per_page'=>-1, 'orderby'=>'date', 'order'=>'DESC' ));

	if( $cities ){
		echo '
		<div style="max-height:200px; overflow-y:auto;">
			<ul>
		';

		foreach( $cities as $city ){
			echo '
			<li><label>
				<input type="radio" name="post_parent" value="'. $city->ID .'" '. checked($city->ID, $post->post_parent, 0) .'> '. esc_html($city->post_title) .'
			</label></li>
			';
		}

		echo '
			</ul>
		</div>';
	}
	else
		echo 'Городов нет';
}
include_once("checkbox.php");

add_action( 'wp_ajax_add_real', 'add_real_callback' );
add_action('wp_ajax_nopriv_add_real', 'add_real_callback');
function add_real_callback() {

	$city = get_page_by_title( $_POST['city'], OBJECT, 'city');
	$post_data = array(
		'post_title'    => wp_strip_all_tags( $_POST['title'] ),
		'meta_input'     => array( 
			'стоимость'=>$_POST['price'],
		 'площадь'=>$_POST['square'],
		  'жилая_площадь'=>$_POST['live-square'],
		  'этаж'=>$_POST['floor'],
			'адрес' =>$_POST['address']
		),
		'post_type'      => 'real-estate',  
		'tax_input'      => $custom_tax,  
		'post_parent' =>    $city->ID,
		'post_status'      => 'publish'            
	);
	
	// Вставляем запись в базу данных
	$post_id = wp_insert_post( $post_data );

	//вставляем таксономию
	wp_set_object_terms( $post_id, $_POST['estate-type'], "estate-type" );
}


?>