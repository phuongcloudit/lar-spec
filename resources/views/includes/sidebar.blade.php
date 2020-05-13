<div class="sidebar">
    <div class="r-category r-div">
        <div class="r-category-title r-title">
            カテゴリーで選ぶ
        </div>
        <ul class="r-category-content r-content">
            @foreach ($reportCategories as $category)
            @if ($category->reports->count() > 0)
            <li><a href="{{ route('reports.project',['slug'=> $category->slug]) }}">{{ $category->name }}
                    ({{ $category->reports->count() }})</a></li>
            @endif
            @endforeach
            @foreach ($reportTypes as $type)
            @if ($type->reports->count() > 0)
            <li><a href="{{ route('reports.type',['slug'=> $type->slug]) }}">{{ $type->name }}
                    ({{ $type->reports->count() }})</a></li>
            @endif
            @endforeach
        </ul>
    </div>
    <div class="r-archive r-div">
        <div class="r-archive-title r-title">
            期間で選ぶ
        </div>
        <ul class="r-archive-content r-content">
            @foreach ($links as $link)
            <li>{{ $link->year }}({{ $link->report_count }})</li>
            @endforeach
        </ul>
    </div>
    <div class="r-search r-div">
        <div class="r-search-title r-title">
            キーワードで探す
        </div>
        <ul class="r-search-content r-content">
            {!! Form::open(['method' => 'GET', 'route'=>['reports.search']]) !!}
            {!! Form::text('q', Request::query('q'), array('required' => "",'placeholder' =>
            "キーワード")) !!}
            {!! Form::button('', ['class' => 'search-icon', 'type' => 'submit']) !!}
            {!! Form::close() !!}
        </ul>
    </div>
</div>