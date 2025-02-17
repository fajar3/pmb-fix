<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Assalam Bantur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin-style.css') }}">

    <style>


 :root {
            --primary-green: #4CAF50;
            --hover-green:rgb(72, 198, 78);
            --light-green: #E8F5E9;
            --dark-green: #2E7D32;
        }

        body {
            background: linear-gradient(to bottom, rgba(0, 93, 22, 0.02), rgba(255, 255, 255, 0.6), rgba(2, 152, 59, 0.15)),
            url("../img/batik.png") no-repeat center/cover;
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
        }
             /* Button Styling */
        .btn-login {
            background: linear-gradient(135deg, var(--primary-green), var(--hover-green));
            color: #fff;
            padding: 12px;
            border-radius: 12px;
            border: none;
            font-weight: 500;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, var(--hover-green), var(--primary-green));
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            transform: translateY(-2px);
        }

        /* Register Link */
        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .register-link a {
            color: var(--primary-green);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: var(--hover-green);
            text-decoration: underline;
        }

        /* Container Spacing */
        .container.mt-4 {
            padding-bottom: 2rem;
            
        }
    </style>
</head>
<body>
    
    <div class="container mt-4 jj">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
        
    </script>
</body>
</html>