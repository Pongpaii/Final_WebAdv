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
            <label class="col-sm-2"> card number </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="card_number" required placeholder="card Number"
                    minlength="3" value="{{ old('card_number') }}">
                @if(isset($errors))
                @if($errors->has('card_number'))
                <div class="text-danger"> {{ $errors->first('card_number') }}</div>
                @endif
                @endif
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2"> card rarity </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="rarity" required placeholder="card rarity"
                    minlength="3" value="{{ old('rarity') }}">
                @if(isset($errors))
                @if($errors->has('rarity'))
                <div class="text-danger"> {{ $errors->first('rarity') }}</div>
                @endif
                @endif
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2"> card set </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="set_name" required placeholder="card set"
                    minlength="3" value="{{ old('set_name') }}">
                @if(isset($errors))
                @if($errors->has('set_name'))
                <div class="text-danger"> {{ $errors->first('set_name') }}</div>
                @endif
                @endif
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2"> description </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="description" required placeholder="card description"
                    minlength="3" value="{{ old('description') }}">
                @if(isset($errors))
                @if($errors->has('description'))
                <div class="text-danger"> {{ $errors->first('description') }}</div>
                @endif
                @endif
            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2">card price </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="card_price" required placeholder="card price"
                    minlength="3" value="{{ old('card_price') }}">
                @if(isset($errors))
                @if($errors->has('card_price'))
                <div class="text-danger"> {{ $errors->first('card_price') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                <input type="file" name="card_img" required placeholder="card_img" accept="image/*">
                @if(isset($errors))
                @if($errors->has('card_img'))
                <div class="text-danger"> {{ $errors->first('card_img') }}</div>
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