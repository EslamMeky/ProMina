<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Http\Requests\PhotoRequest;
use App\Models\Album;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
   public function save(AlbumRequest $request)
   {
       try
       {
            if ($request->file('image'))
            {
                $path=uploadImage('album',$request->image);
                Album::create([
                    'name'=>$request->name,
                    'desc'=>$request->desc,
                    'image'=>$path,
                    'user_id'=>Auth::id(),
                ]);
                return redirect()->route('home')->with(['success'=>'Created Album']);
            }
            return redirect()->route('home')->with(['error'=>'Not found Image']);
       }
       catch (\Exception $ex)
       {
            return redirect()->route('home')->with(['error'=>'SomeThing Wrong Please try Again Later']);
       }
   }


   public function edit($id)
   {
       try
       {
           $album=Album::find($id);
           if (!$album){
               return redirect()->route('home')->with(['error'=>'Not Found This Album']);
           }
           return view('editAlbum',compact('album'));

       }
       catch (\Exception $ex)
       {
           return redirect()->route('home')->with(['error'=>'SomeThing Wrong Please try Again Later']);
       }
   }
   public function update(AlbumRequest $request,$id)
   {
       try
       {
           $album=Album::find($id);
           if (!$album){
               return redirect()->route('home')->with(['error'=>'Not Found This Album']);
           }
           Album::where('id',$id)->update([
               'name'=>$request->name,
               'desc'=>$request->desc,
               'user_id'=>Auth::id(),
           ]);
           if ($request->has('image'))
           {
               $path=uploadImage('album',$request->image);

               Album::where('id',$id)->update([
                   'image'=>$path,
               ]);
           }
           return redirect()->route('home')->with(['success'=>'updated Album']);
       }catch (\Exception $ex)
       {
           return redirect()->route('home')->with(['error'=>'SomeThing Wrong Please try Again Later']);

       }
   }


   public function deleteAll($id){
       try
       {
           $pictures=Picture::where('album_id',$id)->get();
           if ($pictures->isEmpty()){
               return redirect()->route('home')->with(['error'=>'Album Already Empty']);
           }
           foreach ($pictures as $picture) {
               $image=Str::after($picture->Pathphoto,'assets/');
               $image=public_path('assets/'.$image);
               if (File::exists($image)) {
                   File::delete($image);
               }
               else {
                   Log::warning('الصورة ' . $image . ' Not Found');
               }
               $picture->delete();
           }
           return redirect()->route('home')->with(['success'=>'Deleted All Picture From this Album']);
       }
       catch (\Exception $ex){
           return redirect()->route('home')->with(['error'=>'SomeThing Wrong Please try Again Later']);

       }
   }


   public function delete($id)
   {
       try
       {
          $album= Album::find($id);
          if (!$album){
              return redirect()->route('home')->with(['error'=>'Album Not Found']);
          }
           $image=Str::after($album->image,'assets/');
           $image=public_path('assets/'.$image);
           unlink($image);
           $album->delete();
           return redirect()->route('home')->with(['success'=>'Deleted Album']);
       }
       catch (\Exception $ex)
       {
//           return redirect()->route('home')->with(['error'=>'SomeThing Wrong Please try Again Later']);
return $ex;
       }
   }

}
