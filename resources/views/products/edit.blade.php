@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <div class="d-flex align-items-center">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary me-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h2 class="fw-bold text-primary mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Product
                    </h2>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                @if($product->image)
                    <div class="mb-4 text-center">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-thumbnail"
                            style="max-height: 150px;">
                        <p class="form-text mt-2">Current product image</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-tag text-primary me-1"></i> Product Name
                                </label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $product->name) }}" placeholder="Enter product name" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-align-left text-primary me-1"></i> Description
                                </label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                    rows="4"
                                    placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-dollar-sign text-primary me-1"></i> Price
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white">$</span>
                                    <input type="number" step="0.01" min="0" name="price"
                                        class="form-control @error('price') is-invalid @enderror"
                                        value="{{ old('price', $product->price) }}" placeholder="0.00" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-boxes text-primary me-1"></i> Quantity
                                </label>
                                <input type="number" min="0" name="quantity"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    value="{{ old('quantity', $product->quantity) }}" placeholder="0" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-folder text-primary me-1"></i> Category
                                </label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror"
                                    required>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-image text-primary me-1"></i> Update Product Image
                                </label>
                                <div class="input-group">
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Leave empty to keep the current image</div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-4 mt-2">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Product
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection