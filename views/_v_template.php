<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link href="http://fonts.googleapis.com/css?family=Walter+Turncoat" rel="stylesheet" type="text/css">
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
</head>
<body>
	<div id="menu">
		<!-- Home link logo -->
		<a href="/">Logo here</a>
		<span class="text_link">
			<!-- Top Menu for users who are logged in -->
			<?php if($user): ?>
				<a href="/users/profile"><img src="/images/profile.png" alt="View Profile"/></a>&nbsp;
				<a href="/users/logout"><img src="/images/logout2.png" alt="Log out!"/></a>				
			<!-- Menu options for users who are not logged in -->
			<?php else: ?>
				<a href="/users/signup"><img src="/images/signup.png" alt="Sign up!"/></a>&nbsp;
				<a href="/users/login"><img src="/images/login2.png" alt="Log In!"/></a>
			<?php endif; ?>
		</span>
	</div>
	<div id="main_content">
    <br/>
	<!-- Navigation menu for users who are logged in, do not display when not logged in -->
	<?php if($user): ?>
		<div id="main_navigation">
			<a href="/users/index" id="home_link"></a> |
			<a href="/users/profile" id="profile_link"></a> |
			<a href="/comics/create" id="create_link"></a> |
			<a href="/comics/index" id="my_comics_link"></a> |
			<a href="/comics/gallery" id="gallery_link"></a> |
			<a href="/comics/users" id="creators_link"></a>
		</div>
		<div class="clearfix"></div>
	<?php endif; ?>	
	<!-- Main page content -->
	<?php if(isset($content)) echo $content; ?>
	</div>
	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>