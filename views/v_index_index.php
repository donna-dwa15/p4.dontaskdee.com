<h1>Welcome to the Cat's Meow Comic Creator!</h1>
<!-- Left hand content -->
<div id="new_features">
	Use our custom tools to create your own personal comic strips!  Choose your characters, backgrounds and text.  The possibilities are endless!
	<br/><br/>
	You can create your own comic strips to:
	<ul>
		<li>share with other users!</li>
		<li>keep for yourself!</li>
		<li>print and share!</li>
	</ul>
	Sign up today and start creating!
	<img src="/images/meower_head.png" alt="Meow!"/>
</div>

<!-- Right hand content -->
<div id="form_content">
	<div id="accordion">
		<header id="login">
			<h2><img src="/images/meower_head.png" alt="Meow!"/>Ready to create? Login!</h2>
		</header>
		<!-- Login form -->
		<div>
		<form method="POST" action="/users/p_login">
			<label for="user_name">User Name</label><br/>
			<input type="text" size="30" maxlength="50" id="user_name" name="user_name" required/>
			<br/>
			<label for="password">Password</label>
			<br/>
			<input type="password" size="30" maxlength="50" id="password" name="password" required/>
			<br/>
			<input type="image" src="/images/login_btn.png" alt="login!"/>
		</form>
		</div>
		<!-- For new users -->
		<header id="new_user">
			<h2><img src="/images/meower_head.png" alt="Meow!"/>New user? Sign up!</h2>
		</header>
		<div>
			<!-- User signup form -->
			<form method="POST" action="/users/p_signup">
				<?php if(isset($error)): ?>
					<div class="error">
						<?php foreach($_SESSION['error'] as $error_msg)
								echo($error_msg."<br/>");
						?>
						<br/>
					</div>
				<?php endif; ?>
				<!-- User info fields -->
				<label for="first_name">First Name</label><br/>
				<input type="text" id="first_name" name="first_name" size="30" maxlength="150" value="" required/>
				<br/>
				<label for="last_name">Last Name</label><br/>
				<input type="text" id="last_name" name="last_name" size="30" maxlength="150" value="" required/>
				<br/>
				<label for="email">Email</label><br/>
				<input type="text" id="email" name="email" size="30" maxlength="150" value="" required/>
				<br/>
				<label for="user_name">User Name</label><br/>
				<input type="text" id="new_user_name" name="user_name" size="30" maxlength="50" value="" required/>
				<br/>
				<label for="password">Password</label><br/>
				<input type="password" id="new_password" name="password" size="30" maxlength="50" value="" required/>
				<br/>
				<label for="password_confirm">Confirm Password</label><br/>
				<input type="password" id="password_confirm" name="password_confirm" size="30" maxlength="50" value="" required/>
				<br/>
				<input type="hidden" name="timezone"/>
				<script>
					$('input[name=timezone]').val(jstz.determine().name());
				</script>
				<input type="image" src="/images/signup_btn.png" alt="sign up!"/>
			</form>
		</div>
	</div>
</div>
<script>
$( "#accordion" ).accordion( {header: "header"}, {heightStyle: "content" });
</script>