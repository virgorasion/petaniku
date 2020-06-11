<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Config_setting extends CI_Controller
{
    public function __construct(){
        parent::__construct();
		//check user
		if (!is_admin()) {
			redirect(admin_url() . 'login');
		}
    }

    public function email_option()
    {
        // Mail Options
        $config['send_email_new_product'] = 1; 
		$config['send_email_buyer_purchase'] = 0;
        $config['send_email_order_shipped'] = 0;
        $config['send_email_contact_messages'] = 0;
		$config['send_email_shop_opening_request'] = 0;
		$config['send_email_bidding_system'] = 0;
        $config['mail_options_account'] = ""; //alamat email untuk menerima email admin
        if ($this->settings_model->update_email_options($config)) {
            $this->session->set_flashdata('success', "Opsi Email Berhasil Diubah");
            echo "<script>alert('Opsi Email Berhasil Diubah')</script>";
		} else {
            $this->session->set_flashdata('error', "Opsi Email Gagal Diubah");
            echo "<script>alert('Opsi Email Gagal Diubah')</script>";
		}
    }

    public function email_settings()
    {
        // Mail Settings
		$config['mail_library'] = "php"; //swift,php,codeigniter
		$config['mail_protocol'] = "smtp"; //smtp,mail
		$config['mail_title'] = "Petaniku";
		$config['mail_host'] = "smtp.gmail.com";
		$config['mail_port'] = 587;
		$config['mail_username'] = "topun2018@gmail.com"; 
        $config['mail_password'] = "mrrekwurcflogmvi";
        if ($this->settings_model->update_email_settings($config)) {
            $this->session->set_flashdata('success', "Pengaturan Email Berhasil Diubah");
            echo "<script>alert('Pengaturan Email Berhasil Diubah')</script>";
		} else {
            $this->session->set_flashdata('error', "Pengaturan Email Gagal Diubah");
            echo "<script>alert('Pengaturan Email Gagal Diubah')</script>";
		}
    }

    public function cache_system()
    {
        $config['cache_system'] = 1;
        $config['refresh_cache_database_changes'] = 1;
        $config['cache_refresh_time'] = 30;
        if ($this->settings_model->update_cache_system($config)) {
            $this->session->set_flashdata('success', "Sistem Cache Berhasil Diubah");
            echo "<script>alert('Sistem Cache Email Berhasil Diubah')</script>";
        } else {
            $this->session->set_flashdata('error', "Sistem Cache Gagal Diubah");
            echo "<script>alert('Sistem Cache Email Gagal Diubah')</script>";
        }
    }

    public function seo_tools()
    {
        $this->load->model("sitemap_model");
        
        $config['frequency'] = "monthly"; //none,always,hourly,daily,weekly,monthly,yearly,never
        $config['last_modification'] = "server_response"; //none,server_response   
        $config['priority'] = "none"; //none, automatically
        $config['google_analytics'] = "";
        
        if ($this->settings_model->update_seo_tools($config) && $this->sitemap_model->update_sitemap_settings($config)) {
            $this->session->set_flashdata('success', "Pengaturan SEO Berhasil Diubah");
            echo "<script>alert('Pengaturan SEO Berhasil Diubah')</script>";
		} else {
            $this->session->set_flashdata('error', "Pengaturan SEO Gagal Diubah");
            echo "<script>alert('Pengaturan SEO Gagal Diubah')</script>";
        }
    }

    public function preferences()
    {
        $config['approve_before_publishing'] = 1;
        $config['promoted_products'] = 0;
        $config['product_link_structure'] = "slug-id"; //slug-id, id-slug
        if ($this->settings_model->update_preferences($config)) {
            $this->session->set_flashdata('success', "Pengaturan Preferences Berhasil Diubah");
            echo "<script>alert('Pengaturan Preferences Berhasil Diubah')</script>";
        }else {
            $this->session->set_flashdata('success', "Pengaturan Preferences Gagal Diubah");
            echo "<script>alert('Pengaturan Preferences Gagal Diubah')</script>";
        }
    }

    public function settings()
    {
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
			// alert coockie
			'cookies_warning' => 1,
			'cookies_warning_text' => "This site uses cookies. By continuing to browse the site you are agreeing to our use of cookies."
		);
		$lang_id = 2;

		$this->db->where('lang_id', $lang_id);
        $query = $this->db->update('settings', $data);
        if ($this->settings_model->update_preferences($config)) {
            $this->session->set_flashdata('success', "Pengaturan Umum Berhasil Diubah");
            echo "<script>alert('Pengaturan Umum Berhasil Diubah')</script>";
        }else {
            $this->session->set_flashdata('success', "Pengaturan Umum Gagal Diubah");
            echo "<script>alert('Pengaturan Umum Gagal Diubah')</script>";
        }
    }

    public function maintenance()
    {
        $data = array(
			'maintenance_mode_title' => "Coming Soon",
			'maintenance_mode_description' => "Our website is under construction. We'll be here soon with our new awesome site.",
			'maintenance_mode_status' => 0,
		);

		$this->db->where('id', 1);
		return $this->db->update('general_settings', $data);
    }

    public function bank_transfer_setting()
    {
        $config['bank_transfer_enabled'] = 1;
        $config["bank_transfer_accounts"] = "
        <p>Silahkan untuk membayar melalui akun bank di bawah ini</p>

        <ul>
            <li>0821323122 (BCA)</li>
            <li>021312392 (BRI)</li>
        </ul>";
        $data = array(
			'bank_transfer_enabled' => $config['bank_transfer_enabled'],
			'bank_transfer_accounts' => $config['bank_transfer_accounts']
		);

		$this->db->where('id', 1);
		return $this->db->update('payment_settings', $data);
    }
}
