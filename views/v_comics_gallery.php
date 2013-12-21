<!-- Display all posts of users being followed by logged in user -->
<div id="posts">
	<h1>Gallery</h1>
	<?php foreach($comics as $comic): ?>
		<article>
			<!-- Print the name of the post's creator and date created -->
			<span class="user_info">
				<?php if($comic['comic_user_id'] != $user->user_id): ?>
					<a href="/users/profile/<?=$comic['user_name']?>"><?=$comic['first_name']?> <?=$comic['last_name']?></a> 
				<?php else: echo "You" ?>
				<?php endif; ?> 
				created on 
				<time datetime="<?=Time::display($comic['created'],'Y-m-d H:i',$user->timezone)?>">
					<?=Time::display($comic['created'],'F j, Y g:ia',$user->timezone)?>
				</time>
			</span>		
			<?=$comic['comic_html']?>
		</article>
		<br/>
	<?php endforeach; ?>
	<?php if(count($comics)==0): ?>
		<article>
			<p>There are no comics.  Go create one <a href="/comics/create">now</a>!</p>
		</article>
	<?php endif; ?>
</div>