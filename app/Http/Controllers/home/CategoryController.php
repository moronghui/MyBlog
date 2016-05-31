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

class CategoryController extends Controller {

	/**
	 * 分类管理
	 *
	 */
	public function index(){

		$user=User::find(Auth::id());
		//获取分类
		//$category=Category::where('user_id','=',Auth::id())->get();
		$category=DB::table('categories as c')
		->select('c.*')
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
		return view('home.category.index',$data);
	}

	/**
	 * 添加分类
	 *
	 */
	public function add(Request $request){

		$name=Input::get('category');
		$user_id=Auth::id();
		$category=new Category;
		$category->user_id=$user_id;
		$category->name=$name;
		$category->save();
		return redirect('/category/index')->withInput();
	}

	/**
	 * 删除分类
	 *
	 */
	public function delete($id){

		$category=Category::find($id);
		$category->delete();
		return redirect()->back()->withInput();

	}
}
