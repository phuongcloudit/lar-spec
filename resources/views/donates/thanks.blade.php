@extends('layouts.app')
@section('content')


<div class="detail-content">
    <div class="container">
        <div class=" detail-content__body">
           <h2>ご注文ありがとうございました。</h2>
           <p>
           	決済方法：{{	$donate->payment_name	}}<br><br>
			商品名: {{	$donate->item_name	}}<br>
			価格: {{	$donate->money	}}円<br><br>
			</p>
        </div>
    </div>
</div>
@endsection
