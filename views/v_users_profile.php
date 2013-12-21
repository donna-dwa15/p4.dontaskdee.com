<div id="profile">
	<!-- Profile header depending on who is viewing -->
	<h1><?=$header?></h1>
	<!-- Profile content -->
	<div id="profile_info">
		<?php if(!isset($error)): ?>
			Name: <?=$first_name?> <?=$last_name?><br/>
			Email: <?=$email?><br/>
			Approximate Location: <?=$location?><br/> 
			Meower Since: 
			<time datetime="<?=Time::display($created,'Y-m-d',$user->timezone)?>">
				<?=Time::display($created,'F j, Y',$user->timezone)?>
			</time><br/>
			Number of Comics Created: <?=$comic_count?>
			<br/>
			<?php if(isset($last_comic)): ?>
			Last comic created on:
			<time datetime="<?=Time::display($last_comic,'Y-m-d @ H:i',$user->timezone)?>">
				<?=Time::display($last_comic,'F j, Y @ g:ia',$user->timezone)?>
			</time>
			<?php endif; ?>
		<?php endif; ?>
	</div>
	<div id="profile_update">
	</div>
</div>