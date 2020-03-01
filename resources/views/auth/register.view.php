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
							<?php foreach (session()->errors("first_name") as $error): ?>
								<span class="validation-error"><?= $error ?><span>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

                    <div class="form-control">
						<label for="last_name">Last name:</label>
						<input name="last_name" type="text" />
						<?php if (session()->errors("last_name")): ?>
							<?php foreach (session()->errors("last_name") as $error): ?>
								<span class="validation-error"><?= $error ?><span>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>

					<div class="form-control">
						<label for="email">Email:</label>
						<input name="email" type="text" />
						<?php if (session()->errors("email")): ?>
							<?php foreach (session()->errors("email") as $error): ?>
								<span class="validation-error"><?= $error ?></span>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					
					<div class="form-control">
						<label for="password">Password:</label>
						<input name="password" type="password" />
						<?php if (session()->errors("password")): ?>
							<?php foreach (session()->errors("password") as $error): ?>
								<span class="validation-error"><?= $error ?><span>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					
					<input class="btn" type="submit" value="Register" />
				</form>
				
			</div>
		</div>
	</div>
</div>

<?php partial("footer"); ?>