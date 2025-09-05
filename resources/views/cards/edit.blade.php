@extends('home')
@section('js_before')
@include('sweetalert::alert')
@section('header')
@section('sidebarMenu')   
@section('content')

    <h3> :: form Update card :: </h3>

    <form action="/card/{{ $id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group row mb-2">
            <label class="col-sm-2"> card Name </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="card_name" required placeholder="card Name "
                    minlength="3" value="{{ $card_name }}">
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
                <input type="text" class="form-control" name="card_number" required placeholder="card_number "
                    minlength="3" value="{{ $card_number }}">
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
                <input type="text" class="form-control" name="rarity" required placeholder="rarity"
                    minlength="3" value="{{ $rarity }}">
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
                <input type="text" class="form-control" name="set_name" required placeholder="set_name "
                    minlength="3" value="{{ $set_name }}">
                @if(isset($errors))
                @if($errors->has('set_name'))
                <div class="text-danger"> {{ $errors->first('set_name') }}</div>
                @endif
                @endif
            </div>
        </div> 
      
       

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                old img <br>
                <img src="{{ asset('storage/' . $card_img) }}" width="200px"> <br>
                choose new image <br>
                <input type="file" name="card_img" placeholder="card_img" accept="image/*">
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
                <input type="hidden" name="oldImg" value="{{ $card_img }}">
                <button type="submit" class="btn btn-primary"> Update </button>
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