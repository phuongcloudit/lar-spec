<div class="report-item">
    <div class="report_thumb">
        <a href="{{ route('reports.detail',['slug'=> $report->slug]) }}"><img src="{{ $report->thumbnail }}" alt=""></a>
    </div>
    <div class="report_body">
        <div class="report_title">
            <a href="{{ route('reports.detail',['slug'=> $report->slug]) }}">{{ $report->title }}</a>
        </div>
        <div class="report_meta">
            <ul class="blog-meta">
                <li class="blog-date">{{ $report->date->format("Y 年 n 月 j 日")}}</li>
                <li>@if (empty($report->author)){{ $report->user->name }}@else{{ $report->author }}@endif</li>
            </ul>
        </div>
        <div class="report_type">
            <div class="report_type-inner">
                @if (!empty($report->project_category->name))
                <a href="{{ route('reports.project',['slug'=> $report->project_category->slug]) }}"
                    class="project-category">{{ $report->project_category->name }}</a>
                @endif
                @if (!empty($report->report_type->name))
                <a href="{{ route('reports.type',['slug'=> $report->report_type->slug]) }}"
                    class="type">{{ $report->report_type->name }}</a>
                @endif
            </div>
        </div>
        <div class="report_snippet">
          {!! substr(strip_tags($report->content), 0, 100) !!}...
        </div>
    </div>
</div>