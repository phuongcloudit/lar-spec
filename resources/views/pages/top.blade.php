@extends('layouts.app')
@section('content')
<main>
    <img src="{{ asset('assets/images/home/main.png') }}" alt="届くが見える︒想いが届く︑">
</main>
<section id="home-content">
    <div class="content">
        <div class="container">
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
    </div>
</section>
<section class="section" id="topics">
    <div class="container">
        <h2 class="heading">
            TOPICS
            <p>【トピックス】<br />スタッフ注目のプロジェクト</p>
        </h2>
        <div class="projects colums-5">
            <?php for($i=0; $i<10; $i++):?>
            <div class="project">
                <a class="project-item" href="#">
                    <div class="thumbnail" style="background-image: url({{ asset('assets/images/common/project-demo.png') }});">
                        <div class="project-info">
                            <div class="category"><span>カテゴリー</span></div>
                            <div class="title">
                                <h3>タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</h3>
                            </div>
                        </div>
                    </div>
                    <div class="details">
                        <div class="detail">
                            <div class="th">募金<br />総額</div>
                            <div class="td">¥000.000</div>
                        </div>
                        <div class="detail">
                            <div class="th">募金<br />者数</div>
                            <div class="td">100人</div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endfor;?>
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
            <?php for($i=0; $i<10; $i++):?>
            <div class="project">
                <a class="project-item" href="#">
                    <div class="thumbnail" style="background-image: url({{ asset('assets/images/common/project-demo.png') }});">
                        <div class="project-info">
                            <div class="category"><span>カテゴリー</span></div>
                            <div class="title">
                                <h3>タイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトルタイトル</h3>
                            </div>
                        </div>
                    </div>
                    <div class="details">
                        <div class="detail">
                            <div class="th">募金<br />総額</div>
                            <div class="td">¥000.000</div>
                        </div>
                        <div class="detail">
                            <div class="th">募金<br />者数</div>
                            <div class="td">100人</div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endfor;?>
        </div>
    </div>
</section>
<section id="categories">
    <div class="container">
        <h2>        
            CATEGORY<span>募金カテゴリー</span>
        </h2>
        <ul class="categories">
            <li>
                <div class="category">
                    <a href="{{ route('home') }}" >
                        <img src="{{ asset('assets/images/common/category-human.png') }}" alt="">
                        <div class="title">ヒューマン</div>
                    </a>
                </div>
            </li>
            <li>
                <div class="category">
                    <a href="{{ route('home') }}" >
                        <img src="{{ asset('assets/images/common/category-petto.png') }}" alt="">
                        <div class="title">ペット</div>
                    </a>
                </div>
            </li>
            <li>
                <div class="category">
                    <a href="{{ route('home') }}" >
                        <img src="{{ asset('assets/images/common/category-iryou.png') }}" alt="">
                        <div class="title">医療</div>
                    </a>
                </div>
            </li>
            <li>
                <div class="category">
                    <a href="{{ route('home') }}" >
                        <img src="{{ asset('assets/images/common/category-supottsu.png') }}" alt="">
                        <div class="title">スポーツ</div>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</section>
<section class="banner">
    <div class="container">
        <img src="{{ asset('assets/images/common/banner.png')}}">
    </div>
</section>
<section id="news">
    <div class="container">
        <h2 class="heading">
            NEWS
            <p>【ニュース】   <br />新着情報</p>
        </h2>
        <div class="news">
            <ul>
                <?php for($i=0; $i<10; $i++):?>
                <li>
                    <div class="date">
                        2019.00.00
                    </div>
                    <div class="category">
                        <span>カテゴリー</span>
                    </div>
                    <div class="content">
                        テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト
                    </div>
                </li>
                <?php endfor;?>
            </ul>
        </div>
    </div>
</section>