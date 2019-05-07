<?php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
?>
<?php
register_nav_menus(array(
	'top'    => 'top menu',    //name menu
	'bottom' => 'bottom nenu'      //name menu 2
));
?>
<?php register_nav_menus( array( 'top' => 'top menu' ) ); ?>
<?php
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
	global $post;
	return '<a href="'. get_permalink($post->ID) . '">...<p class="more-link">Читати далі</p></a>';
}
?>
<?php
function my_myme_types($mime_types) {
    $mime_types['svg'] = 'image/svg+xml'; //add files SVG
    $mime_types['psd'] = 'image/vnd.adobe.photoshop'; //add files PHOTOSHOP
    $mime_types['jpg'] = 'image/jpeg'; //add files PHOTOSHOP
    $mime_types['odt'] = 'application/vnd.oasis.opendocument.text'; //add files OpenOffice
    $mime_types['rtf'] = 'application/rtf'; //add files RTF
    $mime_types['docx'] = 'application/msword'; //add files DOCX
    $mime_types['doc'] = 'application/msword';
    $mime_types['xls'] = 'application/vnd.ms-excel'; //add files XLS
    $mime_types['pdf'] = 'application/pdf'; //add files PDF
    return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);
?>
<?php
## отключаем создание миниатюр файлов для указанных размеров
add_filter( 'intermediate_image_sizes', 'delete_intermediate_image_sizes' );
function delete_intermediate_image_sizes( $sizes ){
	// размеры которые нужно удалить
	return array_diff( $sizes, array(
		'medium_large',
		'large',
	) );
}
?>
<?php
// просмотры
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);
function posts_column_views($defaults){
    $defaults['post_views'] = __('Просмотры');
    return $defaults;
}
function posts_custom_column_views($column_name, $id){
        if($column_name === 'post_views'){
        echo getPostViews(get_the_ID());
    }
}
?>