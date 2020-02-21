@extends('layouts.app')
@section('content')

@include('shared.slide')
<div class="nav-header">
    <div class="container">
        <div class="row center-xs">
            <div class="nav left col-xs-12 col-sm-5">
                <span>カテゴリ</span>

                <div class="select">
                    <select name="type" id="type">
                        <option value="volvo" selected>ペット</option>
                        <option value="saab">Saab</option>
                        <option value="vw">VW</option>
                        <option value="audi">Audi</option>
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
<section id="pet" class="category cate_page">
    <div class="container">
        <div class="row">
            <h2 class="title">
            {{ $cat->name }}<span>{{ $cat->description }}</span>
            </h2>
        </div>
        <div class="row content">
            @if ($posts->isEmpty())
             <p> Post is Empty</p>
            @else
                @foreach($posts as $post)

        <a class="item" href="{{ url('') }}/post/{{ $post->slug }}">
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
                            <span>¥{{ $post->donate_money }}</span>
                            </div>
                        </div>
                        <div class="item-donate__item">
                            <div class="left">
                                募金<br>者数
                            </div>
                            <div class="right">
                                <span>{{ $post->donate_people }}人</span>
                            </div>
                        </div>
                    </div>
                </a> 
                @endforeach
            @endif
        </div>
        {{-- <div class="row center-xs">
            <div class="pagination">
                <ul>
                    <li class="active"><a href="">1</a></li>
                    <li><a href="">2</a></li>
                    <li><a href="">3</a></li>
                    <li><a href="">4</a></li>
                    <li><a href="">5</a></li>
                    <li class="more"><a href="">...</a></li>
                    <li><a href="">></a></li>
                </ul>
            </div>
        </div> --}}
    </div>
</section>
@include('shared.donate-banner')

@endsection
