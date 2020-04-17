@extends('layouts.app')
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        /*$('.ae-select-content').each(function(index){
            $(this).html($(this).closest(".dropdown-wrapper").find('li.selected').find("a").html());
        });*/
        $('.select-category').click(function(){
            $(this).children(".dropdown").slideToggle(200, function(){
                $(this).toggleClass('active');
            })
        })
        $('.dropdown-menu > li').click(function(){
            $(this).closest(".ae-dropdown").find(".ae-select-content").html($(this).find("a").html());
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