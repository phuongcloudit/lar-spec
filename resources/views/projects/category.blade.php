@extends('layouts.app')
@push('title'){{ $projectCategory->name }}@endpush
@section('content')
@include("includes.pickups")
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