@extends('layouts.app')
@section('content')
<main>
    <img src="{{ asset('assets/images/home/main.png') }}" alt="届くが見える︒想いが届く︑">
</main>
<section id="home-content">
    <div class="content">
        <div class="container">
            <div class="content-right">
                届かせたい想いがある
            </div>
            <p>
                人は一人では生きるには難しくどこかで誰かに支えられて日々を生きています。<br>
                名前も知らない誰かからのやさしさが社会、人々の日々の生活、そして何より人の心を豊かにすると私たちは信じています。<br>
                困っている人を名前のわからない誰かが少しずつ支えることでもっともっとこの社会がよくなると信じています。<br>
                Special Thanks（スペシャルサンクス）では寄付という形で皆様からの少しずつの支えを集めて、社会への貢献を目指します。<br>
                昨今の災害で被災された方への寄付はもちろん、夢への道のりの途中で今困っている、そんな方へ寄付という形で応援しませんか？
            </p>
            <p>
                <span class="red">約束</span><br>
                Special　Thanks（以下本サービス）を運営している株式会社クロスフォース（以下当社）はWebマーケティングを主な生業とする営利企業です。<br>
                だからこそ本サービスでも営利を出さなければなりません。<br>
                だからと言って不明瞭に弊社が利益を追求するために本サービスは生まれたわけではありません。<br>
                弊社はここで宣言いたします。<br>
                本サービスにおいて弊社は皆様から頂きました寄付のうち20％を運用管理費として頂戴し、その中から本サービスの認知拡大・運営事務費用を捻出いたします。<br>
                これを嘘偽りなく遂行するために毎月の月次の寄付金及び運営コストを発表することをお約束いたします。
            </p>

            <a href="">募金実績はこちら>></a>

            
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
                <a class="category" href="{{ route('projects.category', $projectCat->slug) }}" >
                    <div>
                        <img src="{{ $projectCat->image?$projectCat->image:asset('assets/images/common/category-human.png') }}" alt="">
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
            <p>【ニュース】   <br />新着情報</p>
        </h2>
        <div class="news">
            <ul>
                @foreach($posts as $post)
                <li>
                    <div class="date">
                        {{ $post->date->format("Y.m.d") }}
                    </div>
                    <div class="category">
                        <span>{{ $post->category->name }}</span>
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