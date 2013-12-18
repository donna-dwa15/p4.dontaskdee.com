<div id="content">
	<h1>Fellow Creators</h1>
	<!-- Search users form -->
	<div id="search">
		<form action="/posts/p_search" method="POST">
			<label for="search_term">Search Creators</label>
			<input type="text" size="50" maxlength="50" id="search_term" name="search_term"/> 
			<input type="submit" value="Search"/>
		</form>
	</div>
	<!-- Display all users or error messaging -->
	<div id="users">
		<?php if(isset($message)):?>
			<?php echo $message ?>
			<br/>
		<?php else: ?>
				<?php foreach($users as $user): ?>
				<!-- Print this user's name -->
				<a href="/users/profile/<?=$user['user_name']?>"><?=$user['first_name']?> <?=$user['last_name']?></a>
				<!-- If there exists a connection with this user, show a unfollow link -->
				<?php if(isset($connections[$user['user_id']])): ?>
					<a href='/posts/unfollow/<?=$user['user_id']?>'><img src="/images/unstalk_btn_2.png" alt="Unstalk!"/></a>
				<!-- Otherwise, show the follow link -->
				<?php else: ?>
					<a href='/posts/follow/<?=$user['user_id']?>'><img src="/images/stalk_btn_2.png" alt="Stalk!"/></a>
				<?php endif; ?>
				<br/><br/>
				<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
