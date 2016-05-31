@extends('home/default')
@section('content')
<center>
<div class="profile comWidth">
	<script src="{{ asset('org/uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('org/uploadify/uploadify.css')}}">
	<img src="<?php echo $user->face?asset('/uploads/'.$user->face) :asset('/uploads/default.jpg') ?>" />
	<input id="file_upload" name="file_upload" type="file" multiple="true">
	<!-- <script type="text/javascript">
		<?php $timestamp = time();?>
		$(function() {
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'_token'     : "{{ csrf_token() }}",
				},
				'buttonText' : '上传头像',
				'swf'      : "{{ asset('org/uploadify/uploadify.swf')}}",
				'uploader' : "{{ url('personal/upform')}}",
				onUploadSuccess : function(file, data, response) {

        			if (data.status==1) {
        				alert('上传成功');
        			}
        			else{
        				alert('上传失败，请重新上传，状态码为0');
        			}
        		}
			});
		});
	</script> -->
	<!-- <form id="frmFace" enctype="multipart/form-data" method="post" name="upform" action="{{ asset('/personal/upform') }}">  

		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<label class="face" id="face">头像:</lable>
		<input id="uploadify" class="uploadify" name="face" type="file" style=" border:none;">
		<input type="button" id="upload" value="上传"><br /><br />

	</form> -->


	<form class="" action="{{ asset('/personal/updata')}}" method="POST">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<table>
			<tr>
				<td class="label"><label for="username">昵称:</label></td>
				<td class="text"><input type="text"  name="username" required="required" value="{{ $user->name }}"></td>
			</tr>
			<tr>
				<td class="label"><label for="set">性别:</label></td>
				<td class="text">
					<input type="radio"  name="sex" required="required" <?php echo $user->sex=='男'?'checked':null; ?> value="男">男
					<input type="radio"  name="sex" required="required" <?php echo $user->sex=='女'?'checked':null; ?> value="女">女
				</td>
			</tr>
			<tr>
				<td class="label"><label for="word">签名:</label></td>
				<td class="text"><input type="text"  name="word" value="{{ $user->word }}"></td>
			</tr>
			<tr>
				<td class="label"><label for="word">新密码:</label></td>
				<td class="text"><input type="password"  name="password"></td>
			</tr>
			<tr align="center">
				<td  colspan="2"><input type='submit' value="确定修改"></td>
			</tr>
		</table>
	</form>
</div>
</center>
@endsection