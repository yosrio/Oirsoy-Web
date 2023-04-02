<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Oirsoy">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('admin/dist/img/icons/icon-48x48.png') }}" />

	<title>Backoffice</title>

	<link href="{{ asset('admin/dist/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="/">
					<span class="align-middle">Backoffice</span>
				</a>
				<ul class="sidebar-nav" id="sidebarMenu">
					<?php foreach ($sidebar as $item) : ?>
						<li class="sidebar-header">
							<?php echo $item->header; ?>
							<?php $menuItem = json_decode($item->item, 1); ?>
							<?php foreach ($menuItem['items'] as $menu) : ?>
								<li class="sidebar-item">
									<a class="sidebar-link" href="{{ route($menu['route']) }}" 
									id="{{ $menu['menu_id'] }}" 
									name="{{ $menu['menu_id'] }}">
										<i class="align-middle" data-feather="{{ $menu['feather'] }}"></i> 
										<span class="align-middle">{{ $menu['menu_title'] }}</span>
									</a>
								</li>
							<?php endforeach; ?>
						</li>
				<?php endforeach; ?>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="sidebar-toggle js-sidebar-toggle">
					<i class="hamburger align-self-center"></i>
				</a>
				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
								<span class="text-dark"><?php echo $user->name ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ route('profile') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="{{ route('logout') }}">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				@yield('content')
			</main>

			<footer class="footer">

			</footer>
		</div>
	</div>

	<script src="{{ asset('admin/dist/js/app.js') }}"></script>
</body>

</html>