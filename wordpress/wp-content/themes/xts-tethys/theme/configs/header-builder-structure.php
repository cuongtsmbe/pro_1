<?php
/**
 * Default header builder structure
 *
 * @package xts
 * @version 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

return array(
	'id'      => 'root',
	'type'    => 'root',
	'content' => array(
		0 => array(
			'id'      => 'top-bar',
			'type'    => 'row',
			'content' => array(
				0 => array(
					'id'      => 'column5',
					'type'    => 'column',
					'content' => array(),
				),
				1 => array(
					'id'      => 'column6',
					'type'    => 'column',
					'content' => array(),
				),
				2 => array(
					'id'      => 'column7',
					'type'    => 'column',
					'content' => array(),
				),
				3 => array(
					'id'      => 'column_mobile1',
					'type'    => 'column',
					'content' => array(),
				),
			),
			'params'  => array(
				'flex_layout'            => array(
					'id'    => 'flex_layout',
					'value' => 'stretch-center',
					'type'  => 'selector',
				),
				'height'                 => array(
					'id'    => 'height',
					'value' => 40,
					'type'  => 'slider',
				),
				'mobile_height'          => array(
					'id'    => 'mobile_height',
					'value' => 40,
					'type'  => 'slider',
				),
				'align_dropdowns_bottom' => array(
					'id'    => 'align_dropdowns_bottom',
					'value' => false,
					'type'  => 'switcher',
				),
				'hide_desktop'           => array(
					'id'    => 'hide_desktop',
					'value' => true,
					'type'  => 'switcher',
				),
				'hide_mobile'            => array(
					'id'    => 'hide_mobile',
					'value' => true,
					'type'  => 'switcher',
				),
				'sticky'                 => array(
					'id'    => 'sticky',
					'value' => false,
					'type'  => 'switcher',
				),
				'sticky_height'          => array(
					'id'    => 'sticky_height',
					'value' => 40,
					'type'  => 'slider',
				),
				'color_scheme'           => array(
					'id'    => 'color_scheme',
					'value' => 'dark',
					'type'  => 'selector',
				),
				'shadow'                 => array(
					'id'    => 'shadow',
					'value' => false,
					'type'  => 'switcher',
				),
				'background'             => array(
					'id'    => 'background',
					'value' => '',
					'type'  => 'bg',
				),
				'border'                 => array(
					'id'    => 'border',
					'value' => '',
					'type'  => 'border',
				),
			),
		),
		1 => array(
			'id'      => 'general-header',
			'type'    => 'row',
			'content' => array(
				0 => array(
					'id'      => 'column8',
					'type'    => 'column',
					'content' => array(
						0 => array(
							'id'     => 'myn6esz4tgrupuasppzu',
							'type'   => 'logo',
							'params' => array(
								'image'        => array(
									'id'    => 'image',
									'value' => '',
									'type'  => 'image',
								),
								'width'        => array(
									'id'    => 'width',
									'value' => 150,
									'type'  => 'slider',
								),
								'sticky_image' => array(
									'id'    => 'sticky_image',
									'value' => '',
									'type'  => 'image',
								),
								'sticky_width' => array(
									'id'    => 'sticky_width',
									'value' => 150,
									'type'  => 'slider',
								),
								'logo_notice'  => array(
									'id'    => 'logo_notice',
									'value' => '',
									'type'  => 'notice',
								),
							),
						),
					),
				),
				1 => array(
					'id'      => 'column9',
					'type'    => 'column',
					'content' => array(
						0 => array(
							'id'     => '1nvvzpt7u5gy49mknbdq',
							'type'   => 'mainmenu',
							'params' => array(
								'menu_style'       => array(
									'id'    => 'menu_style',
									'value' => 'underline',
									'type'  => 'selector',
								),
								'menu_full_height' => array(
									'id'    => 'menu_full_height',
									'value' => false,
									'type'  => 'switcher',
								),
								'menu_align'       => array(
									'id'    => 'menu_align',
									'value' => 'left',
									'type'  => 'selector',
								),
								'menu_items_gap'   => array(
									'id'    => 'menu_items_gap',
									'value' => 'm',
									'type'  => 'selector',
								),
							),
						),
					),
				),
				2 => array(
					'id'      => 'column10',
					'type'    => 'column',
					'content' => array(
						0 => array(
							'id'     => 'ghcomzz16pqd38rc3ud3',
							'type'   => 'my-account',
							'params' => array(
								'style'         => array(
									'id'    => 'style',
									'value' => 'icon',
									'type'  => 'selector',
								),
								'icon_style'    => array(
									'id'    => 'icon_style',
									'value' => 'default',
									'type'  => 'selector',
								),
								'custom_icon'   => array(
									'id'    => 'custom_icon',
									'value' => '',
									'type'  => 'image',
								),
								'with_username' => array(
									'id'    => 'with_username',
									'value' => false,
									'type'  => 'switcher',
								),
								'login_form'    => array(
									'id'    => 'login_form',
									'value' => true,
									'type'  => 'switcher',
								),
								'position'      => array(
									'id'    => 'position',
									'value' => 'right',
									'type'  => 'selector',
								),
								'color_scheme'  => array(
									'id'    => 'color_scheme',
									'value' => 'dark',
									'type'  => 'selector',
								),
							),
						),
						1 => array(
							'id'     => 'bj5nm84ffnugtb5jqsik',
							'type'   => 'wishlist',
							'params' => array(
								'style'       => array(
									'id'    => 'style',
									'value' => 'icon',
									'type'  => 'selector',
								),
								'design'      => array(
									'id'    => 'design',
									'value' => 'count-text',
									'type'  => 'selector',
								),
								'icon_style'  => array(
									'id'    => 'icon_style',
									'value' => 'default',
									'type'  => 'selector',
								),
								'custom_icon' => array(
									'id'    => 'custom_icon',
									'value' => '',
									'type'  => 'image',
								),
							),
						),
						2 => array(
							'id'     => 'esehdvt062xw5th3x7hb',
							'type'   => 'compare',
							'params' => array(
								'style'       => array(
									'id'    => 'style',
									'value' => 'icon',
									'type'  => 'selector',
								),
								'design'      => array(
									'id'    => 'design',
									'value' => 'count-text',
									'type'  => 'selector',
								),
								'icon_style'  => array(
									'id'    => 'icon_style',
									'value' => 'default',
									'type'  => 'selector',
								),
								'custom_icon' => array(
									'id'    => 'custom_icon',
									'value' => '',
									'type'  => 'image',
								),
							),
						),
						3 => array(
							'id'     => 'guebnsnp7qsi5nf623im',
							'type'   => 'cart',
							'params' => array(
								'widget_type'  => array(
									'id'    => 'widget_type',
									'value' => 'side',
									'type'  => 'selector',
								),
								'color_scheme' => array(
									'id'    => 'color_scheme',
									'value' => 'dark',
									'type'  => 'selector',
								),
								'position'     => array(
									'id'    => 'position',
									'value' => 'right',
									'type'  => 'selector',
								),
								'style'        => array(
									'id'    => 'style',
									'value' => 'icon-text',
									'type'  => 'selector',
								),
								'design'       => array(
									'id'    => 'design',
									'value' => 'default',
									'type'  => 'selector',
								),
								'icon_style'   => array(
									'id'    => 'icon_style',
									'value' => 'cart',
									'type'  => 'selector',
								),
								'custom_icon'  => array(
									'id'    => 'custom_icon',
									'value' => '',
									'type'  => 'image',
								),
							),
						),
						4 => array(
							'id'     => '5rslxrpwpkt3iyimhxir',
							'type'   => 'search',
							'params' => array(
								'display'             => array(
									'id'    => 'display',
									'value' => 'full-screen',
									'type'  => 'selector',
								),
								'search_style'        => array(
									'id'    => 'search_style',
									'value' => 'icon-alt',
									'type'  => 'selector',
								),
								'form_color_scheme'   => array(
									'id'    => 'form_color_scheme',
									'value' => 'inherit',
									'type'  => 'selector',
								),
								'icon_style'          => array(
									'id'    => 'icon_style',
									'value' => 'icon',
									'type'  => 'selector',
								),
								'categories_dropdown' => array(
									'id'    => 'categories_dropdown',
									'value' => false,
									'type'  => 'switcher',
								),
								'icon_type'           => array(
									'id'    => 'icon_type',
									'value' => 'default',
									'type'  => 'selector',
								),
								'custom_icon'         => array(
									'id'    => 'custom_icon',
									'value' => '',
									'type'  => 'image',
								),
								'ajax'                => array(
									'id'    => 'ajax',
									'value' => true,
									'type'  => 'switcher',
								),
								'ajax_result_count'   => array(
									'id'    => 'ajax_result_count',
									'value' => 20,
									'type'  => 'slider',
								),
								'post_type'           => array(
									'id'    => 'post_type',
									'value' => 'product',
									'type'  => 'selector',
								),
								'color_scheme'        => array(
									'id'    => 'color_scheme',
									'value' => 'dark',
									'type'  => 'selector',
								),
							),
						),
					),
				),
				3 => array(
					'id'      => 'column_mobile2',
					'type'    => 'column',
					'content' => array(
						0 => array(
							'id'     => 'n8izqhu02dvdpyg4divc',
							'type'   => 'burger',
							'params' => array(
								'menu_id'      => array(
									'id'    => 'menu_id',
									'value' => 'main-menu-left',
									'type'  => 'select',
								),
								'style'        => array(
									'id'    => 'style',
									'value' => 'icon',
									'type'  => 'selector',
								),
								'icon_type'    => array(
									'id'    => 'icon_type',
									'value' => 'default',
									'type'  => 'selector',
								),
								'custom_icon'  => array(
									'id'    => 'custom_icon',
									'value' => '',
									'type'  => 'image',
								),
								'position'     => array(
									'id'    => 'position',
									'value' => 'left',
									'type'  => 'selector',
								),
								'color_scheme' => array(
									'id'    => 'color_scheme',
									'value' => 'dark',
									'type'  => 'selector',
								),
								'search_form'  => array(
									'id'    => 'search_form',
									'value' => true,
									'type'  => 'switcher',
								),
							),
						),
					),
				),
				4 => array(
					'id'      => 'column_mobile3',
					'type'    => 'column',
					'content' => array(
						0 => array(
							'id'     => 'uukiexdzix8hhmfmh1nk',
							'type'   => 'logo',
							'params' => array(
								'image'        => array(
									'id'    => 'image',
									'value' => '',
									'type'  => 'image',
								),
								'width'        => array(
									'id'    => 'width',
									'value' => 150,
									'type'  => 'slider',
								),
								'sticky_image' => array(
									'id'    => 'sticky_image',
									'value' => '',
									'type'  => 'image',
								),
								'sticky_width' => array(
									'id'    => 'sticky_width',
									'value' => 150,
									'type'  => 'slider',
								),
								'logo_notice'  => array(
									'id'    => 'logo_notice',
									'value' => '',
									'type'  => 'notice',
								),
							),
						),
					),
				),
				5 => array(
					'id'      => 'column_mobile4',
					'type'    => 'column',
					'content' => array(
						0 => array(
							'id'     => 'lw6ues2z26lxd152r3j7',
							'type'   => 'cart',
							'params' => array(
								'widget_type'  => array(
									'id'    => 'widget_type',
									'value' => 'side',
									'type'  => 'selector',
								),
								'color_scheme' => array(
									'id'    => 'color_scheme',
									'value' => 'dark',
									'type'  => 'selector',
								),
								'position'     => array(
									'id'    => 'position',
									'value' => 'right',
									'type'  => 'selector',
								),
								'style'        => array(
									'id'    => 'style',
									'value' => 'icon',
									'type'  => 'selector',
								),
								'design'       => array(
									'id'    => 'design',
									'value' => 'design-1',
									'type'  => 'selector',
								),
								'icon_style'   => array(
									'id'    => 'icon_style',
									'value' => 'bag',
									'type'  => 'selector',
								),
								'custom_icon'  => array(
									'id'    => 'custom_icon',
									'value' => '',
									'type'  => 'image',
								),
							),
						),
					),
				),
			),
			'params'  => array(
				'flex_layout'            => array(
					'id'    => 'flex_layout',
					'value' => 'equal-sides',
					'type'  => 'selector',
				),
				'height'                 => array(
					'id'    => 'height',
					'value' => 90,
					'type'  => 'slider',
				),
				'mobile_height'          => array(
					'id'    => 'mobile_height',
					'value' => 60,
					'type'  => 'slider',
				),
				'align_dropdowns_bottom' => array(
					'id'    => 'align_dropdowns_bottom',
					'value' => false,
					'type'  => 'switcher',
				),
				'hide_desktop'           => array(
					'id'    => 'hide_desktop',
					'value' => false,
					'type'  => 'switcher',
				),
				'hide_mobile'            => array(
					'id'    => 'hide_mobile',
					'value' => false,
					'type'  => 'switcher',
				),
				'sticky'                 => array(
					'id'    => 'sticky',
					'value' => true,
					'type'  => 'switcher',
				),
				'sticky_height'          => array(
					'id'    => 'sticky_height',
					'value' => 60,
					'type'  => 'slider',
				),
				'color_scheme'           => array(
					'id'    => 'color_scheme',
					'value' => 'dark',
					'type'  => 'selector',
				),
				'shadow'                 => array(
					'id'    => 'shadow',
					'value' => false,
					'type'  => 'switcher',
				),
				'background'             => array(
					'id'    => 'background',
					'value' => '',
					'type'  => 'bg',
				),
				'border'                 => array(
					'id'    => 'border',
					'value' => array(
						'applyFor' => 'fullwidth',
						'sides'    => array(
							0 => 'top',
							1 => 'bottom',
							2 => 'left',
							3 => 'right',
						),
					),
					'type'  => 'border',
				),
			),
		),
		2 => array(
			'id'      => 'header-bottom',
			'type'    => 'row',
			'content' => array(
				0 => array(
					'id'      => 'column11',
					'type'    => 'column',
					'content' => array(),
				),
				1 => array(
					'id'      => 'column12',
					'type'    => 'column',
					'content' => array(),
				),
				2 => array(
					'id'      => 'column13',
					'type'    => 'column',
					'content' => array(),
				),
				3 => array(
					'id'      => 'column_mobile5',
					'type'    => 'column',
					'content' => array(),
				),
			),
			'params'  => array(
				'flex_layout'            => array(
					'id'    => 'flex_layout',
					'value' => 'stretch-center',
					'type'  => 'selector',
				),
				'height'                 => array(
					'id'    => 'height',
					'value' => 50,
					'type'  => 'slider',
				),
				'mobile_height'          => array(
					'id'    => 'mobile_height',
					'value' => 50,
					'type'  => 'slider',
				),
				'align_dropdowns_bottom' => array(
					'id'    => 'align_dropdowns_bottom',
					'value' => false,
					'type'  => 'switcher',
				),
				'hide_desktop'           => array(
					'id'    => 'hide_desktop',
					'value' => true,
					'type'  => 'switcher',
				),
				'hide_mobile'            => array(
					'id'    => 'hide_mobile',
					'value' => true,
					'type'  => 'switcher',
				),
				'sticky'                 => array(
					'id'    => 'sticky',
					'value' => false,
					'type'  => 'switcher',
				),
				'sticky_height'          => array(
					'id'    => 'sticky_height',
					'value' => 50,
					'type'  => 'slider',
				),
				'color_scheme'           => array(
					'id'    => 'color_scheme',
					'value' => 'dark',
					'type'  => 'selector',
				),
				'shadow'                 => array(
					'id'    => 'shadow',
					'value' => false,
					'type'  => 'switcher',
				),
				'background'             => array(
					'id'    => 'background',
					'value' => '',
					'type'  => 'bg',
				),
				'border'                 => array(
					'id'    => 'border',
					'value' => '',
					'type'  => 'border',
				),
			),
		),
	),
);
