<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    //
    public function upload() {
        $this->validate(request(), [
            'file' => 'required|image|mimes:jpg,jpeg,png'
        ]);

        $file = request()->file('file');
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $size = $file->getSize();
        $mime = $file->getMimeType();
        $newName = auth()->user()->id . '_image_' . time() . '.' . $extension;
        $file->move(public_path('uploads'), $newName);

        return back();
    }

    public function upload_multiple() {
        $this->validate(request(), [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif',
            'files.*' => 'required|image|mimes:jpg,jpeg,png,gif',
        ]);
        $files = request()->file('files');
        $i = 0;
        foreach ($files as $file) {
            # code...
            $name = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mime = $file->getMimeType();
            $newName = auth()->user()->id . '_image_' . $i++ . '_' . time() . '.' . $extension;
            $file->move(public_path('uploads'), $newName);   
        }
        return back();
    }
}
