<!-- Display all comics created by this user -->
<div id="posts">
	<h1>My Comics</h1>
	<?php foreach($comics as $comic): ?>
		<article>
			<span class="user_info">
				Created on 
				<time datetime="<?=Time::display($comic['created'],'Y-m-d H:i',$user->timezone)?>">
					<?=Time::display($comic['created'],'F j, Y g:ia',$user->timezone)?>
				</time>
			</span>
			<a href="/comics/delete/<?=$comic['comic_id']?>">Delete!</a>
			<p><?=$comic['comic_html']?></p>
		</article>
	<?php endforeach; ?>
	<?php if(count($comics)==0): ?>
		<article>
			<p>You have no saved comics.  Create one <a href="/comics/create/">now</a>!</p>
		</article>
	<?php endif; ?>
</div>