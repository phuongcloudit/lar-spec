@extends('layouts.app')
@push('title')募金プロジェクト@endpush
@section('content')
<section class="section">
    <div class="container">
        <h2 class="heading">
            募金プロジェクト
            <p>【新規募金プロジェクト】<br />新着のプロジェクト</p>
        </h2>
        <div class="projects colums-3">
            @foreach($projects as $project)
                @include("projects.loop-project")
            @endforeach
        </div>
        <?php echo $projects->render(); ?>
    </div>
</section>
@stop