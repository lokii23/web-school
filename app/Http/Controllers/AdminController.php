<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Models\Subject;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin/dashboard');
    }

    public function users()
    {
        $users = User::all(); // or paginate() for better performance
        return view('admin.users', compact('users'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email', 'usertype'));

        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.users')->with('success', 'User deleted successfully!');
    }

    public function index()
    {
        $subjects = Subject::with('teacher')->get();
        return view('admin.subjects.create', compact('subjects'));
    }

    public function create()
    {
        $teachers = User::where('usertype', 'teacher')->get();
        return view('admin.subjects.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'teacher_id' => 'nullable|exists:users,id',
        ]);

        Subject::create($request->only('name', 'teacher_id'));

        return redirect()->route('admin.subjects.index')->with('success', 'Subject created successfully.');
    }

    public function editsub(Subject $subject)
    {
        $teachers = User::where('usertype', 'teacher')->get();
        return view('admin.subjects.edit', compact('subject', 'teachers'));
    }

    public function updatesub(Request $request, Subject $subject)
    {
        $request->validate([
            'name' => 'required|string',
            'teacher_id' => 'nullable|exists:users,id',
        ]);

        $subject->update($request->only('name', 'teacher_id'));

        return redirect()->route('admin.subjects.index')->with('success', 'Subject updated successfully.');
    }

    public function destroysub(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('admin.subjects.index')->with('success', 'Subject deleted.');
    }

    public function viewSub()
    {
        $subjects = Subject::with('teacher')->get();
        return view('teacher.dashboard', compact('subjects'));
    }
}
