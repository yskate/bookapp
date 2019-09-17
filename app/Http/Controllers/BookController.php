<?php

namespace App\Http\Controllers;

use DB;
use \App\User;

use App\Book;
use App\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index','map']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        if($user){
            
            $books = Book::where('status', 'waiting')->where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
            $count = count($books);
        
            return view('books', [
                'books' => $books,
                'count' => $count
            ]);
        
        }else{
            
            return view('home');
        }
    }


    public function all(Request $request,$name)
    {
        $user = \Auth::user()->where('name',$name)->first();
        $books = Book::where('user_id', $user->id)->orderBy('created_at', 'asc')->get();
        
        $count = count($books);
        if($user){
            return view('all', [
                'books' => $books,
                'count' => $count,
                'name' => $name
            ]);
        }else{
            
            return view('login');
        }
    }

    public function friend()
    {
        $user = \Auth::user();
        $friends = Friend::join('users', function ($join) use ($user) {
            $join->on('users.id', '=', 'friends.friend_id')
                 ->where('friends.user_id', '=', $user->id)
                 ->orderBy('created_at', 'asc');
        })
        ->get();
        
        $count = count($friends);

        return view('friend', [
            'friends' => $friends,
            'count' => $count
        ]);
        return view('friend');

    }

    public function search(Request $request)
    {
            $user = \Auth::user();
            $word = $request->word;
            
            $followers = Friend::where('user_id', $user->id)->get();
            

        $friends = DB::table('books as b')
                ->join('users as u', 'u.id', '=', 'b.user_id')
                ->join('friends as f','f.user_id', '=', 'u.id')
                ->select('u.name')
                //->distinct()
                ->where('b.author', '=', $word)
                ->where('b.user_id', '<>', $user->id)
  //              ->where('f.friend_id', '<>', 'b.user_id')
  //              ->groupBy('u.name')
                ->orderBy('b.created_at', 'asc')
            ->get();
                        //->toSql();
            
            $count = count($friends);
        
            return view('search', [
                'friends' => $friends,
                'count' => $count,
                'word'=> $word
            ]);

    }


    public function map(Request $request)
    {
        $place = $request->place;
        if($place==''){$place='東京駅';}
        return view('map',['place'=> $place]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'author' => 'required|max:255',
                'translator' => 'max:255',
                'publisher' => 'required|max:255',
            ]);
    
            if($validator->fails()){
                return redirect('/')
                ->withInput()
                ->withErrors($validator);
            }
        

        
        $book = new Book;
        $user = \Auth::user();
        
        $book->title = $request->title;
        $book->author = $request->author;
        $book->translator = $request->translator ? $request->translator : "-" ;
        $book->publisher = $request->publisher;
        $book->status = "waiting";
        $book->user_id = $user->id;
        $book->save();
        
        return redirect('/');
    }
    
    
    public function complete(Request $request,$id,Book $book)
    {
        $book = Book::find($id);
        $book->status = "completed";
        $book->save();
        
        return redirect('/'); 

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('edit', ['book' => $book]);        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,Book $book)
    {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:255',
                'author' => 'required|max:255',
                'translator' => 'max:255',
                'publisher' => 'required|max:255',
                'status' => 'required',
            ]);
    
            if($validator->fails($id)){
                return redirect('/book/edit/'.$id)
                ->withInput()
                ->withErrors($validator);
            }
        
        $name = \Auth::user()->name;
        
        $book = Book::find($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->translator = $request->translator ? $request->translator : "-" ;
        $book->publisher = $request->publisher;
        $book->status = $request->status;
        $book->save();
        
        return redirect('book/all/'.$name);
    }

    public function follow($name)
    {
        
        $friend = new Friend;
        $new_friend = \Auth::user()->where('name',$name)->first();
        
        $user = \Auth::user();
        
        $friend->user_id = $user->id;
        $friend->friend_id = $new_friend->id;

        $friend->save();
        
        return redirect('/friend');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $name = \Auth::user()->name;
        $book = Book::find($id);
        $book->delete();

        return redirect('book/all/'.$name);

    }
    
    public function remove($id)
    {
        $user = \Auth::user();
        $friend = Friend::where('friend_id', $id)->where('user_id', $user->id)->first();
        $friend->delete();

        return redirect('/friend');
    }
    
    
}
