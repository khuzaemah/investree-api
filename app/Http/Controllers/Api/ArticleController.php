<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Validator;

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
        return response()->json([
            "success" => true,
            "message" => "Article List",
            "data" => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
        ]);
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        $article = Article::create($input);
        return response()->json([
            "success" => true,
            "message" => "Article created successfully.",
            "data" => $article
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        if (is_null($article)) {
            return $this->sendError('Product not found');
        }

        return response()->json([
            "success" => true,
            "message" => "Article retrieved successfully.",
            "data" => $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
            'user_id' => 'required',
            'category_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $article->title = $input['title'];
        $article->content = $input['content'];
        $article->image = $input['image'];
        $article->user_id = $input['user_id'];
        $article->category_id = $input['category_id'];
        $article->save();
        
        return response()->json([
            "success" => true,
            "message" => "Article update successfully.",
            "data" => $article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            "success" => true,
            "message" => "Article deleted successfully.",
            "data" => $article
        ]);
    }
}
