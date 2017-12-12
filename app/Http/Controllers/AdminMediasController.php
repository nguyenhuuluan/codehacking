<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Photo;

class AdminMediasController extends Controller
{
    //

    public function index(){

    	$photos = Photo::all();

    	return 	view('admin.media.index', compact('photos'));
    }

    public function create(){
    	return view('admin.media.create');
    }

    public function store(Request $request){


    	$file = $request->file('file');

    	$name = time().$file->getClientoriginalName();

    	$file->move('images', $name);

    	Photo::create(['file'=>$name]);

    }

    public function destroy($id){

    	$photo = Photo::findOrFail($id);

    	unlink(public_path().$photo->file);
    	$photo->delete();
    	return redirect('/admin/media');

    }

    public function deleteMedia(Request $request){
        //dd($request);

        if(isset($request->delete_single)){
            //unlink(public_path().$photo->file);
            $this->destroy($request->photo);        
            return redirect()->back();

        }elseif(isset($request->delete_all) && !empty($request->checkBoxArray))
        {
            $photos = Photo::findOrFail($request->checkBoxArray);
            foreach ($photos as $photo) {
                unlink(public_path().$photo->file);
                $photo->delete();
            }
            return redirect()->back();
        //return "it works";
        }







    }
}
