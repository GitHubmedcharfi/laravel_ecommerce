<!doctype html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Edit Profile</title>
  <!-- Favicon -->
  <link rel="icon" href="assets/img/favicons/favicon.ico">
  <!-- Fonts and Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="{{ asset('dashboardassest/css/phoenix.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dashboardassest/css/user.min.css') }}" rel="stylesheet">
  <style>
    body {
      opacity: 0;
    }

    .form-container {
      max-width: 600px;
      margin: 30px auto;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h3,
    h4 {
      font-family: 'Poppins', sans-serif;
      font-weight: 600;
    }

    .btn-primary {
      width: 100%;
    }
  </style>
</head>

<body>
  <main class="main" id="top">
    <div class="container-fluid px-0">
      @include('includes.client.sidebar')
      @include('includes.client.nav')
      <div class="content">
        <div class="pb-5">
          <div class="row g-5">
            <div class="form-container">
              @include('includes.flash_message')
              <h3 class="text-center mb-4">Admin Edit Profile</h3>
              <form action="{{ route('client.profile.update') }}" method="POST">
                @csrf
                <!-- Username -->
                <div class="form-group mb-3">
                  <label for="name" class="form-label">Username</label>
                  <input type="text" value="{{ auth()->user()->name }}" class="form-control" name="name" id="name" placeholder="Enter your username">
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" value="{{ auth()->user()->email }}" class="form-control" name="email" id="email" placeholder="Enter your email">
                </div>

                <!-- Password Section -->
                <h4 class="mt-4">Change Password</h4>
                <div class="form-group mb-3">
                  <label for="password" class="form-label">New Password</label>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Enter new password">
                </div>

                <div class="form-group mb-3">
                  <label for="confirm-password" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm_password" id="confirm-password" placeholder="Confirm new password">
                </div>

                <!-- Save Button -->
                <div class="form-group mt-4">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="row g-0 justify-content-between align-items-center h-100 mb-3">
            
           
          </div>
        </footer>
      </div>
    </div>
  </main>

  <!-- JavaScript -->
  <script src="{{ asset('dashboardassest/js/phoenix.js') }}"></script>
  <script src="{{ asset('dashboardassest/js/ecommerce-dashboard.js') }}"></script>
</body>

</html>
