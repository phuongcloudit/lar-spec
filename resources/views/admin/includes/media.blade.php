
<div class="modal-mm modal fade" id="media-manager-modal-tinymce" tabindex="-1" role="dialog">
    <div class="modal-mm modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Media Manager</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="media-manager-tinymce"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal-mm modal fade" id="media-manager-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Media Manager</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="media-manager"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary media-confirm" data-dismiss="modal">Select</button>
                <button type="button" class="btn btn-default media-cancel" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('assets/admin/css/mm.css') }}">
@endpush
@push('scripts')
<script src="{{ asset('assets/admin/js/mm.min.js') }}"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script src="{{ asset('assets/admin/libs/jquery-sortable/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/jquery-sortable/jquery.ui.touch-punch.min.js') }}"></script>
<script>
var tinymce_field_name;

var editor_config = {
    height: 300,
    path_absolute : "/",
    selector: "textarea#content",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
    ],
    rel_list: [
        {title: 'dofollow', value: 'dofollow'},
        {title: 'nofollow', value: 'nofollow'}
    ],
    allow_unsafe_link_target: true,
    toolbar: "insertfile undo redo | styleselect fontselect fontsizeselect | bold italic | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | emoticons preview",
    relative_urls: false,
    image_caption: true,
    file_browser_callback : function(field_name, url, type, win) {
        tinymce_field_name = field_name;

        $("#media-manager-modal-tinymce").modal('show');
    },
    content_css: [
    	"{{ asset('assets/admin/css/tinymce.css') }}",
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    ]
};

tinymce.init(editor_config);
$('#media-manager-modal-tinymce').on('show.bs.modal', function (e) {
    new MM({
        el: '#media-manager-tinymce',
        api: {
            baseUrl: '/media-manager/',
            listUrl: 'list',
            downloadUrl: 'download',
            uploadUrl: 'upload',
            deleteUrl: 'delete'
        },
        input: {
            el: '#file-input-tinymce',
            multiple: false
        },
        height: '430px',
        onSelect: function(e) {
            $('#media-manager-modal-tinymce').modal('hide');
            window.document.getElementById(tinymce_field_name).value = e.selected.file
        }
    });
});
$(".delete-media").click(function(){
    var input = $(this).data("input"),
        preview = $(this).data("preview")
        $(input).val("");
        $(preview).html("");
})
$(".select-media").click(function(){
    var input = $(this).data("input"),
        preview = $(this).data("preview"),
        multiple = $(this).data("multiple")==true?true:false,
        size = $(this).data("size")?$(this).data("size"):"file"

    $(".media-confirm").unbind( "click" );
    $('#media-manager-modal').modal('show');
    new MM({
        el: '#media-manager',
        api: {
            baseUrl: '/media-manager/',
            listUrl: 'list',
            downloadUrl: 'download',
            uploadUrl: 'upload',
            deleteUrl: 'delete'
        },
        input: {
            el: input,
            multiple: multiple
        },
        height: '430px',
        onSelect: function(e) {
            $(".media-confirm").unbind( "click" );
            $(".media-confirm").click(function(){
                if(multiple){
                    var files = [];
                    if($(input).val() != ""){
                        files = JSON.parse($(input).val())
                    }
                    selecteds = e.selected.map(file=>{return file[size]});
                    var preview_html = '';
                    $.each(selecteds,function(index,value){
                        files.push(value);
                        preview_html +=     createImageItem(value)
                    })
                    $(preview).append(preview_html);
                    $(input).val(JSON.stringify(files))
                }else{
                    $(input).val(e.selected[size]);
                    $(preview).html(`<img src='${e.selected[size]}' />`)
                }
            })
        }
    });
})
function createImageItem(value){
    return `<div class="item"><img src="${value}" /><span class="remove"><i class="far fa-trash-alt"></i></span></div>`
}
function reCreateList(list){
    var input = list.data("input"),
    preview = list.data("preview")
    var files = []
    list.find("img").each(function(index){
        files.push($(this).attr("src"))
    })
    var preview_html = '';
    $.each(files,function(index,value){
        preview_html +=     createImageItem(value)
    })
    $(preview).html(preview_html)
    $(input).val(JSON.stringify(files))
}

$( ".list-preview" ).on('click','.remove',function(){
    $(this).closest(".item").fadeOut(200, function(){
        list = $(this).closest(".list-preview")        
        $(this).remove();
        reCreateList(list)
    })
})

$( ".list-preview" ).sortable({
    update: function (event, ui) {reCreateList($(this))  }
});
$( ".list-preview" ).sortable();
</script>
@endpush