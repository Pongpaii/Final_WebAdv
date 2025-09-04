@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">

            <h3> :: form Update  :: </h3>


<form action="/test/{{ $id }}" method="post">
@csrf
@method('put')

<div class="form-group row mb-2">
    <label class="col-sm-2"> ชื่อ - สกุล </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="name" required placeholder=" Name" minlength="3" value="{{ $name }}">
        @if(isset($errors))
            @if($errors->has('name'))
                <div class="text-danger"> {{ $errors->first('name') }}</div>
            @endif 
        @endif
    </div>
</div>



<div class="form-group row mb-2">
    <label class="col-sm-2"> เบอร์โทร  </label>
    <div class="col-sm-6">
        <input type="text" class="form-control" name="phone" required placeholder="เบอร์โทร" value="{{ $phone }}">
        @if(isset($errors))
            @if($errors->has('phone'))
                <div class="text-danger"> {{ $errors->first('phone') }}</div>
            @endif 
        @endif
    </div>
</div>

<div class="form-group row mb-2">
    <label class="col-sm-2"> Email </label>
    <div class="col-sm-6">
        <input type="email" class="form-control" name="email" required placeholder="Email"   value="{{ $email }}">
        @if(isset($errors))
            @if($errors->has('email'))
                <div class="text-danger"> {{ $errors->first('email') }}</div>
            @endif 
        @endif
    </div>
</div>


<div class="form-group row mb-2">
    <label class="col-sm-2"> อายุ </label>
    <div class="col-sm-6">
        <input type="number" class="form-control" name="age" required placeholder="อายุ"  value="{{ $age }}">
        @if(isset($errors))
            @if($errors->has('age'))
                <div class="text-danger"> {{ $errors->first('age') }}</div>
            @endif 
        @endif
    </div>
</div>


<div class="form-group row mb-2">
    <label class="col-sm-2">  </label>
    <div class="col-sm-5">
       <button type="submit" class="btn btn-primary"> Update  </button>
       <a href="/test" class="btn btn-danger">cancel</a>
    </div>
</div>

</form>
</div> <!--  / <div class="col-sm-9 col-md-9"> -->


    @endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection