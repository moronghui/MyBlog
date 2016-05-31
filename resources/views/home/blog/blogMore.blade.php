@extends('home/default')
@section('content')
<div class="content comWidth">
	<div class="c_left left">
		<!-- 个人资料 -->
		<div class="data">
			<div class="title">
				<span class="left">个人资料</span>
				<span class="right"><a href="{{ asset('/profile')}}">[管理]</a></span>
			</div>
			<div class="img">
				<img src="<?php echo $user->face?asset('/uploads/'.$user->face) :asset('/uploads/default.jpg') ?>" alt="头像">
			</div>
			<div class="name">{{ $user->name}}</div>
		</div>
		<!-- 相关博文 -->
		<div class="comment">
			<div class="title">
				<span class="left">相关博文</span>
			</div>
			<div class="item">
				<div class="user">
					<span class="left username">蔡英文傻眼：北京一招彻底解决台湾</span> 
				</div>
				<div class="c_content">
					<span class="left">风的渡口1986</span>
				</div>					
			</div>
			<div class="item">
				<div class="user">
					<span class="left username">蔡英文傻眼：北京一招彻底解决台湾</span> 
				</div>
				<div class="c_content">
					<span class="left">风的渡口1986</span>
				</div>					
			</div>
			<div class="item">
				<div class="user">
					<span class="left username">蔡英文傻眼：北京一招彻底解决台湾</span> 
				</div>
				<div class="c_content">
					<span class="left">风的渡口1986</span>
				</div>					
			</div>
			<div class="more">
					<a href="#" class="right">更多>></a>
			</div>
		</div>
	</div>
	<div class="c_right right">
		<div class="title">
			<span class="left">正文</span>
		</div>
		<div class="item" style="border:none">
			<a href="#" class="title">{{ $blog[0]->title}}</a><span>({{ $blog[0]->created_at}})</span><a href="{{ asset('/edit')}}/{{ $blog[0]->id}}">[编辑]</a><a href="{{ asset('/delete')}}/{{ $blog[0]->id}}">[删除]</a>
			<p>标签：<span class="lable">{{ $blog[0]->label}}</span> &nbsp;&nbsp;分类：<span class="cate">{{ $blog[0]->name}}</span></p>
			<article class="article">
				{{ $blog[0]->content}}
			</article>
			<div class="flooter">
				<a href="#">评论</a><span class="num">({{ count($blog[0]->comid)}})</span>
			</div>
		</div> 
		<div class="comment_b">
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
						<a href="#" class="username">{{ $com->name}}</a>
						</div> 
					</div> 
					<p class="contents">{{ $com->content}}</p>
					<div class="left flooter">
							<span class="right"><a href="{{ asset('/comment/delete')}}/{{ $com->id}}" class="delete">[删除]</a></span>
							<span class="left">{{ $com->created_at}}</span>
					</div>
				</div>
			</div>
			@endforeach
						
			@endif
		</div>
		<!-- 发评论 -->
		<div class="deliverComment">
			<div class="title">
				<span>发评论</span>
			</div>
			<div class="content">
				<form action="{{ asset('/comment/deliver')}}/{{ $blog[0]->id}}" method="post">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<label>{{ $user->name}}:</label><br>
					<textarea required="required" name="comment" class="comment_t"></textarea><br>
					<input type="submit" value="发评论" class="comment_btn">
				</form>
			</div>
		</div>
	</div>
</div>
@endsection