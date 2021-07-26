@extends('layouts.admin')

@section('head')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css">
<title>Add a product</title>
@endsection

@section('main-content')
<h1 class="text-center mn-2">@yield('top-title')</h1>
<div class="card card-default">
    <div class="card-body px-5">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                    {{$error}}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        @yield('input-data')
    </div>
</div>


@endsection


@section('scripts')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js"></script>
@endsection