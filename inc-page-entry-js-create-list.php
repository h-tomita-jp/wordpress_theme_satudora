<?php

$shop_page_id = get_page_by_path('shop')->ID;
$areas = get_field_object('area', $shop_page_id)['sub_fields'];
$area_list = [];
foreach ( $areas as $key => $value ) {
	$area_list += array( $value['name'] => $value['label'] );
}

function shoplist($search_area){
	$shop_arr = [];
	$args = array(
		'posts_per_page' => -1,
		'post_type' => 'shop',
		'meta_query' => array(
			array(
	  		'key' => 'address',
	  		'value' => $search_area,
	  		'compare' => 'LIKE'
			),
		)
	);
	$query = new WP_Query($args);

	if ( $query->have_posts() ) {
	    while ( $query->have_posts() ) {
	        $query->the_post();
	        $shop_arr[] = get_the_title();
	    }
	}
	return $shop_arr;
}

$shop_list = [];
foreach ( $area_list as $area_name => $area_label ) :
	foreach ( get_field('area', $shop_page_id)[$area_name] as $key => $value ) :
		if($key != 'query_key' && $key != 'coords') :
			foreach ( $value as $index => $list ) :
				if($index == 'query_key') :
					foreach ( $list as $small_area ) :
						$shop_list_in_thisarea = [];
						foreach ( explode ( '・', $small_area ) as $small_area_part ) :
							array_splice($shop_list_in_thisarea,count($shop_list_in_thisarea),0,shoplist($key.$small_area_part));
						endforeach;
						if(count($shop_list_in_thisarea) >0){
							$shop_list[$area_label][$key.$small_area] = $shop_list_in_thisarea;
						}
					endforeach;
				endif;
			endforeach;
		endif;
		if($key == 'query_key') :
			foreach ( $value as $area ) :
				$shop_list_in_thisarea = shoplist($area);
				if(count($shop_list_in_thisarea) >0){
					$shop_list[$area_label][$area] = $shop_list_in_thisarea;
				}
			endforeach;
		endif;
	endforeach;
endforeach;

foreach ( $shop_list as $area_label => $area_list ) :
	$shop_select1 .= '{val:"'.$area_label.'", txt:"'.$area_label.'"}, ';
	$shop_select2 .= 'shop_select2["'.$area_label.'"] = \'';
	foreach($shop_list[$area_label] as $location => $shops):
		$shop_select2 .= '<option value="'.$location.'">'.$location.'</option>';
		$shop_select3 .= 'shop_select3["'.$location.'"] = new Array(';
		foreach($shop_list[$area_label][$location] as $shop):
			$shop_select3 .= '"'.$shop.'", ';
		endforeach;
		$shop_select3 .= ');'."\n";
	endforeach;
	$shop_select2 .= '\';'."\n";
endforeach;

?>