<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Get all students with their related courses
            $students = Student::with('courses')->get();
            return view('students.index', compact('students'));
        } catch (QueryException $e) {
            // Specific exception for database query failures
            return back()->with('error', 'Failed to load students due to a database issue. Please try again.');
        } catch (\Exception $e) {
            // General exception for all other errors
            return back()->with('error', 'An unexpected error occurred while loading students.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            // Get all courses for the dropdown
            $courses = Course::all();
            return view('students.create', compact('courses'));
        } catch (QueryException $e) {
            return back()->with('error', 'Failed to load courses due to a database issue.');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred while preparing the creation form.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:students',
                'courses' => 'required|array',
            ]);

            // Create a new student record
            $student = Student::create($request->only(['name', 'email']));

            // Attach selected courses to the student
            $student->courses()->attach($request->courses);

            return redirect()->route('students.index')->with('success', 'Student added successfully!');
        } catch (ValidationException $e) {
            // Handle validation errors (e.g. form validation failure)
            return back()->with('error', 'Validation failed. Please check your input.');
        } catch (QueryException $e) {
            // Handle database query exceptions
            return back()->with('error', 'Failed to add student due to a database issue.');
        } catch (\Exception $e) {
            // Catch any other exceptions
            return back()->with('error', 'An unexpected error occurred while adding the student.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            // Attempt to find the student by ID, or throw ModelNotFoundException
            $student = Student::findOrFail($id);
            return view('students.show', compact('student'));
        } catch (ModelNotFoundException $e) {
            // Handle case when student is not found
            return back()->with('error', 'Student not found.');
        } catch (\Exception $e) {
            // Handle any other general errors
            return back()->with('error', 'An error occurred while retrieving the student data.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            // Attempt to find the student by ID, or throw ModelNotFoundException
            $student = Student::findOrFail($id);
            $courses = Course::all(); // Get all courses
            return view('students.edit', compact('student', 'courses'));
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Student not found.');
        } catch (QueryException $e) {
            return back()->with('error', 'Failed to load courses or student data.');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred while preparing the edit form.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        try {
            // Validate the incoming request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => "required|email|unique:students,email,$student->id",
                'courses' => 'required|array',
            ]);

            // Update student details
            $student->update($request->only(['name', 'email']));

            // Sync the selected courses with the student (attach new, remove old)
            $student->courses()->sync($request->courses);

            return redirect()->route('students.index')->with('success', 'Student updated successfully!');
        } catch (ValidationException $e) {
            // Handle validation errors (e.g. form validation failure)
            return back()->with('error', 'Validation failed. Please check your input.');
        } catch (QueryException $e) {
            // Handle database-related issues
            return back()->with('error', 'Failed to update student due to a database issue.');
        } catch (\Exception $e) {
            // Catch any other exceptions
            return back()->with('error', 'An unexpected error occurred while updating the student.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        try {
            // Delete the student record
            $student->delete();

            return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
        } catch (QueryException $e) {
            return back()->with('error', 'Failed to delete student due to a database issue.');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred while deleting the student.');
        }
    }
}
