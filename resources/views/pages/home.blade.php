@extends('layouts.app')
@section('content')
<main>
    <img src="{{ asset('assets/images/home/main.png') }}" alt="届くが見える︒想いが届く︑">
</main>
<section id="home-content">
   
        <div class="container">
         <div class="content">
            <p>
                Special Thanks（スペシャルサンクス）では寄付という形で皆様からの少しずつの支えを集めて、社会への貢献を目指します。<br />
                昨今の災害で被災された方への寄付はもちろん、夢への道のりの途中で今困っている、そんな方へ寄付という形で応援しませんか？

            </p>

        </div>
    </div>
</section>
<section class="section" id="topics">
    <div class="container">
        <h2 class="heading">
            TOPICS
            <p>【トピックス】<br />スタッフ注目のプロジェクト</p>
        </h2>
        <div class="projects colums-5">
            @foreach($featured_projects as $project)
            @include("projects.loop-project", ["itemId" => "featured-project"])
            @endforeach
        </div>
    </div>
</section>
<section class="section" id="project-new">
    <div class="container">
        <h2 class="heading">
            NEW
            <p>【新規募金プロジェクト】<br />新着のプロジェクト</p>
        </h2>
        <div class="projects colums-5">
            @foreach($new_projects as $project)
            @include("projects.loop-project")
            @endforeach
        </div>
    </div>
</section>
<section id="categories">
    <div class="container">
        <h2>
            CATEGORY<span>募金カテゴリー</span>
        </h2>
        <ul class="categories">
            @foreach($project_categories as $projectCat)
            <li>
                <a class="category" href="{{ route('projects.category', $projectCat->slug) }}">
                    <div>
                        <img src="{{ $projectCat->image?$projectCat->image:asset('assets/images/common/category-human.png') }}"
                            alt="">
                        <div class="title">{{ $projectCat->name  }}</div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</section>
@include("includes.banner")
<section id="news">
    <div class="container">
        <h2 class="heading">
            NEWS
            <p>【ニュース】 <br />新着情報</p>
        </h2>
        <div class="news">
            <ul>
                @foreach($posts as $post)
                <li>
                    <div class="meta">
                        <div class="date">
                            {{ $post->date->format("Y.m.d") }}
                        </div>
                        <div class="category">
                            <span>{{ $post->category->name }}</span>
                        </div>
                    </div>
                    <div class="content">
                        {{ $post->title }}
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
@stop