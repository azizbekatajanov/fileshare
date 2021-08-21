<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index(Request $request){
        if ($request->isMethod('POST')){
            $request->validate([
               'file'=>'required|file'
            ]);
            $path = $request->file('file');
            $path = $path->storeAs('files', uniqid() . '.' .$path->extension());
            $file = File::create([
               'path'=>$path,
                'uniqid'=>uniqid(),
                'deleted_at'=>Carbon::now()->addMinutes(5)
            ]);
            return redirect(route('mainpage'))->with([
                'uniqid'=>$file->uniqid
            ]);
        }

        return view('main');
    }

    public function download($uniqid)
    {
        /**
         * @var File $file
         */
        $file=File::query()->where(['uniqid'=>$uniqid])->first();
        if ($file===null){
            abort(404);
        }

        if ($file->deleted_at->isBefore(Carbon::now())) {
            Storage::disk('local')->delete($file->path);
            $file->delete();
            abort(404);
        }


        return Storage::download($file->path);

    }
}
