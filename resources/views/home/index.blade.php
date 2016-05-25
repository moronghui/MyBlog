@extends('home/default')
@section('content')
<div class="content comWidth">
	<div class="c_left left">
		<!-- 个人资料 -->
		<div class="data">
			<div class="title">
				<span class="left">个人资料</span>
				<span class="right"><a href="#">[管理]</a></span>
			</div>
			<div class="img">
				<img src="{{ asset('/uploads/default.jpg')}}" alt="头像">
			</div>
			<div class="name">倾听</div>
		</div>
		<!-- 评论 -->
		<div class="comment">
			<div class="title">
				<span class="left">评论</span>
				<span class="right"><a href="#">[管理]</a></span>
			</div>
			<div class="item">
				<div class="user">
					<span class="left">新浪官博</span> 
					<span class="right">05-01 14:45</span>
				</div>
				<div class="c_content">
					<span class="left">恭喜你已开通...</span>
					<span class="right"><a href="#">[删除]</a></span> 
				</div>				
			</div>
			<div class="item">
				<div class="user">
					<span class="left">新浪官博</span> 
					<span class="right">05-01 14:45</span>
				</div>
				<div class="c_content">
					<span class="left">恭喜你已开通...</span>
					<span class="right"><a href="#">[删除]</a></span> 
				</div>				
			</div>
			<div class="more">
					<a href="#" class="right">更多>></a>
			</div>
		</div>
		<!-- 分类 -->
		<div class="category">
			<div class="title">
				<span class="left">评论</span>
				<span class="right"><a href="#">[管理]</a></span>
			</div>
			<ul>
				<li><a href="#">全部博文</a>(11)</li>
				<li><a href="#">PHP</a>(3)</li>
				<li><a href="#">android</a>(4)</li>
				<li><a href="#">laravel</a>(4)</li>
			</ul>
		</div>
	</div>
	<div class="c_right right">
		<div class="title">
			<span class="left">博文</span>
			<span class="right"><a href="#">[管理]</a></span>
		</div>
		<div class="item">
			<a href="#" class="title">数据库乱码</a><span>(2016-05-17 17:41)</span><a href="#">[管理]</a><a href="#">[删除]</a>
			<p>标签：<span class="lable">mysql</span> &nbsp;&nbsp;分类：<span class="cate">php</span></p>
			<article class="article">
				正文部分正文部分正文部分正文部分正文部分正文部分
				正文部分正文部分正文部分正文部分
			</article>
			<div class="flooter">
				<a href="#">评论</a><span class="num">(3)</span><a href="#" class="right">查看正文</a>
			</div>
		</div>
		<div class="item">
			<a href="#" class="title">数据库乱码</a><span>(2016-05-17 17:41)</span><a href="#">[管理]</a><a href="#">[删除]</a>
			<p>标签：<span class="lable">mysql</span> &nbsp;&nbsp;分类：<span class="cate">php</span></p>
			<article class="article">
				正文部分正文部分正文部分正文部分正文部分正文部分
				正文部分正文部分正文部分正文部分
			</article>
			<div class="flooter">
				<a href="#">评论</a><span class="num">(3)</span><a href="#" class="right">查看正文</a>
			</div>
		</div>
		<div class="item">
			<a href="#" class="title">数据库乱码</a><span>(2016-05-17 17:41)</span><a href="#">[管理]</a><a href="#">[删除]</a>
			<p>标签：<span class="lable">mysql</span> &nbsp;&nbsp;分类：<span class="cate">php</span></p>
			<article class="article">
				正文部分正文部分正文部分正文部分正文部分正文部分
				正文部分正文部分正文部分正文部分
			</article>
			<div class="flooter">
				<a href="#">评论</a><span class="num">(3)</span><a href="#" class="right">查看正文</a>
			</div>
		</div>
	</div>
</div>
@endsection