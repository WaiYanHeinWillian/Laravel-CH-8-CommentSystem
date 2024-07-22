<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    
    public function index() {
        // dd(request(['search']));
        return view('blogs.index',[
            // 'blogs'=>Blog::with('category','author')->get() //eager load // lazy loading

            // 'blogs'=>$this->getBlogs(),
            
            'blogs'=>Blog::latest()
                        ->filter(request(['search','category','username']))
                        ->paginate(6)
                        // ->simplePaginate()
                        ->withQueryString(),

            // 'categories'=>Category::all()
        ]);
    }

    public function show(Blog $blog){
       
        return view('blogs.show',[
            // 'blog'=>Blog::findOrFail($id)
            'blog'=>$blog,
            'randomBlogs'=>Blog::inRandomOrder()->take(3)->get()
        ]);
    }

    // protected function getBlogs(){
        // $blogs= Blog::latest();            
        // if(request('search')){
        //     $blogs=$blogs->where('title','LIKE',"%".request('search')."%")
        //                  ->orWhere('body','LIKE','%'.request('search').'%');
        // }

        // $query->when(request('search'),function($query,$search){
        //     $query->where('title','LIKE',"%".$search."%")
        //                  ->orWhere('body','LIKE','%'.$search.'%');
        // });
        // return $blogs->get();

//         return Blog::latest()->filter()->get();
//     }

        public function subscriptionHandler(Blog $blog)
        {
            if(User::find(auth()->id())->isSubscribed($blog))
            {
                $blog->unSubscribe();
            }else
            {
                $blog->subscribe();
            }
            return back();
        }

        

}
