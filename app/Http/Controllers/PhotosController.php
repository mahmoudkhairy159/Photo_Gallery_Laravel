<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Album;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotosController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($album_id)
    {
        return view('photos.create')->with('album_id',$album_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'photo' => 'required|image|max:1999',
        ]);
        $album=Album::find($request->album_id);
        Photo::create([
            'title' => $request->title,
            'photo' => $request->photo->store($album->name.'Album','public'),
            'album_id'=>$request->album_id
        ]);
        return redirect(route('albums.show',$request->album_id));

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
    public function edit(Photo $photo)
    {
        return view('photos.edit')->with('photo',$photo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        $this->validate($request, [
            'title' => 'required',
            'photo' => 'image|max:1999',
        ]);

        $photo->update([
            'title' => $request->title,
            'album_id'=>$request->album_id
        ]);

        //Updating photo
        if($request->hasFile('photo')){
            //delete old photo from storage
            Storage::disk('public')->delete($photo->photo);
            //adding new photo
            $photo->update([
                'photo' => $request->photo->store($photo->album->name.'Album','public'),
            ]);

        }

        return redirect(route('albums.show',$request->album_id));

    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $photo=Photo::withTrashed()->where('id', $id)->first();
        if ($photo->trashed()) {
            //delete photo from storage
            Storage::disk('public')->delete($photo->photo);
            $album_id=$photo->album_id;
            $photo->forceDelete();
            return redirect(route('trashedPhotos.index', $album_id));
        } else {
            $album_id=$photo->album_id;
            $photo->delete();
            return redirect(route('albums.show', $album_id));
        }
    }

        public function trashed ($album_id)
        {
            $album=Album::find($album_id);
            $album->photos= Photo::onlyTrashed()->where('album_id',$album_id)->get();
            return view('albums.show')->with('album', $album);

        }


        public function restore ($id){
            $photo=Photo::onlyTrashed()->where('id',$id)->first();
            $photo->restore();
            return redirect(route('trashedPhotos.index',$photo->album_id));

        }




    }

