@if ($success = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>完了</strong>&nbsp&nbsp&nbsp{{ $success }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if ($error = Session::get('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>エラー!</strong>&nbsp&nbsp&nbsp{{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif