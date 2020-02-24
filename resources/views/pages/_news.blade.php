<div class="container">
    <div class="row">
        <h2 class="title">
            NEWS<span>【ニュース】<br>新着情報</span>
        </h2>
    </div>
    <div class="row center-xs">
        <div class="content">
            @foreach ($news as $item)
            <div class="news-item row">
                <div class="news-item__time col-sm-2 col-xs-12">
                    {{ $item->date_time }}
                </div>
                <div class="news-item__content-out col-sm-10 col-xs-12">
                    <div class="row middle-xs">
                        <span class="news-type col-sm-2">
                            {{ $item->news_type }}
                        </span>
                        <div class="news-item__content-in col-sm-10">
                            {{ $item->news_content }}
                        </div>
                    </div>
                </div>
            </div>
            
            @endforeach
        </div>
        
         
    </div>
</div>