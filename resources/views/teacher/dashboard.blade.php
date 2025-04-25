<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-4 flex flex-col">
        <img src="{{ asset('pap3.png') }}" alt="Logo">
        <br />
        <div class="text-2xl font-bold text-center mb-10 text-blue-600">
            <h1 class="text-2xl font-bold">Hi! Teacher, <br/>{{ auth()->user()->name }}!<br/> 👋</h1>
        </div>
        <nav class="flex-1 space-y-2">
            <a href="{{ route('teacher.dashboard') }}" class="block px-4 py-2 rounded {{ request()->routeIs('teacher.dashboard') ? 'bg-blue-600 text-white font-semibold' : 'hover:bg-gray-200' }}">
                Dashboard
            </a>

            <!-- Add more links here if needed -->

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
        <h2 class="text-2xl font-bold mb-4">Subjects List</h2>

        <a href="{{ route('admin.subjects.create') }}"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 mb-4 inline-block">+ Add New Subject</a>

        <table class="min-w-full bg-white shadow rounded">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-2 px-4">#</th>
                    <th class="py-2 px-4">Subject Name</th>
                    <th class="py-2 px-4">Assigned Teacher</th>
                    <th class="py-2 px-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $index => $subject)
                    <tr class="border-t">
                        <td class="py-2 px-4">{{ $index + 1 }}</td>
                        <td class="py-2 px-4">{{ $subject->name }}</td>
                        <td class="py-2 px-4">
                            {{ $subject->teacher ? $subject->teacher->name : '— Not Assigned —' }}
                        </td>
                        <td class="py-2 px-4">
                            <a href="{{ route('admin.subjects.edit', $subject->id) }}" class="text-blue-500 hover:underline mr-3">Edit</a>

                            <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-gray-500">No subjects found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>

</body>
</html>
