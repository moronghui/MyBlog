@extends('home/default')
@section('content')
<div class="blog comWidth">
	<div class="head">
		<span class="left">发博文</span>
	</div>
	<form action="{{ asset('/blog/edit')}}/{{ $blog->id}}" method="POST" class="form">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<label for="title" class="title_l">标题：</label>
		<input type="text" name="title" class="title" id="title" required="required" value="<?php if(isset($blog)) echo $blog->title; ?>" /><br><br>
		<label for="cate" class="cate_l">分类：</label>
		<select class="cate" name="category" id="cate">
			<option>选择分类</option>
			@if(count($category)>0)
				@foreach($category as $cate)
					<option value="{{ $cate->id}}" <?php if(isset($blog)) echo $cate->id==$blog->category?"selected='selected'":null; ?> >{{ $cate->name}}</option>
				@endforeach
			@endif		
		</select><br><br>
		<label for="label">标签：</label>
		<input type="text" name="label" class="label" id="label" value="<?php if(isset($blog)) echo $blog->label; ?>" />
		<textarea name="content" class="content" required="required"><?php if(isset($blog)) echo $blog->content; ?></textarea><br>
		<div class="div"><input type="submit" value="修改" class="submit"></div>

	</form>
</div>
@endsection