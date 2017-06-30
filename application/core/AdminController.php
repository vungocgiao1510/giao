<?php
class AdminController extends MY_Controller {
	protected $_data;
	public function __construct() {
		// $mod sẽ lấy tên hiển thị ở vị trí thứ 1.
		$mod = $this->uri->segment ( 1 );
		$this->_data ['module'] = $mod;
		// $this->_data['path'] là đường dẫn đến template chính bên views ngoài.
		$this->_data ['path'] = "$mod/template";
		// Kiểm tra xem session level có đúng là admin hay không, nếu không thì tự động đẩy ra ngoài đăng nhập.
		if (!$this->session->userdata ['username'] && $this->uri->segment(2) != "login") {
			redirect ( base_url () . $mod );
		}
		$this->load->helper("Permissions");
		$permissions = $this->session->userdata("permissions");
		$key = $this->uri->segment(2)."/".$this->uri->segment(3);
		$level = $this->session->userdata("level");
		checkPermission($permissions,$key,$level);
		// Kiểm tra ngôn ngữ và tự động require đến folder languages.
		if ($this->session->userdata ['lang'] == "vn") {
			$this->lang->load ( "gcms", 'vietnamese' );
		} elseif ($this->session->userdata ['lang'] == "en") {
			$this->lang->load ( "gcms", 'english' );
		} else {
			$this->lang->load ( "gcms", 'vietnamese' );
		}
		$lang = $this->session->userdata ['lang'];
		$this->_data ['getlangID'] = $lang;
		$this->form_validation->CI =& $this;
		// Helper cho link SEO.
		$this->load->helper("Seourl");
		// Helper cho menu đệ quy.
		$this->load->helper("Menu");
		/*
		 * Mảng menu trái được gọi ra giúp dễ tùy biến hơn thay vì sử dụng HTML hiển thị.
		 */
		$this->_data ['leftmenu'] = array (
				array (
						"root" => $this->lang->line ( 'dashboard' ),
						"img" => base_url () . "public/gcms/img/dashboard.png",
						"url" => base_url () . $mod . "/home/index",
						"controller" => "home",
				),
				array (
						"root" => "Quản lý bài viết",
						"img" => base_url () . "public/gcms/img/list.png",
						"url" => base_url () . "gcms/news/index",
						"controller" => "news",
						"parent" => array (
								array (
										"parentname" => "Tất cả bài viết",
										"parenturl" => base_url () . "gcms/news/index"
								),
								array (
										"parentname" => "Bài viết mới",
										"parenturl" => base_url () . "gcms/news/add"
								) 
						) 
				),
				array (
						"root" => "Quản lý sản phẩm",
						"img" => base_url () . "public/gcms/img/small-rocket-ship-silhouette.png",
						"url" => base_url () . "gcms/products/index",
						"controller" => "products",
						"parent" => array (
								array (
										"parentname" => "Tất cả sản phẩm",
										"parenturl" => base_url () . "gcms/products/index",
								),
								array (
										"parentname" => "Sản phẩm mới",
										"parenturl" => base_url () . "gcms/products/add"
								) 
						) 
				),
				array (
						"root" => "Danh sách đơn hàng",
						"img" => base_url () . "public/gcms/img/shopping-cart-black-shape.png",
						"url" => base_url () . "gcms/order/index",
						"controller" => "order",
						"parent" => array (
								array (
										"parentname" => "Tất cả đơn hàng",
										"parenturl" => base_url () . "gcms/order/index",
								),
								array (
										"parentname" => "Đơn hàng chưa xử lý",
										"parenturl" => base_url () . "gcms/order/inactive",
								),
								array (
										"parentname" => "Đơn hàng đã xử lý",
										"parenturl" => base_url () . "gcms/order/active",
								) 
						) 
				),
				array (
						"root" => "Quản lý chuyên mục",
						"img" => base_url () . "public/gcms/img/earth-globe.png",
						"url" => base_url () . "gcms/categorie/index",
						"controller" => "categorie",
						"parent" => array (
								array (
										"parentname" => "Tất cả chuyên mục",
										"parenturl" => base_url () . "gcms/categorie/index" 
								),
								array (
										"parentname" => "Chuyên mục mới",
										"parenturl" => base_url () . "gcms/categorie/add" 
								) 
						) 
				),
				array (
						"root" => "Quảng cáo",
						"img" => base_url () . "public/gcms/img/open-wrench-tool-silhouette.png",
						"url" => base_url () . "gcms/images/index",
						"controller" => "images",
						"parent" => array (
								array (
										"parentname" => "Danh sách",
										"parenturl" => base_url () . "gcms/images/index",
								),
								array (
										"parentname" => "Thêm mới",
										"parenturl" => base_url () . "gcms/images/add",
								),
						) 
				),
				array (
						"root" => "Quản lý thành viên",
						"img" => base_url () . "public/gcms/img/group-profile-users.png",
						"url" => base_url () . "gcms/user/index",
						"controller" => "user",
						"parent" => array (
								array (
										"parentname" => "Tất cả thành viên",
										"parenturl" => base_url () . "gcms/user/index",
								),
								array (
										"parentname" => "Thêm mới thành viên",
										"parenturl" => base_url () . "gcms/user/add",
								),
								array (
										"parentname" => "Nhóm thành viên",
										"parenturl" => base_url () . "gcms/user/usergroup",
								),
								array (
										"parentname" => "Tạo nhóm thành viên",
										"parenturl" => base_url () . "gcms/user/add_usergroup",
								),
								array (
										"parentname" => "Hồ sơ của bạn",
										"parenturl" => base_url () . "gcms/user/myprofile",
								) 
						) 
				),
				array (
						"root" => "Liên kết",
						"img" => base_url () . "public/gcms/img/open-wrench-tool-silhouette.png",
						"url" => base_url () . "gcms/links/index",
						"controller" => "links",
						"parent" => array (
								array (
										"parentname" => "Danh sách",
										"parenturl" => base_url () . "gcms/links/index",
								),
								array (
										"parentname" => "Thêm mới",
										"parenturl" => base_url () . "gcms/links/add",
								),
						)
				),
				array (
						"root" => "Hòm thư liên hệ",
						"img" => base_url () . "public/gcms/img/envelope.png",
						"url" => base_url () . "gcms/contact/index",
						"controller" => "contact",
				),
				array (
						"root" => "Bình luận phản hồi",
						"img" => base_url () . "public/gcms/img/comment-black-oval-bubble-shape.png",
						"url" => base_url () . "gcms/comment/index",
						"controller" => "comment",
				),
				array (
						"root" => "Cấu hình hệ thống",
						"img" => base_url () . "public/gcms/img/settings.png",
						"url" => base_url () . "gcms/setting/index",
						"controller" => "setting",
				) 
		);
	}
}