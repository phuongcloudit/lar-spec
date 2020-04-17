<div class="project">
    <a class="project-item" href="{{ route('project.detail',['slug'=> $project->slug]) }}">
        <div class="thumbnail" id="{{ isset($itemId)?$itemId:'project' }}-{{ $project->id }}">
            <div class="project-info">
                <div class="category"><span>{{ $project->project_category->name }}</span></div>
                <div class="title">
                    <h3>{{ $project->name }}</h3>
                </div>
            </div>
        </div>
        <div class="details">
            <div class="detail">
                <div class="th">募金<br />総額</div>
                <div class="td">¥{{$project->TotalDonatedFormat}}</div>
            </div>
            <div class="detail">
                <div class="th">募金<br />者数</div>
                <div class="td">{{$project->TotalDonatedNumber}}人</div>
            </div>
        </div>
    </a>
</div>
@if($project->thumbnail)
<style type="text/css">
    #{{ isset($itemId)?$itemId:'project' }}-{{ $project->id }}{
        background-image: url('{{$project->thumbnail}}');
    }
</style>
@endif