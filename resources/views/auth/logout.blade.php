<!-- resources/views/layouts/app.blade.php -->

@if (Auth::check())
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endif
