@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

    <div class="text-center">
        <h1>404 Page Not Found !!</h1>
        <a href="{{ url()->previous() }}" class="btn btn-secondary">​ << ย้อนกลับ</a>

    </div>
 
    @endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection
