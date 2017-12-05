<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="fa" class="fa">
	<head>
		<title><?php echo $page_title ?></title>
		
		<!-- Meta tags -->
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
		
		<!-- Load styles -->
		<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet" type="text/css" />
		<?php if($page_css): ?><link href="<?php echo $page_css ?>" rel="stylesheet" type="text/css" /><?php endif; ?>
		
		<!-- Load scripts -->
		<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
		<?php if($page_js): ?><script type="text/javascript" src="<?php echo $page_js ?>"></script><?php endif; ?>
	</head>
	
	<body id="page-top" class="<?php echo $page_class ?>">
		<div class="nav_bar_holder">
			<?php if($isOnline): ?>
				<ul class="nav_bar right_area">
					<li><a href="<?php echo base_url(); ?>">صفحه نخست</a></li>
					<?php if($user_rankName == 'is_owner'): ?><li><a href="<?php echo base_url(); ?>index.php/panel/register">ثبت کاربر</a></li><?php endif; ?>
				</ul>
				
				<ul class="nav_bar left_area">
					<li><a href="<?php echo base_url(); ?>index.php/panel/logout">خروج از سیستم</a></li>
					<?php if($user_rankName == 'is_owner'): ?><li><a href="<?php echo base_url(); ?>index.php/panel/addticket">ثبت بلیط</a></li><?php endif; ?>
				</ul>
			<?php else: ?>
				<span>لطفا وارد شوید</span>
			<?php endif; ?>
		</div>
		
		<?php if($isOnline): ?>
			<div class="membership">
				<span class="welcome_to">خوش آمدید, <i><?php echo $user_fname ?> <?php echo $user_lname ?></i></span>
				<span class="access_level">سطح دسترسی: <i><?php echo $user_rankName ?></i></span>
			</div>
		<?php endif; ?>
		
		<div id="content">
			<div id="profil">
				<img src="<?php echo base_url() ?>assets/img/volkswagen-logo2.png">
			</div>
			
			<div id="ana">