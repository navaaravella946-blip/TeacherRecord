@extends('layouts.app')

@section('title', 'Add teacher')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">TEACHER DIRECTORY</p>
            <h1>Add a teacher</h1>
            <p class="muted">Create a new faculty record.</p>
        </div>
        <a class="button button-secondary" href="{{ route('teachers.index') }}">Back to directory</a>
    </div>

    <section class="panel form-panel">
        <div class="form-intro">
            <span class="form-icon" aria-hidden="true">✎</span>
            <div>
                <h2>Teacher details</h2>
                <p class="muted">Add the teacher's basic contact and subject information.</p>
            </div>
        </div>
        @include('teachers._form', ['teacher' => $teacher, 'buttonLabel' => 'Save teacher'])
    </section>
@endsection
