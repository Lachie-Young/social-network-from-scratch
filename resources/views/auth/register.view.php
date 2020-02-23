<?php partial("header"); ?>

<div id="login">
	<div class="info-box">
		<div class="info-box-title">
			<span>Register for Social Network below!</span>
		</div>
		<div class="info-box-content">
			<div id="login-form">
				<form method="POST" action="/register">
					
                    <div class="form-control">
						<label for="first_name">First name:</label>
						<input name="first_name" type="text" />
						<?php if (session()->errors("first_name")): ?>
							<span class="validation-error"><?= session()->errors("first_name") ?><span>
						<?php endif; ?>
					</div>

                    <div class="form-control">
						<label for="last_name">Last name:</label>
						<input name="last_name" type="text" />
						<?php if (session()->errors("last_name")): ?>
							<span class="validation-error"><?= session()->errors("last_name") ?><span>
						<?php endif; ?>
					</div>

					<div class="form-control">
						<label for="email">Email:</label>
						<input name="email" type="text" />
						<?php if (session()->errors("email")): ?>
							<span class="validation-error"><?= session()->errors("email") ?><span>
						<?php endif; ?>
					</div>
					
					<div class="form-control">
						<label for="password">Password:</label>
						<input name="password" type="password" />
						<?php if (session()->errors("password")): ?>
							<span class="validation-error"><?= session()->errors("password") ?><span>
						<?php endif; ?>
					</div>
					
					<input class="btn" type="submit" value="Register" />
				</form>
			</div>
		</div>
	</div>
</div>

<?php partial("footer"); ?>