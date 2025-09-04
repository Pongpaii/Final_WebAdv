@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')   
@endsection
@section('content')
 


    <h3> :: Form Add student :: </h3>

    <form action="/student/" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row mb-2">
            <label class="col-sm-2"> student Name </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="student_name" required placeholder="student Name "
                    minlength="3" value="{{ old('student_name') }}">
                @if(isset($errors))
                @if($errors->has('student_name'))
                <div class="text-danger"> {{ $errors->first('student_name') }}</div>
                @endif
                @endif
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2"> student Code </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="student_code" required placeholder="student code "
                    minlength="5" value="{{ old('student_code') }}">
                @if(isset($errors))
                @if($errors->has('student_code'))
                <div class="text-danger"> {{ $errors->first('student_code') }}</div>
                @endif
                @endif
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2"> student Phone </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="student_phone" required placeholder="student phone "
                    minlength="10" maxlength="10" value="{{ old('student_phone') }}">
                @if(isset($errors))
                @if($errors->has('student_phone'))
                <div class="text-danger"> {{ $errors->first('student_phone') }}</div>
                @endif
                @endif
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                <input type="file" name="student_img" required placeholder="student_img" accept="image/*">
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

                <button type="submit" class="btn btn-primary"> Insert student </button>
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