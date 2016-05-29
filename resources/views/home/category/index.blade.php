@extends('home/default')
@section('content')
<div class="cate_detail comWidth">
	<div class="title">
		<span class="left">分类</span>
	</div>
	<form method="post" action="/category/add">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="add">
			<input class="cate" type="text" name="category" placeholder="请输入分类名">
			<input type="submit" value="创建分类">
		</div>
	</form>
	@if(count($category)==0)
		<p style="margin-left:25px;">您还没添加分类！</p>
	@else
	<ul>
		<li><a href="#">全部博文</a>({{ count($blog)}})</li>
		@foreach($category as $cate)
			<li><a href="#">{{ $cate->name}}</a>({{ $cate->blog_num}})<a href="{{ asset('/category/delete')}}/{{ $cate->id}}" class="right" style="margin-right:150px;">删除</a></li>
		@endforeach
	</ul>
	@endif
</div>
@endsection
