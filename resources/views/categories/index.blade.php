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
                        <h2 class="fw-bold text-primary">
                            <i class="fas fa-folder me-2"></i>Categories
                        </h2>
                        <a href="{{ route('categories.create') }}" class="btn btn-success">
                            <i class="fas fa-plus-circle me-1"></i> Add Category
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

            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Category Name</th>
                                    <th class="text-end pe-3" width="200">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="ps-3 align-middle">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-folder text-warning me-2"></i>
                                                <span class="fw-medium">{{ $category->name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-end pe-3">
                                            <div class="btn-group">
                                                <a href="{{ route('categories.edit', $category) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('categories.destroy', $category) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Are you sure you want to delete this category? This may affect products assigned to this category.')"
                                                        class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center py-4">
                                            <div class="py-3">
                                                <i class="fas fa-folder-open text-muted mb-2" style="font-size: 3rem;"></i>
                                                <p class="text-muted mb-0">No categories found.</p>
                                                <p class="text-muted">Create your first category to get started.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4">


                <div class="alert alert-info">
                    <div class="d-flex">
                        <div class="me-3">
                            <i class="fas fa-info-circle text-info fa-lg"></i>
                        </div>
                        <div>
                            <h6 class="alert-heading mb-1">Deleted Categories</h6>
                            <p class="mb-0 small">Any products assigned to a deleted category will be removed.</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    @endsection
</body>

</html>