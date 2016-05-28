@extends('home/default');
@section('content')
<div class="content comWidth">
	<div class="c_left left">
		<!-- 分类 -->
		<div class="category">
			<div class="title">
				<span class="left">分类</span>
				<span class="right"><a href="#">[管理]</a></span>
			</div>
			@if(count($category)==0)
				<p style="margin-left:25px;">您还没添加分类！</p>
			@else
			<ul>
				<li><a href="#">全部博文</a>({{ count($blog)}})</li>
				@foreach($category as $cate)
					<li><a href="#">{{ $cate->name}}</a>({{ $cate->blog_num}})</li>
				@endforeach
			</ul>
			@endif
		</div>
	</div>
	<div class="c_right right">
		<div class="title">
			<span class="left">全部博文（{{ count($blog)}}）</span>
		</div>
		@if(count($blog)==0)
			<p style="margin-left:25px;">您还没发过博文！</p>
		@else
			@foreach($blog as $bg)
			<div class="blog_item">
				<div class="left"><a href="#" class="title">{{ $bg->title}}</a></div>
				<div class="right">
					<span>{{ $bg->created_at}}</span><a href="#">[编辑]</a><a href="#">[更改分类]</a><a href="#">[删除]</a>
				</div>
			</div>
		@endforeach
		@endif		
		
	</div>
</div>
@endsection