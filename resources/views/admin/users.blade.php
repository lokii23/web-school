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
            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded text-black hover:bg-gray-200 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-semibold' : '' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="block px-4 py-2 rounded text-white  {{ request()->routeIs('admin.users') ? 'bg-red-600 font-semibold' : '' }}">
                Users
            </a>
            <a href="{{ route('admin.subjects.create') }}" class="block px-4 py-2 rounded hover:bg-gray-200  {{ request()->routeIs('admin.subjects') ? 'bg-gray-200font-semibold' : '' }}">
                Create Subjects
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
                                class="bg-yellow-500 text-white px-6 py-1 rounded hover:bg-yellow-600">
                                    Edit
                                </a>

                                <!-- Delete Button triggers modal -->
                                <button onclick="openModal({{ $user->id }})"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-500">
                                Delete
                                </button>

                                <!-- Modal -->
                                <div id="modal-{{ $user->id }}" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                                    <div class="bg-white p-6 rounded shadow-lg max-w-md w-68">
                                        <h2 class="text-lg font-semibold mb-4">Delete Confirmation</h2>
                                        <p class="mb-4">Are you sure you want to delete <strong>{{ $user->name }}</strong>?</p>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="flex justify-end gap-2">
                                                <button type="button" onclick="closeModal({{ $user->id }})"
                                                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancel</button>
                                                <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
<script>
    function openModal(id) {
        document.getElementById(`modal-${id}`).classList.remove('hidden');
        document.getElementById(`modal-${id}`).classList.add('flex');
    }

    function closeModal(id) {
        document.getElementById(`modal-${id}`).classList.add('hidden');
        document.getElementById(`modal-${id}`).classList.remove('flex');
    }
</script>
</html>
