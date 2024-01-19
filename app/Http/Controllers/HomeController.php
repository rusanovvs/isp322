<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Rubric;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request) 
    {
        session(['cart' => [
            ['id' => 1, 'title' => 'product 1'],
            ['id' => 2, 'title' => 'product 2'],
        ]]);

        dump($request->session()->get('cart')[0]['title']);
        
        $request->session()->push('cart', ['id' => 3, 'title' => 'product 3']);


        dump(session()->all());

        //Cookie::queue('test1', 'value');
        //dump(Cookie::get('test1'));
        //Cookie::queue(Cookie::forget('test1'));

        //Cache::put('key', 'value', 30);
        //dump(Cache::get('key'));



        

        if (Cache::has('posts')) {
            $posts = Cache::get('posts');
        } else {
            $posts = Post::orderBy('id', 'desc')->get();
            Cache::put('posts', $posts);
        }

        //Cache::forget('posts');
        //Cache::flush();

        $title = 'Home';
        return view('home', compact('title', 'posts'));
    }

    public function about() 
    {
        $title = 'About';
        return view('about', compact('title'));
    }


    public function create()
    {
        $title = 'NewPost';
        $rubrics = Rubric::pluck('title', 'id')->all();
        return view('posts.create', compact('title', 'rubrics'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required|min:5|max:100',
            'content' => 'required',
            'rubric_id' => 'required|integer',
        ],
        $messages = [
            'title.required' => 'Заполните поле title',
            'title.min:5' => 'Минимум 5 символов',
            'title.max:100' => 'Максимум 100 симоволов',
            'content.required'=> 'Заполните поле content',
            'rubric_id.integer'=> 'Должно быть числом',
            'rubric_id.required'=> 'Заполните поле rubric_id',
        ],
    );
        Post::create($request->all());
        return redirect()->route('home');




        // dump($request->input('title'));
        // dump($request->input('content'));
        // dump($request->input('rubric_id'));


        //dd($request->all());
    }


           // $post = Post::find(1);
        // dump($post->title);

        // foreach ($post->tags as $tag) {
        //     dump($tag->title);
        // }
        // $rubrics = Rubric::find(1);
        // return view('home', compact('rubrics'));

        // Свяжите созданную вами таблицу countries с таблицей cities отношением hasMany.
        // Получите все страны вместе с их городами.


        // dump($rubric->title);
        // dump($rubric->posts);

        // foreach ($rubric->posts as $rubrics)
        // {
        //     dump($rubrics->title);
        //     dump($rubrics->content);
        // }

        // $post = Post::find(1);
        // dump($post->title, $post->rubric->title);

        // $post = Post::find(1);
        //dump($post->title, $post->rubric->title);

        // $rubric = Rubric::find(1);
        //dump($rubric->title, $rubric->post->title);

        // return view('home', compact('post', 'rubric'));
        // $post = new Post();
        // $post->title = 'Статья 1';
        // $post->content = 'Контент 1';
        // $post->save();

        // $datas = Post::all();


        
        //$data = Post::limit(5)->get();
        //$data = Post::find('ABW');
        // $data = Post::where('Code', '>', 'ABW')->select('name')->get();
        
        //Post::create(['title' => 'постs 1', 'content' => 'Content 2']);     


        // $query = DB::insert("INSERT INTO posts (title, content, created_at, updated_at)
        // VALUES(?,?,?,?)", ['Пост 7', 'Content7', NOW(), NOW()]);

        // $query = DB::insert("INSERT INTO posts (title, content)
        // VALUES(?,?)", ['Пост 3', 'Content3']);

        // $posts = DB::select("SELECT * FROM posts");

        // DB::update("UPDATE posts SET created_at = ?, updated_at = ? WHERE
        // created_at IS NULL OR updated_at IS NULL", [NOW(), NOW()]);

        // DB::delete("DELETE FROM posts WHERE id = ?", [1]);
        // dump ($posts);

        //2 Query Builder

        // $datas = DB::table('posts')->get();
        // $data = DB::table('posts')->limit(1)->get();
        // $data = DB::table('posts')->select('title', 'content')->first();
        // $data = DB::table('posts')->select('title', 'content')->orderBy('id', 'desc')->first();
        // $data = DB::table('posts')->select('title', 'content')->find(3);
        // $data = DB::table('posts')->pluck('content');
        //  $data = DB::table('posts')->where('id', '<', '1')->get();
        //dump($data);

        // $data = DB::table('posts')->where([
        //     ['id', '>', '3'],
        //     ['id', '<', '6'],
        // ])->get();


}
