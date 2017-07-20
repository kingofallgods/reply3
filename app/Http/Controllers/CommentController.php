<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/7/13
 * Time: 23:55
 */

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $userid;

    public function index()
    {
        $n = 5;
        $articles = DB::table('articles')->paginate($n);
        $i = ((isset($_GET['page']) ? $_GET['page'] : 1) - 1) * $n + 1;

        return view('comment.index', [
            'articles' => $articles, 'i' => $i
        ]);

    }

    public function create()
    {

    }

    public function store(Request $request){
        $userid = $request->input('userid');
        if (!isset($userid)){
            return redirect()->route('home');
        }
        $articleid = $request->input('articleid');
        $content = $request->input('content');
        $parent = $request->input('parent');
        $validator = Validator::make($request->all(), [
            'articleid' => 'required',
            'userid' => 'required',
            'content' => 'required|min:12',
        ], [
            'required' => ':attribute 为必填项',
            'min' => ':attribute 不得少于12个中文字符'
        ], [
            'articleid' => '文章id',
            'userid' => '用户id',
            'content' => '内容',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'content' => $content,
            'userid' => $userid,
            'articleid' => $articleid,
            'parent' => $parent
        ];
       Comment::create($data);
            return redirect()->back();


    }
    public function show($id){
        $this->userid=Auth::id();
        $article = DB::table('articles')->join('users',function($join){
            $join->on('users.id','=','articles.authorid');
        })->select('users.name', 'articles.title', 'articles.content', 'articles.created_at')->where('articles.id',$id)->get();

        $comment=DB::table ( 'comment' )->join('users',function($join){
            $join->on('users.id','=','comment.userid');
        })->select('users.name','comment.id', 'comment.content', 'comment.parent', 'comment.created_at')
            ->where('articleid','=',$id)->orderBy('id','desc')->get();
        $arr_comm=array();
        foreach ($comment as $key=>$comm){
            $arr_comm_son=array();
            $arr_comm_son['name']=$comm->name;
            $arr_comm_son['id']=$comm->id;
            $arr_comm_son['content']=$comm->content;
            $arr_comm_son['parent']=$comm->parent;
            $arr_comm_son['created_at']=$comm->created_at;
            $arr_comm[$key]=$arr_comm_son;
        }

        $comment = subtree($arr_comm,0,1);

        return view('comment.detail', [
            'article' => $article[0],'id'=>$id,'userid'=>$this->userid,'comment'=>$comment
        ]);
    }

}
function subtree($arr,$id=0,$lev=1) {
    $subs = array(); // 子孙数组
    foreach($arr as $v) {
        if($v['parent'] == $id) {
            $v['lev'] = $lev;
            $subs[] = $v; // 举例说找到array('id'=>1,'name'=>'安徽','parent'=>0),
            $subs = array_merge($subs,subtree($arr,$v['id'],$lev+1));
        }
    }
    return $subs;
}