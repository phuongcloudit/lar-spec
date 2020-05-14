@extends('layouts.app')
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
                <div class="the-article">
                    <div class="post-header">
                        <div class="post-title">
                            {{ $report->title }}
                        </div>
                        <div class="post-meta">
                            <ul class="blog-meta">
                                <li class="blog-date">{{ $report->date->format("Y 年 n 月 j 日") }}</li>
                                <li class="blog-date"> @if (empty($report->author)){{ $report->user->name }}@else{{ $report->author }}@endif</li>
                            </ul>
                        </div>
                        <div class="post-category">
                            <div class="post-category-inner">
                            @if (!empty($report->project_category->name))
                            <a href="" class="project-category">{{ $report->project_category->name }}</a>
                            @endif
                            @if (!empty($report->report_type->name))
                            <a href="" class="type">{{ $report->report_type->name }}</a>
                            @endif 
                            </div>
                        </div>
                    </div>
                    <div class="post-body">
                        <div class="featured-media">
                            <img src="{{ $report->thumbnail }}" alt="">
                        </div>
                        <div class="entry-content">
                           {!! $report->content !!}
                        </div>
                    </div>
                    <div class="post-footer">
                        <div class="return">
                            <a href="{{ route('reports.index') }}">記事一覧へ戻る</a>
                        </div>
                    </div>

                </div>
            </div>
            @include("includes.sidebar")
        </div>
    </section>
    <div class="clear"></div>
    @include("includes.pickups")
@stop
