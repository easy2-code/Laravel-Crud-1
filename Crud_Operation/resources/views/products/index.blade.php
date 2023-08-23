@extends('layouts.main')
@section('close')
    <div class="container">
        <div class="text-right">
            <a href="products/create" class="btn btn-dark mt-2">New Product</a>
        </div>
    </div>

    <table class="table table-hover mt-2">
        <thead>
            <tr>
                <th>Sno.</th>
                <th>Name</th>
                {{-- <th>Description</th> --}}
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products  as $product)
            <tr>
                <td>{{ $loop->index+1}}</td>
                <td><a href="products/{{ $product->id}}/show" class="text-dark">{{ $product->name }}</a></td>
                {{-- <td>{{ $product->description }}</td> --}}
                <td>
                    <img src="products/{{ $product->image }}" class="rounded-circle" width="40" height="40">
                </td>
                <td>
                    <a href="products/{{ $product->id}}/edit" class="btn btn-dark btn-sm">Edit</a>
                    {{-- We use delete method to delete product  --}}
                    {{-- <a href="products/{{ $product->id}}/delete" class="btn btn-danger btn-sm">Delete</a> --}}
                    {{-- To delete a product we need to create a form  --}}
                    <form action="products/{{ $product->id}}/delete" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $products->links()}}
@endsection
