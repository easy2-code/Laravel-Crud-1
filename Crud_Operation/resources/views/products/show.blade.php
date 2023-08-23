@extends('layouts.main')
@section('close')
<div class="container">
    <div class="row justify-centent-center">
        <div class="col-sm-8 mt-4">
            <div class="card p-4">
                <p>
                    Name: <b>{{ $product->name}}</b>
                </p>
                <p>
                    Description: <b>{{ $product->description}}</b>
                </p>
                <p>
                    <img src="/products/{{ $product->image}}" class="rounded" width="400">
                </p>
            </div>
        </div>
    </div>
</div>
@endsection