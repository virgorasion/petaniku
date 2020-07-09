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

    public function payout_settings()
    {
        $this->load->model("earnings_admin_model");
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
        $this->db->where('id', 1);
        if ($this->db->update('payment_settings', $data)) {
            $this->session->set_flashdata('success', "Pengaturan Pencairan Berhasil Diubah");
            echo "<script>alert('Pengaturan Pencairan Berhasil Diubah')</script>";
        }else {
            $this->session->set_flashdata('success', "Pengaturan Pencairan Gagal Diubah");
            echo "<script>alert('Pengaturan Pencairan Gagal Diubah')</script>";
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
			// alert cookie
			'cookies_warning' => 1,
			'cookies_warning_text' => "This site uses cookies. By continuing to browse the site you are agreeing to our use of cookies."
		);
		$lang_id = 2; //2 = Indonesia, 1 = inggris

		$this->db->where('lang_id', $lang_id);
        if ($this->db->update('settings', $data)) {
            $this->session->set_flashdata('success', "Pengaturan Berhasil Diubah");
            echo "<script>alert('Pengaturan Berhasil Diubah')</script>";
        }else {
            $this->session->set_flashdata('success', "Pengaturan Gagal Diubah");
            echo "<script>alert('Pengaturan Gagal Diubah')</script>";
        }
    }

    public function general_settings()
    {
        $data = array(
			'application_name' => "Modesy",
			'head_code' => ""
		);

		$this->db->where('id', 1);
        if ($this->db->update('general_settings', $data)) {
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

		$this->db->where('id', 1);
		return $this->db->update('payment_settings', $data);
    }

    public function setting_recaptcha()
    {
        $config['recaptcha_site_key'] = "6LelRaQZAAAAAK9tAF_6q4JWIJNoaYogWXhShwM3";
        $config['recaptcha_secret_key'] = "6LelRaQZAAAAAOEFu96cN1Ie3iVm0zIy7LAbFXBr";
        $config['recaptcha_lang'] = "en";

        if ($this->settings_model->update_recaptcha_settings($config)) {
			$this->session->set_flashdata('success', "Pengaturan Recaptcha Berhasil Diubah");
            echo "<script>alert('Pengaturan Recaptcha Berhasil Diubah')</script>";
        }else {
            $this->session->set_flashdata('success', "Pengaturan Recaptcha Gagal Diubah");
            echo "<script>alert('Pengaturan Recaptcha Gagal Diubah')</script>";
        }
    }

    public function maintenance_mode()
    {
        $config['maintenance_mode_title'] = "Coming Soon";
        $config['maintenance_mode_description'] = "Our website is under construction. We'll be here soon with our new awesome site.";
        $config['maintenance_mode_status'] = 0; // 0 = Nonaktif, 1 = Aktif

        if ($this->settings_model->update_maintenance_mode_settings($config)) {
			$this->session->set_flashdata('success', "Maintenance Mode Berhasil Diubah");
            echo "<script>alert('Maintenance Mode Berhasil Diubah')</script>";
        }else {
            $this->session->set_flashdata('success', "Maintenance Mode Gagal Diubah");
            echo "<script>alert('Maintenance Mode Gagal Diubah')</script>";
        }
    }
}
