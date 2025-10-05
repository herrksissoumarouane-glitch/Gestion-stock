@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <div class="d-flex align-items-center">
                    <a href="{{ route('stock.index') }}" class="btn btn-outline-secondary me-3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h2 class="fw-bold text-primary mb-0">
                        <i class="fas fa-exchange-alt me-2"></i>Add Stock Movement
                    </h2>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">


                <form method="POST" action="{{ route('stock.store') }}">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-box text-primary me-1"></i> Product
                                </label>
                                <select name="product_id" class="form-select @error('product_id') is-invalid @enderror"
                                    required>
                                    <option value="" disabled selected>Select a product</option>
                                    @foreach($products as $prod)
                                        <option value="{{ $prod->id }}">
                                            {{ $prod->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-sort-numeric-up text-primary me-1"></i> Quantity
                                </label>
                                <input type="number" name="quantity" min="1"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    placeholder="Enter quantity" required>
                                @error('quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-exchange-alt text-primary me-1"></i> Movement Type
                                </label>
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input @error('type') is-invalid @enderror" type="radio"
                                            name="type" id="typeIn" value="in">
                                        <label class="form-check-label" for="typeIn">
                                            <span class="badge bg-success rounded-pill px-3">
                                                <i class="fas fa-arrow-down me-1"></i> IN (Add to Inventory)
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input" type="radio" name="type" id="typeOut" value="out">
                                        <label class="form-check-label" for="typeOut">
                                            <span class="badge bg-danger rounded-pill px-3">
                                                <i class="fas fa-arrow-up me-1"></i> OUT (Remove from Inventory)
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                @error('type')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-sticky-note text-primary me-1"></i> Note
                                </label>
                                <textarea name="note" class="form-control @error('note') is-invalid @enderror" rows="4"
                                    placeholder="Enter additional details about this stock movement"></textarea>
                                @error('note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Include details like purchase order numbers, reasons for adjustments,
                                    etc.</div>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-info mb-4">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-info-circle text-info fa-lg"></i>
                            </div>
                            <div>
                                <p class="mb-0 small">Stock movements cannot be edited after submission. Please double-check
                                    your entries.</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-4 mt-2">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('stock.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Movement
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection