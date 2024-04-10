<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropZoneController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = Time() . '.' . $image->extension();
            $image->move(public_path('uploads'), $imageName);

            return response()->json([
                'success' => 'uploads/' . $imageName,
            ]);
        } else {
            return response()->json([
                'error' => 'No file uploaded.',
            ]);
        }
    }
}
