<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\ArcCate;
use App\Models\Article;
use App\Models\Tag;
use App\Tools\Qiniu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['articles'] = Article::select('id','title','pic')->get();

        return view('admin.article.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = '文章添加';
        $this->appendData($data);
        //解析模板
        return view('admin.article.create', compact('data'));
    }

    /**
     * 追加一些公共数据
     *
     * @param $data
     */
    private function appendData(&$data)
    {
        //获取分类
        $data['cates'] = ArcCate::getCateByLevelForList();
        //获取七牛token
        $data['qiniu_token'] = Qiniu::getToken();
        //设置七牛仓库名
        $data['bucket'] = env('QINIU_BUCKET');
        //获取标签
        $data['tags'] = Tag::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request, \Parsedown $parsedown)
    {
        //创建模型对象
        $article = new Article;
        //插入数据
        $article -> title = $request->title;
        $article -> cate_id = $request->cate_id;
        $article -> pic = $request->pic;
        $article -> intro = $request->intro;
        $article -> markdown = $request->markdown;
        $article -> content = $parsedown->text($request->markdown);
        //将数据插入到文章表中
        if($article->save()) {
            //获取标签id
            $ids = $this->handleTag($request);
            if(!empty($ids)) {
                if($article->tags()->sync($ids)){
                    return redirect('/article')->with('msg','添加成功');
                }else{
                    return back()->with('/article','标签关联失败!');
                }
            }else{
                return redirect('/article')->with('msg','添加成功');
            }
        }else{
            return back()->with('msg','添加失败!');
        }
    }

    /**
     * 处理标签
     * eg: php_laravel_abc_  =>  ['php','laravel','abc]
     *
     * @param Request $request
     * @return array|string
     */
    protected function handleTag(Request $request)
    {
        return $request->tag_id ? explode('_', trim($request->tag_id,'_')) : '';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //获取文章模型
        $article = Article::findOrFail($id);

        //获取标签
        $tags = Tag::all();

        //获取分类
        $cates = ArcCate::all();

        //解析模板
        return view('home.blog.show', compact('article','tags','cates','request'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //读取当前文章内容
        $data['article'] = Article::findOrFail($id);
        $data['title'] = '更新文章';
        $this->appendData($data);
        //获取当前文章的标签
        $data['tag'] = $data['article']
            ->tags()
            ->select('id')
            ->get()
            ->map(function($item){
            return $item['id'];
        })->all();
        //解析模板
        return view('admin.article.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id,\Parsedown $parsedown)
    {
        $article = Article::findOrFail($id);

        $article -> title = $request->title;
        $article -> cate_id = $request->cate_id;
        $article -> pic = $request->pic;
        $article -> intro = $request->intro;
        $article -> markdown = $request->markdown;
        $article -> content = $parsedown->parse($request->markdown);
        //将数据插入到文章表中
        if($article->save()) {
            //获取标签id
            $ids = $this->handleTag($request);
            if(!empty($ids)) {
                if($article->tags()->sync($ids)){
                    return redirect('/article')->with('msg','更新成功');
                }else{
                    return back()->with('/article','标签关联失败!');
                }
            }else{
                return redirect('/article')->with('msg','更新成功');
            }
        }else{
            return back()->with('msg','更新失败!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        //删除图片
        $pics[] = $article->pic;
        //正则匹配获取图片路径
        preg_match_all('/\!\[.*\]\((.*)\)/isU', $article->markdown, $res);
        //如果文章中有图片
        if(!empty($res[0])) {
            $pics = array_merge($pics, array_map(function($v){
                return explode(' ', $v)[0];
            }, $res[1]));
        }
        //批量删除
        array_walk($pics, function($v){
            Qiniu::removeFile(basename($v));
        });

        if($article->delete()) {
            return rjson(1,'删除成功');
        }else{
            return rjson(0,'删除失败');
        }

    }

    /**
     * 博客列表
     *
     * @return int
     */
    public function list(Request $request)
    {
        //获取文章信息
        $blogs = Article::where(function($query)use($request){
            //判断分类id
            if(!empty($request->cate_id)) {
                $query->where('cate_id', $request->cate_id);
            }

            //判断关键字
            if(!empty($request->keywords)) {
                $query->where('title','like','%'.$request->keywords.'%');
            }

            //标签名
            if(!empty($request->tag)) {
                //读取标签信息
                $tag = Tag::where('name',$request->tag)->first();
                if($tag) {
                    //获取标签关联的博文的id
                    $blog_ids = DB::table('article_tag')->select('article_id')->where('tag_id', $tag->id)->get()->toArray();
                    $query->whereIn('id', array_map(function($v){return $v->article_id;}, $blog_ids));
                }
            }
        })->orderBy('id','desc')->paginate(5);

        //获取标签信息
        $tags = Tag::all();

        //读取分类信息
        $cates = ArcCate::all();

        return view('home.blog.list', compact('blogs','tags','request','cates'));
    }
}
