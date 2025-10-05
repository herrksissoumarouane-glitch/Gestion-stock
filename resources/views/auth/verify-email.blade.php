<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            <i class="fas fa-envelope-open-text text-primary fa-3x mb-3"></i>
                            <h2 class="fw-bold text-primary">Verify Your Email</h2>
                            <p class="text-muted">Welcome, <span class="fw-medium">{{ auth()->user()->name }}</span></p>
                        </div>

                        @if(session('status'))
                            <div class="alert alert-success alert-dismissible fade show mb-4">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-check-circle text-success fa-lg"></i>
                                    </div>
                                    <div>
                                        {{ session('status') }}
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="card bg-light border-0 mb-4">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <i class="fas fa-info-circle text-primary fa-lg"></i>
                                    </div>
                                    <div>
                                        <p class="mb-1">Please verify your email address by clicking on the link we just emailed to you.</p>
                                        <p class="mb-0">If you didn't receive the email, we will gladly send you another.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <div class="border-top pt-4 mt-2">
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary px-4">
                                        <i class="fas fa-paper-plane me-2"></i>Resend Verification Email
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- <div class="text-center mt-4">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none">
                        <i class="fas fa-arrow-left me-1"></i> Return to Dashboard
                    </a>
                </div> -->
            </div>
        </div>
    </div>
</body>

</html>