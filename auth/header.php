<!DOCTYPE html>
<html lang="en">

<style>
	.navbar {
		position: sticky !important;
	}
</style>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Security-Policy" content="block-all-mixed-content">

	<title>PUPSRC - Webdev Project 1.3</title>
	<link rel="icon" href="/pupwebdev/assets/images/favicon.png">
	<script src="/pupwebdev/assets/javascript/jquery-3.3.1.min.js"></script>
	<link href="/pupwebdev/assets/stylesheet/bootstrap413.min.css" rel="stylesheet">
	<link href="/pupwebdev/assets/stylesheet/fontawesome531.css" rel="stylesheet">
	<link href="/pupwebdev/assets/stylesheet/styles.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>

</head>

<body>

	<nav class="navbar navbar-expand navbar-dark bg-pupcustomcolornavbar fixed-top profile-block">
		<a class="navbar-brand" href="#">
			<img src="/pupwebdev/assets/images/logo.png" width="70" height="70" class="d-inline-block align-top logo-design" alt="">
			<div class="navbar-titlehead">
				Polytechnic University of the Philippines <br>
				Santa Rosa Campus	<br>
				City of Santa Rosa, Laguna
			</div>
		</a>
		<?php include 'profile.php';?>
	</nav>
