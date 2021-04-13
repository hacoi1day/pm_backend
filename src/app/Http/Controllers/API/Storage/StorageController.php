<?php

namespace App\Http\Controllers\API\Storage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Storage\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    public function getFile(Request $request)
    {
        $url = $request->input('url');
        $file = Storage::disk('public')->get($url);
        return response($file);
    }
    public function storeFile(StoreRequest $request)
    {
        $file = $request->file('file');
        $fileName = 'images/'.time().'_'.$file->getClientOriginalName();
        Storage::disk('public')->put($fileName, file_get_contents($file));

        return response()->json([
            'url' => 'storage/'.$fileName
        ], 200);
    }
}
