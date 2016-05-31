@extends('home/default')
@section('content')
<div class="blog comWidth">
	<div class="head">
		<span class="left">发博文</span>
	</div>
	<form action="{{ asset('/blog/deliver')}}" method="POST" class="form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<label for="title" class="title_l">标题：</label>
		<input type="text" name="title" class="title" id="title" required="required" /><br><br>
		<label for="cate" class="cate_l">分类：</label>
		<select class="cate" name="category" id="cate">
			<option>选择分类</option>
			@if(count($category)>0)
				@foreach($category as $cate)
					<option value="{{ $cate->id}}">{{ $cate->name}}</option>
				@endforeach
			@endif		
		</select><br><br>
		<label for="label">标签：</label>
		<input type="text" name="label" class="label" id="label" />
		<textarea name="content" class="content" required="required"></textarea><br>
		<div class="div"><input type="submit" value="发表" class="submit"></div>

	</form>
</div>
@endsection