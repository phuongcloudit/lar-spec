<?php 
$orderby = request()->input('orderby');
$url = \Request::url();
if(isset($projectCategory))
    $url = route('projects.category', $projectCategory->slug);
?>
<section>
    <div class="sorting">
        <div class="container">
            <div class="sort">
                <div class="category">
                    <label>カテゴリ</label>
                    <div class="select-category">
                        <div class="selecting">
                        	@if(isset($projectCategory))
                        		<img src="{{ $projectCategory->image }}" />  {{ $projectCategory->name }}
                        	@else
                            	<img src="http://spec.oisonvietnam.abc/assets/images/common/category-human.png">   ヒューマン
                            @endif
                        </div>
                        <div class="dropdown">
                            <ul>
                                @foreach($projectCategories as $projectCat)
                                <li >
                                    <a href="{{ route('projects.category', $projectCat->slug) }}"><img src="{{ $projectCat->image }}" />  {{ $projectCat->name }}</a>   
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ordering">
                    <img src="{{ asset('/assets/images/common/sort-icon.png') }}">
                    並べ替え
                    <ul>
                        <li class="{{ $orderby==''?'active':'' }}">
                            <a href="{{ $url }}">新着順</a>
                        </li>
                        <li class="{{ $orderby=='end_time'?'active':'' }}">
                            <a href="{{ $url }}?orderby=end_time">終了日が近い順</a>
                        </li>
                        <li class="{{ $orderby=='money'?'active':'' }}">
                            <a href="{{ $url }}?orderby=money">支援総額順</a>
                        </li>
                        <li class="{{ $orderby=='donated'?'active':'' }}">
                            <a href="{{ $url }}?orderby=donated">支援者数順</a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</section>
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.select-category').click(function(){
            $(this).children(".dropdown").slideToggle(200, function(){
                $(this).toggleClass('active');
            })
        })
    })
</script>
@endpush