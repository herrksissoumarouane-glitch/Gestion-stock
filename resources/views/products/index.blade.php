<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container py-4">
            <div class="row mb-4">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold text-primary"><i class="fas fa-box me-2"></i>Products</h2>
                        <a href="{{ route('products.create') }}" class="btn btn-success">
                            <i class="fas fa-plus-circle me-1"></i> Add Product
                        </a>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-muted"><i class="fas fa-filter me-2"></i>Filter Products</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                        placeholder="Search product name...">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text bg-white"><i class="fas fa-tags text-muted"></i></span>
                                    <select name="category_id" class="form-select">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-filter me-1"></i> Apply Filters
                                </button>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-redo me-1"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th class="text-end pe-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                    <tr>
                                        <td class="ps-3">
                                            @if($product->image)
                                                <img src="{{ asset($product->image) }}" class="rounded" width="100" height="100"
                                                    alt="{{ $product->name }}">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center rounded"
                                                    style="width:100px;height:100px">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="fw-medium">{{ $product->name }}</td>
                                        <td class="text-muted">{{ Str::limit($product->description, 50) }}</td>
                                        <td class="text-center">
                                            @if($product->category)
                                                {{ $product->category->name }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="fw-bold text-success">${{ number_format($product->price, 2) }}</td>
                                        <td class="text-center">
                                            {{ $product->quantity }}
                                            @if($product->quantity <= 0)
                                                <small class="d-block text-danger">(Out of stock)</small>
                                            @endif
                                        </td>
                                        <td class="text-end pe-3">
                                            <div class="btn-group">
                                                <a href="{{ route('products.edit', $product) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('products.destroy', $product) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this product?')"
                                                        class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="py-3">
                                                <i class="fas fa-box-open text-muted mb-2" style="font-size: 3rem;"></i>
                                                <p class="text-muted mb-0">No products found.</p>
                                                <p class="text-muted">Try adjusting your search or filter criteria.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
            </div>
        </div>

    @endsection

</body>

</html>