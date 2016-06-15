<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ImageRequest;
use Auth;
use App\Image;
use Carbon\Carbon;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images  = Image::where('user_id', Auth::id())->paginate(5);
        return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageRequest $request)
    {
        $totalImages = Image::saveImage($request);
        return redirect()->route('image.index')->with('status', $totalImages.' images saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        if(!is_null($image))
        {
            if($image->user->id == Auth::id())
            {
                $image->delete();
                unlink(public_path().'/assets/image/'.substr($image->image, 0, 10).'/'.$image->image);
                return redirect()->route('image.index')->with('status', 'Image deleted!');
            } else {
                return redirect()->route('image.index')->with('status', 'You do not have access');
            }
        } else {
            return redirect()->route('image.index')->with('status', 'Image does not exist');
        }
    }
}
