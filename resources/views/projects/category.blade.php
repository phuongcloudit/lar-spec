@extends('layouts.app')
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.select-category').click(function(){
            $(this).children(".dropdown").slideToggle(200, function(){
                $(this).toggleClass('active');
            })
        })
    })
</script>
@endpush
@section('content')
@include("includes.sorting")
<section class="section">
    <div class="container">
        <h2 class="heading">
            {{ $projectCategory->slug }}
            <p>{!! nl2br($projectCategory->description) !!}</p>
        </h2>
        <div class="projects colums-3">
            @foreach($projects as $project)
                @include("projects.loop-project")
            @endforeach
        </div>
        <?php echo $projects->render(); ?>
    </div>
</section>
@include("includes.banner")
@stop