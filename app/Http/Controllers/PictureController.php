<?php

namespace App\Http\Controllers;

use App\Http\Requests\MoveToRequest;
use App\Http\Requests\PhotoRequest;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PictureController extends Controller
{
    public function index()
    {
        $albums=Album::latest()->where('user_id',Auth::id())->get();
//     $pictures=Picture::with('albums')->paginate(PAGINATE);
        $pictures = Picture::whereHas('albums', function ($query) {
            $query->where('user_id', Auth::id());
        })->paginate(PAGINATE);

        return view('pictures',compact(['pictures','albums']));
    }

    public function save(PhotoRequest $request)
    {
        try
        {
            if ($request->hasFile('path'))
            {
               foreach ($request->file('path') as $photo)
               {
                   $pathFile=uploadImage('picture',$photo);
                   Picture::create([
                       'name_photo'=>$request->name,
                       'Pathphoto'=>$pathFile,
                       'album_id'=>$request->album

                   ]);
               }
               return redirect()->route('index.picture')->with(['success'=>'Saved Pictures']);
            }
            return redirect()->route('index.picture')->with(['error'=>'Not Pictures']);

        }
        catch (\Exception $ex)
        {
            return redirect()->route('index.picture')->with(['error'=>'SomeThing Wrong Please try Again Later']);
        }
    }


    public function move($id)
    {
        try
        {
            $picture = Picture::find($id);

            if (!$picture){
                return redirect()->route('index.picture')->with(['error'=>'Picture Not Found']);
            }
            $albums=Album::selection()->where('user_id',Auth::id())
                ->where('id','!=',$picture->album_id)
                ->get();
            return view('moveAlbum',compact('picture','albums'));
        }
        catch (\Exception $ex){
           return redirect()->route('index.picture')->with(['error'=>'SomeThing Wrong Please try Again Later']);
//            return $ex;
        }
    }

    public function MoveTo(MoveToRequest $request ,$id )
    {
        try
        {
            $picture=Picture::find($id);
            if (!$picture)
            {
                return redirect()->route('index.picture')->with(['error'=>'Picture Not Fogfsdund']);
            }
            Picture::where('id',$id)->update([
                'album_id' => $request->album,
            ]);
            return redirect()->route('index.picture')->with(['success'=>'Move To Done']);
        }
        catch (\Exception $ex){
//            return redirect()->route('index.picture')->with(['error'=>'SomeThing Wrong Please try Again Later']);
return $ex;
        }
    }

}
