<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseApiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:courses']);

        $course = Course::create(['name' => $request->name]);

        return response()->json($course);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}
