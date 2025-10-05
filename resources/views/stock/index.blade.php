<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container py-4">
            <div class="row mb-4">
                <div class="col">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="fw-bold text-primary">
                            <i class="fas fa-exchange-alt me-2"></i>Stock History
                        </h2>
                        <a href="{{ route('stock.create') }}" class="btn btn-success">
                            <i class="fas fa-plus-circle me-1"></i> Add Movement
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
                                    <th class="ps-3">Date</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th class="pe-3">Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($movements as $move)
                                    <tr>
                                        <td class="ps-3 align-middle">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-calendar-alt text-secondary me-2"></i>
                                                <span>{{ $move->created_at->format('Y-m-d H:i') }}</span>
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="fw-medium">{{ $move->product->name }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <span
                                                class="badge bg-{{ $move->type === 'in' ? 'success' : 'danger' }} rounded-pill px-3 py-2">
                                                <i
                                                    class="fas fa-{{ $move->type === 'in' ? 'arrow-down' : 'arrow-up' }} me-1"></i>
                                                {{ strtoupper($move->type) }}
                                            </span>
                                        </td>
                                        <td class="align-middle fw-medium">
                                            {{ $move->quantity }}
                                        </td>
                                        <td class="pe-3 align-middle text-muted">
                                            {{ $move->note }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <div class="py-3">
                                                <i class="fas fa-box-open text-muted mb-2" style="font-size: 3rem;"></i>
                                                <p class="text-muted mb-0">No stock movements found.</p>
                                                <p class="text-muted">Add your first stock movement to get started.</p>
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
                            <h6 class="alert-heading mb-1">Stock Management Tips</h6>
                            <p class="mb-0 small">Use "IN" for receiving new inventory and "OUT" for sales or adjustments.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</body>

</html>