<?php
if (!class_exists('Affiliate_Account_Page')){
	class Affiliate_Account_Page{
		private $uid;
		private $affiliate_id;
		private $general_settings;
		private $current_url;
		private $account_page_base_url;
		private $account_page_settings;
		private $public_extra_settings;

		public function __construct($uid, $affiliate_id){
			/*
			 * @param int
			 * @return none
			 */
			global $indeed_db;
			$this->uid = $uid;
			$this->affiliate_id = $affiliate_id;
			$this->general_settings = $indeed_db->return_settings_from_wp_option('general-settings');
			$this->public_extra_settings = $indeed_db->return_settings_from_wp_option('general-public_workflow');
			$this->account_page_settings = $indeed_db->return_settings_from_wp_option('account_header');
			$this->current_url = UAP_PROTOCOL . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; /// $_SERVER['SERVER_NAME']

			/// CREATE BASE URL
			$this->account_page_base_url = $this->current_url;
			$remove_get_attr = array('uap_aff_subtab', 'uap_register', 'uap_list_item', 'udf', 'udu', 'u_sts', 'add_new');
			foreach ($remove_get_attr as $key){
				if (!empty($_GET[$key])){
					$this->account_page_base_url = remove_query_arg($key, $this->account_page_base_url);
				}
			}
		}

		public function output(){
			/*
			 * @param none
			 * @return string
			 */
		
			/// HEAD
			$this->head();
		}

		private function head(){
			/*
			 * @param none
			 * @return none (print html)
			 */
			global $indeed_db;

			$exclude_tabs = array();
			if (!$indeed_db->is_magic_feat_enable('coupons')){
				$exclude_tabs[] = 'coupons';
			}
			if (!$indeed_db->is_magic_feat_enable('custom_affiliate_slug')){
				$exclude_tabs[] = 'custom_affiliate_slug';
			}
			if (!$indeed_db->is_magic_feat_enable('mlm')){
				$exclude_tabs[] = 'mlm';
			}
			if (!$indeed_db->is_magic_feat_enable('pushover')){
				$exclude_tabs[] = 'pushover';
			}
			if (!$indeed_db->is_magic_feat_enable('wallet')){
				$exclude_tabs[] = 'wallet';
			}
			if (!$indeed_db->is_magic_feat_enable('referral_notifications') && !$indeed_db->is_magic_feat_enable('periodically_reports')){
				$exclude_tabs[] = 'referral_notifications';
			}
			if (!$indeed_db->is_magic_feat_enable('simple_links')){
				$exclude_tabs[] = 'simple_links';
			}
			if (!$indeed_db->is_magic_feat_enable('landing_pages')){
				$exclude_tabs[] = 'landing_pages';
			}

			$custom_menu = $indeed_db->account_page_get_custom_menu_items();

			$data['show_tab_list'] = $this->account_page_settings['uap_ap_tabs'];
			if ($data['show_tab_list']){
				$data['show_tab_list'] = explode(',', $data['show_tab_list']);
				foreach ($data['show_tab_list'] as $k=>$v){
					$data['urls'][$v] = add_query_arg('uap_aff_subtab', $v, $this->account_page_base_url);
				}
				$data['urls']['logout'] = add_query_arg('uapaction', 'logout', $this->account_page_base_url );//modify logout link
			} else {
				$data['show_tab_list'] = array();
			}

			$data['uap_account_page_custom_css'] = stripslashes($this->account_page_settings['uap_account_page_custom_css']);

			$data['message'] = uap_replace_constants($this->account_page_settings['uap_ap_welcome_msg'], $this->uid);
			$data['message'] = stripslashes(uap_format_str_like_wp($data['message']));
			if ($this->account_page_settings['uap_ap_edit_show_avatar']){
				$avatar = get_user_meta($this->uid, 'uap_avatar', true);
				if (strpos($avatar, "http")===0){
					$avatar_url = $avatar;
				} else {
					$avatar_url = wp_get_attachment_url($avatar);
				}
				$data['avatar'] = ($avatar_url) ? $avatar_url : UAP_URL . 'assets/images/no-avatar.png';
			}
			if ($this->account_page_settings['uap_ap_edit_show_rank']) $data['top-rank'] = 1;
			if ($this->account_page_settings['uap_ap_edit_show_earnings']) $data['top-earning'] = 1;
			if ($this->account_page_settings['uap_ap_edit_show_referrals']) $data['top-referrals'] = 1;
			if ($this->account_page_settings['uap_ap_edit_show_achievement']) $data['top-achievement'] = 1;
			if ($this->account_page_settings['uap_ap_edit_background']) $data['top-background'] = 1;
			if ($this->account_page_settings['uap_ap_edit_background_image']) $data['top-background-image'] = $this->account_page_settings['uap_ap_edit_background_image'];
			$data['uap_ap_edit_show_metrics'] = $this->account_page_settings['uap_ap_edit_show_metrics'];
			if ($data['uap_ap_edit_show_metrics']){
					$data['metrics'] = '';
					$data['metrics'][3] = $indeed_db->getEPCdata('3months', $this->affiliate_id);
					$data['metrics'][7] = $indeed_db->getEPCdata('7days', $this->affiliate_id);
			}


			$data['uap_ap_top_theme'] = (empty($this->account_page_settings['uap_ap_top_theme'])) ? 'uap-ap-top-theme-1' : $this->account_page_settings['uap_ap_top_theme'];
			$data['uap_ap_theme'] = (empty($this->account_page_settings['uap_ap_theme'])) ? 'uap-ap-theme-1' : $this->account_page_settings['uap_ap_theme'];
			$data['selected_tab'] = (empty($_GET['uap_aff_subtab'])) ? '' : $_GET['uap_aff_subtab'];

			$data['stats'] = $indeed_db->get_stats_for_payments($this->affiliate_id);
			$data['stats']['currency'] = get_option('uap_currency');

			 $current_rank_id = $indeed_db->get_affiliate_rank($this->affiliate_id);
			if(!empty($current_rank_id) && $current_rank_id>0){
				$current_rank = $indeed_db->get_rank($current_rank_id);
				$data['rank'] = $current_rank;
			}

			$data['achieved'] = $indeed_db->get_next_rank_achieved_percetage($this->affiliate_id);

			$order = get_option('uap_account_page_menu_order');
			$data['available_tabs'] = $indeed_db->account_page_get_menu();
			$data['uap_account_page_personal_header'] = get_user_meta($this->uid, 'uap_account_page_personal_header', true);

			require_once UAP_PATH . 'public/views/account-header.php';
		}

	}//end class
}//end if
