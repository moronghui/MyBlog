<?php namespace App\Http\Controllers\home;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;
use App\User;
use App\Category;
use App\Comment;
use App\Blog;
use Auth;
use DB;
use Input;
use Hash;
use Redirect;

class PersonalController extends Controller {

	/**
	 *个人中心
	 *
	 */
	public function index(Request $request)
	{
		//
		//获取用户详细信息
		$user=User::find(Auth::id());
		//获取分类
		//$category=Category::where('user_id','=',Auth::id())->get();
		$category=DB::table('categories as c')
		->select('c.*')
		->where('c.user_id','=',Auth::id())
		->get();
		//获取评论
		$comment=DB::table('comments as c')
		->leftJoin('users as u','c.user_id','=','u.id')
		->select('c.content','u.name','c.created_at')
		->where('blog_user_id','=',Auth::id())
		->take(5)
		->orderBy('c.created_at','desc')
		->get();
		//获取博文
		$blog=DB::table('blogs as b')
		->leftJoin('categories as c','b.category','=','c.id')
		->select('b.*','c.name')
		->where('b.user_id','=',Auth::id())
		->orderBy('b.created_at','desc')
		->get();
		//$blog=Blog::where('user_id','=',Auth::id())->get();
		$data=[
			'user'=>$user,
			'category'=>$category,
			'comment'=>$comment,
			'blog'=>$blog,
		];
		return view('home.personal.index',$data);
	}

	public function profile(){
		//获取用户详细信息
		$user=User::find(Auth::id());
		return view('home.personal.profile',['user'=>$user]);
	}

	/**
	 * 修改个人资料
	 *
	 * @return Response
	 */
	public function updata(Request $request)
	{
		//
		//获取用户详细信息
		$user=User::find(Auth::id());
		$name=Input::get('username');
		$word=Input::get('word');
		$sex=Input::get('sex');
		$password=Input::get('password');
		if ($password!=null) {
			$user->password=Hash::make($password);
		}
		$user->name=$name;
		$user->word=$word;
		$user->sex=$sex;
		$user->save();

		return view('home.personal.profile',['user'=>$user]);
	}

	/**
	 * 处理上传头像
	 *
	 * @return Response
	 */
	public function face(Request $request)
	{
		//
		$face=Input::file("face");
		if (is_file($face)) {

			$clientName = $face->getClientOriginalName();
			$realpath=$face->getRealPath();
			$mimeType=$face->getClientOriginalExtension();;
			$newName=md5(date('ymdhis').$clientName).'.'.$mimeType;
			$path = $face->move(rtrim(app_path(),'\app').'\public\uploads',$newName);
			$user=User::find(Auth::id());
			$user->face=$newName;
			$user->save();
		}
		return redirect('/personal/profile');
	}

	

	
}
