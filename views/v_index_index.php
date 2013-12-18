<h1>Welcome!</h1>
<!-- Left hand content -->
<div id="new_features">
</div>
<!-- Content divider -->
<div id="vert_line">
	<img src="/images/v_line.png" alt=""/>
</div>
<!-- Right hand content -->
<div id="form_content">
	<div id="accordion">
		<header id="login">
			<h2>Ready to create? Login!</h2>
		</header>
		<!-- Login form -->
		<div>
		<form method="POST" action="/users/p_login">
			<label for="user_name">User Name</label><br/>
			<input type="text" size="30" maxlength="50" id="user_name" name="user_name"/>
			<br/>
			<label for="password">Password</label>
			<br/>
			<input type="password" size="30" maxlength="50" id="password" name="password"/>
			<br/>
			<input type="image" src="/images/login_btn.png" alt="login!"/>
		</form>
		</div>
		<!-- For new users -->
		<header id="new_user">
			<h2>New user? Sign up!</h2>
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
				<input type="text" id="first_name" name="first_name" size="30" maxlength="150" value=""/>
				<br/>
				<label for="last_name">Last Name</label><br/>
				<input type="text" id="last_name" name="last_name" size="30" maxlength="150" value=""/>
				<br/>
				<label for="email">Email</label><br/>
				<input type="text" id="email" name="email" size="30" maxlength="150" value=""/>
				<br/>
				<label for="user_name">User Name</label><br/>
				<input type="text" id="user_name" name="user_name" size="30" maxlength="50" value=""/>
				<br/>
				<label for="password">Password</label><br/>
				<input type="password" id="password" name="password" size="30" maxlength="50" value=""/>
				<br/>
				<label for="password_confirm">Confirm Password</label><br/>
				<input type="password" id="password_confirm" name="password_confirm" size="30" maxlength="50" value=""/>
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