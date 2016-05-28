@extends('home/default')
@section('content')
<div class="comment_detail comWidth">
	<div class="title">
		<span>评论</span>
	</div>
	@if(count($comment)==0)
		<p style="margin-left:25px;">暂时没有评论！</p>
	@else
		@foreach($comment as $com)
			<div class="c_item">
				<div class="left face">
					<img src="<?php echo $user->face?asset('/uploads/'.$user->face) :asset('/uploads/default.jpg') ?>"" alt="头像" width="50px" height="50px">
				</div>	
				<div class="left item_r">
					<div class="user">
						<div class="left">
						<a href="#" class="username">{{ $com->name}}</a>对您的博文发表了评论
						</div> 
						<div class="right">
							<span class="right"><a href="{{ asset('/comment/delete')}}/{{ $com->id}}" class="delete">[删除]</a></span>
							<span class="right">{{ $com->created_at}}</span>
						</div>
					</div> 
					<p class="contents">{{ $com->content}}</p>
					<p>来自<a href="#" class="which">《{{ $com->title}}》</a></p>
				</div>
			</div>
		@endforeach
				
	@endif
</div>
@endsection