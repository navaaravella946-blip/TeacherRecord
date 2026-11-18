@extends('layouts.app')

@section('title', 'Edit teacher')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">TEACHER DIRECTORY</p>
            <h1>Edit teacher</h1>
            <p class="muted">Update {{ $teacher->name }}'s faculty record.</p>
        </div>
        <a class="button button-secondary" href="{{ route('teachers.index') }}">Back to directory</a>
    </div>

    <section class="panel form-panel">
        <div class="form-intro">
            <span class="form-icon" aria-hidden="true">✎</span>
            <div>
                <h2>Teacher details</h2>
                <p class="muted">Update the teacher's contact and subject information.</p>
            </div>
        </div>
        @include('teachers._form', ['teacher' => $teacher, 'buttonLabel' => 'Save changes'])
    </section>
@endsection
