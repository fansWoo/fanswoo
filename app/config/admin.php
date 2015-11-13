<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//會員群組權限管理，紀錄每個groupid的會員能夠使用那些功能
$config['group_purview_Arr'] = array(
	'1' => array(//系統管理員，看得到所有系統及所有管理員
	),
	'2' => array(//總管理員，看得到除了系統管理員以外的所有管理員
		array('base', 'global', 'global', 'common'),
		array('base', 'global', 'global', 'email'),
		array('base', 'global', 'global', 'seo'),
		array('base', 'global', 'global', 'plugin'),
		// array('base', 'advertising', 'advertising', 'edit'),
		// array('base', 'advertising', 'advertising', 'tablelist'),
		// array('base', 'advertising', 'classmeta', 'edit'),
		// array('base', 'advertising', 'classmeta', 'tablelist'),
		array('base', 'pic', 'pic', 'edit'),
		array('base', 'pic', 'pic', 'tablelist'),
		array('base', 'pic', 'album', 'edit'),
		array('base', 'pic', 'album', 'tablelist'),
		array('base', 'file', 'file', 'edit'),
		array('base', 'file', 'file', 'tablelist'),
		array('base', 'file', 'classmeta', 'edit'),
		array('base', 'file', 'classmeta', 'tablelist'),
		array('base', 'note', 'note', 'edit'),
		array('base', 'note', 'note', 'tablelist'),
		array('base', 'note', 'classmeta', 'edit'),
		array('base', 'note', 'classmeta', 'tablelist'),
		array('base', 'user', 'user', 'edit'),
		array('base', 'user', 'user', 'tablelist'),
		// array('base', 'user', 'user_shop', 'edit'),
		// array('base', 'user', 'user_shop', 'tablelist'),
		// array('base', 'user', 'classmeta', 'edit'),
		// array('base', 'user', 'classmeta', 'tablelist'),
		// array('base', 'pager', 'pager', 'edit'),
		// array('base', 'pager', 'pager', 'tablelist'),
		// array('base', 'pager', 'classmeta', 'edit'),
		// array('base', 'pager', 'classmeta', 'tablelist'),
		// array('base', 'pager', 'classmeta2', 'edit'),
		// array('base', 'pager', 'classmeta2', 'tablelist'),
		// array('base', 'showpiece', 'showpiece', 'edit'),
		// array('base', 'showpiece', 'showpiece', 'tablelist'),
		// array('base', 'showpiece', 'classmeta', 'edit'),
		// array('base', 'showpiece', 'classmeta', 'tablelist'),
		// array('base', 'showpiece', 'classmeta2', 'edit'),
		// array('base', 'showpiece', 'classmeta2', 'tablelist'),
		array('base', 'contact', 'contact', 'edit'),
		array('base', 'contact', 'contact', 'tablelist'),

		// array('shop', 'store', 'global', 'hot'),
		// array('shop', 'store', 'global', 'tradein'),
		// array('shop', 'store', 'global', 'coupon'),
		// array('shop', 'store', 'global', 'transfer'),
		// array('shop', 'product', 'product', 'edit'),
		// array('shop', 'product', 'product', 'tablelist'),
		// array('shop', 'product', 'classmeta', 'edit'),
		// array('shop', 'product', 'classmeta', 'tablelist'),
		// array('shop', 'product', 'classmeta2', 'edit'),
		// array('shop', 'product', 'classmeta2', 'tablelist'),
		// array('shop', 'product', 'set', 'set'),
		// array('shop', 'order_shop', 'order_shop', 'edit'),
		// array('shop', 'order_shop', 'order_shop', 'tablelist'),
        
		array('user', 'global', 'global', 'user'),
		// array('user', 'global', 'global_shop', 'user'),
		// array('user', 'order_shop', 'order_shop', 'edit'),
		// array('user', 'order_shop', 'order_shop', 'tablelist')
	),
	'3' => array(//一般管理員，只看得到自己
		// array('base', 'user', 'user_shop', 'edit'),
		// array('base', 'user', 'user_shop', 'tablelist'),
		array('base', 'user', 'classmeta', 'edit'),
		array('base', 'user', 'classmeta', 'tablelist'),
        
		array('user', 'global', 'global', 'user'),
		// array('user', 'global', 'global_shop', 'user'),
		// array('user', 'order_shop', 'order_shop', 'edit'),
		// array('user', 'order_shop', 'order_shop', 'tablelist')
	),
	'100' => array(//一般會員
		array('user', 'global', 'global', 'user'),
		// array('user', 'global', 'global_shop', 'user'),
		array('user', 'order_shop', 'order_shop', 'edit'),
		array('user', 'order_shop', 'order_shop', 'tablelist')
	),
	'101' => array(//進階會員
		array('user', 'global', 'global', 'user'),
		// array('user', 'global', 'global_shop', 'user'),
		// array('user', 'order_shop', 'order_shop', 'edit'),
		// array('user', 'order_shop', 'order_shop', 'tablelist')
	)
);

//後台架構
$config['admin_sidebox'] = array(
		'base' => array(
			'title' => '基本管理',
			'child2' => array(
				'global' => array(
					'title' => '全域管理',
					'child3' => array(
						'global' => array(
							'title' => '全域',
							'child4' => array(
								'common' => array('title' => '基本設置'),
                                'email' => array('title' => '郵件設置'),
								'seo' => array('title' => 'SEO標籤'),
								'plugin' =>array('title' => '第三方外掛')
							)
						)
					)
				),
				// 'webcontent' => array(
				// 	'title' => '內容管理',
				// 	'child3' => array(
				// 		'webcontent' => array(
				// 			'title' => '內容',
				// 			'child4' => array(
				// 				'edit' => array('title' => '首頁內容')
				// 			)
				// 		)
				// 	)
				// ),
				'advertising' => array(
					'title' => '廣告管理',
					'child3' => array(
						'advertising' => array(
							'title' => '廣告',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '廣告分類',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'note' => array(
					'title' => '文章管理',
					'child3' => array(
						'note' => array(
							'title' => '文章',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '分類標籤',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'pic' => array(
					'title' => '圖片管理',
					'child3' => array(
						'pic' => array(
							'title' => '圖片',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'album' => array(
							'title' => '分類標籤',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'file' => array(
					'title' => '檔案管理',
					'child3' => array(
						'file' => array(
							'title' => '檔案',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '分類標籤',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'showpiece' => array(
					'title' => '商品展示',
					'child3' => array(
						'showpiece' => array(
							'title' => '產品',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '產品分類',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta2' => array(
							'title' => '二級分類',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'user' => array(
					'title' => '會員管理',
					'child3' => array(
						'user' => array(
							'title' => '會員',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'user_shop' => array(
							'title' => '會員',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '會員群組',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				),
				'pager' => array(
				 	'title' => '動態頁面',
				 	'child3' => array(
				 		'pager' => array(
				 			'title' => '頁面',
				 			'child4' => array(
				 				'edit' => array('title' => '編輯'),
				 				'tablelist' => array('title' => '列表')
				 			)
				 		),
				 		'classmeta' => array(
				 			'title' => '頁籤分類',
				 			'child4' => array(
				 				'edit' => array('title' => '編輯'),
				 				'tablelist' => array('title' => '列表')
				 			)
				 		),
				 		'classmeta2' => array(
				 			'title' => '二級頁籤',
				 			'child4' => array(
				 				'edit' => array('title' => '編輯'),
				 				'tablelist' => array('title' => '列表')
				 			)
				 		)
				 	)
				 ),
				'contact' => array(
				 	'title' => '聯繫單',
				 	'child3' => array(
				 		'contact' => array(
				 			'title' => '聯繫單',
				 			'child4' => array(
				 				'edit' => array('title' => '編輯'),
				 				'tablelist' => array('title' => '列表')
				 			)
				 		)
				 	)
				 )
			)
		),
		'shop' => array(
			'title' => '購物系統',
			'child2' => array(
				'store' => array(
					'title' => '商店設定',
					'child3' => array(
						'global' => array(
							'title' => '全域',
							'child4' => array(
								'hot' => array('title' => '熱銷商品'),
								'tradein' => array('title' => '滿額優惠'),
								'coupon' => array('title' => '折扣金規則'),
								'transfer' => array('title' => '轉帳帳號')
							)
						)
					)
				),
				'product' => array(
					'title' => '銷售產品',
					'child3' => array(
						'product' => array(
							'title' => '產品',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta' => array(
							'title' => '產品分類',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'classmeta2' => array(
							'title' => '二級分類',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						),
						'set' => array(
							'title' => '產品系統',
							'child4' => array(
								'set' => array('title' => '設置')
							)
						)
					)
				),
				'order_shop' => array(
					'title' => '訂單管理',
					'child3' => array(
						'order_shop' => array(
							'title' => '訂單',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				)
			)
		),
		'user' => array(
			'title' => '帳號設定',
			'child2' => array(
				'global' => array(
					'title' => '帳號資料',
					'child3' => array(
						'global' => array(//本功能為一般網站時開啟
							'title' => '全域',
							'child4' => array(
								'user' => array('title' => '會員資料')
							)
						),
						'global_shop' => array(//本選項為購物網站時才開啟，具會員購物資料填寫功能
							'title' => '全域',
							'child4' => array(
								'user' => array('title' => '會員資料')
							)
						)
					)
				),
				'order_shop' => array(
					'title' => '我的訂單',
					'child3' => array(
						'order_shop' => array(
							'title' => '訂單',
							'child4' => array(
								'edit' => array('title' => '編輯'),
								'tablelist' => array('title' => '列表')
							)
						)
					)
				)
			)
		)
	);