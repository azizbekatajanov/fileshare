@extends('layouts.main-layout')
@section('content')

    <h1>File Hosting</h1>
<p class="lead">Share With Your Files</p>
<form action="" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" class="lead form-control-file" name="file" id="file">
    <input type="submit" class="btn btn-primary" name="submit" value="OK">
</form>
    @if(session('uniqid'))
        <div>
            Your link:
            <a href="{{route('download',['uniqid'=>session('uniqid')])}}">{{route('download',['uniqid'=>session('uniqid')])}}</a>
        </div>
    @endif
@endsection
