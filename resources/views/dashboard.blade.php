<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>

    
</form>
<h1>Welcome to your Dashboard</h1>

    @auth
        <p>Hello, <h1>{{ $user->name }}! </h1> Welcome back to your dashboard.</p>
    @endauth

    @guest
        <p>You are not logged in. Please <a href="{{ route('login') }}">login</a> to continue.</p>
    @endguest