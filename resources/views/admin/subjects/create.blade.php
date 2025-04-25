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
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded hover:bg-gray-200 {{ request()->routeIs('admin.users') ? 'bg-gray-200 font-semibold' : '' }}">
                Users
            </a>
            <a href="{{ route('admin.subjects.create') }}" class="block px-4 py-2 rounded text-white {{ request()->routeIs('admin.subjects.create') ? 'bg-red-600 font-semibold' : '' }}">
                Subjects
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
        @yield('content')
        <h2 class="text-2xl font-bold mb-4">Create Subject</h2>

        <form action="{{ route('admin.subjects.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
            @csrf

            <div>
                <label class="block font-semibold">Subject Name</label>
                <input type="text" name="name" class="w-full p-2 border rounded" required>
            </div>

            <div>
                <label class="block font-semibold">Assign to Teacher</label>
                <select name="teacher_id" class="w-full p-2 border rounded">
                    <option value="">-- Optional --</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Create</button>
        </form>
    </main>

</body>
</html>
