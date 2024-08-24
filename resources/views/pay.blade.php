<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .payment-container {
            background: #ffffff;
            padding: 2rem;
            border-radius: .5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .success-message, .error-message {
            padding: 1rem;
            border-radius: .25rem;
            margin-bottom: 1rem;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="payment-container">
        <h1 class="text-center mb-4">Payment Form</h1>

        <h5 class="text-center mb-4">{{ $price }}</h5>

        @if (session('success'))
            <div class="success-message alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="error-message alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('updatePaid') }}">
            @csrf
            <div class="mb-3">
                <label for="payment_amount" class="form-label">Enter Payment Amount:</label>
                <input type="number" id="payment_amount" name="payment_amount" class="form-control" required>
            </div>

            <input type="hidden" id="price" name="price" value="{{ $price }}">

            <button type="submit" class="btn btn-primary w-100">Pay Now</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
