<?php
/*
 * Custom Helpers
 *
 */
if (strpos($_SERVER['REQUEST_URI'], '/index.php') !== false) {
	$ci =& get_instance();
	$ci->load->helper('url');
	redirect(current_url());
	exit();
}

function payout_settings()
{
	$ci =& get_instance();
	$ci->load->model("earnings_admin_model");
	$data = array(
		// paypal
		'payout_paypal_enabled' => 1,
		'min_payout_paypal' => price_database_format(300000),
		// iban
		'payout_iban_enabled' => 0,
		'min_payout_iban' => price_database_format(50000),
		// Swift
		'payout_swift_enabled' => 0,
		'min_payout_swift' => price_database_format(100000)
	);
	$ci->db->where('id', 1);
	$ci->db->update('payment_settings', $data);
	// if ($this->db->update('payment_settings', $data)) {
	//     $this->session->set_flashdata('success', "Pengaturan Pencairan Berhasil Diubah");
	//     echo "<script>alert('Pengaturan Pencairan Berhasil Diubah')</script>";
	// }else {
	//     $this->session->set_flashdata('success', "Pengaturan Pencairan Gagal Diubah");
	//     echo "<script>alert('Pengaturan Pencairan Gagal Diubah')</script>";
	// }
}

function email_option()
{
	$ci =& get_instance();
	// Mail Options
	$config['send_email_new_product'] = 1; 
	$config['send_email_buyer_purchase'] = 0;
	$config['send_email_order_shipped'] = 0;
	$config['send_email_contact_messages'] = 0;
	$config['send_email_shop_opening_request'] = 0;
	$config['send_email_bidding_system'] = 0;
	$config['mail_options_account'] = ""; //alamat email untuk menerima email admin
	$ci->settings_model->update_email_options($config);
	// if ($this->settings_model->update_email_options($config)) {
	//     $this->session->set_flashdata('success', "Opsi Email Berhasil Diubah");
	//     echo "<script>alert('Opsi Email Berhasil Diubah')</script>";
	// } else {
	//     $this->session->set_flashdata('error', "Opsi Email Gagal Diubah");
	//     echo "<script>alert('Opsi Email Gagal Diubah')</script>";
	// }
}

function email_settings()
{
	$ci =& get_instance();
	// Mail Settings
	$config['mail_library'] = "php"; //swift,php,codeigniter
	$config['mail_protocol'] = "smtp"; //smtp,mail
	$config['mail_title'] = "Petaniku";
	$config['mail_host'] = "smtp.gmail.com";
	$config['mail_port'] = 587;
	$config['mail_username'] = "topun2018@gmail.com"; 
	$config['mail_password'] = "mrrekwurcflogmvi";
	$ci->settings_model->update_email_settings($config);
	// if ($this->settings_model->update_email_settings($config)) {
	//     $this->session->set_flashdata('success', "Pengaturan Email Berhasil Diubah");
	//     echo "<script>alert('Pengaturan Email Berhasil Diubah')</script>";
	// } else {
	//     $this->session->set_flashdata('error', "Pengaturan Email Gagal Diubah");
	//     echo "<script>alert('Pengaturan Email Gagal Diubah')</script>";
	// }
}

function cache_system()
{
	$ci =& get_instance();
	$config['cache_system'] = 1;
	$config['refresh_cache_database_changes'] = 1;
	$config['cache_refresh_time'] = 30;
	$ci->settings_model->update_cache_system($config);
	// if ($this->settings_model->update_cache_system($config)) {
	//     $this->session->set_flashdata('success', "Sistem Cache Berhasil Diubah");
	//     echo "<script>alert('Sistem Cache Email Berhasil Diubah')</script>";
	// } else {
	//     $this->session->set_flashdata('error', "Sistem Cache Gagal Diubah");
	//     echo "<script>alert('Sistem Cache Email Gagal Diubah')</script>";
	// }
}

function seo_tools()
{
	$ci =& get_instance();
	$ci->load->model("sitemap_model");
	$config['frequency'] = "monthly"; //none,always,hourly,daily,weekly,monthly,yearly,never
	$config['last_modification'] = "server_response"; //none,server_response   
	$config['priority'] = "none"; //none, automatically
	$config['google_analytics'] = "";
	$ci->settings_model->update_seo_tools($config);
	$ci->sitemap_model->update_sitemap_settings($config);
	
	// if ($this->settings_model->update_seo_tools($config) && $this->sitemap_model->update_sitemap_settings($config)) {
	//     $this->session->set_flashdata('success', "Pengaturan SEO Berhasil Diubah");
	//     echo "<script>alert('Pengaturan SEO Berhasil Diubah')</script>";
	// } else {
	//     $this->session->set_flashdata('error', "Pengaturan SEO Gagal Diubah");
	//     echo "<script>alert('Pengaturan SEO Gagal Diubah')</script>";
	// }
}

function preferences()
{
	$ci =& get_instance();
	// Homepage Preferences
	$config['index_slider'] = 1; //1 = lihat slider, 0 = sembunyikan slider
	$config['index_categories'] = 0; // 1=lihat,2=sembunyikan
	$config['index_promoted_products'] = 0;
	$config['index_latest_products'] = 1;
	$config['index_blog_slider'] = 1;
	$config['index_promoted_products_count'] = 8;
	$config['index_latest_products_count'] = 10;
	// General Preferences
	$config['multilingual_system'] = 0;
	$config['rss_system'] = 0;
	$config['vendor_verification_system'] = 1;
	$config['guest_checkout'] = 0;
	// Products Preferences
	$config['approve_before_publishing'] = 1;
	$config['promoted_products'] = 0;
	$config['product_link_structure'] = "slug-id"; //slug-id, id-slug
	// Review Comments Preferences
	$config['product_reviews'] = 1;
	$config['user_reviews'] = 1;
	$config['product_comments'] = 1;
	$config['blog_comments'] = 1;
	$ci->settings_model->update_preferences($config);
	// if ($this->settings_model->update_preferences($config)) {
	//     $this->session->set_flashdata('success', "Pengaturan Preferences Berhasil Diubah");
	//     echo "<script>alert('Pengaturan Preferences Berhasil Diubah')</script>";
	// }else {
	//     $this->session->set_flashdata('success', "Pengaturan Preferences Gagal Diubah");
	//     echo "<script>alert('Pengaturan Preferences Gagal Diubah')</script>";
	// }
}

function settings()
{
	$ci =& get_instance();
	$data = array(
		'site_title' => "Modesy",
		'homepage_title' => "Index",
		'site_description' => "Modesy",
		'keywords' => "modesy",
		'about_footer' => "",
		'copyright' => "",
		// Sosmed Setting
		'facebook_url' => "",
		'twitter_url' => "",
		'instagram_url' => "",
		'pinterest_url' => "",
		'linkedin_url' => "",
		'vk_url' => "",
		'youtube_url' => "", 
		// Pengaturan Kontak
		'contact_text' => "",
		'contact_address' => "",
		'contact_email' => "",
		'contact_phone' => "",
		// alert cookie
		'cookies_warning' => 1,
		'cookies_warning_text' => "This site uses cookies. By continuing to browse the site you are agreeing to our use of cookies."
	);
	$lang_id = 2; //2 = Indonesia, 1 = inggris

	$ci->db->where('lang_id', $lang_id);
	$ci->db->update('settings', $data);
	// if ($this->db->update('settings', $data)) {
	//     $this->session->set_flashdata('success', "Pengaturan Berhasil Diubah");
	//     echo "<script>alert('Pengaturan Berhasil Diubah')</script>";
	// }else {
	//     $this->session->set_flashdata('success', "Pengaturan Gagal Diubah");
	//     echo "<script>alert('Pengaturan Gagal Diubah')</script>";
	// }
}

function general_settings()
{
	$ci =& get_instance();
	$data = array(
		'application_name' => "Modesy",
		'head_code' => ""
	);

	$ci->db->where('id', 1);
	$ci->db->update('general_settings', $data);
	// if ($this->db->update('general_settings', $data)) {
	//     $this->session->set_flashdata('success', "Pengaturan Umum Berhasil Diubah");
	//     echo "<script>alert('Pengaturan Umum Berhasil Diubah')</script>";
	// }else {
	//     $this->session->set_flashdata('success', "Pengaturan Umum Gagal Diubah");
	//     echo "<script>alert('Pengaturan Umum Gagal Diubah')</script>";
	// }
}

function maintenance()
{
	$ci =& get_instance();
	$data = array(
		'maintenance_mode_title' => "Coming Soon",
		'maintenance_mode_description' => "Our website is under construction. We'll be here soon with our new awesome site.",
		'maintenance_mode_status' => 0,
	);

	$ci->db->where('id', 1);
	$ci->db->update('general_settings', $data);
}

function bank_transfer_setting()
{
	$ci =& get_instance();
	$fh = fopen('DATABASE_BANK.txt','r');

	$config['bank_transfer_enabled'] = 1;
	$bank_akun = "
	<p>Pilih salah satu pembayaran melalui akun bank di bawah ini</p>

	<ul>";
	while ($line = fgets($fh)) {
		$bank_akun .= "<li>".$line."</li>";            
	}
	$bank_akun .= "</ul>";
	fclose($fh);

	$config["bank_transfer_accounts"] = $bank_akun;
	$data = array(
		'bank_transfer_enabled' => $config['bank_transfer_enabled'],
		'bank_transfer_accounts' => $config['bank_transfer_accounts']
	);

	$ci->db->where('id', 1);
	$ci->db->update('payment_settings', $data);
}

function setting_recaptcha()
{
	$ci =& get_instance();
	$config['recaptcha_site_key'] = "";
	$config['recaptcha_secret_key'] = "";
	$config['recaptcha_lang'] = "en";
	$ci->settings_model->update_recaptcha_settings($config);

	// if ($this->settings_model->update_recaptcha_settings($config)) {
	// 	$this->session->set_flashdata('success', "Pengaturan Recaptcha Berhasil Diubah");
	//     echo "<script>alert('Pengaturan Recaptcha Berhasil Diubah')</script>";
	// }else {
	//     $this->session->set_flashdata('success', "Pengaturan Recaptcha Gagal Diubah");
	//     echo "<script>alert('Pengaturan Recaptcha Gagal Diubah')</script>";
	// }
}

function maintenance_mode()
{
	$ci =& get_instance();
	$config['maintenance_mode_title'] = "Coming Soon";
	$config['maintenance_mode_description'] = "Our website is under construction. We'll be here soon with our new awesome site.";
	$config['maintenance_mode_status'] = 0; // 0 = Nonaktif, 1 = Aktif
	$ci->settings_model->update_maintenance_mode_settings($config);

	// if ($this->settings_model->update_maintenance_mode_settings($config)) {
	// 	$this->session->set_flashdata('success', "Maintenance Mode Berhasil Diubah");
	//     echo "<script>alert('Maintenance Mode Berhasil Diubah')</script>";
	// }else {
	//     $this->session->set_flashdata('success', "Maintenance Mode Gagal Diubah");
	//     echo "<script>alert('Maintenance Mode Gagal Diubah')</script>";
	// }
}
// END Config Setting

// carbon
if (!function_exists('hitung_waktu')) {
	function hitung_waktu($waktu)
	{
		$human = \Carbon\Carbon::parse($waktu)->diffForHumans();
		$human = str_replace("dari sekarang", "lagi", $human);

		if (strpos($human, 'yang lalu') !== false) {
			return "Telah berakhir";
		}

		return $human;
	}
}

//post method
if (!function_exists('post_method')) {
	function post_method()
	{
		$ci =& get_instance();
		if ($ci->input->method(FALSE) != 'post') {
			exit();
		}
	}
}

//get method
if (!function_exists('get_method')) {
	function get_method()
	{
		$ci =& get_instance();
		if ($ci->input->method(FALSE) != 'get') {
			exit();
		}
	}
}

//check auth
if (!function_exists('lang_base_url')) {
	function lang_base_url()
	{
		// Get a reference to the controller object
		$ci =& get_instance();
		return $ci->lang_base_url;
	}
}

//check auth
if (!function_exists('auth_check')) {
	function auth_check()
	{
		// Get a reference to the controller object
		$ci =& get_instance();
		return $ci->auth_model->is_logged_in();
	}
}

//is admin
if (!function_exists('is_admin')) {
	function is_admin()
	{
		// Get a reference to the controller object
		$ci =& get_instance();
		return $ci->auth_model->is_admin();
	}
}

//get logged user
if (!function_exists('user')) {
	function user()
	{
		// Get a reference to the controller object
		$ci =& get_instance();
		$user = $ci->auth_model->get_logged_user();
		if (empty($user)) {
			$ci->auth_model->logout();
		} else {
			return $user;
		}
	}
}

//get user by id
if (!function_exists('get_user')) {
	function get_user($user_id)
	{
		// Get a reference to the controller object
		$ci =& get_instance();
		return $ci->auth_model->get_user($user_id);
	}
}

//get shop name
if (!function_exists('get_shop_name')) {
	function get_shop_name($user)
	{
		if (!empty($user)) {
			if (!empty($user->shop_name) && ($user->role == 'admin' || $user->role == 'vendor')) {
				return html_escape($user->shop_name);
			} else {
				return html_escape($user->username);
			}
		}
	}
}

//get shop name product
if (!function_exists('get_shop_name_product')) {
	function get_shop_name_product($product)
	{
		if (!empty($product)) {
			if (!empty($product->shop_name) && ($product->user_role == 'admin' || $product->user_role == 'vendor')) {
				return html_escape($product->shop_name);
			} else {
				return html_escape($product->user_username);
			}
		}
	}
}

//get shop name by user id
if (!function_exists('get_shop_name_by_user_id')) {
	function get_shop_name_by_user_id($user_id)
	{
		$user = get_user($user_id);
		if (!empty($user)) {
			if (!empty($user->shop_name)) {
				return html_escape($user->shop_name);
			} else {
				return html_escape($user->username);
			}
		}
	}
}

//is multi-vendor active
if (!function_exists('is_multi_vendor_active')) {
	function is_multi_vendor_active()
	{
		$ci =& get_instance();
		$active = true;
		if ($ci->general_settings->multi_vendor_system != 1) {
			$active = false;
		}
		if ($ci->auth_check) {
			if ($ci->auth_user->role == "admin") {
				$active = true;
			}
		}
		return $active;
	}
}

//check is user vendor
if (!function_exists('is_user_vendor')) {
	function is_user_vendor()
	{
		$ci =& get_instance();
		if ($ci->auth_check && is_multi_vendor_active()) {
			if ($ci->general_settings->vendor_verification_system != 1) {
				return true;
			} else {
				if ($ci->auth_user->role == 'vendor' || $ci->auth_user->role == 'admin') {
					return true;
				}
			}
		}
		return false;
	}
}

//is marketplace active
if (!function_exists('is_marketplace_active')) {
	function is_marketplace_active()
	{
		$ci =& get_instance();
		if ($ci->general_settings->marketplace_system == 1) {
			return true;
		}
		return false;
	}
}

//is bidding system active
if (!function_exists('is_bidding_system_active')) {
	function is_bidding_system_active()
	{
		$ci =& get_instance();
		if ($ci->general_settings->bidding_system == 1) {
			return true;
		}
		return false;
	}
}

//show cart
if (!function_exists('is_sale_active')) {
	function is_sale_active()
	{
		$ci =& get_instance();
		if (is_marketplace_active() || is_bidding_system_active()) {
			return true;
		}
		return false;
	}
}

//get translated message
if (!function_exists('trans')) {
	function trans($string)
	{
		$ci =& get_instance();
		return $ci->lang->line($string);
	}
}

//print old form data
if (!function_exists('old')) {
	function old($field)
	{
		$ci =& get_instance();
		if (isset($ci->session->flashdata('form_data')[$field])) {
			return html_escape($ci->session->flashdata('form_data')[$field]);
		}
	}
}

//admin url
if (!function_exists('admin_url')) {
	function admin_url()
	{
		require APPPATH . "config/route_slugs.php";
		return base_url() . $custom_slug_array["admin"] . "/";
	}
}

//get category
if (!function_exists('get_category')) {
	function get_category($id)
	{
		$ci =& get_instance();
		return $ci->category_model->get_category($id);
	}
}

//get category joined
if (!function_exists('get_category_joined')) {
	function get_category_joined($id)
	{
		$ci =& get_instance();
		return $ci->category_model->get_category_joined($id);
	}
}

//get subcategories
if (!function_exists('get_subcategories_by_parent_id')) {
	function get_subcategories_by_parent_id($parent_id)
	{
		$ci =& get_instance();
		return $ci->category_model->get_subcategories_by_parent_id($parent_id);
	}
}

//get featured category
if (!function_exists('get_featured_category')) {
	function get_featured_category($order)
	{
		$ci =& get_instance();
		return $ci->category_model->get_featured_category($order);
	}
}

//get categories json
if (!function_exists('get_categories_json')) {
	function get_categories_json($lang_id)
	{
		$ci =& get_instance();
		return $ci->category_model->get_categories_json($lang_id);
	}
}

//get parent categories array
if (!function_exists('get_parent_categories_array')) {
	function get_parent_categories_array($category_id)
	{
		$ci =& get_instance();
		return $ci->category_model->get_parent_categories_array_by_category_id($category_id);
	}
}

//get order
if (!function_exists('get_order')) {
	function get_order($order_id)
	{
		$ci =& get_instance();
		return $ci->order_model->get_order($order_id);
	}
}

//get order by order number
if (!function_exists('get_order_by_order_number')) {
	function get_order_by_order_number($order_number)
	{
		$ci =& get_instance();
		return $ci->order_model->get_order_by_order_number($order_number);
	}
}

//generate category url
if (!function_exists('generate_category_url')) {
	function generate_category_url($category)
	{

		if (!empty($category)) {
			if ($category->parent_id == 0) {
				return lang_base_url() . $category->slug;
			} else {
				return lang_base_url() . $category->parent_slug . "/" . $category->slug;
			}
		}
	}
}

//generate product url
if (!function_exists('generate_product_url')) {
	function generate_product_url($product)
	{
		if (!empty($product)) {
			return lang_base_url() . $product->slug;
		}
	}
}

//generate blog url
if (!function_exists('generate_post_url')) {
	function generate_post_url($post)
	{
		if (!empty($post)) {
			return lang_base_url() . 'blog' . '/' . $post->category_slug . '/' . $post->slug;
		}
	}
}

//generate profile url
if (!function_exists('generate_profile_url')) {
	function generate_profile_url($user)
	{
		if (!empty($user)) {
			return lang_base_url() . 'profile' . '/' . $user->slug;
		}
	}
}

//delete file from server
if (!function_exists('delete_file_from_server')) {
	function delete_file_from_server($path)
	{
		$full_path = FCPATH . $path;
		if (strlen($path) > 15 && file_exists($full_path)) {
			@unlink($full_path);
		}
	}
}

//get user avatar from product
if (!function_exists('get_user_avatar_from_product')) {
	function get_user_avatar_from_product($product)
	{
		$ci =& get_instance();
		$ci->load->model('profile_model');
		$user = $ci->profile_model->detail_user($product->user_id);

		if (!empty($user)) {
			if (!empty($user->avatar) && file_exists(FCPATH . $user->avatar)) {
				return base_url() . $user->avatar;
			} elseif (!empty($user->avatar) && $user->user_type != "registered") {
				return $user->avatar;
			} else {
				return base_url() . "assets/img/user.png";
			}
		} else {
			return base_url() . "assets/img/user.png";
		}
	}
}

//get paket gambar
if (!function_exists('get_paket_gambar')) {
	function get_paket_gambar($paket)
	{
		if (!empty($paket)) {
			if (!empty($paket->gambar) && file_exists(FCPATH . $paket->gambar)) {
				return base_url() . $paket->gambar;
			} elseif (!empty($paket->gambar) && $paket->user_type != "registered") {
				return $paket->gambar;
			} else {
				return base_url() . "assets/img/user.png";
			}
		} else {
			return base_url() . "assets/img/user.png";
		}
	}
}

//get user avatar
if (!function_exists('get_user_avatar')) {
	function get_user_avatar($user)
	{
		if (!empty($user)) {
			if (!empty($user->avatar) && file_exists(FCPATH . $user->avatar)) {
				return base_url() . $user->avatar;
			} elseif (!empty($user->avatar) && $user->user_type != "registered") {
				return $user->avatar;
			} else {
				return base_url() . "assets/img/user.png";
			}
		} else {
			return base_url() . "assets/img/user.png";
		}
	}
}

//get user avatar by id
if (!function_exists('get_user_avatar_by_id')) {
	function get_user_avatar_by_id($user_id)
	{
		$ci =& get_instance();

		$user = $ci->auth_model->get_user($user_id);
		if (!empty($user)) {
			if (!empty($user->avatar) && file_exists(FCPATH . $user->avatar)) {
				return base_url() . $user->avatar;
			} elseif (!empty($user->avatar) && $user->user_type != "registered") {
				return $user->avatar;
			} else {
				return base_url() . "assets/img/user.png";
			}
		} else {
			return base_url() . "assets/img/user.png";
		}
	}
}

//get user review count
if (!function_exists('get_user_review_count')) {
	function get_user_review_count($user_id)
	{
		$ci =& get_instance();
		return $ci->user_review_model->get_review_count($user_id);
	}
}

//get user rating
if (!function_exists('get_user_rating')) {
	function get_user_rating($user_id)
	{
		$ci =& get_instance();
		return $ci->user_review_model->get_user_rating($user_id);
	}
}

//get user review count
if (!function_exists('get_count_user_rating_from_all_product')) {
	function get_count_user_rating_from_all_product($user_id)
	{
		$ci =& get_instance();
		return $ci->review_model->get_user_review_count($user_id);
	}
}

//get user rating
if (!function_exists('get_user_rating_from_all_product')) {
	function get_user_rating_from_all_product($user_id)
	{
		$ci =& get_instance();
		return $ci->review_model->get_user_rating($user_id);
	}
}

//date format
if (!function_exists('helper_date_format')) {
	function helper_date_format($datetime)
	{
		$date = date("M Y", strtotime($datetime));
		$date = str_replace("Jan", trans("January"), $date);
		$date = str_replace("Feb", trans("February"), $date);
		$date = str_replace("Mar", trans("March"), $date);
		$date = str_replace("Apr", trans("April"), $date);
		$date = str_replace("May", trans("May"), $date);
		$date = str_replace("Jun", trans("June"), $date);
		$date = str_replace("Jul", trans("July"), $date);
		$date = str_replace("Aug", trans("August"), $date);
		$date = str_replace("Sep", trans("September"), $date);
		$date = str_replace("Oct", trans("October"), $date);
		$date = str_replace("Nov", trans("November"), $date);
		$date = str_replace("Dec", trans("December"), $date);
		return $date;

	}
}

//get logo
if (!function_exists('get_logo')) {
	function get_logo($settings)
	{
		if (!empty($settings)) {
			if (!empty($settings->logo) && file_exists(FCPATH . $settings->logo)) {
				return base_url() . $settings->logo;
			}
		}
		return base_url() . "assets/img/logo.svg";
	}
}

//get logo email
if (!function_exists('get_logo_email')) {
	function get_logo_email($settings)
	{
		if (!empty($settings)) {
			if (!empty($settings->logo_email) && file_exists(FCPATH . $settings->logo_email)) {
				return base_url() . $settings->logo_email;
			}
		}
		return base_url() . "assets/img/logo.png";
	}
}

//get favicon
if (!function_exists('get_favicon')) {
	function get_favicon($settings)
	{
		if (!empty($settings)) {
			if (!empty($settings->favicon) && file_exists(FCPATH . $settings->favicon)) {
				return base_url() . $settings->favicon;
			}
		}
		return base_url() . "assets/img/favicon.png";
	}
}

//get page title
if (!function_exists('get_page_title')) {
	function get_page_title($page)
	{
		if (!empty($page)) {
			return html_escape($page->title);
		} else {
			return "";
		}
	}
}

//get page description
if (!function_exists('get_page_description')) {
	function get_page_description($page)
	{
		if (!empty($page)) {
			return html_escape($page->description);
		} else {
			return "";
		}
	}
}

//get page keywords
if (!function_exists('get_page_keywords')) {
	function get_page_keywords($page)
	{
		if (!empty($page)) {
			return html_escape($page->keywords);
		} else {
			return "";
		}
	}
}

//get settings
if (!function_exists('get_settings')) {
	function get_settings()
	{
		$ci =& get_instance();
		$ci->load->model('settings_model');
		return $ci->settings_model->get_settings();
	}
}

//get general settings
if (!function_exists('get_general_settings')) {
	function get_general_settings()
	{
		$ci =& get_instance();
		$ci->load->model('settings_model');
		return $ci->settings_model->get_general_settings();
	}
}

//get form settings
if (!function_exists('get_form_settings')) {
	function get_form_settings()
	{
		$ci =& get_instance();
		$ci->load->model('settings_model');
		return $ci->settings_model->get_form_settings();
	}
}

//get product
if (!function_exists('get_product')) {
	function get_product($id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_product_by_id($id);
	}
}

//get available product
if (!function_exists('get_available_product')) {
	function get_available_product($id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_available_product($id);
	}
}

//get logged user
if (!function_exists('get_logged_user')) {
	function get_logged_user()
	{
		$ci =& get_instance();
		return $ci->auth_model->get_logged_user();
	}
}

//check apakah user sudah beli
if (!function_exists('apakah_user_sudah_beli')) {
	function apakah_user_sudah_beli($user, $product_id)
	{
		$ci =& get_instance();
		return $ci->order_model->get_user_complete_order_product($user->id, $product_id);
	}
}

//get digital sale by buyer id
if (!function_exists('get_digital_sale_by_buyer_id')) {
	function get_digital_sale_by_buyer_id($buyer_id, $product_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_digital_sale_by_buyer_id($buyer_id, $product_id);
	}
}

//get digital sale by order id
if (!function_exists('get_digital_sale_by_order_id')) {
	function get_digital_sale_by_order_id($buyer_id, $product_id, $order_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_digital_sale_by_order_id($buyer_id, $product_id, $order_id);
	}
}

//check is product available for sale
if (!function_exists('check_product_available_for_sale')) {
	function check_product_available_for_sale($product)
	{
		if (empty($product)) {
			return false;
		}
		if ($product->status == 0) {
			return false;
		}
		if ($product->visibility == 0) {
			return false;
		}
		if ($product->is_sold == 1) {
			return false;
		}
		if ($product->is_deleted == 1) {
			return false;
		}
		return true;
	}
}

//get product image
if (!function_exists('get_product_image')) {
	function get_product_image($product_id, $size_name)
	{
		$ci =& get_instance();
		$image = $ci->file_model->get_image_by_product($product_id);
		if (empty($image)) {
			return base_url() . 'assets/img/no-image.jpg';
		} else {
			if ($image->storage == "aws_s3") {
				return $ci->aws_base_url . "uploads/images/" . $image->$size_name;
			} else {
				return base_url() . "uploads/images/" . $image->$size_name;
			}
		}
	}
}

//get product image url
if (!function_exists('get_product_image_url')) {
	function get_product_image_url($image, $size_name)
	{
		if ($image->storage == "aws_s3") {
			$ci =& get_instance();
			return $ci->aws_base_url . "uploads/images/" . $image->$size_name;
		} else {
			return base_url() . "uploads/images/" . $image->$size_name;
		}
	}
}

//get product images
if (!function_exists('get_product_images')) {
	function get_product_images($product_id)
	{
		$ci =& get_instance();
		return $ci->file_model->get_product_images($product_id);
	}
}

//get file manager image
if (!function_exists('get_file_manager_image')) {
	function get_file_manager_image($image)
	{
		$path = base_url() . 'assets/img/no-image.jpg';
		$ci =& get_instance();
		if (!empty($image)) {
			if ($image->storage == "aws_s3") {
				$path = $ci->aws_base_url . "uploads/images-file-manager/" . $image->image_path;
			} else {
				$path = base_url() . "uploads/images-file-manager/" . $image->image_path;
			}
		}
		return $path;
	}
}

//get product video url
if (!function_exists('get_product_video_url')) {
	function get_product_video_url($video)
	{
		$path = "";
		$ci =& get_instance();
		if (!empty($video)) {
			if ($video->storage == "aws_s3") {
				$path = $ci->aws_base_url . "uploads/videos/" . $video->file_name;
			} else {
				$path = base_url() . "uploads/videos/" . $video->file_name;
			}
		}
		return $path;
	}
}

//get product digital file url
if (!function_exists('get_product_digital_file_url')) {
	function get_product_digital_file_url($digital_file)
	{
		$path = "";
		$ci =& get_instance();
		if (!empty($digital_file)) {
			if ($digital_file->storage == "aws_s3") {
				$path = $ci->aws_base_url . "uploads/digital-files/" . $digital_file->file_name;
			} else {
				$path = base_url() . "uploads/digital-files/" . $digital_file->file_name;
			}
		}
		return $path;
	}
}

//get product audio url
if (!function_exists('get_product_audio_url')) {
	function get_product_audio_url($audio)
	{
		$path = "";
		$ci =& get_instance();
		if (!empty($audio)) {
			if ($audio->storage == "aws_s3") {
				$path = $ci->aws_base_url . "uploads/audios/" . $audio->file_name;
			} else {
				$path = base_url() . "uploads/audios/" . $audio->file_name;
			}
		}
		return $path;
	}
}

//get product count by category
if (!function_exists('get_products_count_by_category')) {
	function get_products_count_by_category($category_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_products_count_by_category($category_id);
	}
}

//get product count by subcategory
if (!function_exists('get_products_count_by_subcategory')) {
	function get_products_count_by_subcategory($category_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_products_count_by_subcategory($category_id);
	}
}

//get category name by lang
if (!function_exists('get_category_name_by_lang')) {
	function get_category_name_by_lang($category_id, $lang_id)
	{
		$ci =& get_instance();
		return $ci->category_model->get_category_name_by_lang($category_id, $lang_id);
	}
}

//get custom field
if (!function_exists('get_custom_field')) {
	function get_custom_field($field_id)
	{
		$ci =& get_instance();
		return $ci->field_model->get_field_joined($field_id);
	}
}

//get product custom field
if (!function_exists('get_product_custom_field')) {
	function get_product_custom_field($field_id, $product_id)
	{
		$ci =& get_instance();
		return $ci->field_model->get_product_custom_field($field_id, $product_id);
	}
}


//get custom field name by lang
if (!function_exists('get_custom_field_name_by_lang')) {
	function get_custom_field_name_by_lang($field_id, $lang_id)
	{
		$ci =& get_instance();
		return $ci->field_model->get_field_name_by_lang($field_id, $lang_id);
	}
}

//get custom field options
if (!function_exists('get_custom_field_options')) {
	function get_custom_field_options($field_id)
	{
		$ci =& get_instance();
		return $ci->field_model->get_field_options($field_id);
	}
}

//get custom field options by lang
if (!function_exists('get_custom_field_options_by_lang')) {
	function get_custom_field_options_by_lang($field_id, $lang_id)
	{
		$ci =& get_instance();
		return $ci->field_model->get_custom_field_options_by_lang($field_id, $lang_id);
	}
}

//get active product conditions
if (!function_exists('get_active_product_conditions')) {
	function get_active_product_conditions($lang_id)
	{
		$ci =& get_instance();
		return $ci->settings_model->get_active_product_conditions($lang_id);
	}
}

//get custom field option by lang
if (!function_exists('get_field_option_by_lang')) {
	function get_field_option_by_lang($common_id, $lang_id)
	{
		$ci =& get_instance();
		return $ci->field_model->get_field_option_by_lang($common_id, $lang_id);
	}
}

//get custom field value
if (!function_exists('get_custom_field_value')) {
	function get_custom_field_value($custom_field)
	{
		$str = "";
		if (!empty($custom_field)) {
			if (!empty($custom_field->field_value)) {
				$str = html_escape($custom_field->field_value);
			} elseif (!empty($custom_field->field_common_ids)) {
				$ci =& get_instance();
				foreach ($custom_field->field_common_ids as $item) {
					$field_option = get_field_option_by_lang($item, $ci->selected_lang->id);
					if (!empty($field_option)) {
						if (empty($str)) {
							$str = $field_option->field_option;
						} else {
							$str .= ", " . $field_option->field_option;
						}
					}
				}
			}
		}
		return $str;
	}
}

//check product in favorites
if (!function_exists('is_product_in_favorites')) {
	function is_product_in_favorites($product_id)
	{
		$ci =& get_instance();
		return $ci->product_model->is_product_in_favorites($product_id);
	}
}

//get product favorited count
if (!function_exists('get_product_favorited_count')) {
	function get_product_favorited_count($product_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_product_favorited_count($product_id);
	}
}

//get product favorited count
if (!function_exists('get_user_favorited_products_count')) {
	function get_user_favorited_products_count($user_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_user_favorited_products_count($user_id);
	}
}

//get followers count
if (!function_exists('get_followers_count')) {
	function get_followers_count($following_id)
	{
		$ci =& get_instance();
		return $ci->profile_model->get_followers_count($following_id);
	}
}

//get following users count
if (!function_exists('get_following_users_count')) {
	function get_following_users_count($follower_id)
	{
		$ci =& get_instance();
		return $ci->profile_model->get_following_users_count($follower_id);
	}
}

//get user products count
if (!function_exists('get_user_products_count')) {
	function get_user_products_count($user_slug)
	{
		$ci =& get_instance();
		return $ci->product_model->get_user_products_count($user_slug);
	}
}

//get user products count
if (!function_exists('get_user_pending_products_count')) {
	function get_user_pending_products_count($user_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_user_pending_products_count($user_id);
	}
}

//get user drafts count
if (!function_exists('get_user_drafts_count')) {
	function get_user_drafts_count($user_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_user_drafts_count($user_id);
	}
}

//get user drafts count
if (!function_exists('get_user_downloads_count')) {
	function get_user_downloads_count($user_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_user_downloads_count($user_id);
	}
}

//get user hidden products count
if (!function_exists('get_user_hidden_products_count')) {
	function get_user_hidden_products_count($user_id)
	{
		$ci =& get_instance();
		return $ci->product_model->get_user_hidden_products_count($user_id);
	}
}
//get product comment count
if (!function_exists('get_product_comment_count')) {
	function get_product_comment_count($product_id)
	{
		$ci =& get_instance();
		return $ci->comment_model->get_product_comment_count($product_id);
	}
}

//get product product variation options
if (!function_exists('get_product_variation_options')) {
	function get_product_variation_options($variation_common_id, $lang_id)
	{
		$ci =& get_instance();
		return $ci->variation_model->get_variation_options($variation_common_id, $lang_id);
	}
}

//get grouped shipping options
if (!function_exists('get_grouped_shipping_options')) {
	function get_grouped_shipping_options()
	{
		$ci =& get_instance();
		return $ci->settings_model->get_grouped_shipping_options();
	}
}

//get order shipping
if (!function_exists('get_order_shipping')) {
	function get_order_shipping($order_id)
	{
		$ci =& get_instance();
		return $ci->order_model->get_order_shipping($order_id);
	}
}

//get shipping option by lang
if (!function_exists('get_shipping_option_by_lang')) {
	function get_shipping_option_by_lang($common_id, $lang_id)
	{
		$ci =& get_instance();
		return $ci->settings_model->get_shipping_option_by_lang($common_id, $lang_id);
	}
}

//get shipping option by key
if (!function_exists('get_shipping_option_by_key')) {
	function get_shipping_option_by_key($key, $lang_id)
	{
		$ci =& get_instance();
		return $ci->settings_model->get_shipping_option_by_key($key, $lang_id);
	}
}

//get grouped product conditions
if (!function_exists('get_grouped_product_conditions')) {
	function get_grouped_product_conditions()
	{
		$ci =& get_instance();
		return $ci->settings_model->get_grouped_product_conditions();
	}
}

//get product condition by lang
if (!function_exists('get_product_condition_by_lang')) {
	function get_product_condition_by_lang($common_id, $lang_id)
	{
		$ci =& get_instance();
		return $ci->settings_model->get_product_condition_by_lang($common_id, $lang_id);
	}
}

//get product condition by key
if (!function_exists('get_product_condition_by_key')) {
	function get_product_condition_by_key($key, $lang_id)
	{
		$ci =& get_instance();
		return $ci->settings_model->get_product_condition_by_key($key, $lang_id);
	}
}

//check user follows
if (!function_exists('is_user_follows')) {
	function is_user_follows($following_id, $follower_id)
	{
		$ci =& get_instance();
		return $ci->profile_model->is_user_follows($following_id, $follower_id);
	}
}

//get blog post
if (!function_exists('get_post')) {
	function get_post($id)
	{
		$ci =& get_instance();
		return $ci->blog_model->get_post_joined($id);
	}
}

//get blog image url
if (!function_exists('get_foto_toko')) {
	function get_foto_toko($nama)
	{
		return base_url() . $nama;
	}
}

//get blog image url
if (!function_exists('get_blog_image_url')) {
	function get_blog_image_url($post, $size_name)
	{
		if ($post->storage == "aws_s3") {
			$ci =& get_instance();
			return $ci->aws_base_url . $post->$size_name;
		} else {
			return base_url() . $post->$size_name;
		}
	}
}

//get category image url
if (!function_exists('get_category_image_url')) {
	function get_category_image_url($category, $size_name)
	{
		if ($category->storage == "aws_s3") {
			$ci =& get_instance();
			return $ci->aws_base_url . $category->$size_name;
		} else {
			return base_url() . $category->$size_name;
		}
	}
}

//get blog categories
if (!function_exists('get_blog_categories')) {
	function get_blog_categories()
	{
		$ci =& get_instance();
		return $ci->blog_category_model->get_categories();
	}
}

//get blog post count by category
if (!function_exists('get_blog_post_count_by_category')) {
	function get_blog_post_count_by_category($category_id)
	{
		$ci =& get_instance();
		return $ci->blog_model->get_post_count_by_category($category_id);
	}
}

//get post comment count
if (!function_exists('get_post_comment_count')) {
	function get_post_comment_count($post_id)
	{
		$ci =& get_instance();
		return $ci->comment_model->get_post_comment_count($post_id);
	}
}

//get subcomments
if (!function_exists('get_subcomments')) {
	function get_subcomments($parent_id)
	{
		$ci =& get_instance();
		return $ci->comment_model->get_subcomments($parent_id);
	}
}

//get unread conversations count
if (!function_exists('get_unread_conversations_count')) {
	function get_unread_conversations_count($receiver_id)
	{
		$ci =& get_instance();
		return $ci->message_model->get_unread_conversations_count($receiver_id);
		// return $ci->message_model->get_unread_conversations_count_custom($receiver_id);
	}
}

//get conversation unread messages count
if (!function_exists('get_conversation_unread_messages_count')) {
	function get_conversation_unread_messages_count($conversation_id)
	{
		$ci =& get_instance();
		return $ci->message_model->get_conversation_unread_messages_count($conversation_id);
	}
}

//get language
if (!function_exists('get_language')) {
	function get_language($lang_id)
	{
		$ci =& get_instance();
		return $ci->language_model->get_language($lang_id);
	}
}

//get countries
if (!function_exists('get_countries')) {
	function get_countries()
	{
		$ci =& get_instance();
		return $ci->location_model->get_countries();
	}
}

//get country
if (!function_exists('get_country')) {
	function get_country($id)
	{
		$ci =& get_instance();
		return $ci->location_model->get_country($id);
	}
}

//get state
if (!function_exists('get_state')) {
	function get_state($id)
	{
		$ci =& get_instance();
		return $ci->location_model->get_state($id);
	}
}

//get states by country
if (!function_exists('get_states_by_country')) {
	function get_states_by_country($country_id)
	{
		$ci =& get_instance();
		return $ci->location_model->get_states_by_country($country_id);
	}
}

//get ad codes
if (!function_exists('get_ad_codes')) {
	function get_ad_codes($ad_space)
	{
		// Get a reference to the controller object
		$ci =& get_instance();
		return $ci->ad_model->get_ad_codes($ad_space);
	}
}

//get recaptcha
if (!function_exists('generate_recaptcha')) {
	function generate_recaptcha()
	{
		$ci =& get_instance();
		if ($ci->recaptcha_status) {
			$ci->load->library('recaptcha');
			echo '<div class="form-group">';
			echo $ci->recaptcha->getWidget();
			echo $ci->recaptcha->getScriptTag();
			echo ' </div>';
		}
	}
}

//reset flash data
if (!function_exists('reset_flash_data')) {
	function reset_flash_data()
	{
		$ci =& get_instance();
		$ci->session->set_flashdata('errors', "");
		$ci->session->set_flashdata('error', "");
		$ci->session->set_flashdata('success', "");
	}
}

//get location home
if (!function_exists('get_location_home')) {
	function get_location_home($object)
	{
		$ci =& get_instance();
		$location = "";
		if (!empty($object)) {
			if (!empty($object->city_id)) {
				// $city = $ci->location_model->get_city($object->city_id);
				$city = $ci->locationid_model->get_city($object->city_id);
				if (!empty($city)) {
					if (!empty($object->address) || !empty($object->zip_code)) {
						$location .= " ";
					}
					$location .= $city->name;
				} else {
					$location = '-';
				}
			}
		}
		return replace_kab($location);
	}
}

//get kota
if (!function_exists('get_kota')) {
	function get_kota($id)
	{
		$ci =& get_instance();
		if($id) {
			$city = $ci->location_model->get_city($id);
			return $city->name;
		} else {
			return "";
		}
	}
}

//get provinsi
if (!function_exists('get_provinsi')) {
	function get_provinsi($id)
	{
		$ci =& get_instance();
		if($id) {
			$state = $ci->location_model->get_state($id);
			return $state->name;			
		} else {
			return "";
		}
	}
}

//get kota
if (!function_exists('get_kota_id')) {
	function get_kota_id($id)
	{
		$ci =& get_instance();
		if($id) {
			$city = $ci->locationid_model->get_city($id);
			return empty($city) ? '' : $city->name;
		} else {
			return "";
		}
	}
}

//get provinsi
if (!function_exists('get_provinsi_id')) {
	function get_provinsi_id($id)
	{
		$ci =& get_instance();
		if($id) {
			$state = $ci->locationid_model->get_state($id);
			return empty($state) ? '' : $state->name;			
		} else {
			return "";
		}
	}
}

//get provinsi
if (!function_exists('get_kecamatan')) {
	function get_kecamatan($id)
	{
		$ci =& get_instance();
		if($id) {
			$state = $ci->locationid_model->get_kecamatan($id);
			return $state->name;			
		} else {
			return "";
		}
	}
}

//get location
if (!function_exists('get_location')) {
	function get_location($object)
	{
		$ci =& get_instance();
		$location = "";
		if (!empty($object)) {
			if (!empty($object->address)) {
				// $location = $object->address;
				$kecamatan = $ci->locationid_model->get_kecamatan($object->address);
				$location .= empty($kecamatan) ? '' : $kecamatan->name .',';
			}
			if (!empty($object->zip_code)) {
				$location .= " " . $object->zip_code;
			}
			if (!empty($object->city_id)) {
				$city = $ci->locationid_model->get_city($object->city_id);
				// $city = $ci->location_model->get_city($object->city_id);
				if (!empty($city)) {
					if (!empty($object->address) || !empty($object->zip_code)) {
						$location .= " ";
					}
					$location .= $city->name;
				}
			}
			if (!empty($object->state_id)) {
				$state = $ci->locationid_model->get_state($object->state_id);
				// $state = $ci->location_model->get_state($object->state_id);
				if (!empty($state)) {
					if (!empty($object->address) || !empty($object->zip_code) || !empty($object->city_id)) {
						$location .= ", ";
					}
					$location .= $state->name;
				}
			}
			// if (!empty($object->country_id)) {
			// 	$country = $ci->location_model->get_country($object->country_id);
			// 	if (!empty($country)) {
			// 		if (!empty($object->state_id) || $object->city_id || !empty($object->address) || !empty($object->zip_code)) {
			// 			$location .= ", ";
			// 		}
			// 		$location .= $country->name;
			// 	}
			// }
		}
		return replace_kab($location);
	}
}

//get location input
if (!function_exists('get_location_input')) {
	function get_location_input($country_id, $state_id, $city_id)
	{
		$ci =& get_instance();
		if (!empty($country_id) || !empty($state_id) || !empty($city_id)) {
			return $ci->locationid_model->get_location_input($country_id, $state_id, $city_id);
		}
		return "";
	}
}

if (!function_exists('dd')) {
	function dd($data)
	{
		die(json_encode($data));
	}
}

//get currencies
if (!function_exists('get_currencies')) {
	function get_currencies()
	{
		$ci =& get_instance();
		$ci->config->load('currencies');
		return $ci->config->item('currencies_array');
	}
}

//get currency
if (!function_exists('get_currency')) {
	function get_currency($currency_key)
	{
		$ci =& get_instance();
		$ci->config->load('currencies');
		$currencies = $ci->config->item('currencies_array');
		if (!empty($currencies)) {
			if (isset($currencies[$currency_key])) {
				return $currencies[$currency_key]["hex"];
			}
		}
		return "";
	}
}

//price database format
if (!function_exists('price_database_format')) {
	function price_database_format($price)
	{
		$price = str_replace(',', '.', $price);
		$price = floatval($price);
		$price = number_format($price, 2, '.', '') * 100;
		return $price;
	}
}

//price format
if (!function_exists('price_format')) {
	function price_format($price)
	{
		$ci =& get_instance();
		$price = $price / 100;
		$dec_point = '.';
		$thousands_sep = ',';

		if ($ci->thousands_separator != '.') {
			$dec_point = ',';
			$thousands_sep = '.';
		}
		return number_format($price, 2, $dec_point, $thousands_sep);
	}
}

//price format decimal
if (!function_exists('price_format_decimal')) {
	function price_format_decimal($price)
	{
		$price = $price / 100;
		return number_format($price, 2, ".", "");
	}
}

//price format input
if (!function_exists('price_format_input')) {
	function price_format_input($price)
	{
		$ci =& get_instance();
		$new_price = 0;
		$price = $price / 100;
		if (is_int($price)) {
			$new_price = number_format($price, 0, ".", "");
		} else {
			$new_price = number_format($price, 2, ".", "");
		}
		if ($ci->thousands_separator == ',') {
			$new_price = str_replace('.', ',', $new_price);
		}
		return $new_price;
	}
}

//print price
if (!function_exists('print_price')) {
	function print_price($price, $currency)
	{
		$ci =& get_instance();
		$price = $price / 100;
		$dec_point = '.';
		$thousands_sep = ',';

		if ($ci->thousands_separator != '.') {
			$dec_point = ',';
			$thousands_sep = '.';
		}
		if (is_int($price)) {
			$price = number_format($price, 0, $dec_point, $thousands_sep);
		} else {
			$price = number_format($price, 2, $dec_point, $thousands_sep);
		}
		$currency = get_currency($currency);
		if ($ci->payment_settings->currency_symbol_format == "left") {
			echo "<span>" . $currency . "</span>" . $price;
		} else {
			echo $price . "<span>" . $currency . "</span>";
		}
	}
}

if (!function_exists('return_format_price')) {
	function return_format_price($price, $currency)
	{
		$ci =& get_instance();
		$price = $price / 100;
		$dec_point = '.';
		$thousands_sep = ',';

		if ($ci->thousands_separator != '.') {
			$dec_point = ',';
			$thousands_sep = '.';
		}
		if (is_int($price)) {
			$price = number_format($price, 0, $dec_point, $thousands_sep);
		} else {
			$price = number_format($price, 2, $dec_point, $thousands_sep);
		}
		$currency = get_currency($currency);
		if ($ci->payment_settings->currency_symbol_format == "left") {
			return $currency . $price;
		} else {
			return $price . " " .$currency;
		}
	}
}

//kabupaten
if (!function_exists('replace_kab')) {
	function replace_kab($string)
	{
		return str_replace('KABUPATEN', 'KAB', $string);
	}
}

//print preformatted price
if (!function_exists('print_preformatted_price')) {
	function print_preformatted_price($price, $currency)
	{
		$ci =& get_instance();
		$currency = get_currency($currency);
		if ($ci->payment_settings->currency_symbol_format == "left") {
			echo "<span>" . $currency . "</span>" . $price;
		} else {
			echo $price . "<span>" . $currency . "</span>";
		}
	}
}

//generate slug
if (!function_exists('str_slug')) {
	function str_slug($str)
	{
		$str = trim($str);
		return url_title(convert_accented_characters($str), "-", true);
	}
}

//generate product keywords
if (!function_exists('generate_product_keywords')) {
	function generate_product_keywords($title)
	{
		$array = explode(" ", $title);
		$keywords = "";
		$c = 0;
		if (!empty($array)) {
			foreach ($array as $item) {
				$item = trim($item);
				$item = trim($item, ",");
				if (!empty($item)) {
					$keywords .= $item;
					if ($c > 0) {
						$keywords .= ", ";
					}
				}
				$c++;
			}
		}
		return $keywords;
	}
}

//set cached data by lang
if (!function_exists('set_cache_data')) {
	function set_cache_data($key, $data)
	{
		$ci =& get_instance();
		if ($ci->general_settings->cache_system == 1) {
			$ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
			$ci->cache->save($key, $data, $ci->general_settings->cache_refresh_time);
		}
	}
}

//get cached data by lang
if (!function_exists('get_cached_data')) {
	function get_cached_data($key)
	{
		$ci =& get_instance();
		if ($ci->general_settings->cache_system == 1) {
			$ci->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
			if ($data = $ci->cache->get($key)) {
				return $data;
			}
		}
		return false;
	}
}

//reset cache data
if (!function_exists('reset_cache_data')) {
	function reset_cache_data()
	{
		$ci =& get_instance();
		$path = $ci->config->item('cache_path');
		$cache_path = ($path == '') ? APPPATH . 'cache/' : $path;
		$handle = opendir($cache_path);
		while (($file = readdir($handle)) !== FALSE) {
			//Leave the directory protection alone
			if ($file != '.htaccess' && $file != 'index.html') {
				@unlink($cache_path . '/' . $file);
			}
		}
		closedir($handle);
	}
}

//reset user cache data
if (!function_exists('reset_user_cache_data')) {
	function reset_user_cache_data($user_id)
	{
		$ci =& get_instance();
		$path = $ci->config->item('cache_path');
		$cache_path = ($path == '') ? APPPATH . 'cache/' : $path;
		$handle = opendir($cache_path);
		while (($file = readdir($handle)) !== FALSE) {
			//Leave the directory protection alone
			if ($file != '.htaccess' && $file != 'index.html') {
				if (strpos($file, 'user' . $user_id . 'cache') !== false) {
					@unlink($cache_path . '/' . $file);
				}
			}
		}
		closedir($handle);
	}
}

//reset product img cache data
if (!function_exists('reset_product_img_cache_data')) {
	function reset_product_img_cache_data($product_id)
	{
		$ci =& get_instance();
		$path = $ci->config->item('cache_path');
		$cache_path = ($path == '') ? APPPATH . 'cache/' : $path;
		$handle = opendir($cache_path);
		while (($file = readdir($handle)) !== FALSE) {
			//Leave the directory protection alone
			if ($file != '.htaccess' && $file != 'index.html') {
				if (strpos($file, 'img_product_' . $product_id) !== false) {
					@unlink($cache_path . '/' . $file);
				}
			}
		}
		closedir($handle);
	}
}

//reset cache data on change
if (!function_exists('reset_cache_data_on_change')) {
	function reset_cache_data_on_change()
	{
		$ci =& get_instance();
		if ($ci->general_settings->refresh_cache_database_changes == 1) {
			reset_cache_data();
		}
	}
}

//cart product count
if (!function_exists('get_cart_product_count')) {
	function get_cart_product_count()
	{
		$ci =& get_instance();
		if (!empty($ci->session->userdata('mds_shopping_cart'))) {
			return @count($ci->session->userdata('mds_shopping_cart'));
		} else {
			return 0;
		}
	}
}

//date diff
if (!function_exists('date_difference')) {
	function date_difference($end_date, $start_date, $format = '%a')
	{
		$datetime_1 = date_create($end_date);
		$datetime_2 = date_create($start_date);
		$diff = date_diff($datetime_1, $datetime_2);
		$day = $diff->format($format) + 1;
		if ($start_date > $end_date) {
			$day = 0 - $day;
		}
		return $day;
	}
}

function formatSizeUnits($bytes)
{
	if ($bytes >= 1073741824) {
		$bytes = number_format($bytes / 1073741824, 2) . ' GB';
	} elseif ($bytes >= 1048576) {
		$bytes = number_format($bytes / 1048576, 2) . ' MB';
	} elseif ($bytes >= 1024) {
		$bytes = number_format($bytes / 1024, 2) . ' KB';
	} elseif ($bytes > 1) {
		$bytes = $bytes . ' bytes';
	} elseif ($bytes == 1) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}

	return $bytes;
}

//get checkbox value
if (!function_exists('get_checkbox_value')) {
	function get_checkbox_value($input_post)
	{
		if (empty($input_post)) {
			return 0;
		} else {
			return 1;
		}
	}
}

//get product listing type
if (!function_exists('get_product_listing_type')) {
	function get_product_listing_type($product)
	{
		if (!empty($product)) {
			if ($product->listing_type == 'sell_on_site') {
				return trans("add_product_for_sale");
			}
			if ($product->listing_type == 'ordinary_listing') {
				return trans("add_product_services_listing");
			}
		}
	}
}

//get custom filters
if (!function_exists('get_custom_filters')) {
	function get_custom_filters($category_id)
	{
		$ci =& get_instance();
		return $ci->field_model->get_custom_filters($category_id);
	}
}

//get sess product filters
if (!function_exists('get_sess_product_filters')) {
	function get_sess_product_filters()
	{
		$ci =& get_instance();
		if (!empty($ci->session->userdata('mds_custom_product_filters'))) {
			return $ci->session->userdata('mds_custom_product_filters');
		}
		return null;
	}
}

//get filter name by key
if (!function_exists('get_filter_name_by_key')) {
	function get_filter_name_by_key($key)
	{
		if ($key == "search") {
			return trans("search");
		} else {
			$filters = get_sess_product_filters();
			if (!empty($filters)) {
				foreach ($filters as $filter) {
					if ($filter->product_filter_key == $key) {
						return @html_escape($filter->name);
						break;
					}
				}
			}
		}
	}
}

//get filters query string array
if (!function_exists('get_filters_query_string_array')) {
	function get_filters_query_string_array()
	{
		$array = array();
		@parse_str($_SERVER["QUERY_STRING"], $array);
		return $array;
	}
}

//get filter query string key value
if (!function_exists('get_filter_query_string_key_value')) {
	function get_filter_query_string_key_value($key)
	{
		$array = get_filters_query_string_array();
		if (!empty($array)) {
			return @html_escape($array[$key]);
		}
		return '';
	}
}

//is value exists in array
if (!function_exists('is_value_in_array')) {
	function is_value_in_array($value, $array)
	{
		if (empty($array)) {
			return false;
		}
		if (in_array($value, $array)) {
			return true;
		}
		return false;
	}
}

//get first value of array
if (!function_exists('get_first_array_value')) {
	function get_first_array_value($array)
	{
		if (empty($array)) {
			return '';
		}
		return html_escape(@$array[0]);
	}
}

//remove filter from query string
if (!function_exists('remove_filter_from_query_string')) {
	function remove_filter_from_query_string($filter_key)
	{
		$array = get_filters_query_string_array();
		$filter_key = decode_slug($filter_key);
		$url = base_url() . uri_string();
		$i = 0;
		if (!empty($array)) {
			foreach ($array as $key => $value) {
				if ($filter_key == 'price') {
					if ($key != 'p_min' && $key != 'p_max') {
						if ($i == 0) {
							$url .= '?' . $key . '=' . $value;
						} else {
							$url .= '&' . $key . '=' . $value;
						}
						$i++;
					}
				} elseif ($filter_key == 'location') {
					if ($key != 'country' && $key != 'state' && $key != 'city') {
						if ($i == 0) {
							$url .= '?' . $key . '=' . $value;
						} else {
							$url .= '&' . $key . '=' . $value;
						}
						$i++;
					}
				} else {
					if (($key != $filter_key)) {
						if ($i == 0) {
							$url .= '?' . $key . '=' . $value;
						} else {
							$url .= '&' . $key . '=' . $value;
						}
						$i++;
					}
				}
			}
		}
		return $url;
	}
}

//generate unique id
if (!function_exists('generate_unique_id')) {
	function generate_unique_id()
	{
		$id = uniqid("", TRUE);
		$id = str_replace(".", "-", $id);
		return $id . "-" . rand(10000000, 99999999);
	}
}

//generate short unique id
if (!function_exists('generate_short_unique_id')) {
	function generate_short_unique_id()
	{
		$id = uniqid("", TRUE);
		return str_replace(".", "-", $id);
	}
}
//generate order number
if (!function_exists('generate_transaction_number')) {
	function generate_transaction_number()
	{
		$transaction_number = uniqid("", TRUE);
		return str_replace(".", "-", $transaction_number);
	}
}

//generate token
if (!function_exists('generate_token')) {
	function generate_token()
	{
		$token = uniqid("", TRUE);
		$token = str_replace(".", "-", $token);
		return $token . "-" . rand(10000000, 99999999);
	}
}

//generate purchase code
if (!function_exists('generate_purchase_code')) {
	function generate_purchase_code()
	{
		$id = uniqid("", TRUE);
		$id = str_replace(".", "-", $id);
		$id .= "-" . rand(100000, 999999);
		$id .= "-" . rand(100000, 999999);
		return $id;
	}
}

//decode slug
if (!function_exists('decode_slug')) {
	function decode_slug($slug)
	{
		$ci =& get_instance();
		$slug = urldecode($slug);
		$slug = $ci->security->xss_clean($slug);
		$slug = remove_special_characters($slug);
		return $slug;
	}
}

//clean number
if (!function_exists('clean_number')) {
	function clean_number($num)
	{
		$ci =& get_instance();
		$num = $ci->security->xss_clean($num);
		$num = str_slug($num);
		$num = intval($num);
		$num = mysqli_real_escape_string($ci->db->conn_id, $num);
		return $num;
	}
}

//remove special characters
if (!function_exists('remove_special_characters')) {
	function remove_special_characters($str)
	{
		$ci =& get_instance();
		$str = str_replace('#', '', $str);
		$str = str_replace(';', '', $str);
		$str = str_replace('!', '', $str);
		$str = str_replace('"', '', $str);
		$str = str_replace('$', '', $str);
		$str = str_replace('%', '', $str);
		$str = str_replace("'", '', $str);
		$str = str_replace('(', '', $str);
		$str = str_replace(')', '', $str);
		$str = str_replace('*', '', $str);
		$str = str_replace('+', '', $str);
		$str = str_replace('/', '', $str);
		$str = str_replace('\'', '', $str);
		$str = str_replace('<', '', $str);
		$str = str_replace('>', '', $str);
		$str = str_replace('=', '', $str);
		$str = str_replace('?', '', $str);
		$str = str_replace('[', '', $str);
		$str = str_replace(']', '', $str);
		$str = str_replace('\\', '', $str);
		$str = str_replace('^', '', $str);
		$str = str_replace('`', '', $str);
		$str = str_replace('{', '', $str);
		$str = str_replace('}', '', $str);
		$str = str_replace('|', '', $str);
		$str = str_replace('~', '', $str);
		$str = mysqli_real_escape_string($ci->db->conn_id, $str);
		return $str;
	}
}


if (!function_exists('cek_status_order')) {
	function cek_status_order($order)
	{
		if($order->payment_status == "awaiting_payment") {
			return trans("awaiting_payment");
		}
		if($order->payment_status == "awaiting_verification") {
			return trans("awaiting_verification");
		}
		if($order->payment_status == "payment_received") {
			return trans("payment_received");
		}
		if($order->payment_status == "shipped") {
			return trans("shipped");
		}
		if($order->payment_status == "cancelled") {
			return trans("cancelled");
		}
		if($order->payment_status == "completed") {
			return trans("completed");
		}
		return trans("order_processing");
	}
}

if (!function_exists('time_ago')) {
	function time_ago($timestamp)
	{
		$time_ago = strtotime($timestamp);
		$current_time = time();
		$time_difference = $current_time - $time_ago;
		$seconds = $time_difference;
		$minutes = round($seconds / 60);           // value 60 is seconds
		$hours = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
		$days = round($seconds / 86400);          //86400 = 24 * 60 * 60;
		$weeks = round($seconds / 604800);          // 7*24*60*60;
		$months = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
		$years = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
		if ($seconds <= 60) {
			return trans("just_now");
		} else if ($minutes <= 60) {
			if ($minutes == 1) {
				return "1 " . trans("minute_ago");
			} else {
				return "$minutes " . trans("minutes_ago");
			}
		} else if ($hours <= 24) {
			if ($hours == 1) {
				return "1 " . trans("hour_ago");
			} else {
				return "$hours " . trans("hours_ago");
			}
		} else if ($days <= 30) {
			if ($days == 1) {
				return "1 " . trans("day_ago");
			} else {
				return "$days " . trans("days_ago");
			}
		} else if ($months <= 12) {
			if ($months == 1) {
				return "1 " . trans("month_ago");
			} else {
				return "$months " . trans("months_ago");
			}
		} else {
			if ($years == 1) {
				return "1 " . trans("year_ago");
			} else {
				return "$years " . trans("years_ago");
			}
		}
	}
}

if(!function_exists('time_ago_bahasa')) {
	function time_ago_bahasa($datetime, $full = false) {
		$now = new DateTime;
		$ago = new DateTime($datetime);
		$diff = $now->diff($ago);
	
		$diff->w = floor($diff->d / 7);
		$diff->d -= $diff->w * 7;
	
		$string = array(
			'y' => 'year',
			'm' => 'month',
			'w' => 'week',
			'd' => 'day',
			'h' => 'hour',
			'i' => 'minute',
			's' => 'second',
		);
		foreach ($string as $k => &$v) {
			if ($diff->$k) {
				$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
			} else {
				unset($string[$k]);
			}
		}
	
		if (!$full) $string = array_slice($string, 0, 1);
		return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
}

if (!function_exists('is_user_online')) {
	function is_user_online($timestamp)
	{
		$time_ago = strtotime($timestamp);
		$current_time = time();
		$time_difference = $current_time - $time_ago;
		$seconds = $time_difference;
		$minutes = round($seconds / 60);
		if ($minutes <= 2) {
			return true;
		} else {
			return false;
		}
	}
}

if (!function_exists('convert_to_xml_character')) {
	function convert_to_xml_character($string)
	{
		return str_replace(array('&', '<', '>', '\'', '"'), array('&amp;', '&lt;', '&gt;', '&apos;', '&quot;'), $string);
	}
}
?>
