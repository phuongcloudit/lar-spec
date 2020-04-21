<header id="header">
	<div class="container">
		<div class="header-content">
			<div class="header-logo">
				<div class="logo">
					<a href="{{ route('home') }}">
						<img src="{{ asset('./assets/images/logo.png') }}" width="250" alt="届くが見える︒想いが届く︑" >
					</a>
				</div>
				<a class="menu-mobile" href="javascript:;">
					<svg width="36" height="32" stroke="#394261" stroke-width="2">
							<line x1="2" y1="4" x2="28" y2="4"></line>
						<line x1="2" y1="12" x2="32" y2="12"></line>
						<line x1="2" y1="20" x2="28" y2="20"></line>
						<line x1="2" y1="28" x2="32" y2="28"></line>
					</svg>
				</a>
			</div>
			<div class="header-nav">
				<ul>
					<li>
						<a href="{{ route('home') }}">
							<span>募金先を探す</span>
							<img src="{{ asset('assets/images/common/btn-green.png') }}" alt="募金先を探す">
						</a>
					</li>
					<li>
						<a href="{{ route('home') }}">
							<span>募金を募集する</span>
							<img src="{{ asset('assets/images/common/btn-blue.png') }}" alt="募金を募集する">
						</a>
					</li>
					<li>
						<a href="{{ route('home') }}">
							<span>募金現場レポート</span>
							<img src="{{ asset('assets/images/common/btn-orange.png') }}" alt="募金現場レポート">
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</header>