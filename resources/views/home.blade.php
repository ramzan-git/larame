@extends('layouts.myapp')

@section('title', 'Page Title')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi voluptatum, neque expedita sequi consectetur atque dolor porro voluptate quo saepe numquam esse odio quibusdam, distinctio consequatur explicabo quia similique? Molestiae.
    </p>
@endsection
