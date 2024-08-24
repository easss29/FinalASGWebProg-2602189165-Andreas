<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-container {
            max-width: 600px;
            width: 100%;
            padding: 2rem;
            background: #ffffff;
            border-radius: .5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .error-message {
            margin-bottom: 1rem;
            padding: 1rem;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: .25rem;
        }
        .register-container h1 {
            margin-bottom: 1.5rem;
        }
        .register-container a {
            color: #007bff;
            text-decoration: none;
        }
        .register-container a:hover {
            text-decoration: underline;
        }
        .form-check-inline {
            margin-right: 1rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1 class="text-center">Register</h1>

        @if ($errors->any())
            <div class="error-message">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender:</label>
                <select id="gender" name="gender" class="form-select" required>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="linkedin_username" class="form-label">LinkedIn Username:</label>
                <input type="text" id="linkedin_username" name="linkedin_username" placeholder="https://www.linkedin.com/in/" class="form-control" value="{{ old('linkedin_username') }}" required>
            </div>

            <div class="mb-3">
                <label for="fields_of_work" class="form-label">Fields of Work:</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" id="field_technology" name="fields_of_work[]" value="Technology" class="form-check-input" {{ in_array('Technology', old('fields_of_work', [])) ? 'checked' : '' }}>
                        <label for="field_technology" class="form-check-label">Technical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" id="field_health" name="fields_of_work[]" value="Health" class="form-check-input" {{ in_array('Health', old('fields_of_work', [])) ? 'checked' : '' }}>
                        <label for="field_health" class="form-check-label">Creative</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" id="field_education" name="fields_of_work[]" value="Education" class="form-check-input" {{ in_array('Education', old('fields_of_work', [])) ? 'checked' : '' }}>
                        <label for="field_education" class="form-check-label">Analytical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" id="field_finance" name="fields_of_work[]" value="Finance" class="form-check-input" {{ in_array('Finance', old('fields_of_work', [])) ? 'checked' : '' }}>
                        <label for="field_finance" class="form-check-label">Physical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" id="field_art" name="fields_of_work[]" value="Art" class="form-check-input" {{ in_array('Art', old('fields_of_work', [])) ? 'checked' : '' }}>
                        <label for="field_art" class="form-check-label">Research</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="mobile_number" class="form-label">Mobile Number:</label>
                <input type="number" id="mobile_number" name="mobile_number" class="form-control" value="{{ old('mobile_number') }}" required>
            </div>

            <div class="mb-3">
                <label for="profile_image" class="form-label">Profile Image:</label>
                <input type="file" id="profile_image" name="profile_image" class="form-control">
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-primary">Register</button>
                <a href="{{ url('/login') }}" class="btn btn-link">Already have an account? Login</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
