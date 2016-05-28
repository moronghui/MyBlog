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
class HomeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
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
		->select('c.*','u.name','c.created_at')
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
		return view('home.index',$data);
	}

	

	



}
