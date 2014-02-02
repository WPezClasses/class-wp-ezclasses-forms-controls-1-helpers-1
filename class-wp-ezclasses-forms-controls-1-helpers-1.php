<?php
/** 
 * Helpers that pair well with Class_WP_ezClasses_Forms_Controls_1
 *
 * Long description TODO (@link http://)
 *
 * PHP version 5.3
 *
 * LICENSE: MIT
 *
 * @package WP ezClasses
 * @author Mark Simchock <mark.simchock@alchemyunited.com>
 * @since 0.5.0
 * @license MIT
 */
 
/*
* == Change Log == 
*
*/

if ( !defined('ABSPATH') ) {
	header('HTTP/1.0 403 Forbidden');
    die();
}
 
if ( !class_exists('class-wp-ezclasses-forms-controls-1-helpers-1' ) ){
	class Class_WP_ezClasses_Forms_Controls_1_Helpers_1 extends Class_WP_ezClasses_Master_Singleton {
	
		/**
		 *
		 */
		protected function __construct(){
			parent::__construct();
		}	

		/**
		 * 
		 */
		public function ezc_init($arr_args = NULL){   
		//	$this->widgets_factory_form_init($arr_args);
		}


		/**
		 * Pass in $str_view: 'all', 'hide', 'login', 'login_not' and method will return a bool on the if that condition is met, or not.
		 */
		 
		/**
		 * TODO - make it possible to have various presets (i.e., combo the values in)
		 */
		public function view_evaluate($str_view = NULL){
		
			if ( $str_view == 'all' ) {
				return true;
			} elseif ( $str_view == 'hide' ) {
				return false;
			} elseif ( $str_view != 'login' && $str_view != 'login_not' && current_user_can( $str_view ) ){
				return true;
			} elseif ( $str_view == 'login' && is_user_logged_in() ){
				return true;
			} elseif ( $str_view == 'login_not' && !is_user_logged_in() ){
				return true;
			} else {
				return false;
			}
		}

		
		/*
		 * Take the "key "from a sort_options() select list (order|orderby) and converts it into args for WP_Query
		 */
		public function order_pipe_orderby_to_query_args($str_current_sort = NULL){

			/*
			 * if none then we won't get orderby
			 *
			 * Note: orderby = none is a legit request, however it seems to foul up Posts 2 Posts. So we'll just not have an orderby if the setting is none. NBD
			 */
			if ( $str_current_sort == 'none' ){
				return array(); 
			}
			// make sorting bit a method that can be over-ridden so it's ez to modify / extends
			$arr_query_args = array();
			if ( $str_current_sort == 'rand' ) {
				$arr_query_args['orderby'] =  $str_current_sort;
			} else {
				$arr_current_sort = explode('|', $str_current_sort);
				$arr_query_args['orderby'] =  $arr_current_sort[0];
				$arr_query_args['order'] = $arr_current_sort[1];
			}
			return $arr_query_args;
		}
		
		
		/**
		 * TODO - test
		 */
		public function wp_kses_allowed_html_add( $arr_args = array()){
		 
			if ( wpezMethods::array_pass($arr_args) === true ){
		 
				global $allowedtags;
				$arr_settings_tags = $allowedtags;
				
				foreach ( $arr_args as $str_new_tag ) {
					$arr_settings_tags[$str_new_tag] = array(
						'class' => array(),
						'id' => array()
					);
				}
				return $arr_settings_tags;
			}
		}


	}
}

?>