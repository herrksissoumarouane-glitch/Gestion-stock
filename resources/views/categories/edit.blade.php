@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <div class="d-flex align-items-center">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary me-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h2 class="fw-bold text-primary mb-0">
                        <i class="fas fa-folder-open me-2"></i>Edit Category
                    </h2>
                </div>
            </div>
        </div>


        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('categories.update', $category) }}">
                    @csrf @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-medium">
                            <i class="fas fa-tag text-primary me-1"></i> Category Name
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}" placeholder="Enter category name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="alert alert-info">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-info-circle text-info fa-lg"></i>
                            </div>
                            <div>
                                <h6 class="alert-heading mb-1">Products with this category</h6>
                                <p class="mb-0 small">Any products assigned to this category will reflect the updated
                                    name.</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-4 mt-2">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endsection