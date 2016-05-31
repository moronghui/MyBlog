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

class CommentController extends Controller {

	/**
	 * 评论
	 *
	 */
	public function index()
	{
		//
		$user=User::find(Auth::id());
		//获取评论
		$comment=DB::table('comments as c')
		->leftJoin('users as u','c.user_id','=','u.id')
		->leftJoin('blogs as b','c.blog_id','=','b.id')
		->select('c.*','b.title','u.name','c.created_at')
		->where('blog_user_id','=',Auth::id())
		->orderBy('c.created_at','desc')
		->get();

		$data=[
			'user'=>$user,
			'comment'=>$comment,
		];
		return view('home.comment.index',$data);
	}

	/**
	 * 发评论
	 *
	 */
	public function deliver($id){

		$content=Input::get('comment');
		$blog_id=$id;
		$user_id=Auth::id();
		$blog_user_id=Blog::select('user_id')->where('id','=',$id)->get();
		$comment=new Comment;
		$comment->blog_id=$blog_id;
		$comment->user_id=$user_id;
		$comment->content=$content;
		$comment->blog_user_id=$blog_user_id[0]->user_id;
		$comment->save();
		//更新相关博文评论条数
		$blog=Blog::find($id);
		$num=$blog->comment_num;
		$blog->comment_num=$num+1;
		$blog->save();

		return redirect('/blog/blogMore/'.$id)->withInput();
	}

	/**
	 * 删除评论
	 *
	 */
	public function delete($id){

		$comment=Comment::find($id);
		$blog_id=$comment->blog_id;
		$comment->delete();

		$blog=Blog::find($blog_id);
		$blog->comment_num--;
		$blog->save();
		return redirect()->back()->withInput();

	}


}
