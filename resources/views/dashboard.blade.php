@extends('auth.layout')

@section('content')

<form action="{{ route('logout') }}"  method="post">
@csrf

<button type="submit" class="btn btn-primary">LOGOUT</button>
</form>
@endsection
