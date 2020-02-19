@extends('layouts.app')
@section('content')

<!-- <div class="row center-xs">
        <div class="slide-spec between-xs owl-carousel owl-theme">
            <div class="slide-item">
                <div class="image">
                    <img src="./assets/images/dog.png" alt="">
                </div>
                <div class="snippet">
                    <div class="cate">
                        Demo
                    </div>
                    <div class="title">
                        わからない誰かわからない誰かわからない誰か
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image">
                    <img src="./assets/images/dog.png" alt="">
                </div>
                <div class="snippet">
                    <div class="cate">
                        Demo
                    </div>
                    <div class="title">
                        わからない誰かわからない誰かわからない誰か
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image">
                    <img src="./assets/images/dog.png" alt="">
                </div>
                <div class="snippet">
                    <div class="cate">
                        Demo
                    </div>
                    <div class="title">
                        わからない誰かわからない誰かわからない誰か
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image">
                    <img src="./assets/images/dog.png" alt="">
                </div>
                <div class="snippet">
                    <div class="cate">
                        Demo
                    </div>
                    <div class="title">
                        わからない誰かわからない誰かわからない誰か
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image">
                    <img src="./assets/images/dog.png" alt="">
                </div>
                <div class="snippet">
                    <div class="cate">
                        Demo
                    </div>
                    <div class="title">
                        わからない誰かわからない誰かわからない誰か
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image">
                    <img src="./assets/images/dog.png" alt="">
                </div>
                <div class="snippet">
                    <div class="cate">
                        Demo
                    </div>
                    <div class="title">
                        わからない誰かわからない誰かわからない誰か
                    </div>
                </div>
            </div>
            <div class="slide-item">
                <div class="image">
                    <img src="./assets/images/dog.png" alt="">
                </div>
                <div class="snippet">
                    <div class="cate">
                        Demo
                    </div>
                    <div class="title">
                        わからない誰かわからない誰かわからない誰か
                    </div>
                </div>
            </div>
        </div>
      </div> -->
<div class="nav-header">
    <div class="container">
        <div class="row center-xs">
            <div class="nav left col-xs-12 col-sm-5">
                <span>カテゴリ</span>

                <div class="select">
                    <select name="type" id="type">
                        @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="nav right col-xs-12 col-sm-7">
                <span>並べ替え</span>
                <ul>
                    <li class="active"><a href="">新着順</a></li>
                    <li><a href="">終了日が近い順</a></li>
                    <li><a href="">支援総額順</a></li>
                    <li><a href="">支援者数順</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="detail-content">
    <div class="container">
        <div class="row center-xs">
            <h2 class="title">
                {{ $post->title }}
            </h2>
        </div>
        <div class="row center-xs">
            <div class="type-span">
                <span>カテゴリ</span>
                <div class="category-type">
                    {{ $post->category->name }}
                </div>
            </div>
        </div>
        <div class="row detail-content__main">
            <div class="slide-img col-xs-12 col-sm-7">
                <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                    @foreach ($post->images as $item)
                    <li data-thumb="{{ url('/') }}/storage/uploads/{{ $item->image_name }}">
                        <img src="{{ url('/') }}/storage/uploads/{{ $item->image_name }}" />
                    </li>
                    @endforeach
                </ul>
                {{-- <img src="./assets/images/dog.png" alt=""> --}}
            </div>
            <div class="info-order col-xs-12 col-sm-5">
                <div class="info-order__item">
                    <div class="info-order__title">
                        募金総額
                    </div>
                    <div class="info-order__body">
                        <span class="red">¥{{ $post->donate_money }}</span>
                    </div>
                </div>
                <div class="info-order__item">
                    <div class="info-order__title">
                        募金者数
                    </div>
                    <div class="info-order__body">
                        {{ $post->donate_people }}人
                    </div>
                </div>
                <div class="info-order__item">
                    <div class="info-order__title">
                        募集終了まで
                    </div>
                    <div class="info-order__body">
                        <span class="red">{{ $post->current }}日</span>
                    </div>
                </div>
                <div class="donate-button__out">
                    <div class="button-dn">
                        <a class="color-dn1" href="">このプロジェクトに募金する</a>
                    </div>
                    <div class="button-dn">
                        <a class="color-dn2" href="">募金現場レポート</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row detail-content__body">
            <div class="col-xs-12 col-sm-7">
                    {!! $post->content !!}
            </div>
            <div class="col-xs-12 col-sm-7">
                <div class="author-profile-widget">
                    <div class="author-info">
                        <div class="author-image">
                            <img src="./assets/images/author.png" alt="">
                        </div>
                        <div class="author-name">
                            テキストテキ
                        </div>
                    </div>
                    <div class="author-introduce">
                        テキストテキストテキストテキストテキストテキストテキストテキスト
                        テキストテキストテキストテキストテキストテキストテキストテキスト
                        テキストテキストテキストテキストテキストテキストテキストテキスト
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
