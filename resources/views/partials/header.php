<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Network</title>
	<link rel="stylesheet" type="text/css" href="public/css/main.css" />
</head>
<body>
	<!-- Begin App -->
    <div id="app">
		<!-- Begin Container -->
		<div id="container">
			<?php if (isAuth()): ?>
				<?php partial("nav"); ?>
			<?php else: ?>
				<?php partial("guest-nav"); ?>
			<?php endif; ?>


