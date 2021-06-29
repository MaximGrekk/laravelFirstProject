<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use \App\Models\Post;
use \App\Models\Country;
use \App\Models\City;
use \App\Models\Rubric;
use \App\Models\Tag;
use \App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    public function index(Request $request,  $rubricId = 0)
    {
        // if (Cache::has('posts')) {
        //     $posts = Cache::get('posts');
        // } else {
        //     $posts = Post::orderBy('id', 'desc')->get();
        //     Cache::put('posts', $posts);
        // }

        $title = 'Home Page';

        $posts = Post::orderBy('id', 'desc');
        $rubrics = Rubric::get();
        if ($rubricId) { // если выбрана какая-то рубрика, то:
            $posts->where('rubric_id', $rubricId);
        }

        // return view('home', compact('title', 'posts', 'rubrics'));
        return view('home', [ // не работает
            'title' => $title,
            'posts' => $posts->paginate(4),
            'rubrics' => $rubrics,
            'rubricId' =>  $rubricId
        ]);
    }

    public function create()
    {
        $title = 'Create Post';
        $rubrics = Rubric::pluck('title', 'id')->all();
        return view('create', compact('title', 'rubrics'));
    }

    public function store(Request $request)
    {
        // dump($request->input('title'));
        // dump($request->input('content'));
        // dd($request->input('rubric_id'));
        // dd($request->all());
        // $this->validate($request, [
        //     'title' => 'required|min:5|max:100',
        //     'content' => 'required',
        //     'rubric_id' => 'required|integer',
        // ]);

        // First sposop
        $rules = [
            'title' => 'required|min:5|max:100',
            'content' => 'required',
            'rubric_id' => 'required|integer',
        ];
        $messages = [
            'title.required' => 'Заполните поле "Название"',
            'title.min' => 'Минимум 5 символов',
            'rubrick_id' => 'Выберите рубрику из списка',
        ];
        $validator = Validator::make($request->all(), $rules, $messages)->validate();
        // Second sposob -> resources/lang/en/validation.php to resources/lang/ru/validation.php 

        $request->session()->flash('success', 'Данные сохранены');

        // Post::query()->create($request->all());

        // first sposob to create a post in DB
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->rubric_id = $request->input('rubric_id');
        $post->user_id = Auth::user()->id;
        $post->save();

        // second sposob
        // Post::query()->create([
        //     'title' => 'Статья 4',
        //     'content' => 'Lorem ipsum 5'
        // ]);

        // third sposob
        // $post = new Post();
        // $post->fill([
        //     'title' => 'Статья 4',
        //     'content' => 'Lorem ipsum 5'
        // ]);
        // $post->save();

        return redirect()->route('home');
    }

    public function showPost($id)
    {
        $post = Post::where('id', '=', $id)->firstOrFail();
        $temp = $post->user_id;
        $author = User::query()->where('id', '=', $temp)->first();
        return View::make('posts.post')->with('post', $post)->with('author', $author);
    }
    public function updatePost($id)
    {
        $rubrics = Rubric::pluck('title', 'id')->all();
        $postOld = Post::find($id);
        $postOld->user_id;
        $post = new Post;
        $this->authorize('update', $postOld);
        return view('posts.update', ['post' => $post->find($id), 'rubrics' => $rubrics]);
    }
    public function updatePostCreate($id, Request $request)
    {
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->rubric_id = $request->input('rubric_id');
        // dump($post->user_id);
        $post->save();
        return redirect()->route('home');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);
        if ($post) {
            $post->delete();
        }
        return redirect()->route('home')->with('success', 'Статья удалена');
    }
}






































































// <?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use \App\Models\Post;
// use \App\Models\Country;
// use \App\Models\City;



// class HomeController extends Controller
// {
//     public function index()
//     {
        /*
        dump($_ENV['DB_DATABASE']);
        dump(env('MY_SETTING', 'defaultValue'));
        dump(config('app.timezone'));
        dump(config('database.connections.mysql.database'));
        dump($_ENV);
        return view('home', ['res' => 5, 'name' => 'John']);
        */

        // RAW REQESTS 

        /*
        DB::insert("INSERT INTO posts (title, content) VALUES (?, ?)", ['Статья 4', 'Lorem ipsum 4']);
        DB::update("UPDATE posts SET created_at = ?, updated_at = ? WHERE created_at IS NULL OR updated_at IS NULL", [NOW(), NOW()]);
        DB::delete("DELETE FROM posts WHERE id = ?", [4]);

        DB::beginTransaction();
        try {
            DB::update("UPDATE posts SET created_at = ? WHERE created_at IS NULL", [NOW()]);
            DB::update("UPDATE posts SET updated_at = ? WHERE updated_at IS NULL", [NOW()]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
        $posts = DB::select("SELECT * FROM posts WHERE id > :id", ['id' => 2]);
        return $posts;
        */

        // Query Builder

        /*
        $data = DB::table('country')->select('Code', 'Name')->limit(5)->get();
        $data = DB::table('country')->select('Code', 'Name')->first();
        $data = DB::table('country')->select('Code', 'Name')->orderBy('Code', 'desc')->first();
        $data = DB::table('city')->select('ID', 'Name')->find(2);
        $data = DB::table('city')->select('ID', 'Name')->where('id', '<', 5)->get();
        $data = DB::table('city')->select('ID', 'Name')->where([
            ['id', '>', 1],
            ['id', '<', 5]
        ])->get();
        $data = DB::table('city')->where('id', '<', 5)->value('Name');
        $data = DB::table('country')->limit(10)->pluck('Name', 'Code');
        $data = DB::table('country')->count();
        $data = DB::table('country')->avg('Population');
        $data = DB::table('country')->avg('Population');
        $data = DB::table('city')->select('CountryCode')->distinct()->get();
        $data = DB::table('city')->select(
            'city.ID',
            'city.Name as city_name',
            'country.Code',
            'country.Name as country_name'
        )
            ->limit(10)
            ->join('country', 'city.CountryCode', '=', 'country.Code')
            ->orderBy('city.ID')
            ->get();
        dump($data);
        */

        // ORM_1

        /*
        $post = new Post();
        $post->title = 'Статья 2';
        // $post->content = 'Lorem ipsum 1';
        $post->save();
        */

        // ORM_2


        // $data = Country::limit(10)->get();
        // $data = Country::query()->limit(10)->get();
        // $data = Country::query()->where('Code', '<', 'ALB')->select('Code', 'Name')->offset(1)->limit(2)->get();
        // $data = City::query()->find(5);
        // $data = Country::query()->find('AFG');
        // dump($data);

        // first sposob to create a post in DB
        // $post = new Post();
        // $post->title = 'Статья 3';
        // $post->content = 'Lorem ipsum 3';
        // $post->save();

        // second sposob
        // Post::query()->create([
        //     'title' => 'Статья 4',
        //     'content' => 'Lorem ipsum 5'
        // ]);

        // third sposob
        // $post = new Post();
        // $post->fill([
        //     'title' => 'Статья 4',
        //     'content' => 'Lorem ipsum 5'
        // ]);
        // $post->save();

        // Обновление элемента таблицы
        // $post = Post::find(5);
        // $post->title = 'Статья 5';
        // $post->save();

        //Меняем сразу несколько моделей
        // Post::where('id', '>', '3')->update([
        //     'updated_at' => NOW()
        // ]);

        // Удаление модели (delete/destroy)
        // 1
        // $post = Post::find(5);
        // $post->delete();
        // 2
        // Post::destroy(4);

        // $post = Post::query()->find(2);
        // dump($post->title, $post->rubric->title);
        // $rubric = Rubric::query()->find(3);
        // dump($rubric->title, $rubric->post->title);

        // $posts = Rubric::find(1)->posts()->select('title')->where('id', '>', '2')->get();
        // dump($posts);
        // $post = Post::query()->find(1);
        // dump($post->title, $post->rubric->title);


        // $posts = Post::query()->where('id', '>', '1')->get();
        // foreach ($posts as $post) {
        //     dump($post->title, $post->rubric->title);
        // }
        //жадная загрузка
        // $posts = Post::query()->with('rubric')->where('id', '>', '1')->get();
        // foreach ($posts as $post) {
        //     dump($post->title, $post->rubric->title);
        // }

        // $post = Post::query()->find(2);
        // dump($post->title);
        // foreach ($post->tags as $tag) {
        //     dump($tag->title);
        // }
        // $tag = Tag::query()->find(2);
        // dump($tag->title);
        // foreach ($tag->posts as $post) {
        //     dump($post->title);
        // }

        // dump($request->session()->all());
        // dump(session()->all());
        // $request->session()->put('test', 'Test value');
        // session(['cart' => [
        //     ['id' => 1, 'title' => 'Product 1'],
        //     ['id' => 2, 'title' => 'Product 2'],
        // ]]);
        // dump(session('cart')[0]['title']);
        // dump($request->session('cart')->get('cart')[0]['title']);
        // $request->session()->push('cart', ['id' => 3, 'title' => 'product 3']);
        // dump($request->session()->pull('test'));
        // $request->session()->forget('test');
        // $request->session()->flush();
        // $request->session()->flash('success', 'Данные сохранены');
        // Not working!
        // Cookie::queue('test2', 'Test Cookie', 5);
        // dump(Cookie::get('test'));
        // dump($request->cookie('test'));

        // Cache::put('key', 'Value', 60);
        // dump(Cache::get('key'));

        // Cache::put('key', 'Value', 300);
        // dump(Cache::pull('key'));
        // dump(Cache::get('key'));
        // Cache::flush();
        // Сохраняем посты в кэш, если они ещё не сохранены


//         return view('home', ['res' => 5, 'name' => 'John']);
//     }
//     public function test()
//     {
//         return __METHOD__;
//     }
// }
