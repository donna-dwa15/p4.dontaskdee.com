<h1>Hello, <?=$user->first_name?>!</h1>
<!-- Current user stats summary -->
<div id="users">
	<?php if(isset($last_login)): ?>
	Last logged in on 
	<time datetime="<?=Time::display($last_login,'Y-m-d @ H:i.',$user->timezone)?>">
		<?=Time::display($last_login,'F j, Y @ g:ia.',$user->timezone)?>
	</time>
	<br/><br/>
	<?php endif; ?>
	You are hoarding <?=$private_count?> of your comics.</br>
	You are sharing <?=$public_count?> of your comics.</br>
	<br/>
	There are <?=$user_count?> other creators.<br/>
	There are <?=$comic_count?> public comics available!<br/>
	<br/>
	<?php if($new_count > 0): ?>
	There are <?=$new_count?> new comics to read!<br/><br/>
	<? else: ?>
		There are no new comics.<br/>
	<?php endif; ?>
</div>
<?php if($new_count > 0): ?>
<div>
	<header><h2>Latest comic:</h2></header>
	<?=$last_comic['comic_html']?>
</div>
<?php endif; ?>