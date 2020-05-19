@extends('layouts.app')

@push('title')募金現場レポート@endpush
@section('content')

<section id="heading-cover">
    <div class="container">
        <h2 class="heading-title">
            <span>募金現場レポート</span>
        </h2>
    </div>
</section>


<section id="content-sidebar" class="section">
    <div class="container">
        <div class="main-content">

            <div class="report-content">

            @foreach($reports as $report)
                @include("reports.loop-report")
            @endforeach

           
            </div>
            <div class="report-pagination">
                <?php echo $reports->render(); ?>
            </div>
        </div>
        @include("includes.sidebar")
    </div>
</section>
<div class="clear"></div>


@stop