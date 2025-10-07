<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\MyStory;
use DB;
use \Carbon\Carbon;

class SharedStories extends Controller
{
    //
    public function getStories() {
        $data = MyStory::with('userDetails')->get();
        if(!$data) {
            return response()->json(['data' => []], 200);
        }
        return response()->json(['data' => $data], 200);
    }
    public function postStories(Request $request) {
        DB::connection('mysql')->beginTransaction();
        $validated_data = $request->validate([
            'image'             => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'title'             => 'required|string|max:200',
            'content'           => 'required|string|max:10000',
        ]);
        $imagePath = $request->file('image')->store('images', 'public');
        $data = [
            'User_Id'   => $request->userId,
            'Title'     => $validated_data['title'],
            'Story'     => $validated_data['content'],
            'Image_Url' => $imagePath,
            'created_at'    => Carbon::now(),
            'created_by'    => $request->userId,
        ];
        try {
            $create_story = MyStory::Create($data);
            if(!$create_story) {
                throw new Exception('Failed to Create Story');
            }
            DB::connection('mysql')->commit();
            return response()->json(['data' => $data], 200);
        } catch(\Exception $e) {
            DB::connection('mysql')->rollBack();
            return response()->json([
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    
    }
}
