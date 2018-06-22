<style>
<?php foreach ($data['available_tabs'] as $k=>$v):?>
	<?php echo '.fa-' . $k . '-account-uap:before';?>{
		content: '\<?php echo $v['uap_tab_' . $k . '_icon_code'];?>';
	}
<?php endforeach;?>
<?php   if (!empty($data['uap_account_page_custom_css'])) echo $data['uap_account_page_custom_css'];?>
</style>

<link href='<?php echo UAP_URL . 'assets/css/croppic.css';?>' rel='stylesheet' type='text/css' />
<script src="<?php echo UAP_URL . 'assets/js/jquery.mousewheel.min.js';?>"></script>
<script src="<?php echo UAP_URL . 'assets/js/croppic.js';?>"></script>
<script src="<?php echo UAP_URL . 'assets/js/account_page-banner.js';?>"></script>

<script>
UapAccountPageBanner.init({
		triggerId					: 'js_uap_edit_top_ap_banner',
		saveImageTarget		: '<?php echo UAP_URL . 'public/ajax-upload.php';?>',
		cropImageTarget   : '<?php echo UAP_URL . 'public/ajax-upload.php';?>',
		bannerClass       : 'uap-user-page-top-background'
});
</script>

<div class="uap-user-page-wrapper">
<?php
	$top_style='';
	if (empty($data['top-background']) && ($data['uap_ap_top_theme'] == 'uap-ap-top-theme-2' || $data['uap_ap_top_theme'] == 'uap-ap-top-theme-3' )) $top_style .='style="padding-top:75px;"'; ?>
<div class="uap-user-page-top-wrapper  <?php echo (!empty($data['uap_ap_top_theme']) ? $data['uap_ap_top_theme'] : '');?>" <?php echo $top_style;?>>

  <div class="uap-left-side">
	<div class="uap-user-page-details">
		<?php if (!empty($data['avatar'])):?>
			<div class="uap-user-page-avatar"><img src="<?php echo $data['avatar'];?>" class="uap-member-photo"/></div>
		<?php endif;?>
	 </div>
	</div>
	<div class="uap-middle-side">
		<div class="uap-account-page-top-mess"><?php echo do_shortcode($data['message']);?></div>
		<?php if (!empty($data['top-rank']) && !empty($data['rank'])):?>
		<div class="uap-top-rank">
			<div class="uap-top-rank-box" style="background-color:#<?php echo $data['rank']['color'];?>;" title=""><?php echo $data['rank']['label'];?></div>
		</div>
		<?php endif;?>
	</div>
	<div class="uap-right-side">
		<?php if (!empty($data['top-earning'])):?>
			<div class="uap-top-earnings">
				<div class="uap-stats-label"><?php echo __('Earnings', 'uap'); ?></div>
				<div class="uap-stats-content"> <?php echo uap_format_price_and_currency($data['stats']['currency'], round($data['stats']['paid_payments_value']+$data['stats']['unpaid_payments_value'], 2)); ?></div>
			</div>
		<?php endif;?>
		<?php if (!empty($data['top-referrals'])):?>
			<div class="uap-top-referrals">
				<div class="uap-stats-label"><?php echo __('Referrals', 'uap'); ?></div>
				<div class="uap-stats-content"> <?php echo $data['stats']['referrals']; ?></div>
			</div>
		<?php endif;?>

		
		<?php if (!empty($data['top-achievement']) && $data['achieved']>-1):?>
			<div class="uap-clear uap-special-clear"></div>
			<div class="uap-top-achievement">
				<div class="uap-stats-label"><?php echo __('Until the next Rank...', 'uap'); ?></div>
				<div class="uap-achievement-line">
					<div class="uap-achieved" style="width:<?php echo $data['achieved']; ?>%;"></div>
				</div>
			</div>
		<?php endif;?>
        <?php if (!empty($data['uap_ap_edit_show_metrics'])):?>
			<div class="uap-top-metrics">
				<div class="uap-stats-content">
					<div class="uap-metris-rightside">
						<div>
								<?php echo __('3 months EPC: ', 'uap');
								echo uap_format_price_and_currency($data['stats']['currency'], $data['metrics'][3]); ?>
						</div>
						<div>
								<?php echo __('7 days EPC: ', 'uap');
								echo uap_format_price_and_currency($data['stats']['currency'], $data['metrics'][7]); ;?>
						</div>
					</div>
				</div>
			</div>
		<?php endif;?>

		<div class="uap-clear"></div>
	</div>
	<div class="uap-clear"></div>
	<?php if (!empty($data['top-background'])):
  	$bk_style='';

		///
		$bkStyle = '';
		$banner = '';
		if (!empty($data['uap_account_page_personal_header'])):
				$banner = $data ['uap_account_page_personal_header'];
		endif;
		if (!empty($data ['top_banner'])):
			$banner = $data ['top_banner'];
		endif;
		if (!empty($banner)){
				$bkStyle = 'style="background-image:url('.$banner.');"';
		}
		///
	?>
  <div class="uap-user-page-top-background" <?php echo $bkStyle;?>>
			<div class="uap-edit-top-ap-banner" id="js_uap_edit_top_ap_banner"></div>
	</div>
  <?php endif;?>
</div>
<div class="uap-user-page-content-wrapper <?php echo $data['uap_ap_theme'];?>">