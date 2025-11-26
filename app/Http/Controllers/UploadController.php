<?php

namespace App\Http\Controllers;
use App\Models\Upload;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('file')->store('uploads', 'public');

        Upload::create([
            'filename' => $request->file('file')->getClientOriginalName(),
            'filepath' => $path,
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'File berhasil diupload!.');
    }

    public function destroy(Upload $upload)
    {
        if ($upload->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak berhak menghapus file ini.');
        }

        \Storage::delete('public/' . $upload->filepath);
        $upload->delete();

        return back()->with('success', 'File berhasil dihapus!.');
    }
}
