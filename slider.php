<?php
/**
 * Custom Post Types para o WP Fred Slider
 * http://github.com/everaldomatias/wp-fred-slider
 *
 * @package wp-fred-slider
 */

/**
 * Adiciona acao no inicio do WordPress
 * atraves do action add_action( 'init' )
 */
add_action( 'init', 'create_post_type_sliders' );

/**
 * Funcao chamada pelo add_action()
 */
function create_post_type_sliders() {

    /**
     * Labels customizados
     */
    $labels = array(
	    'name' => _x('Sliders', 'post type general name'),
	    'singular_name' => _x('Slider', 'post type singular name'),
	    'add_new' => _x('Novo slider', 'itens'),
	    'add_new_item' => __('Novo slider'),
	    'edit_item' => __('Editar slider'),
	    'new_item' => __('Novo slider'),
	    'all_items' => __('Todos sliders'),
	    'view_item' => __('Ver slider'),
	    'search_items' => __('Procurar slider'),
	    'not_found' =>  __('Nenhuma slider encontrado'),
	    'not_found_in_trash' => __('Nenhuma slider encontrado no lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Sliders'
    );
    
    /**
     * Registra o cpt com os labels acima
     */
    register_post_type( 'sliders', array(
	    'labels' => $labels,
	    'menu_icon' => 'dashicons-slides',
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    'show_in_menu' => true,
	    'query_var' => true,
		'rewrite' => array(
			'slug' => 'sliders',
			'with_front' => false,
	    ),
	    'capability_type' => 'post',
	    'has_archive' => true,
	    'menu_position' => 5,
	    'supports' => array( 'title', 'editor', 'thumbnail' )
	    )
    );

}

/**
 * Funcao para imprimir o slider
 */
function the_slider() {
	require get_template_directory() . '/slider/template-slider.php';
}

/**
 * Inclui metabox
 */
require get_template_directory() . '/slider/metabox.php';


/**
 * Enqueue de scripts e estilos.
 */
function slider_enqueue() {

  wp_enqueue_style( 'slider-style', get_template_directory_uri() . '/slider/slider.css' );

  wp_enqueue_script( 'caroufredsel', get_template_directory_uri() . '/slider/js/jquery.carouFredSel-6.2.1-packed.js', array('jquery') );
  wp_enqueue_script( 'custom-caroufredsel', get_template_directory_uri() . '/slider/js/main.js', array('caroufredsel') );

}
add_action( 'wp_enqueue_scripts', 'slider_enqueue' );