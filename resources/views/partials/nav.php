<div id="header">
	<a id="logo" href="/"><h1>Social Network</h1></a>
	
	<div id="main-nav">
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">Search</a></li>
			<li><a href="#">Browse</a></li>
			<li><a href="#">Invite</a></li>
			<li><a href="#">Help</a></li>
			
			<?php if (isAuth()): ?>
				<li><a href="/logout">Logout</a></li>
			<?php else: ?>
				<li><a href="/login">Login</a></li>
			<?php endif; ?>
		</ul>
	</div>
</div>

<div id="profile-header">
	<span>Lachie Young's Profile</span>
</div>