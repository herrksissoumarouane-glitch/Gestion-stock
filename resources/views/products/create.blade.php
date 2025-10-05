
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
                            <i class="fas fa-plus-circle me-2"></i>Add New Product
                        </h2>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-tag text-primary me-1"></i> Product Name
                                    </label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                         placeholder="Enter product name" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-align-left text-primary me-1"></i> Description
                                    </label>
                                    <textarea name="description"
                                        class="form-control @error('description') is-invalid @enderror" rows="4"
                                        placeholder="Enter product description"></textarea>
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
                                            placeholder="0.00" required>
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
                                         placeholder="0" >
                                    @error('quantity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-folder text-primary me-1"></i> Category
                                    </label>
                                    <select name="category_id"
                                        class="form-select @error('category_id') is-invalid @enderror" required>
                                        <option value="" disabled selected>Select a category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" >
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
                                        <i class="fas fa-image text-primary me-1"></i> Product Image
                                    </label>
                                    <div class="input-group">
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror" accept="image/*">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-text">Recommended size: 500x500 pixels (JPG, PNG or GIF)</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-4 mt-2">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Save Product
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    @endsection
