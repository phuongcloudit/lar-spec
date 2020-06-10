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

<section id="feature-blog">
    <div class="container">
        <h2 class="title">
            人気ブログ
        </h2>
        <div class="feature-blog-wrapper">
            @foreach($featureReports as $freport)
            <div class="blog-item">
                <div class="blog-item-inner">
                    <div class="blog-title">
                        <a href="{{ route('reports.detail',['slug'=> $freport->slug]) }}">{{ $freport->title }}</a>
                    </div>
                    <div class="blog-meta-wrapper">
                        <ul class="blog-meta">
                            <li class="blog-date">{{ $freport->date->format("Y 年 n 月 j 日") }}</li>
                            <li class="blog-date"> @if(empty($freport->author)){{ $freport->user->name }}@else{{ $freport->author }}@endif</li>
                        </ul>
                    </div>
                    <div class="blog-thumbnail">
                        <a href="{{ route('reports.detail',['slug'=> $freport->slug]) }}"><img src="{{ $freport->thumbnail }}" alt=""></a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</section>

<section id="content-sidebar" class="section">
    <div class="container">
        <div class="main-content">
            <div class="new-report">
                <h2 class="title">
                新着記事
                </h2>

                <div class="new-report-content">
                    <div class="new-report-title">
                        <a href="{{ route('reports.detail',['slug'=> $report_first->slug]) }}">{{ $report_first->title }}</a>
                    </div>
                    <div class="new-report-meta-wrapper">
                        <ul class="blog-meta">
                            <li class="blog-date">{{ $report_first->date->format("Y 年 n 月 j 日")}}</li>
                            <li class="blog-date">黒須 花子</li>
                        </ul>
                    </div>
                    <div class="entry-categories">
                        <div class="entry-categories-inner">
                            @if (!empty($report_first->project_category->name))
                            <a href="{{ route('reports.project',['slug'=> $report_first->project_category->slug]) }}"
                                class="project-category">{{ $report_first->project_category->name }}</a>
                            @endif
                            @if (!empty($report_first->report_type->name))
                            <a href="{{ route('reports.type',['slug'=> $report_first->report_type->slug]) }}"
                                class="type">{{ $report_first->report_type->name }}</a>
                            @endif
                        </div>
                    </div>
                    <div class="featured-media">
                        <a href="{{ route('reports.detail',['slug'=> $report_first->slug]) }}"><img src="{{ $report_first->thumbnail }}" alt=""></a>
                    </div>
                    <div class="entry-content">
                    {!! substr(strip_tags($report_first->content), 0, 100) !!} 
                    </div>
                </div>
            </div>

            <div class="report-content">
                @foreach($reports as $report)
                    @include("reports.loop-report")
                @endforeach
            </div>
            <div class="report-pagination">
                <?php echo $reports->render(); ?>
            </div>
            <!-- <div class="pagination">
                <ul>
                    <li><a href="" class="first"><</a>
                    </li>
                    <li class="active"><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li>...</li>
                    <li><a href="">12</a></li>
                    <li><a href="" class="last">></a></li>

                </ul>
            </div> -->
        </div>
        @include("includes.sidebar")
    </div>
</section>
<div class="clear"></div>

@include("includes.pickups")
@stop
