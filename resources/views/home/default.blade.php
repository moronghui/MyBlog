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
		<img src="<?php echo $user->face?asset('/uploads/'.$user->face) :asset('/uploads/default.jpg') ?>" alt="头像">
		<p><a href="{{ asset('/')}}">{{ $user->name}}的博客</a></p>
	</div>
	<div class="nav right" >
		<ul>
			<li><a href="{{ asset('/')}}">首页</a></li>
			<li><a href="{{ asset('/blog/lists')}}">博文目录</a></li>
			<li><a href="{{ asset('/blog/index')}}">发博文</a></li>
			<li><a href="{{ asset('/personal/index')}}">个人中心</a></li>
		</ul>
	</div>
</div><!-- header结束 -->
	@yield('content');
</body>
</html>