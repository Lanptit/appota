<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class Image extends Model
{
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'image',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public static function saveImage($request)
    {
    	$timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateString());
    	$images= $request->file('images');
    	foreach ($images as $file) {
    		$image = new Image;
    		$image->user_id = Auth::id();
    		$name = $timestamp.'-'.uniqid().'-'.$file->getClientOriginalName();
    		$image->image = $name;
    		$file->move(public_path().'/assets/image/'.$timestamp, $name);
    		$image->save();
    	}
    	return count($images);
    }
}
