<a href="" class="brand-link text-center">
	@if(!Auth::check())
	<img src="{{ asset('assets/images/logo-admin.png') }}" alt="" class="brand-image" style="opacity: .8">
	<span class="brand-text font-weight-light">Admin</span>
	@else
	<img src="{{ asset('assets/images/logo-admin.png') }}" alt="" class="brand-image" style="opacity: .8">
	<span class="brand-text font-weight-light">{{ Auth::user()->name }}</span>
	@endif
</a>

<!-- Sidebar -->
<div class="sidebar">
	<!-- Sidebar user panel (optional) -->
	<div class="user-panel mt-3 pb-3 mb-3 d-flex">
		<div class="image">
			<img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="">
		</div>
		<div class="info">
			<a href="#" class="d-block">{{ Auth::user()->name }}</a>
		</div>
	</div>

	<!-- Sidebar Menu -->
	<nav class="mt-2">
		<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
			<li class="nav-item has-treeview">
				<a href="{{ route('admin.dashboard') }}" class="nav-link actsive">
					<i class="nav-icon fas fa-tachometer-alt"></i> Dashboard 
				</a>
			</li>
			<li class="nav-item has-treeview ">
				<a href="{{ route('admin.posts.index') }}" class="nav-link">
					<i class="nav-icon fas fa-hand-holding-usd"></i>
					<p>募金プロジェクト	<i class="fas fa-angle-left right"></i></p>
				</a>
				<ul class="nav nav-treeview">

					<li class="nav-item">
						<a href="{{ route('admin.posts.index') }}" class="nav-link">
							<i class="far fa-circle nav-icon"></i> 募金プロジェクト
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.posts.create') }}" class="nav-link">
							<i class="far fa-circle nav-icon"></i> 新規追加
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.categories.index') }}" class="nav-link">
							<i class="far fa-circle nav-icon"></i> カテゴリー
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item has-treeview ">
				<a href="{{ route('admin.news.index') }}" class="nav-link">
					<i class="nav-icon fas fa-edit"></i>
					<p>News<i class="fas fa-angle-left right"></i></p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route('admin.news.index') }}" class="nav-link">
							<i class="far fa-circle nav-icon"></i>	All news
						</a>
					</li>
					<li class="nav-item">
						<a href="{{ route('admin.news.create') }}" class="nav-link">
							<i class="far fa-circle nav-icon"></i> 新規追加
						</a>
					</li>
				</ul>
			</li>
			<li class="nav-item has-treeview ">
				<a href="{{ route('admin.users.index') }}" class="nav-link">
					<i class="nav-icon fas fa-users"></i>
					<p>Users <i class="fas fa-angle-left right"></i></p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="{{ route('admin.users.index') }}" class="nav-link">
							<i class="far fa-circle nav-icon"></i>All User
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</nav>
</div>