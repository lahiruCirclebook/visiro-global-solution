@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Students</h2>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Add Student</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Courses</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    {{ implode(', ', $student->courses->pluck('name')->toArray()) }}
                </td>
                <td>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
