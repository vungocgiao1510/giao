<?php
class Home extends DefaultController {
	public function __construct() {
		parent::__construct ();
		if ($this->uri->segment ( 1 ) == "vn" || $this->uri->segment ( 1 ) == "en") {
			$ses_lang = array (
					'getlangID' => $this->uri->segment ( 1 ) 
			);
			$this->session->set_userdata ( $ses_lang );
		} else {
			$ses_lang = array (
					'getlangID' => 'vn' 
			);
			$this->session->set_userdata ( $ses_lang );
		}
		$this->_data ['lang'] = $this->session->userdata ( 'getlangID' );
		// Kiểm tra xem session đang lưu ngôn ngữ nào, rồi require đến ngôn ngữ đó.
		if ($this->_data ['lang'] == "vn") {
			$this->lang->load ( "home", 'vietnamese' );
		} elseif ($this->_data ['lang'] == "en") {
			$this->lang->load ( "home", 'english' );
		} else {
			$this->lang->load ( "home", 'vietnamese' );
		}
		// Thu vien gio hang.
		$this->load->helper ( "Menu" );
		$this->_data ['setting'] = $this->Msetting->getSettingById ( $this->_data['lang'] );
		$this->_data ['menu'] = $this->Mcategorie->listCategorie2 ( $this->_data ['lang'] );
		$this->_data ['productnb'] = $this->Mproducts->listAllProductHot ( 8, $this->_data ['lang'] );
		// Sản phẩm nổi bật.
		$this->_data ['productnb2'] = $this->Mproducts->listAllProductHot ( 5, $this->_data ['lang'] );
		// Sản phẩm nổi bật 2.
		$this->_data ['productnews'] = $this->Mproducts->listAllProductNews ( $this->_data ['lang'] );
		// Sản phẩm mới.
		$this->_data ['news'] = $this->Mnews->listAllNews2 ( $this->_data ['lang'] );
		// Tin tức mới.
	}
	public function index() {
		$this->_data ['slide'] = $this->Mimages->getImagesByProperties ( $this->_data ['lang'], 1, 3);
		$this->_data ['qc'] = $this->Mimages->getImagesByProperties ($this->_data['lang'],3, 4);
		$meta = $this->_data ['setting'];
		$this->_data['title'] = $this->lang->line("homepage");
		$this->_data ['titleseo'] = $meta['title'];
		$this->_data['keywords'] = $meta['keywords'];
		$this->_data['descriptionseo'] = $meta['description'];
		$this->_data['imageseo'] = $meta['logo'];
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/main", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );
	}
	public function category() {
		$linkseo = ( string ) $this->uri->segment ( 2 );
		$data = $this->Mcategorie->listCategorieByLinkseo ( $linkseo, $this->_data ['lang']);
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		$id = ( int ) $data ['id'];
		switch ($data ['service']) {
			case '1' :
				$this->news ( $id );
				break;
			case '2' :
				$this->products ( $id );
				break;
			case '3' :
				$this->contact ( $id );
				break;
		}
	}
	public function countUserOnline(){
		
	}
	public function news($id = "") {
		$this->load->helper("CutText");
		$this->_data ['cate'] = $this->Mcategorie->listCategorieById ( $id, $this->_data ['lang']);
		$cate = $this->_data ['cate'];
		$meta = $this->_data ['setting'];
		$this->_data ['title'] = ($cate ['titleseo']) ? $cate ['titleseo'] : $meta['title'];
		$this->_data ['titleseo'] = ($cate ['titleseo']) ? $cate ['titleseo'] : $meta['title'];
		$this->_data['keywords'] = ($cate ['keywords']) ? $cate ['keywords'] : $meta['keywords'];
		$this->_data['descriptionseo'] = ($cate ['description']) ? $cate ['description'] : $meta['description'];
		$this->_data['imageseo'] = $meta['logo'];
		// phan trang
		$config ['base_url'] = base_url () . $this->_data ['lang'] . "/" . $cate ['linkseo'];
		// $config ['base_url'] = base_url () . "gcms/user/index/";
		$config ['total_rows'] = $this->Mproducts->countAll ( $this->_data ['lang'] );
		$config ['per_page'] = 10;
		$config ['uri_segment'] = 3;
		$config ['full_tag_open'] = '<ul class="pagination">';
		$config ['full_tag_close'] = '</ul>';
		$config ['first_link'] = 'Đầu trang';
		$config ['last_link'] = 'Cuối trang';
		$config ['first_tag_open'] = '<li>';
		$config ['first_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li>';
		$config ['last_tag_close'] = '</li>';
		$config ['prev_link'] = '&laquo;';
		$config ['prev_tag_open'] = '<li>';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = '&raquo;';
		$config ['next_tag_open'] = '<li>';
		$config ['next_tag_close'] = '</li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['use_page_numbers'] = TRUE;
		// $config ['page_query_string'] = TRUE;
		// $config ['page_query_string'] = TRUE;
		// Truyền $config vào initialize.
		$this->pagination->initialize ( $config );
		$this->_data ['pagination'] = $this->pagination->create_links ();
		// $current_page = ($this->input->get ( "per_page" )) ? $this->input->get ( "per_page" ) : 1;
		$current_page = ($this->uri->segment ( 3 )) ? $this->uri->segment ( 3 ) : 1;
		$start = ($current_page - 1) * $config ['per_page'];
		$this->_data['data'] = $this->Mnews->listAllNewsByCate($config ['per_page'],$start,$this->_data['lang'],$cate['id']);
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/news", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );
	}
	public function detailnews($id="") {
		$id = $this->uri->segment(4);
		// show news
		$this->_data['data'] = $this->Mnews->getNewsById2($this->_data['lang'],$id);
		$data = $this->_data['data'];
		$uri = $this->uri->segment(2);
		$this->_data ['cate'] = $this->Mcategorie->listCategorieByLinkseo( $uri,$this->_data ['lang']);
		$cate = $this->_data ['cate'];
		$meta = $this->_data ['setting'];
		$this->_data ['title'] = ($data['titleseo']) ? $data['titleseo'] : $meta['title'];
		$this->_data ['titleseo'] = ($data['titleseo']) ? $data['titleseo'] : $meta['title'];
		$this->_data['keywords'] = ($data['keyword']) ? $data['keyword'] : $meta['keywords'];
		$this->_data['descriptionseo'] = ($cate['description']) ? $cate['description'] : $meta['description'];
		$this->_data['imageseo'] = $data['image'];

		$this->_data['other'] = $this->Mnews->listAllNewsOther($this->_data['lang'],$id);
		// Other news.
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/detailnews", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );
	}
	public function products($id = "") {
		$this->_data ['cate'] = $this->Mcategorie->listCategorieById ( $id, $this->_data ['lang']);
		$cate = $this->_data ['cate'];
		$meta = $this->_data ['setting'];
		$this->_data ['title'] = ($cate ['titleseo']) ? $cate ['titleseo'] : $meta['title'];
		$this->_data ['titleseo'] = ($cate ['titleseo']) ? $cate ['titleseo'] : $meta['title'];
		$this->_data['keywords'] = ($cate ['keywords']) ? $cate ['keywords'] : $meta['keywords'];
		$this->_data['descriptionseo'] = ($cate ['description']) ? $cate ['description'] : $meta['description'];
		$this->_data['imageseo'] = $meta['logo'];
		// echo "<pre>";
		// print_r($cate);
		// echo "</pre>";
		// config setting phần phân trang.
		$config ['base_url'] = base_url () . $this->_data ['lang'] . "/" . $cate ['linkseo'];
		// $config ['base_url'] = base_url () . "gcms/user/index/";
		$config ['total_rows'] = $this->Mproducts->countAll ( $this->_data ['lang'] );
		$config ['per_page'] = 10;
		$config ['uri_segment'] = 3;
		$config ['full_tag_open'] = '<ul class="pagination">';
		$config ['full_tag_close'] = '</ul>';
		$config ['first_link'] = 'Đầu trang';
		$config ['last_link'] = 'Cuối trang';
		$config ['first_tag_open'] = '<li>';
		$config ['first_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li>';
		$config ['last_tag_close'] = '</li>';
		$config ['prev_link'] = '&laquo;';
		$config ['prev_tag_open'] = '<li>';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = '&raquo;';
		$config ['next_tag_open'] = '<li>';
		$config ['next_tag_close'] = '</li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['use_page_numbers'] = TRUE;
		// $config ['page_query_string'] = TRUE;
		// $config ['page_query_string'] = TRUE;
		// Truyền $config vào initialize.
		$this->pagination->initialize ( $config );
		$this->_data ['pagination'] = $this->pagination->create_links ();
		// $current_page = ($this->input->get ( "per_page" )) ? $this->input->get ( "per_page" ) : 1;
		$current_page = ($this->uri->segment ( 3 )) ? $this->uri->segment ( 3 ) : 1;
		$start = ($current_page - 1) * $config ['per_page'];
		// $start = $this->uri->segment(3);
		// echo $cate['check_parent']."<br />";
		// echo $cate['id'];
		$this->_data ['data'] = "";
		if ($cate ['check_parent'] != 1) {
			$this->_data ['data'] = $this->Mproducts->listAllProductByCate ( $config ['per_page'], $start, $this->_data ['lang'], $cate ['id'] );
		} else {
			$this->_data ['data'] = $this->Mproducts->listAllProductByCateMain ( $config ['per_page'], $start, $this->_data ['lang'], $cate ['id'] );
		}
		// echo $this->db->last_query();
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/products", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );
	}
	public function detailproducts() {
		$id = $this->uri->segment(4);
		// show product
		$this->_data['data'] = $this->Mproducts->getProductsById($id,$this->_data ['lang']);
		$data = $this->_data['data'];
		// Meta
		$uri = $this->uri->segment(2);
		$this->_data ['cate'] = $this->Mcategorie->listCategorieByLinkseo( $uri,$this->_data ['lang']);
		$cate = $this->_data ['cate'];
		$meta = $this->_data ['setting'];
		$this->_data ['title'] = ($data['titleseo']) ? $data['titleseo'] : $meta['title'];
		$this->_data ['titleseo'] = ($data['titleseo']) ? $data['titleseo'] : $meta['title'];
		$this->_data['keywords'] = ($data['keyword']) ? $data['keyword'] : $meta['keywords'];
		$this->_data['descriptionseo'] = ($cate['description']) ? $cate['description'] : $meta['description'];
		$this->_data['imageseo'] = $data['image'];
		$this->_data['other'] = "";
		if ($cate ['check_parent'] != 1) {
			$this->_data['other'] = $this->Mproducts->listAllProductOther($this->_data['lang'],$cate['id'],$id);
		} else {
			$this->_data['other'] = $this->Mproducts->listAllProductOtherMain($this->_data['lang'],$cate['id'],$id);
		}
		
// 		echo "<pre>";
// 		print_r($this->_data['other']);die;
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/detailproducts", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );
	}
	public function addcart(){
		$id = $this->uri->segment(3);
		$product=$this->Mproducts->getProductById($id);
		$shop=array(
			"id" => $product['id'],
			"name" => $product['title'],
			"image" => $product['image'],
			"price" => $product['price'],
			"qty" => 1,
		);
		$this->cart->insert($shop);
		redirect(base_url().$this->_data['lang']."/gio-hang");
	}
	public function cart(){
		// echo "<pre>";
		// print_r($this->cart->contents());
		$this->_data['title'] = "Giỏ hàng của bạn";
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/cart", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );
	}
	public function updatecart(){
		$shop = array(
			"rowid" => $this->input->post("rowid"),
			"qty" => $this->input->post("qty"),
		);
		$this->cart->update($shop);
		$this->load->view ( "default/ajaxupdate", $this->_data );
	}
	public function deletecart(){
		$id = $this->uri->segment(3);
		echo $id;
		foreach($this->cart->contents() as $item){
			if($item['id'] == $id){
				$data['rowid'] = $item['rowid'];
				$data['qty'] = 0;
				$this->cart->update($data);
			}
		}
		redirect(base_url().$this->_data['lang']."/gio-hang");
	}
	public function destroy(){
		$this->cart->destroy();
	}
	public function order(){
		$this->_data['title'] = "Đặt hàng";
		$this->load->helper("captcha");
		$this->_data['error'] = "";
		$vals = array(
		        // 'word'          => 'Random word',
		        'img_path'      => './public/default/captcha/',
		        'img_url'       =>  base_url()."public/default/captcha",
		        // 'font_path'     => './path/to/fonts/texb.ttf',
		        'img_width'     => '150',
		        'img_height'    => 30,
		        'expiration'    => 60,
		        'word_length'   => 8,
		        'font_size'     => 16,
		        'img_id'        => 'Imageid',
		        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

		        // White background and border, black text and red grid
		        		'colors'        => array(
		                'background' => array(255, 255, 255),
		                'border' => array(255, 255, 255),
		                'text' => array(0, 0, 0),
		                'grid' => array(255, 40, 40)
		        )
		);

		$this->_data['cap'] = create_captcha($vals);
		$this->_data['data'] = $this->cart->contents();
		$captcha = $this->_data['cap'];
		// Insert data
		$this->session->set_userdata("captcha", $captcha['word']);
        $this->form_validation->set_rules('fullname', 'Fullname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');		
        // $this->form_validation->set_rules('captcha', 'captcha', 'required');		
        if ($this->form_validation->run() == TRUE){
			$insert = array(
				'fullname' => htmlspecialchars(trim($this->input->post("fullname"))),
				'phone' => htmlspecialchars(trim($this->input->post("phone"))),
				'email' => htmlspecialchars(trim($this->input->post("email"))),
				'address' => htmlspecialchars(trim($this->input->post("address"))),
				'content' => htmlspecialchars(trim($this->input->post("content"))),
				'active' => 2,
				'items' => serialize($this->cart->contents()),
				'totals' => $this->cart->total(),
				'created' => date("Y-m-d")
				);
			$this->load->model("Morder");
			$this->Morder->insertOrder($insert);
			$this->cart->destroy();
			redirect(base_url().$this->_data['lang']."/success");
        }		
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/order", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );		
	}
	public function search(){
		$keyword = $this->input->get("keyword");
		$meta = $this->_data ['setting'];
		$this->_data ['title'] = $meta['title'];
		$this->_data ['titleseo'] = $meta['title'];
		$this->_data['keywords'] = $meta['keywords'];
		$this->_data['descriptionseo'] = $meta['description'];
		$this->_data['imageseo'] = $meta['logo'];
		// config setting phần phân trang.
		$config ['base_url'] = base_url () . $this->_data ['lang'] . "/tim-kiem?keyword=".$keyword;
		// $config ['base_url'] = base_url () . "gcms/user/index/";
		$config ['total_rows'] = $this->Mproducts->countSearchProducts($keyword, $this->_data ['lang'] );
		$config ['per_page'] = 10;
		$config ['uri_segment'] = 3;
		$config ['full_tag_open'] = '<ul class="pagination">';
		$config ['full_tag_close'] = '</ul>';
		$config ['first_link'] = 'Đầu trang';
		$config ['last_link'] = 'Cuối trang';
		$config ['first_tag_open'] = '<li>';
		$config ['first_tag_close'] = '</li>';
		$config ['last_tag_open'] = '<li>';
		$config ['last_tag_close'] = '</li>';
		$config ['prev_link'] = '&laquo;';
		$config ['prev_tag_open'] = '<li>';
		$config ['prev_tag_close'] = '</li>';
		$config ['next_link'] = '&raquo;';
		$config ['next_tag_open'] = '<li>';
		$config ['next_tag_close'] = '</li>';
		$config ['num_tag_open'] = '<li>';
		$config ['num_tag_close'] = '</li>';
		$config ['cur_tag_open'] = '<li class="active"><a href="#">';
		$config ['cur_tag_close'] = '</a></li>';
		$config ['use_page_numbers'] = TRUE;
		$config ['page_query_string'] = TRUE;
		// Truyền $config vào initialize.
		$this->pagination->initialize ( $config );
		$this->_data ['pagination'] = $this->pagination->create_links ();
		// $current_page = ($this->input->get ( "per_page" )) ? $this->input->get ( "per_page" ) : 1;
		$current_page = ($this->input->get('per_page')) ? $this->input->get('per_page') : 1;
		$start = ($current_page - 1) * $config ['per_page'];
		// $start = $this->uri->segment(3);
		// echo $cate['check_parent']."<br />";
		// echo $cate['id'];
		$this->_data['data'] = $this->Mproducts->searchProduct($keyword,$config ['per_page'],$start,$this->_data['lang']);
		// echo $this->db->last_query();
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/search", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );
	}
	public function success(){
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/success", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );	
	}
	public function contact() {
		$this->load->helper("captcha");
		$this->_data['error'] = "";
		$vals = array(
				// 'word'          => 'Random word',
				'img_path'      => './public/default/captcha/',
				'img_url'       =>  base_url()."public/default/captcha",
				// 'font_path'     => './path/to/fonts/texb.ttf',
				'img_width'     => '150',
				'img_height'    => 30,
				'expiration'    => 60,
				'word_length'   => 4,
				'font_size'     => 16,
				'img_id'        => 'Imageid',
				'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
				
				// White background and border, black text and red grid
				'colors'        => array(
						'background' => array(255, 255, 255),
						'border' => array(255, 255, 255),
						'text' => array(0, 0, 0),
						'grid' => array(255, 40, 40)
				)
		);
		
		$this->_data['cap'] = create_captcha($vals);
		$this->_data['data'] = $this->cart->contents();
		$this->session->set_userdata("captcha", $this->_data['cap']);
		$this->load->view ( "default/top", $this->_data );
		$this->load->view ( "default/contact", $this->_data );
		$this->load->view ( "default/bottom", $this->_data );
	}
	public function successContact(){
		$ok = $this->input->post("ok");
		if(isset($ok)){
			$captcha = $this->session->userdata['captcha'];
			if($this->input->post("captcha") == $captcha['word']){
				$insert = array(
						'name' => htmlspecialchars(trim($this->input->post("fullname"))),
						'phone' => htmlspecialchars(trim($this->input->post("phone"))),
						'email' => htmlspecialchars(trim($this->input->post("email"))),
						'address' => htmlspecialchars(trim($this->input->post("address"))),
						'content' => htmlspecialchars(trim($this->input->post("content"))),
						'active' => 2,
						'created' => date("Y-m-d")
				);
				$this->Mcontact->insertContact($insert);
				redirect(base_url().$this->_data['lang']."/success");
			} else {
				echo "<script>alert('Sai mã bảo vệ !!!')
				window.location.replace('".base_url().$this->_data['lang'].'/lien-he'."');
				</script>";
			}
		} else {
			redirect(base_url().$this->_data['lang']."/lien-he");
		}
	}
}
?>
