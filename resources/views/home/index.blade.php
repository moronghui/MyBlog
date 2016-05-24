<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="博客">
<link rel="stylesheet" type="text/css" href="{{ asset('/home/css/main.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('/home/css/reset.css')}}">
<title>博客</title>

<body>
<div class="comWidth header">
	<div class="info">
		<img src="{{ asset('/uploads/default.jpg')}}" alt="头像">
		<p><a href="#">倾听的博客</a></p>
	</div>
	<div class="nav right" >
		<ul>
			<li><a href="#">首页</a></li>
			<li><a href="#">博文目录</a></li>
			<li><a href="#">发博文</a></li>
			<li><a href="#">个人中心</a></li>
		</ul>
	</div>
</div><!-- header结束 -->

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
		<div class="head">
			<span>博文</span>
			<span><a href="#">[管理]</a></span>
		</div>
		<div class="item">
			<h2>数据库乱码<span>(2016-05-17 17:41)</span><span>[管理]</span><span>[删除]</span></h2>
			<h3>标签：<span>mysql</span> &nbsp;&nbsp;分类：<span>php</span></h3>
			<article>
				正文部分正文部分正文部分正文部分正文部分正文部分
				正文部分正文部分正文部分正文部分
			</article>
			<div class="flooter">
				<a href="#">评论</a><span>(3)</span>&nbsp;<a href="#">查看正文</a>
			</div>
		</div>
	</div>
</div>
</body>
</html>