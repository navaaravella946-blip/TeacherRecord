<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TeacherController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('search', ''));

        $teachers = Teacher::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('subject', 'like', "%{$search}%");
                });
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('welcome', [
            'teachers' => $teachers,
            'search' => $search,
            'teacherCount' => Teacher::count(),
            'activeTeacherCount' => Teacher::where('status', 'active')->count(),
            'subjectCount' => Teacher::distinct()->count('subject'),
        ]);
    }

    public function create(): View
    {
        return view('teachers.create', ['teacher' => new Teacher(['status' => 'active'])]);
    }

    public function store(Request $request): RedirectResponse
    {
        Teacher::create($this->validatedTeacher($request));

        return redirect()->route('teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function edit(Teacher $teacher): View
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher): RedirectResponse
    {
        $teacher->update($this->validatedTeacher($request, $teacher));

        return redirect()->route('teachers.index')->with('success', 'Teacher updated successfully.');
    }

    public function destroy(Teacher $teacher): RedirectResponse
    {
        $teacher->delete();

        return redirect()->route('teachers.index')->with('success', 'Teacher deleted successfully.');
    }

    private function validatedTeacher(Request $request, ?Teacher $teacher = null): array
    {
        $uniqueEmail = Rule::unique('teachers', 'email');

        if ($teacher !== null) {
            $uniqueEmail->ignore($teacher);
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:255', $uniqueEmail],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:100'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);
    }
}
