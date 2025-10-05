<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock</title>
</head>

<body>
    @push('styles')
        <style>
            .profile-card {
                border-radius: 15px;
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
                border: none !important;
                transition: transform 0.2s;
            }

            .card-header {
                background-color: #f8f9fa;
                border-bottom: 1px solid #e9ecef;
                border-top-left-radius: 15px !important;
                border-top-right-radius: 15px !important;
                padding: 1.25rem 1.5rem;
            }

            .card-title {
                margin-bottom: 0;
                color: #495057;
                font-weight: 600;
            }

            .form-control:focus {
                border-color: #80bdff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            .form-label {
                font-weight: 500;
                color: #495057;
            }

            .btn-update {
                padding: 0.5rem 2rem;
                font-weight: 500;
                letter-spacing: 0.5px;
            }

            .alert {
                border-radius: 10px;
                padding: 0.85rem 1.25rem;
            }

            .section-divider {
                height: 25px;
            }
        </style>
    @endpush
    </head>

    <body class="bg-light">
        @extends('layouts.app')

        @section('content')
            <div class="container py-5">
                <div class="row justify-content-center">

                    <div class="col-md-8 mb-4">
                        <div class="card profile-card">
                            <div class="card-header d-flex align-items-center">
                                <i class="fas fa-user-circle fs-4 me-2 text-primary"></i>
                                <h5 class="card-title mb-0">Profile Information</h5>
                            </div>

                            <div class="card-body p-4">
                                @if(session('status') === 'profile-information-updated')
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <div>Your profile has been updated successfully!</div>
                                    </div>
                                @endif

                                <form action="{{route('user-profile-information.update')}}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label class="form-label" for="name">Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="name" name="name" value="{{ old('name', auth()->user()->name) }}" />
                                        </div>
                                        @error('name')
                                            <div class="text-danger mt-1 small">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label" for="email">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                id="email" name="email" value="{{ old('email', auth()->user()->email) }}" />
                                        </div>
                                        @error('email')
                                            <div class="text-danger mt-1 small">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary btn-update" type="submit">
                                            <i class="fas fa-save me-2"></i> Update Profile
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-8 mb-4">
                        <div class="card profile-card">
                            <div class="card-header d-flex align-items-center">
                                <i class="fas fa-lock fs-4 me-2 text-primary"></i>
                                <h5 class="card-title mb-0">Update Password</h5>
                            </div>

                            <div class="card-body p-4">
                                @if (session('status') === 'password-updated')
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <div>Your password has been updated successfully!</div>
                                    </div>
                                @endif

                                <form method="POST" action="{{route('user-password.update')}}">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            <input id="current_password" name="current_password" type="password"
                                                class="form-control @error('current_password') is-invalid @enderror"
                                                autocomplete="current-password" />
                                        </div>
                                        @error('current_password')
                                            <div class="text-danger mt-1 small">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input id="password" name="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                autocomplete="new-password" />
                                        </div>
                                        @error('password')
                                            <div class="text-danger mt-1 small">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            <input id="password_confirmation" name="password_confirmation" type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                autocomplete="new-password" />
                                        </div>
                                        @error('password_confirmation')
                                            <div class="text-danger mt-1 small">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary btn-update" type="submit">
                                            <i class="fas fa-key me-2"></i> Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card profile-card">
                            <div class="card-header d-flex align-items-center">
                                <i class="fas fa-cog fs-4 me-2 text-primary"></i>
                                <h5 class="card-title mb-0">Account Actions</h5>
                            </div>

                            <div class="card-body p-4">
                                <form action="{{route('logout')}}" method="POST">
                                    @csrf
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-danger btn-update">
                                            <i class="fas fa-sign-out-alt me-2"></i> Log Out
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
    </body>

</html>