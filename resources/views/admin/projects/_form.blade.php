 <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('name', "募金プロジェクト") }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                    @if ($errors->has('name'))
                        <div class="alert alert-danger">{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="form-group">
                    {{ Form::label('slug', "Slug: ") }}
                    {{ Form::text('slug', null, array('class' => 'form-control',  'minlength' => '5')) }}
                    @if ($errors->has('slug'))<div class="alert alert-danger">{{$errors->first('slug')}}</div>@endif
                </div>
                <div class="form-group">
                    {{ Form::label('content', "Content") }}
                    {!! Form::textarea('content', null, ['id' => 'content', 'class' => 'form-control' ]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                
                @if($project->exists)
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5 offset-7">
                            <a  class="btn btn-success  btn-block" href="{{ route('project.detail',['slug'=> $project->slug]) }}" target="_blank">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <div class="form-group">
                        {{ Form::label('status', "カテゴリー") }}
                        {!! Form::select('status', ["publish"   =>  "公開" ,"draft"    =>  "下書き"], old('status', $project->status?:'publish'), ['class' => 'form-control custom-select']) !!}
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="featured" value="1" {{ old('featured',$project->featured)?'checked':'' }} >
                            注目のプロジェクト
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                 {{ Form::button('<i class="fas fa-save"></i> Save', ['class' => 'btn btn-primary btn-block', 'type'=>'submit']) }}
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-outline-success btn-block" type="reset">
                                    <i class="fas fa-undo"></i> Reset
                                </button>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary  btn-block cancel-update"><i class="fas fa-arrow-left"></i>  キャンセル</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    {{ Form::label('project_category_id', "カテゴリー") }}
                    {!! Form::select('project_category_id', $projectCategories, null, ['class' => 'form-control custom-select']) !!}
                    @if ($errors->has('project_category_id'))<div class="alert alert-danger">{{$errors->first('project_category_id')}}</div>@endif
                </div>
                <div class="form-group">
                    {{ Form::label('end_time', "募集終了まで") }}
                    @if($project->exists)
                        {{ Form::date('end_time', Carbon\Carbon::parse($project->end_time)->format('yy-m-d'), ['class' => 'form-control']) }}
                    @else
                        {{ Form::date('end_time', Carbon\Carbon::now(), ['class' => 'form-control']) }}
                    @endif
                    @if ($errors->has('end_time'))<div class="alert alert-danger">{{$errors->first('end_time')}}</div>@endif
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>アバター画像</label>
                    <div class="select-media" data-input="#thumbnail" data-preview="#thumbnail-preview"  data-multiple="false">
                        <span>アバター画像選択</span>
                    </div>
                    <input type="hidden" class="form-control" name="thumbnail" id="thumbnail" value="{{ old('status', $project->thumbnail) }}">
                    <div id="thumbnail-preview">
                        @if(old('thumbnail',$project->thumbnail))
                        <img src="{{ old('thumbnail',$project->thumbnail) }}">
                        @endif
                    </div>
                    <div class="delete-media" data-input="#thumbnail" data-preview="#thumbnail-preview">
                       アバター画像削除
                    </div>
                </div>
            </div>
        </div>
         <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>ギャラリー</label>
                    <div class="select-media" data-input="#galleries" data-preview="#galleries-preview" data-multiple="true" data-size="file">
                        <span>ギャラリーに追加する</span>
                    </div>
                    <input type="hidden" class="form-control" name="galleries" id="galleries" value="{{ old('status', $project->galleries) }}">
                    <div id="galleries-preview" class="list-preview" data-input="#galleries" data-preview="#galleries-preview">
                        @if($project->gallery)
                            @foreach ($project->gallery as $gallery)
                            <div class="item">
                                <img src="{{ $gallery }}" />
                                <span class="remove"><i class="far fa-trash-alt"></i></span>
                            </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="delete-media" data-input="#galleries" data-preview="#galleries-preview">
                        ギャラリー削除
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="media-manager-modal-tinymce" tabindex="-1" role="dialog">
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
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    ]
};

tinymce.init(editor_config);
var media_file = null
var media_files = null
$('#media-manager-modal').on('hide.bs.modal', function (e) {
    var media_file = null
    var media_files = null
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
/*
$('#media-manager-modal').on('show.bs.modal', function (e) {
    new MM({
        el: '#media-manager',
        api: {
            baseUrl: '/tw-media-manager/',
            listUrl: 'list',
            downloadUrl: 'download',
            uploadUrl: 'upload',
            deleteUrl: 'delete'
        },
        input: {
            el: '#file-input',
            multiple: false
        },
        height: '430px',
        onSelect: function(e) {
            $("#file-input").val(e.selected.thumbnail);
            $("#meta_image").val(e.selected.file);
            $("#preview").attr('src', e.selected.thumbnail);
        }
    });
});
*/
$('#media-manager-modal-tinymce').on('show.bs.modal', function (e) {
    new MM({
        el: '#media-manager-tinymce',
        basePath : "uploads",
        api: {
            baseUrl: '/tw-media-manager/',
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


function slug(title)
{
    var slug = title.toLowerCase();
 
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    return slug;
}


$("#name").on('change', function(e){
    if($("#slug").val()==""){
        $("#slug").val(slug($(this).val()));    
    }
    
});
</script>
<style type="text/css">
    .list-preview .portlet-placeholder {
        width: 110px !important;
        background-color: #ddd;
        height: 74px;
        margin: 0;
        margin-right: 5px;
        float: left;
    }
    .list-preview .ui-sortable-helper {
        background-color: #3c8dbc;
        width: 33.333 !important;
        height: 100px;
        color: #FFF;
    }
</style>
@endpush