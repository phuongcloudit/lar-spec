@extends('layouts.app')
@section('content')
<div class="main-cover">

</div>
<section id="message">
    <div class="container">
        <div class="row">
            <div class="content">
                人は一人では生きるには難しくどこかで誰かに支えられて日々を生きています。<br>
                名前も知らない誰かからのやさしさが社会、人々の日々の生活、そして何より人の心を豊かにすると私たちは信じています。<br>
                困っている人を名前のわからない誰かが少しずつ支えることでもっともっとこの社会がよくなると信じています。<br>
                Special Thanks（スペシャルサンクス）では寄付という形で皆様からの少しずつの支えを集めて、社会への貢献を目指します。<br>
                昨今の災害で被災された方への寄付はもちろん、夢への道のりの途中で今困っている、そんな方へ寄付という形で応援しませんか？<br><br>

                <span class="red">約束</span><br>
                Special　Thanks（以下本サービス）を運営している株式会社クロスフォース（以下当社）はWebマーケティングを主な生業とする営利企業です。<br>
                だからこそ本サービスでも営利を出さなければなりません。<br>
                だからと言って不明瞭に弊社が利益を追求するために本サービスは生まれたわけではありません。<br>
                弊社はここで宣言いたします。<br>
                本サービスにおいて弊社は皆様から頂きました寄付のうち20％を運用管理費として頂戴し、その中から本サービスの認知拡大・運営事務費用を捻出いたします。<br>
                これを嘘偽りなく遂行するために毎月の月次の寄付金及び運営コストを発表することをお約束いたします。<br><br>

                <a href="">募金実績はこちら>></a>
            </div>
        </div>
    </div>
    <!-- <div class="message_right">
        届<br>か<br>せ<br>た<br>い<br>想<br>い<br>が<br>あ<br>る
    </div> -->
</section>
<section id="topics" class="category">
    <div class="container">
        <div class="row">
            <h2 class="title">
                NEW<span>【新規募金プロジェクト】<br>新着のプロジェクト</span>
            </h2>
        </div>
        <div class="row content">
            @if ($posts->isEmpty())
            <p> Post is Empty</p>
           @else
            @foreach ($posts as $post)
            <a class="item" href="{{ route('post.detail',['slug'=> $post->slug]) }}">
                <div class="item-img">
                    @foreach ($post->images as $item)
                    <img src="{{ url('/') }}/storage/uploads/{{ $item->image_name }}" alt="">
                    @break;
                  @endforeach
                    <div class="snippet">
                        {{ $post->title }}
                    </div>
                </div>
                <div class="item-donate">
                    <div class="item-donate__item">
                        <div class="left">
                            募金<br>総額
                        </div>
                        <div class="right">
                            <span>¥000.000</span>
                        </div>
                    </div>
                    <div class="item-donate__item">
                        <div class="left">
                            募金<br>者数
                        </div>
                        <div class="right">
                            <span>{{ $post->donates->count() }}人</span>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
            @endif
        </div>
</section>
<section id="category">
    <div class="container">
        <div class="row">
            <h2 class="title">
                CATEGORY<span>募金カテゴリー</span>
            </h2>
        </div>
        <div class="row center-xs">
            <div class="content">
                <div class="row">
                    <div class="col-xs-6 col-sm-3">
                        <a class="item" href="">
                            <div class="item_cate__icon">
                                <img src="./assets/images/top/human-icon.png" alt="">
                            </div>
                            <div class="item_cate__text">
                                ヒューマン
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a class="item" href="">
                            <div class="item_cate__icon">
                                <img src="./assets/images/top/pet-icon.png" alt="">
                            </div>
                            <div class="item_cate__text">
                                ペット
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a class="item" href="">
                            <div class="item_cate__icon">
                                <img src="./assets/images/top/healthcare-icon.png" alt="">
                            </div>
                            <div class="item_cate__text">
                                医療
                            </div>
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-3">
                        <a class="item" href="">
                            <div class="item_cate__icon">
                                <img src="./assets/images/top/sport-icon.png" alt="">
                            </div>
                            <div class="item_cate__text">
                                スポーツ
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('shared.donate-banner')

<section class="category" id="news">
    @include('pages._news')
</section>
@stop