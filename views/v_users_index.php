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
	There are <?=$new_count?> new comics to read!<br/>
	The most recent comic:<br/>
	<article>
		<!-- Print the name of the comic's creator and date created -->
		<span class="user_info">
			<?=$last_comic['first_name']?> <?=$last_comic['last_name']?> created on 
			<time datetime="<?=Time::display($last_comic['created'],'Y-m-d @ H:i',$user->timezone)?>">
				<?=Time::display($random_post['created'],'F j, Y @ g:ia',$user->timezone)?>
			</time>
		</span>	
		<!-- Display newest comic -->
		<p><?=$last_comic['comic_html']?></p>
	</article>
	<? else: ?>
		There are no new comics.<br/>
	<?php endif; ?>
</div>