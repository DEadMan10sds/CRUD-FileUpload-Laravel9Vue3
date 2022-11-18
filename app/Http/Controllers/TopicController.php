<?php

namespace App\Http\Controllers;

use App\Models\topic;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class TopicController extends Controller
{
    public function index()
    {
        return Inertia::render('Topics/index', [
            'topics'=>topic::all()->map(function($topic) {
                return [
                    'id' => $topic->id,
                    'name' => $topic->name,
                    'image' => asset('storage/'.$topic->image)
                ];
            })
        ]);
    }

    public function create()
    {
        return Inertia::render('Topics/create');
    }


    public function store()
    {
        $file = Request::file('file')->store('topics', 'public');
        topic::create([
            'name'=> Request::input('name'),
            'image'=>$file,
        ]);

        return Redirect::route('topics.index');

    }


    public function edit(topic $topic)
    {
        //dd($topic);
        return Inertia::render('Topics/edit', [
            'topic'=> $topic,
            'file'=>asset('storage/'.$topic->image)
        ]);
    }

    public function update(topic $topic)
    {
        //dd(Request::all());
        $file = $topic->image;
        if(Request::file('file'))
        {
            Storage::delete('public/'.$topic->image);
            $file = Request::file('file')->store('topics', 'public');
        }


        $topic->update([
            'name'=> Request::input('name'),
            'image'=>$file
        ]);

        return Redirect::route("topics.index");

    }

    public function delete(topic $topic)
    {
        Storage::delete('public/'.$topic->image);
        $topic->delete();
        return Redirect::route("topics.index");
    }

}
