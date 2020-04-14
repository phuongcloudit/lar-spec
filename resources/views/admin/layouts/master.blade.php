<!DOCTYPE html>
	<html lang="ja">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title> @yield('title',"Admin")</title>
		<link rel="stylesheet" href="{{ asset('assets/admin/css/app.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/css/jquery.fileupload.css') }}">
		@stack('stylesheets')
		<style>
			input[type="file"] {
				display: block;
			}
			.imageThumb {
				max-height: 75px;
				/* border: 2px solid; */
				padding: 1px;
				cursor: pointer;
			}
			.pip {
				display: inline-block;
				margin: 10px 10px 0 0;
			}
			.remove {
				display: block;
				background: #ffffff;
				border: 1px solid #a6a3a3;
				color: #ed0505;
				text-align: center;
				cursor: pointer;
			}
			.remove:hover {
				background: white;
				color: black;
			}
			a.post-title{
				color: #004a88;
				font-weight: bold;
			}
			.pagination{
				justify-content: flex-end;
			}
		</style>
	</head>
	<body class="hold-transition sidebar-mini">
		<div class="wrapper">
			<nav class="main-header navbar navbar-expand navbar-white navbar-light">
				@include('admin.includes.header')
			</nav>
			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				@include('admin.includes.sidebar')
			</aside>
			<div class="content-wrapper">
				@yield('content')
			</div>
			<footer class="main-footer">
				@include('admin.includes.footer')
			</footer>
		</div>
		<script src="{{ asset('assets/admin/js/app.js') }}"></script>
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script src="{{ asset('assets/js/jquery.ui.widget.js') }}"></script>
		<script>
			var editor_config = {
			path_absolute : "",
			selector: "textarea[name=content]",
			plugins: [
			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars code fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste textcolor colorpicker textpattern"
			],
			relative_urls: false,
			height: 429,
			file_browser_callback : function(field_name, url, type, win) {
			var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
			var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
			var cmsURL = editor_config.path_absolute + route_prefix + '?field_name=' + field_name;
			if (type == 'image') {
			cmsURL = cmsURL + "&type=Images";
			} else {
			cmsURL = cmsURL + "&type=Files";
			}
			tinyMCE.activeEditor.windowManager.open({
			file : cmsURL,
			title : 'Filemanager',
			width : x * 0.8,
			height : y * 0.8,
			resizable : "yes",
			close_previous : "no"
			});
			}
			};
			tinymce.init(editor_config);
		</script>
		<script>
			var route_prefix = "/filemanager";
		</script>
		<script src="{{ asset('assets/js/jquery.fileupload.js') }}"></script>
		<script>
		$(document).ready(function() {
			if (window.File && window.FileList && window.FileReader) {
				$(".imgs").on("change", function(e) {
					var clickedButton = this;
					var files = e.target.files,
					filesLength = files.length;
					for (var i = 0; i < filesLength; i++) {
						var f = files[i]
						var fileReader = new FileReader();
						fileReader.onload = (function(e) {
							var file = e.target;
							$("<span class=\"pip\">" +
							"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
							"<br/><span class=\"remove\"><i class=\"fas fa-trash-alt\"></i></span>" +
							"</span>").insertAfter(clickedButton);
							$(".remove").click(function(){
								$(this).parent(".pip").remove();
							});
						});
						fileReader.readAsDataURL(f);
					}
				});
			} else {
				alert("Your browser doesn't support to File API")
			}
		});
		</script>
		<script type="text/javascript">
			$(function(){
				$(".delete-confirm").click(function(){
					if(confirm("Are you sure you want to delete?")){
						return true;
					}else{
						return false;
					}
				})
			})
		</script>
		@stack('scripts')
	</body>
</html>