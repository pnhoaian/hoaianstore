@extends('welcome')
@section('content')

<div class="features_items">
        <h1 class="title text-center" style="margin: 0 150px;color: #002795;font-family: -apple-system, system-ui, BlinkMacSystemFont;font-weight: 500;">About Us</h1>
    </div>
    
    @foreach ($intr as $key =>$int)
    <p style="margin-top: 20px">
       {!! $int->intro_desc !!}
    </p>
    @endforeach
    
@endsection