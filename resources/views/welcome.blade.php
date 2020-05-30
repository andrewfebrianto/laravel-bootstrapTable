@extends('layouts.main')

@section('title')
Welcome
@endsection

@section("breadcrumb")
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item active">Welcome</li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        Welcome
    </div>
    <div class="card-body">
        <a href="https://laravel.com/docs">Docs</a>
        <a href="https://laracasts.com">Laracasts</a>
        <a href="https://laravel-news.com">News</a>
        <a href="https://blog.laravel.com">Blog</a>
        <a href="https://nova.laravel.com">Nova</a>
        <a href="https://forge.laravel.com">Forge</a>
        <a href="https://vapor.laravel.com">Vapor</a>
        <a href="https://github.com/laravel/laravel">GitHub</a>
    </div>
</div>
@endsection
