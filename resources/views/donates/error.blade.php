@extends('layouts.app')
@section('content')


<div class="detail-content">
    <div class="container">
        <div class="row detail-content__body">
            @if($errors->any())
                            <div class="errors">{{$errors->first()}}</div>
                            @endif
        </div>
    </div>
</div>
@endsection
