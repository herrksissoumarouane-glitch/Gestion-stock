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
                        <i class="fas fa-folder-plus me-2"></i>Add Category
                    </h2>
                </div>
            </div>
        </div>


        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-medium">
                            <i class="fas fa-tag text-primary me-1"></i> Category Name
                        </label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Enter category name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            Category names should be unique and descriptive.
                        </div>
                    </div>

                    <div class="border-top pt-4 mt-2">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Category
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection