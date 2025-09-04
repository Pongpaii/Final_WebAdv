@extends('home')
@section('js_before')
@include('sweetalert::alert')
@section('header')
@section('sidebarMenu')   
@section('content')

    <h3> :: form Update student :: </h3>

    <form action="/student/{{ $id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group row mb-2">
            <label class="col-sm-2"> student Name </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="student_name" required placeholder="student Name "
                    minlength="3" value="{{ $student_name }}">
                @if(isset($errors))
                @if($errors->has('student_name'))
                <div class="text-danger"> {{ $errors->first('student_name') }}</div>
                @endif
                @endif
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2"> student code </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="student_code" required placeholder="student_code "
                    minlength="3" value="{{ $student_code }}">
                @if(isset($errors))
                @if($errors->has('student_name'))
                <div class="text-danger"> {{ $errors->first('student_code') }}</div>
                @endif
                @endif
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2"> student phone </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="student_phone" required placeholder="student_phone "
                    minlength="10" maxlength="10" value="{{ $student_phone}}">
                @if(isset($errors))
                @if($errors->has('student_name'))
                <div class="text-danger"> {{ $errors->first('student_phone') }}</div>
                @endif
                @endif
            </div>
        </div>

       

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                old img <br>
                <img src="{{ asset('storage/' . $student_img) }}" width="200px"> <br>
                choose new image <br>
                <input type="file" name="student_img" placeholder="student_img" accept="image/*">
                @if(isset($errors))
                @if($errors->has('student_img'))
                <div class="text-danger"> {{ $errors->first('student_img') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-5">
                <input type="hidden" name="oldImg" value="{{ $student_img }}">
                <button type="submit" class="btn btn-primary"> Update </button>
                <a href="/student" class="btn btn-danger">cancel</a>
            </div>
        </div>

    </form>
</div>


@endsection


@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}