@extends('layouts.admin')

@section('main-content')
<div id="app">
    <articles></articles>
</div>
@endsection

@section('scripts')
<script src="{{asset('js/app.js')}}"></script>
@endsection