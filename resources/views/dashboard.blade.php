<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }

        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .card-icon {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 2rem;
            opacity: 0.7;
        }
    </style>
</head>

<body>
    @extends('layouts.app')

    @section('content')
        <div class="container-fluid px-4 py-4">
            <div class="row mb-4 align-items-stretch">
                <div class="col-md-3 mb-3">
                    <div class="card dashboard-card text-bg-primary h-100 position-relative">
                        <div class="card-body">
                            <h5 class="card-title">Total Products</h5>
                            <h2 class="card-text display-6 fw-bold">{{ $totalProducts }}</h2>
                            <i class="fas fa-box card-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card dashboard-card text-bg-secondary h-100 position-relative">
                        <div class="card-body">
                            <h5 class="card-title">Total Categories</h5>
                            <h2 class="card-text display-6 fw-bold">{{ $totalCategories }}</h2>
                            <i class="fas fa-tags card-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card dashboard-card text-bg-success h-100 position-relative">
                        <div class="card-body">
                            <h5 class="card-title">Total Stock IN</h5>
                            <h2 class="card-text display-6 fw-bold">{{ $totalIn }}</h2>
                            <i class="fas fa-arrow-down card-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <div class="card dashboard-card text-bg-danger h-100 position-relative">
                        <div class="card-body">
                            <h5 class="card-title">Total Stock OUT</h5>
                            <h2 class="card-text display-6 fw-bold">{{ $totalOut }}</h2>
                            <i class="fas fa-arrow-up card-icon"></i>
                        </div>
                    </div>
                </div>
            </div>

            @if($lowStock->count())
                <div class="alert mb-4 alert-warning">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-3 text-warning" style="font-size: 1.5rem;"></i>
                        <div>
                            <strong>Low Stock Products:</strong>
                            <ul class="mb-0 ps-3">
                                @foreach($lowStock as $product)
                                    <li>{{ $product->name }} — {{ $product->quantity }} left</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4">Stock Movements per Product</h4>
                    <canvas id="stockChart"></canvas>
                </div>
            </div>
        </div>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('stockChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [
                        {
                            label: 'Stock IN',
                            backgroundColor: 'rgba(75, 192, 192, 0.7)',
                            data: {!! json_encode($stockIn) !!}
                        },
                        {
                            label: 'Stock OUT',
                            backgroundColor: 'rgba(255, 99, 132, 0.7)',
                            data: {!! json_encode($stockOut) !!}
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Quantity'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Products'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>