<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    protected $authorid;

    /**
     * 显示文章列表.
     *
     * @return Response
     */

    public function index()
    {

        $articles = Article::paginate(5);

        return view('article.index', [
            'articles' => $articles,
        ]);

    }

    /**
     * 创建新文章表单页面
     *
     * @return Response
     */
    public function create()
    {
        $postUrl = route('article.store');
        $article = new Article();
        return view('article.create', ['postUrl' => $postUrl, 'article' => $article]);
    }

    /**
     * 将新创建的文章存储到存储器
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $this->authorid = Session::get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ], [
            'required' => ':attribute 为必填项'
        ], [
            'title' => '标题',
            'content' => '内容',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $data = [
            'title' => $title,
            'content' => $content,
            'authorid' => $this->authorid,
            'viewcount' => 1
        ];

        if (Article::create($data)) {
            return redirect()->route('article.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * 显示指定文章
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $editUrl = route('article.edit', ['post' => $id]);
        $article = Article::find($id);

        return view('article.detail', ['editUrl' => $editUrl, 'article' => $article]);
    }

    /**
     * 显示编辑指定文章的表单页面
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $article = Article::find($id);


        $postUrl = route('article.update', ['post' => $id]);

        return view('article.update', ['article' => $article, 'postUrl' => $postUrl]);

    }

    /**
     * 在存储器中更新指定文章
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $title = $request->input('title');
        $content = $request->input('content');
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
        ], [
            'required' => ':attribute 为必填项'
        ], [
            'title' => '标题',
            'content' => '内容',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $article->title = $title;
        $article->content = $content;

        if ($article->save()) {
            return redirect()->route('article.show', ['post' => $id]);
        } else {
            return redirect()->back();
        }

    }

    /**
     * 从存储器中移除指定文章
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if ($article->delete()) {
            return redirect()->route('article.index')->with('success', '删除成功-' . $id);
        } else {
            return redirect()->route('article.index')->with('error', '删除失败-' . $id);
        }


    }

}
