<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Autor;
use App\Models\Subject;
use App\Models\Document;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreArticleRequest;
use App\Queries\AutorsDatatable;
use DataTables;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();


        return view('articles.articles')->with([
            'articles' => $articles,
        ]);
    }

    public function adminIndex()
    {
        $articles = Article::all();

        return view('articles.adminArticles')->with([
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $autors = Autor::all();
        $subjects = Subject::all();
        if ($request->ajax()) {

            return DataTables::of((new AutorsDatatable())->get($request->temporal_identifier))->make(true);
        } else {
            $identifier = rand();
            return view('articles.create')->with([
                'autors' => $autors,
                'subjects' => $subjects,
                'identifier' => $identifier,
            ]);
        }
    }

    public function storeAutor(Request $request)
    {
        DB::beginTransaction();
        try {
            $autor = new Autor();
            $autor->name = $request->name;
            $autor->email = $request->email;
            $autor->mebership = $request->membership;
            $autor->temporal_identifier = $request->temporal_identifier;
            $autor->is_contact = 0;
            $autor->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
        return "Creado correctamente";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $article = new Article();
            $article->title =  $request->title;
            if($article->save()){
                $temporal_identifier = $request->temporal_identifier;
                $autors = Autor::where('temporal_identifier', $temporal_identifier)->get();
                
                foreach ($autors as $autor) {
                    $article->autors()->attach($autor);
                }
    
                //Asociaremos todos los temas con el articulo segun el arreglo
                #$subjects = $request->subjects;
                foreach ($request->subjects as $subject_id) {
                    $subject = Subject::where('id', $subject_id)->get();
                    $article->subjects()->attach($subject);
                }
    
            }
            $article->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
        return 'Success';
    }

    public function attachArticle(Request $request){   
             
        DB::beginTransaction();
        try{
            $document = new Document();
            if ($files = $request->file('file')) {       
                //store file into document folder
                try{
                    $name = $request->file->getClientOriginalName();
                    $file = $request->file->move(storage_path('app/public'),$name);
                    $document->name = $name;
                    $document->save();
                
                }catch(\Exception $e){
                    return $e;
                }
                
            }
            
        }catch(\Exception $e){
            return $e;
        }
        return 'Articulo Subido Correctamente';
    }

    public function assignArticle(Article $article){
        return view('articles.assign')->with([
            'article' => $article,
        ]);
    }

    public function attachUserArticle(Request $request){
        DB::beginTransaction();
        try{
            $user = User::find($request->user);
            $article = Article::find($request->article);
            $article->users()->attach($user);
            DB::commit();
        }catch(\Exception $e){
            return $e;
        }
        return 'Se asigno correctamente el articulo';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */

    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
