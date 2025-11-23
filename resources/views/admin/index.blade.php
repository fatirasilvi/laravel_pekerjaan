<h1>Admin setelah login</h1>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-danger">Logout</button>
</form>
