<?php
	
	$this->user->write_pageview();
	
	$hdr_search	= ($this->request[0]=='members' ? 'users' : ($this->request[0]=='groups' ? 'groups' : ($this->request[0]=='search' ? $D->tab : 'posts') ) );
	
	$this->load_langfile('inside/header.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
	<head>
		<title><?= htmlspecialchars($D->page_title) ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="keywords" content="microblogging, sharetronix, blogtronix, enterprise microblogging">
		<link href="<?= $C->SITE_URL ?>themes/<?= $C->THEME ?>/css/inside.css?v=<?= $C->VERSION ?>" type="text/css" rel="stylesheet" />
		<link href="<?= $C->SITE_URL ?>themes/<?= $C->THEME ?>/css/jquery-ui-1.8.17.custom.css?v=<?= $C->VERSION ?>" type="text/css" rel="stylesheet" />
		<script type="text/javascript" src="<?= $C->IMG_URL ?>js/jquery.min.js?v=<?= $C->VERSION ?>"></script>
		<script type="text/javascript" src="<?= $C->IMG_URL ?>js/jquery-ui.min.js?v=<?= $C->VERSION ?>"></script>
		<script type="text/javascript" src="<?= $C->SITE_URL ?>i/js/jquery.outside.js?v=<?= $C->VERSION ?>"></script>
		<script type="text/javascript" src="<?= $C->SITE_URL ?>i/js/functions.js?v=<?= $C->VERSION ?>"></script>
		<script type="text/javascript" src="<?= $C->SITE_URL ?>i/js/posts.js?v=<?= $C->VERSION ?>"></script>
		<script type="text/javascript" src="<?= $C->SITE_URL ?>i/js/dashboard.js?v=<?= $C->VERSION ?>"></script>
		<script type="text/javascript" src="<?= $C->SITE_URL ?>i/js/admin.js?v=<?= $C->VERSION ?>"></script>
		<script type="text/javascript" src="<?= $C->SITE_URL ?>i/js/inside_postform.js?v=<?= $C->VERSION ?>"></script>
		<script type="text/javascript" src="<?= $C->SITE_URL ?>i/js/inside_autocomplete.js?v=<?= $C->VERSION ?>"></script>
		<?php if($this->request[0]=='view'){ ?><script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script><?php } ?>
		<base href="<?= $C->SITE_URL ?>" />
		<script type="text/javascript"> 
			var siteurl = "<?= $C->SITE_URL ?>"; 
			var paging_num_posts = "<?= $C->PAGING_NUM_POSTS ?>"; 
		</script>
		
		<?php if( isset($D->page_favicon) ) { ?>
		<link href="<?= $D->page_favicon ?>" type="image/x-icon" rel="shortcut icon" />
		<?php } elseif( $C->HDR_SHOW_FAVICON == 1 ) { ?>
		<link href="<?= $C->SITE_URL.'themes/facebookish/imgs/favicon.ico' ?>" type="image/x-icon" rel="shortcut icon" />
		<?php } elseif( $C->HDR_SHOW_FAVICON == 2 ) { ?>
		<link href="<?= $C->IMG_URL.'attachments/'.$this->network->id.'/'.$C->HDR_CUSTOM_FAVICON ?>" type="image/x-icon" rel="shortcut icon" />
		<?php } ?>
		<?php if(isset($D->rss_feeds)) { foreach($D->rss_feeds as &$f) { ?>
		<link rel="alternate" type="application/atom+xml" title="<?= $f[1] ?>" href="<?= $f[0] ?>" />
		<?php }} ?>
		<?php if( $C->SPAM_CONTROL ){ ?>
		<script type="text/javascript"> spam_control_check = true; spam_control_message = "<?= $this->lang('newpost_spam_filter_msg') ?>"; </script>
		<?php } ?>
		<?php if( $this->lang('global_html_direction') == 'rtl' ) { ?>
		<style type="text/css"> body { direction:rtl; } </style>
		<?php } ?>
	</head>
	<body>
		<div id="fbhdr">
			<div id="fbhdr2">	
				<?php if( $C->HDR_SHOW_LOGO==2&&!empty($C->HDR_CUSTOM_LOGO) ) { 
					$logo_width = @getimagesize($C->IMG_DIR.'attachments/'.$this->network->id.'/'.$C->HDR_CUSTOM_LOGO); $logo_width = @intval($logo_width[0]);
					?>
					<a href="<?= $C->SITE_URL ?>" id="logolink" style="background-image:url('<?= $C->IMG_URL.'attachments/'.$this->network->id.'/'.$C->HDR_CUSTOM_LOGO ?>');width:<?= $logo_width ?>px;" title="<?= htmlspecialchars($C->SITE_TITLE) ?>"></a>
				<?php } else { ?>
					<a href="<?= $C->SITE_URL ?>" id="logolink" title="<?= htmlspecialchars($C->SITE_TITLE) ?>"></a>
				<?php } ?>			
				<?php if( $this->user->is_logged ) { ?>	
				<div id="hdricons">		
					<a href="<?= $C->SITE_URL ?><?= $this->user->info->username ?>" class="icon_profile" title="<?= $this->lang('hdr_nav_profile') ?>"><b><?= $this->lang('hdr_nav_profile') ?></b></a>		
					<a href="<?= $C->SITE_URL ?>settings" class="icon_settings" title="<?= $this->lang('hdr_nav_settings') ?>"><b><?= $this->lang('hdr_nav_settings') ?></b></a>		
					<a href="<?= $C->SITE_URL ?>signout" class="icon_logout" title="<?= $this->lang('hdr_nav_signout') ?>"><b><?= $this->lang('hdr_nav_signout') ?></b></a>	
				</div>			
				<?php } ?>	
				<div id="fbhdrsearch">							
					<div id="topsearch">								
						<form name="search_form" method="post" action="<?= $C->SITE_URL ?>search"> 									
							<input type="hidden" name="lookin" value="<?= $hdr_search ?>" />									
							<div id="searchbtn">
								<input type="submit" value="" />
							</div>									
							<div class="searchselect">										
								<a id="search_drop_lnk" href="javascript:;" onfocus="this.blur();" onclick="try{msgbox_close();}catch(e){}; dropdiv_open('search_drop_menu1');"><?= $this->lang('hdr_search_'.$hdr_search) ?></a>										
								<div id="search_drop_menu1" class="searchselectmenu" style="display:none;">											
									<a href="javascript:;" onclick="hdr_search_settype('posts',this.innerHTML);dropdiv_close('search_drop_menu1');" onfocus="this.blur();"><?= $this->lang('hdr_search_posts') ?></a>											
									<a href="javascript:;" onclick="hdr_search_settype('users',this.innerHTML);dropdiv_close('search_drop_menu1');" onfocus="this.blur();"><?= $this->lang('hdr_search_users') ?></a>											
									<a href="javascript:;" onclick="hdr_search_settype('groups',this.innerHTML);dropdiv_close('search_drop_menu1');" onfocus="this.blur();" style="border-bottom:0px;"><?= $this->lang('hdr_search_groups') ?></a>										
								</div>									
							</div>									
							<div id="searchinput">
								<input type="text" name="lookfor" value="<?= isset($D->search_string)?htmlspecialchars($D->search_string):'' ?>" rel="autocomplete" autocompleteoffset="-6,4" />
							</div>								
						</form>							
					</div>	
				</div>	
				<div id="fbnav">	
					<?php if( $this->user->is_logged && $this->user->info->is_network_admin == 1 ) { ?>							
					<a href="<?= $C->SITE_URL ?>admin" class="<?= $this->request[0]=='admin'?'onnav':'' ?>"><b><?= $this->lang('hdr_nav_admin2') ?></b></a>	
					<?php } ?>	
					<?php if(!$C->PROTECT_OUTSIDE_PAGES || $this->user->is_logged){ ?>		 			
					<a href="<?= $C->SITE_URL ?>groups" class="<?= $this->request[0]=='groups'?'onnav':'' ?>"><b><?= $this->lang('hdr_nav_groups') ?></b></a>			
					<a href="<?= $C->SITE_URL ?>members" class="<?= $this->request[0]=='members'?'onnav':'' ?>"><b><?= $this->lang('hdr_nav_users') ?></b></a>			 			
					<?php } ?>
					<?php if($this->user->is_logged){?>
						<a href="<?= $C->SITE_URL ?>leaders" class="<?= $this->request[0]=='leaders'?'onnettab':'' ?>"><span><b><?= $this->lang('hdr_search_competitions') ?></b></span></a>
					<?php }else{ ?>			 				
					<a href="<?= $C->SITE_URL ?>signup" class="<?= $this->request[0]=='signup'?'onnav':'' ?>"><b><?= $this->lang('hdr_nav_signup') ?></b></a>	 				
					<a href="<?= $C->SITE_URL ?>signin" class="<?= $this->request[0]=='signin'?'onnav':'' ?>"><b><?= $this->lang('hdr_nav_signin') ?></b></a>		 			
					<?php } ?> 			
					<a href="<?= $C->SITE_URL ?>" class="<?= in_array( $this->request[0], array('dashboard', 'privatemessages', 'notifications') )?'onnav':'' ?>"><b><?= $this->lang('hdr_nav_home') ?></b></a>	
				</div>
			</div>
		</div>
		<div id="whiterow">
			<div id="whiterow2">
				<div id="slim_msgbox" style="display:none;">
					<strong id="slim_msgbox_msg"></strong>
					<a href="javascript:;" onclick="msgbox_close('slim_msgbox'); this.blur();" onfocus="this.blur();"><b><?= $this->lang('pf_msg_okbutton') ?></b></a>
				</div>
				
				<div id="pagebody">