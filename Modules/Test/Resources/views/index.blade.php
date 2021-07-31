@extends('layouts.contentLayoutMaster')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('test.name') !!}
    </p>

    {!! $button !!}
@endsection
