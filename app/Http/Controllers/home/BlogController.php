<?php namespace App\Http\Controllers\home;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Blog;
use App\Category;
use Input;
use App\Comment;
use Auth;

class BlogController extends Controller {

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
		->select('c.*')
		->where('c.user_id','=',Auth::id())
		->get();
		$blog=DB::table('blogs as b')
		->leftJoin('categories as c','b.category','=','c.id')
		->select('b.*','c.name')
		->where('b.user_id','=',Auth::id())
		->orderBy('b.created_at','desc')
		->get();
		$data=[
			'user'=>$user,
			'category'=>$category,
			'blog'=>$blog,
		];
		return view('home.blog.lists',$data);
	}

	/**
	 * 发表博文页面
	 *
	 * 
	 */
	public function index()
	{
		//
		$category=Category::where('user_id','=',Auth::id())->get();
		$user=User::find(Auth::id());
		$data=[
			'user'=>$user,
			'category'=>$category,
		];
		return view('home.blog.index',$data);
	}

	/**
	 * 发表博文
	 */
	public function deliver(Request $request)
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
		$cate=Category::find($category);
		$cate->blog_num++;
		$cate->save();
		return redirect('/')->withInput();
	}

	/**
	 * 删除博文
	 *
	 */
	public function delete($id){
		$blog=Blog::find($id);
		$blog_cate=$blog->category;
		//修改相关分类总数
		$cate=Category::find($blog_cate);
		$cate->blog_num--;
		$cate->save();
		//删除相关评论
		$comment=Comment::where('blog_id','=',$blog->id)->delete();
		$blog->delete();
		return redirect('/')->withInput();
	}

	/**
	 * 编辑博文页面
	 *
	 */
	public function editIndex($id){
		
		$blog=Blog::find($id);
		$category=Category::where('user_id','=',Auth::id())->get();
		$user=User::find(Auth::id());
		$data=[
			'user'=>$user,
			'category'=>$category,
			'blog'=>$blog,
		];
		return view('home.blog.editBlog',$data);
	}

	/**
	 * 编辑博文
	 *
	 */
	public function edit($id){
		
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
		->select('c.*','u.name','c.created_at')
		->where('blog_id','=',$id)
		->take(10)
		->orderBy('c.created_at','desc')
		->get();
		$data=[
			'user'=>$user,
			'blog'=>$blog,
			'comment'=>$comment,
		];
		return view('home.blog.blogMore',$data);
	}

}
