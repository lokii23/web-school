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
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded text-black hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded text-white {{ request()->routeIs('admin.users') ? 'bg-red-600 font-semibold' : '' }}">
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
        @yield('content')
        <h1 class="text-2xl font-bold mb-4">All Users</h1>

        <!-- Filter -->
        <form method="GET" action="{{ route('admin.users') }}" class="mb-4 flex items-center gap-4">
            <label for="usertype" class="font-semibold">Filter by Type:</label>
            <select name="usertype" id="usertype"
                    onchange="this.form.submit()"
                    class="p-2 border rounded">
                <option value="">All</option>
                <option value="admin" {{ request('usertype') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="teacher" {{ request('usertype') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                <option value="student" {{ request('usertype') == 'student' ? 'selected' : '' }}>Student</option>
            </select>
        </form>

        <!-- Users Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg overflow-hidden">
                <thead class="bg-red-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">User Type</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($users as $user)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $user->id }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2 capitalize">{{ $user->usertype }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="inline-block px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
