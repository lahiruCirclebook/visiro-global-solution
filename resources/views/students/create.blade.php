@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Student</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Courses:</label>
            <select name="courses[]" id="courses" class="form-control" multiple required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" id="add-course" class="btn btn-success">Add Student</button>
    </form>
</div>
@endsection
