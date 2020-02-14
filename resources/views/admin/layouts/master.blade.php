<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.includes.head')
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

    <script src="{{ asset('admin/js/app.js') }}"></script>
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
    <script src="{{ asset("assets/js/jquery.fileupload.js") }}"></script>
   {{-- <script>
      $('#fileUpload').fileupload();
   </script> --}}
   
</body>

</html>