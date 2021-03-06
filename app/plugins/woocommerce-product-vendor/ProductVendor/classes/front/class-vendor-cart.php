<?php

/**
 *
 *
 * @author Matt Gates <http://mgates.me>
 * @package
 */


class PV_Vendor_Cart
{


	/**
	 *
	 */
	function __construct()
	{
		add_filter( 'woocommerce_get_item_data', array( 'PV_Vendor_Cart', 'sold_by' ), 10, 2 );
		add_action( 'woocommerce_product_meta_start', array( 'PV_Vendor_Cart', 'sold_by_meta' ), 10, 2 );
	}


	/**
	 *
	 *
	 * @param unknown $values
	 * @param unknown $cart_item
	 *
	 * @return unknown
	 */
	public function sold_by( $values, $cart_item )
	{
		$data      = array();
		$author_id = $cart_item[ 'data' ]->post->post_author;
		$sold_by   = PV_Vendors::is_vendor( $author_id )
			? sprintf( '<a href="%s" target="_TOP">%s</a>', PV_Vendors::get_vendor_shop_page( $author_id ), PV_Vendors::get_vendor_shop_name( $author_id ) )
			: get_bloginfo( 'name' );

		$data[ ] = array(
			'name'    => __( 'Sold by', 'wc_product_vendor' ),
			'display' => $sold_by,
		);

		return $data;
	}


	/**
	 *
	 */
	public function sold_by_meta()
	{
		$author_id = get_the_author_meta( 'ID' );

		$sold_by = PV_Vendors::is_vendor( $author_id )
			? sprintf( '<a href="%s" target="_TOP">%s</a>', PV_Vendors::get_vendor_shop_page( $author_id ), PV_Vendors::get_vendor_shop_name( $author_id ) )
			: get_bloginfo( 'name' );

		echo __( 'Sold by', 'wc_product_vendor' ) . ': ' . $sold_by . '<br/>';
	}

}
