<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StudentApiController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->get();
        return response()->json($students, Response::HTTP_OK);
    }

    public function show($id)
    {
        $student = Student::with('courses')->find($id);
        if (!$student) {
            return response()->json(['error' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($student, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'courses' => 'required|array',
        ]);

        $student = Student::create($request->only(['name', 'email']));
        $student->courses()->attach($request->courses);

        return response()->json(['message' => 'Student created successfully', 'student' => $student], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['error' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:students,email,$id",
            'courses' => 'required|array',
        ]);

        $student->update($request->only(['name', 'email']));
        $student->courses()->sync($request->courses);

        return response()->json(['message' => 'Student updated successfully', 'student' => $student], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json(['error' => 'Student not found'], Response::HTTP_NOT_FOUND);
        }

        $student->delete();
        return response()->json(['message' => 'Student deleted successfully'], Response::HTTP_OK);
    }

    public function search(Request $request)
    {
        $query = Student::query();

        if ($request->has('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }
        if ($request->has('email')) {
            $query->where('email', 'LIKE', "%{$request->email}%");
        }

        return response()->json($query->with('courses')->get());
    }
}
