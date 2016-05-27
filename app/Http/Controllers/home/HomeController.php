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
		->leftJoin('blogs as b','c.id','=','b.category')
		->select('c.*','b.id as bid')
		->where('c.user_id','=',Auth::id())
		->get();
		//获取评论
		$comment=DB::table('comments as c')
		->leftJoin('users as u','c.user_id','=','u.id')
		->select('c.content','u.name','c.created_at')
		->where('blog_user_id','=',Auth::id())
		->take(10)
		->get();
		//获取博文
		$blog=DB::table('blogs as b')
		->leftJoin('categories as c','b.category','=','c.id')
		->leftJoin('comments as com','b.id','=','com.blog_id')
		->select('b.*','c.name','com.id as comid')
		->where('b.user_id','=',Auth::id())
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

	public function profile(){
		//获取用户详细信息
		$user=User::find(Auth::id());
		return view('home.profile',['user'=>$user]);
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

		return view('home.profile',['user'=>$user]);
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
		return redirect('/profile');
	}

	/**
	 * 博文目录
	 *
	 * @return Response
	 */
	public function lists()
	{
		//
		$user=User::find(Auth::id());
		$category=DB::table('categories as c')
		->leftJoin('blogs as b','c.id','=','b.category')
		->select('c.*','b.id as bid')
		->where('c.user_id','=',Auth::id())
		->get();
		$blog=DB::table('blogs as b')
		->leftJoin('categories as c','b.category','=','c.id')
		->leftJoin('comments as com','b.id','=','com.blog_id')
		->select('b.*','c.name','com.id as comid')
		->where('b.user_id','=',Auth::id())
		->get();
		$data=[
			'user'=>$user,
			'category'=>$category,
			'blog'=>$blog,
		];
		return view('home.lists',$data);
	}

	/**
	 * 发表博文页面
	 *
	 * 
	 */
	public function blog()
	{
		//
		$category=Category::where('user_id','=',Auth::id())->get();
		$user=User::find(Auth::id());
		$data=[
			'user'=>$user,
			'category'=>$category,
		];
		return view('home.blog',$data);
	}

	/**
	 * 发表博文
	 */
	public function deliverBlog(Request $request)
	{
		//
	/*	$this->validate($request,[
			'title'=>'required',
			'content'=>'required',
			]);*/
		$title=Input::get('title');
		$label=Input::get('label');
		$user_id=Auth::id();
		$category=Input::get('category');
		$content=Input::get('content');
		$blog=new Blog;
		$blog->title=$title;
		$blog->label=$label;
		$blog->content=$content;
		$blog->user_id=$user_id;
		$blog->category=$category;
		$blog->save();
		return redirect('/')->withInput();
	}

	/**
	 *个人中心
	 *
	 */
	public function personal(Request $request)
	{
		//
		//获取用户详细信息
		$user=User::find(Auth::id());
		//获取分类
		//$category=Category::where('user_id','=',Auth::id())->get();
		$category=DB::table('categories as c')
		->leftJoin('blogs as b','c.id','=','b.category')
		->select('c.*','b.id as bid')
		->where('c.user_id','=',Auth::id())
		->get();
		//获取评论
		$comment=DB::table('comments as c')
		->leftJoin('users as u','c.user_id','=','u.id')
		->select('c.content','u.name','c.created_at')
		->where('blog_user_id','=',Auth::id())
		->take(10)
		->get();
		//获取博文
		$blog=DB::table('blogs as b')
		->leftJoin('categories as c','b.category','=','c.id')
		->select('b.*','c.name')
		->where('b.user_id','=',Auth::id())
		->get();
		//$blog=Blog::where('user_id','=',Auth::id())->get();
		$data=[
			'user'=>$user,
			'category'=>$category,
			'comment'=>$comment,
			'blog'=>$blog,
		];
		return view('home.personal',$data);
	}

	/**
	 * 评论
	 *
	 */
	public function comment()
	{
		//
		$user=User::find(Auth::id());
		//获取评论
		$comment=DB::table('comments as c')
		->leftJoin('users as u','c.user_id','=','u.id')
		->select('c.content','u.name','c.created_at')
		->where('blog_user_id','=',Auth::id())
		->take(10)
		->get();
		$data=[
			'user'=>$user,
			'comment'=>$comment,
		];
		return view('home.comment',$data);
	}

	/**
	 * 分类管理
	 *
	 */
	public function category(){

		$user=User::find(Auth::id());
		//获取分类
		//$category=Category::where('user_id','=',Auth::id())->get();
		$category=DB::table('categories as c')
		->leftJoin('blogs as b','c.id','=','b.category')
		->select('c.*','b.id as bid')
		->where('c.user_id','=',Auth::id())
		->get();
		//获取博文
		$blog=DB::table('blogs as b')
		->leftJoin('categories as c','b.category','=','c.id')
		->select('b.*','c.name')
		->where('b.user_id','=',Auth::id())
		->get();
		$data=[
			'user'=>$user,
			'category'=>$category,
			'blog'=>$blog,
		];
		return view('home.category',$data);
	}

	/**
	 * 添加分类
	 *
	 */
	public function addCate(Request $request){

		$name=Input::get('category');
		$user_id=Auth::id();
		$category=new Category;
		$category->user_id=$user_id;
		$category->name=$name;
		$category->save();
		return redirect('/category')->withInput();
	}

	/**
	 * 删除分类
	 *
	 */
	public function deleteCate($id){

		$category=Category::find($id);
		$category->delete();
		return redirect('/category')->withInput();

	}

	/**
	 * 删除博文
	 *
	 */
	public function deleteBlog($id){
		$blog=Blog::find($id);
		$blog->delete();
		return redirect('/')->withInput();
	}

	/**
	 * 编辑博文页面
	 *
	 */
	public function editBlogIndex($id){
		
		$blog=Blog::find($id);
		$category=Category::where('user_id','=',Auth::id())->get();
		$user=User::find(Auth::id());
		$data=[
			'user'=>$user,
			'category'=>$category,
			'blog'=>$blog,
		];
		return view('home.editBlog',$data);
	}

	/**
	 * 编辑博文
	 *
	 */
	public function editBlog($id){
		
		$title=Input::get('title');
		$label=Input::get('label');
		$user_id=Auth::id();
		$category=Input::get('category');
		$content=Input::get('content');
		$blog=Blog::find($id);
		$blog->title=$title;
		$blog->label=$label;
		$blog->content=$content;
		$blog->user_id=$user_id;
		$blog->category=$category;
		$blog->save();
		return redirect('/')->withInput();
	}
	
	/**
	 * 查看博文正文页面
	 *
	 */
	public function blogMore($id){
		
		//获取博文
		$blog=DB::table('blogs as b')
		->leftJoin('categories as c','b.category','=','c.id')
		->leftJoin('comments as com','b.id','=','com.blog_id')
		->select('b.*','c.name','com.id as comid')
		->where('b.id','=',$id)
		->get();
		$user=User::find(Auth::id());
		$comment=DB::table('comments as c')
		->leftJoin('users as u','c.user_id','=','u.id')
		->select('c.content','u.name','c.created_at')
		->where('blog_user_id','=',Auth::id())
		->take(10)
		->get();
		$data=[
			'user'=>$user,
			'blog'=>$blog,
			'comment'=>$comment,
		];
		return view('home.blogMore',$data);
	}


}
