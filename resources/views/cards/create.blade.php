@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')   
@endsection
@section('content')
 


    <h3> :: Form Add Card :: </h3>

    <form action="/card/" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row mb-2">
            <label class="col-sm-2"> card Name </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="card_name" required placeholder="card Name "
                    minlength="3" value="{{ old('card_name') }}">
                @if(isset($errors))
                @if($errors->has('card_name'))
                <div class="text-danger"> {{ $errors->first('card_name') }}</div>
                @endif
                @endif
            </div>
        </div>
 

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-5">

                <button type="submit" class="btn btn-primary"> Insert Card </button>
                <a href="/card" class="btn btn-danger">cancel</a>
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