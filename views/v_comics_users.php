<div id="content">
	<h1>Fellow Creators</h1>
	<!-- Search users form -->
	<div id="search">
		<form action="/comics/p_search" method="POST">
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
				<a href="/users/profile/<?=$user['user_name']?>"><?=$user['user_name']?></a> - <?=$user['first_name']?> <?=$user['last_name']?>
				<br/><br/>
				<?php endforeach; ?>
		<?php endif; ?>
	</div>
</div>
