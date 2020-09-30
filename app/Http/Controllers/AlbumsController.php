<?php

namespace App\Http\Controllers;

use App\Album;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        return view('albums.index')->with('albums', $user->albums);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function create()
    {
        return view('albums.create');

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
            'name' => 'required',
            'cover_img' => 'required|image|max:1999',
        ]);
        Album::create([
            'name' => $request->name,
            'cover_img' => $request->cover_img->store('AlbumCoverImages', 'public'),
            'user_id' => auth()->user()->id,
        ]);
        $directory = $request->name . 'Album';
        Storage::disk('public')->makeDirectory($directory);

        return redirect(route('albums.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album = Album::with('photos')->find($id);
        return view('albums.show')->with('album', $album);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return view('albums.edit')->with('album', $album);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        $this->validate($request, [
            'name' => 'required',
            'cover_img' => 'image|max:1999',
        ]);
        $oldDirName = $album->name . 'Album';
        $newDirName = $request->name . 'Album';
        if ($album->name != $request->name) {
            Storage::disk('public')->rename($oldDirName, $newDirName);

            $album->update([
                'name' => $request->name,
            ]);

        }

        //Updating photo
        if ($request->hasFile('cover_img')) {
            //delete old photo from storage
            Storage::disk('public')->delete($album->cover_img);
            //adding new photo
            $album->update([
                'cover_img' => $request->cover_img->store('AlbumCoverImages', 'public'),
            ]);

        }

        return redirect(route('albums.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //delete photo from storage
        Storage::disk('public')->delete($album->cover_img);
        $dir = $album->name . 'Album';
        Storage::disk('public')->deleteDirectory($dir);
        $album->delete();
        return redirect(route('albums.index'));
    }
}
