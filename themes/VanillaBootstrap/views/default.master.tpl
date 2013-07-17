<!DOCTYPE html>
<html lang="en">
<head>

	{asset name='Head'}
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	{literal}
		<script type="text/javascript">$('html').hide();</script>
	{/literal}

</head>
<body id="{$BodyID}" class="{$BodyClass}">

	<!-- Navbar
	================================================== -->

	<div class="navbar navbar-inverse navbar-fixed-top" id="bootstrap-navbar">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<a class="brand" href="/"><!--{logo}-->VanillaBootstrap</a>

				<!-- Desktop and Tablet navigation
				================================================== -->

				<div class="nav-collapse hidden-phone">
					<ul class="nav">
						<li class="dropdown">
							<a id="drop1" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">Community <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="drop1">
								{discussions_link}
								{activity_link}
								{custom_menu}
							</ul>
						</li>
					</ul>
					{searchbox}
					<ul class="nav pull-right">
						{if $User.SignedIn}
						<li>
							{link path="signinout"}
						</li>
						</li>
						{/if}
						{if !$User.SignedIn}
						<li>
							<a href="{link path="/entry/register"}">
								<i class="icon-edit icon-white"></i> Sign up
							</a>
						</li>
						<li class="divider-vertical"></li>
						<li>
							<a href="{link path="/entry/signin"}" class="SignInPopup">Have an account?
								<i class="icon-share-alt icon-white"></i> Sign in
							</a>
						</li>
						{/if}
					</ul>
				</div>

				<!-- Phone navigation
				================================================== -->

				<div class="nav-collapse hidden-desktop hidden-tablet">
					<ul class="nav">
						{discussions_link}
						{activity_link}
						{if $User.SignedIn}
						<li>
							{link path="signinout"}
						</li>
						</li>
						{/if}
						{if !$User.SignedIn}
						<li>
							<a href="{link path="/entry/register"}">
								<i class="icon-edit icon-white"></i> Register new account
							</a>
						</li>
						<li class="divider-vertical"></li>
						<li>
							<a href="{link path="/entry/signin"}" class="SignInPopup">
								<i class="icon-share-alt icon-white"></i> Login to your account
							</a>
						</li>
						{/if}
					</ul>
				</div>

			</div>
		</div>
	</div>

	<!-- Header
	================================================== -->

	<header class="jumbotron subhead" id="bootstrap-header">
		<div class="container">
			<h1>IceFire Fórum</h1>
		</div>
	</header>

	<div class="bs-docs-social breadcrumb hidden-phone">
		<div class="container">
			{breadcrumbs}
			<div class="pull-right">
				{module name="MeModule"}
			</div>
		</div>
	</div>

	<!-- Container
	================================================== -->

	<div class="container" id="bootstrap-container">

		<noscript>
			<p></p>
			<div class="alert alert-error">
				<strong>Warning!</strong> As the Bootstrap classes are being added dynamically to the Vanilla markup using jQuery, you'll need to enable Javascript in your browser.
			</div>
		</noscript>

		<div class="row">
			<div class="span3" id="panel">
				{asset name="Panel"}
			</div>
			<div class="span9" id="content">
				{asset name="Content"}
			</div>
		</div>
	</div>

	<!-- Footer
	================================================== -->

	<footer class="footer" id="bootstrap-footer">
		<div class="container">
			<p class="pull-right"><a href="#" class="back-to-top">Back to top</a></p>
			{asset name="Foot"}
			<p>VanillaBootstrap is built on <a href="http://twitter.github.com/bootstrap">Bootstrap by Twitter</a> and powered by <a href="http://vanillaforums.org">Vanilla</a></p>
			<p>Twitter Bootstrap is made by <a href="http://twitter.com/mdo">@mdo</a> and <a href="http://twitter.com/fat">@fat</a> and licensed under the <a href="http://www.apache.org/licenses/LICENSE-2.0">Apache License v2.0</a></p>
			<p>The Twitter Bootstrap documentation styles is also created by <a href="http://twitter.com/mdo">@mdo</a> and <a href="http://twitter.com/fat">@fat</a></p>
			<ul class="footer-links">
				<li><a href="https://github.com/kasperisager/VanillaBootstrap/issues?state=open">Submit issues</a></li>
				<li>Created by <a href="http://github.com/kasperisager">Kasper Kronborg Isager</a></li>
			</ul>
		</div>
	</footer>

	{event name="AfterBody"}

</body>
</html>
