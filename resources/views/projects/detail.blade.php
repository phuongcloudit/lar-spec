@extends('layouts.app')
@section('content')
<section class="section">
    <div class="container">
        <h2 class="heading">
            募金プロジェクト
            <p>【新規募金プロジェクト】<br />新着のプロジェクト</p>
        </h2>
        <div class="projects colums-3">
                @include("projects.loop-project")
        </div>
    </div>
</section>
@stop