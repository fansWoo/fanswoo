<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//登入後台預設頁面
//預設頁面應避免設置無登入權限的頁面，否則將被強制登出
$config['default_page'] = [
	1 => 'admin/base/global/global/global_setting',
	2 => 'admin/base/global/global/global_setting',
	3 => 'admin/base/global/global/global_setting',
	4 => 'admin/project/worktask/worktask/calendar',
	5 => 'admin/project/customer/customer/tablelist',
	100 => 'admin/user/global/global/user',
	101 => 'admin/user/global/global/user'
];

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
								// 'common' => [
								// 	'title' => '網站總覽',
								// 	'purview_groupids' => [2]
								// ],
                                'global_setting' => [
                                	'title' => '全域設置',
									'purview_groupids' => [2]
                                ],
                                'website_content' => [
                                	'title' => '網站內容',
									'purview_groupids' => [2]
                                ]
							)
						),
						'page_setting' => array(
							'title' => '全域分頁',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						)
					)
				),
				// 'advertising' => array(
				// 	'title' => '廣告管理',
				// 	'child3' => array(
				// 		'advertising' => array(
				// 			'title' => '廣告',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'classmeta' => array(
				// 			'title' => '分類標籤',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		)
				// 	)
				// ),
				'note' => array(
					'title' => '文章管理',
					'child3' => array(
						'note' => array(
							'title' => '文章',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						),
						'classmeta' => array(
							'title' => '分類標籤',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						),
						'set' => array(
							'title' => '文章系統',
							'child4' => array(
								'set' => array(
									'title' => '設置',
									'purview_groupids' => [2]
								)
							)
						)
					)
				),
				// 'comment' => array(
				// 	'title' => '留言管理',
				// 	'child3' => array(
				// 		'comment' => array(
				// 			'title' => '留言',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '查看',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		)
				// 	)
				// ),
				// 'pic' => array(
				// 	'title' => '圖片管理',
				// 	'child3' => array(
				// 		'pic' => array(
				// 			'title' => '圖片',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'album' => array(
				// 			'title' => '分類標籤',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'set' => array(
				// 			'title' => '圖片系統',
				// 			'child4' => array(
				// 				'set' => array(
				// 					'title' => '設置',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		)
				// 	)
				// ),
				// 'file' => array(
				// 	'title' => '檔案管理',
				// 	'child3' => array(
				// 		'file' => array(
				// 			'title' => '檔案',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'classmeta' => array(
				// 			'title' => '分類標籤',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'set' => array(
				// 			'title' => '檔案系統',
				// 			'child4' => array(
				// 				'set' => array(
				// 					'title' => '設置',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		)
				// 	)
				// ),
				// 'showpiece' => array(
				// 	'title' => '商品展示',
				// 	'child3' => array(
				// 		'showpiece' => array(
				// 			'title' => '商品',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'classmeta' => array(
				// 			'title' => '分類標籤',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'classmeta2' => array(
				// 			'title' => '二級分類',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'set' => array(
				// 			'title' => '商品系統',
				// 			'child4' => array(
				// 				'set' => array(
				// 					'title' => '設置',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		)
				// 	)
				// ),
				'user' => array(
					'title' => '會員管理',
					'child3' => array(
						'user' => array(
							'title' => '會員',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						),
						// 'user_shop' => array(
						// 	'title' => '會員',
						// 	'child4' => array(
						// 		'edit' => array(
						// 			'title' => '編輯',
						// 			'purview_groupids' => [2]
						// 		),
						// 		'tablelist' => array(
						// 			'title' => '列表',
						// 			'purview_groupids' => [2]
						// 		)
						// 	)
						// ),
						'classmeta' => array(
							'title' => '會員群組',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [1]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						),
						'set' => array(
							'title' => '會員系統',
							'child4' => array(
								'set' => array(
									'title' => '設置',
									'purview_groupids' => [2]
								)
							)
						)
					)
				),
				// 'pager' => array(
				//  	'title' => '動態頁面',
				//  	'child3' => array(
				//  		'pager' => array(
				//  			'title' => '頁面',
				//  			'child4' => array(
				//  				'edit' => array(
				//  					'title' => '編輯',
				// 					'purview_groupids' => [2]
				//  				),
				//  				'tablelist' => array(
				//  					'title' => '列表',
				// 					'purview_groupids' => [2]
				//  				)
				//  			)
				//  		),
				//  		'classmeta' => array(
				//  			'title' => '頁籤分類',
				//  			'child4' => array(
				//  				'edit' => array(
				//  					'title' => '編輯',
				// 					'purview_groupids' => [2]
				//  				),
				//  				'tablelist' => array(
				//  					'title' => '列表',
				// 					'purview_groupids' => [2]
				//  				)
				//  			)
				//  		),
				//  		'classmeta2' => array(
				//  			'title' => '二級頁籤',
				//  			'child4' => array(
				//  				'edit' => array(
				//  					'title' => '編輯',
				// 					'purview_groupids' => [2]
				//  				),
				//  				'tablelist' => array(
				//  					'title' => '列表',
				// 					'purview_groupids' => [2]
				//  				)
				//  			)
				//  		),
				//  		'set' => array(
				// 			'title' => '動態頁面系統',
				// 			'child4' => array(
				// 				'set' => array(
				// 					'title' => '設置',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		)
				//  	)
				//  ),
				// 'faq' => array(
				// 	'title' => '常見問題',
				// 	'child3' => array(
				// 		'faq' => array(
				// 			'title' => '常見問題',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'classmeta' => array(
				// 			'title' => '分類標籤',
				// 			'child4' => array(
				// 				'edit' => array(
				// 					'title' => '編輯',
				// 					'purview_groupids' => [2]
				// 				),
				// 				'tablelist' => array(
				// 					'title' => '列表',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		),
				// 		'set' => array(
				// 			'title' => '常見問題系統',
				// 			'child4' => array(
				// 				'set' => array(
				// 					'title' => '設置',
				// 					'purview_groupids' => [2]
				// 				)
				// 			)
				// 		)
				// 	)
				// ),
				'contact' => array(
				 	'title' => '聯繫單',
				 	'child3' => array(
				 		'contact' => array(
				 			'title' => '聯繫單',
				 			'child4' => array(
				 				'edit' => array(
				 					'title' => '編輯',
									'purview_groupids' => [2]
				 				),
				 				'tablelist' => array(
				 					'title' => '列表',
									'purview_groupids' => [2]
				 				)
				 			)
				 		),
				 		'set' => array(
							'title' => '聯繫單系統',
							'child4' => array(
								'set' => array(
									'title' => '設置',
									'purview_groupids' => [2]
								)
							)
						)
				 	)
				 )
			)
		),
		// 'shop' => array(
		// 	'title' => '購物系統',
		// 	'child2' => array(
		// 		'store' => array(
		// 			'title' => '商店設定',
		// 			'child3' => array(
		// 				'global' => array(
		// 					'title' => '全域',
		// 					'child4' => array(
		// 						'hot' => array(
		// 							'title' => '熱銷商品',
		// 							'purview_groupids' => [2]
		// 						),
		// 						'tradein' => array(
		// 							'title' => '滿額優惠',
		// 							'purview_groupids' => [2]
		// 						),
		// 						'coupon' => array(
		// 							'title' => '折扣金規則',
		// 							'purview_groupids' => [2]
		// 						),
		// 						'transfer' => array(
		// 							'title' => '轉帳帳號',
		// 							'purview_groupids' => [2]
		// 						)
		// 					)
		// 				)
		// 			)
		// 		),
		// 		'product' => array(
		// 			'title' => '銷售產品',
		// 			'child3' => array(
		// 				'product' => array(
		// 					'title' => '產品',
		// 					'child4' => array(
		// 						'edit' => array(
		// 							'title' => '編輯',
		// 							'purview_groupids' => [2]
		// 						),
		// 						'tablelist' => array(
		// 							'title' => '列表',
		// 							'purview_groupids' => [2]
		// 						)
		// 					)
		// 				),
		// 				'classmeta' => array(
		// 					'title' => '分類標籤',
		// 					'child4' => array(
		// 						'edit' => array(
		// 							'title' => '編輯',
		// 							'purview_groupids' => [2]
		// 						),
		// 						'tablelist' => array(
		// 							'title' => '列表',
		// 							'purview_groupids' => [2]
		// 						)
		// 					)
		// 				),
		// 				'classmeta2' => array(
		// 					'title' => '二級分類',
		// 					'child4' => array(
		// 						'edit' => array(
		// 							'title' => '編輯',
		// 							'purview_groupids' => [2]
		// 						),
		// 						'tablelist' => array(
		// 							'title' => '列表',
		// 							'purview_groupids' => [2]
		// 						)
		// 					)
		// 				),
		// 				'set' => array(
		// 					'title' => '產品系統',
		// 					'child4' => array(
		// 						'set' => array(
		// 							'title' => '設置',
		// 							'purview_groupids' => [2]
		// 						)
		// 					)
		// 				)
		// 			)
		// 		),
		// 		'gift' => array(
		// 			'title' => '贈品管理',
		// 			'child3' => array(
		// 				'gift' => array(
		// 					'title' => '贈品',
		// 					'child4' => array(
		// 						'edit' => array(
		// 							'title' => '編輯',
		// 							'purview_groupids' => [2]
		// 						),
		// 						'tablelist' => array(
		// 							'title' => '列表',
		// 							'purview_groupids' => [2]
		// 						)
		// 					)
		// 				)
		// 			)
		// 		),
		// 		'transport' => array(
		// 			'title' => '運費管理',
		// 			'child3' => array(
		// 				'transport' => array(
		// 					'title' => '運輸方式',
		// 					'child4' => array(
		// 						'edit' => array(
		// 							'title' => '編輯',
		// 							'purview_groupids' => [2]
		// 						),
		// 						'tablelist' => array(
		// 							'title' => '列表',
		// 							'purview_groupids' => [2]
		// 						)
		// 					)
		// 				)
		// 			)
		// 		),
		// 		'order_shop' => array(
		// 			'title' => '訂單管理',
		// 			'child3' => array(
		// 				'order_shop' => array(
		// 					'title' => '訂單',
		// 					'child4' => array(
		// 						'edit' => array(
		// 							'title' => '編輯',
		// 							'purview_groupids' => [2]
		// 						),
		// 						'tablelist' => array(
		// 							'title' => '列表',
		// 							'purview_groupids' => [2]
		// 						)
		// 					)
		// 				),
		// 				'set' => array(
		// 					'title' => '訂單系統',
		// 					'child4' => array(
		// 						'set' => array(
		// 							'title' => '設置',
		// 							'purview_groupids' => [2]
		// 						)
		// 					)
		// 				)
		// 			)
		// 		)
		// 	)
		// ),
		'project' => array(
			'title' => '公司內部管理',
			'child2' => array(
				'project' => array(
					'title' => '專案管理',
					'child3' => array(
						'project' => array(
							'title' => '專案',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2, 3, 4]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2, 3, 4]
								),
								// 'gantt' => array(
								// 	'title' => '甘特圖',
								// 	'purview_groupids' => [2, 3, 4]
								// )
							)
						),
						'classmeta' => array(
						 	'title' => '專案分類',
						 	'child4' => array(
						 		'edit' => array(
						 			'title' => '編輯',
									'purview_groupids' => [2, 3, 4]
						 		),
						 		'tablelist' => array(
						 			'title' => '列表',
									'purview_groupids' => [2, 3, 4]
						 		)
						 	)
						),
					 	'classmeta2' => array(
							'title' => '二級分類',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2, 3, 4]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2, 3, 4]
								)
							)
						)
					)
				),
				'worktask' => array(
					'title' => '工作任務',
					'child3' => array(
						'worktask' => array(
							'title' => '工作任務',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2, 3, 4]
								),
								'tablelist' => array(
									'title' => '任務列表',
									'purview_groupids' => [2, 3, 4]
								),
								'calendar' => array(
									'title' => '任務日曆',
									'purview_groupids' => [2, 3, 4]
								),
								'worktask_list_json' => array(
									'purview_groupids' => [2, 3, 4],
									'sidebar_hidden' => TRUE
								)
							)
						),
						'classmeta' => array(
							'title' => '任務分類',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2, 3, 4]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2, 3, 4]
								)
							)
						)
					)
				),
				'sales_target' => array(
					'title' => '業績管理',
					'child3' => array(
						'sales_target' => array(
							'title' => '業績進度',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						)
					)
				),
				'income' => array(
					'title' => '收入管理',
					'child3' => array(
						'income' => array(
							'title' => '收入進度',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						)
					)
				),
				'customer' => array(
					'title' => '客戶管理',
					'child3' => array(
						'customer' => array(
							'title' => '客戶資料',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						),
						'customermeet' => array(
							'title' => '拜訪紀錄',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						)
					)
				),
				'server_rent' => array(
					'title' => '伺服器租期管理',
					'child3' => array(
						'sales_target' => array(
							'title' => '伺服器租賃',
							'child4' => array(
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2]
								)
							)
						)
					)
				),
			)
		),
		'user' => array(
			'title' => '帳號設定',
			'child2' => array(
				'global' => array(
					'title' => '帳號資料',
					'child3' => array(
						// 'global' => array(//本功能為一般網站時開啟
						// 	'title' => '全域',
						// 	'child4' => array(
						// 		'user' => array(
						// 			'title' => '會員資料',
						// 			'purview_groupids' => [2, 100]
						// 		)
						// 	)
						// ),
						'global_shop' => array(//本選項為購物網站時才開啟，具會員購物資料填寫功能
							'title' => '全域',
							'child4' => array(
								'user' => array(
									'title' => '會員資料',
									'purview_groupids' => [2, 100]
								)
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
								'edit' => array(
									'title' => '編輯',
									'purview_groupids' => [2, 100]
								),
								'tablelist' => array(
									'title' => '列表',
									'purview_groupids' => [2, 100]
								)
							)
						)
					)
				)
			)
		)
	);