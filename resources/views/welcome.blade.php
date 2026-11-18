@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">OVERVIEW</p>
            <h1>Teacher directory</h1>
            <p class="muted">Keep your faculty information organized in one place.</p>
        </div>
        <a class="button button-primary" href="{{ route('teachers.create') }}">
            <span aria-hidden="true">+</span> Add teacher
        </a>
    </div>

    @if (session('success'))
        <div class="notice" role="status">{{ session('success') }}</div>
    @endif

    <section class="stats-grid" aria-label="Teacher summary">
        <article class="stat-card">
            <span class="stat-icon stat-icon-purple" aria-hidden="true">T</span>
            <div>
                <p class="stat-label">Total teachers</p>
                <p class="stat-value">{{ $teacherCount }}</p>
            </div>
        </article>
        <article class="stat-card">
            <span class="stat-icon stat-icon-green" aria-hidden="true">✓</span>
            <div>
                <p class="stat-label">Active teachers</p>
                <p class="stat-value">{{ $activeTeacherCount }}</p>
            </div>
        </article>
        <article class="stat-card">
            <span class="stat-icon stat-icon-blue" aria-hidden="true">B</span>
            <div>
                <p class="stat-label">Subjects taught</p>
                <p class="stat-value">{{ $subjectCount }}</p>
            </div>
        </article>
    </section>

    <section class="panel">
        <div class="panel-heading">
            <div>
                <h2>All teachers</h2>
                <p class="muted">A directory of the people who make learning happen.</p>
            </div>
            <form class="search-form" action="{{ route('teachers.index') }}" method="GET" role="search">
                <label class="sr-only" for="teacher-search">Search teachers</label>
                <span class="search-icon" aria-hidden="true">⌕</span>
                <input id="teacher-search" type="search" name="search" value="{{ $search }}"
                    placeholder="Search teachers..." autocomplete="off">
                @if ($search !== '')
                    <a class="clear-search" href="{{ route('teachers.index') }}">Clear</a>
                @endif
            </form>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Teacher</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Status</th>
                        <th scope="col"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($teachers as $teacher)
                        <tr>
                            <td>
                                <div class="teacher-cell">
                                    <span class="avatar" aria-hidden="true">{{ strtoupper(substr($teacher->name, 0, 1)) }}</span>
                                    <div>
                                        <span class="teacher-name">{{ $teacher->name }}</span>
                                        <span class="teacher-meta">Added {{ $teacher->created_at->format('M j, Y') }}</span>
                                    </div>
                                </div>
                            </td>
                            <td><span class="subject-tag">{{ $teacher->subject }}</span></td>
                            <td>
                                <span class="contact-main">{{ $teacher->email ?: 'No email added' }}</span>
                                @if ($teacher->phone)
                                    <span class="teacher-meta">{{ $teacher->phone }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="status status-{{ $teacher->status }}">
                                    <span class="status-dot" aria-hidden="true"></span>
                                    {{ ucfirst($teacher->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="row-actions">
                                    <a class="text-action" href="{{ route('teachers.edit', $teacher) }}">Edit</a>
                                    <form action="{{ route('teachers.destroy', $teacher) }}" method="POST"
                                        onsubmit="return confirm('Delete this teacher record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-action text-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <span class="empty-icon" aria-hidden="true">✦</span>
                                    <h3>{{ $search !== '' ? 'No teachers found' : 'Your directory is ready' }}</h3>
                                    <p class="muted">
                                        {{ $search !== '' ? 'Try another name, email, or subject.' : 'Add your first teacher to get started.' }}
                                    </p>
                                    @if ($search === '')
                                        <a class="button button-primary" href="{{ route('teachers.create') }}">Add your first teacher</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($teachers->hasPages())
            <div class="pagination-wrap">{{ $teachers->links() }}</div>
        @endif
    </section>
@endsection
