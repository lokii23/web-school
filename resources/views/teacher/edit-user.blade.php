<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-4 flex flex-col">
        <img src="../../../pap3.png" alt="">
        <br />
        <div class="text-2xl font-bold text-center mb-10 text-red-600">
            SUPER ADMIN PANEL
        </div>
        <nav class="flex-1 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded text-white {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.users') ? 'bg-gray-200 font-semibold' : '' }}">
                Users
            </a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.subjects') ? 'bg-gray-200 font-semibold' : '' }}">
                Subjects
            </a>
            <a href="#" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.exams') ? 'bg-gray-200 font-semibold' : '' }}">
                Exams
            </a>
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
               class="block px-4 py-2 rounded hover:bg-gray-200">Logout</a>
    
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')

        <div>
            <label class="block">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="w-full p-2 border rounded">
        </div>

        <div>
            <label class="block">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" class="w-full p-2 border rounded">
        </div>

        <div>
            <label class="block">User Type</label>
            <select name="usertype" class="w-full p-2 border rounded">
                <option value="admin" {{ $user->usertype == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="teacher" {{ $user->usertype == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ $user->usertype == 'student' ? 'selected' : '' }}>Student</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
    </form>
    </main>

</body>
</html>
