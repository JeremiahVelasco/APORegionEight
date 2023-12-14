<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="APO SEAL.png">
    <link rel="stylesheet" href="admin/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Admin Office - Dashboard</title>
</head>

<body>
    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <img src="APO SEAL.png" height="30" width="30">
                <h2>Alpha Phi Omega | Region 8</h2>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <div class="user">
            <img src="admin.jpg" alt="secret-user" class="admin-img">
            <div class="">
                <p class="bold">Jeremiah V.</p>
                <p>Admin</p>
            </div>
        </div>
        <ul>
            <li>
                <a href="/admindashboard">
                    <i class="fa-solid fa-grip"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/adminusers">
                    <i class="fa-solid fa-user"></i>
                    <span class="nav-item">Users</span>
                </a>
            </li>
            <li>
                <a href="/adminchapters">
                    <i class="fa-solid fa-house-user"></i>
                    <span class="nav-item">Chapters</span>
                </a>
            </li>
            <li>
                <a href="/logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="nav-item">Logout</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="main-content" id="dashboard-content">
        <h1 class="chapter-title">
            DASHBOARD
        </h1>
        <div class="total-container">
            <div class="total-card">
                <i class="fa-solid fa-users"></i>
                <br></br>
                <h1><span>Total Registered Alumni:</span> <strong>{{ $totalUsers }}</strong></h1>
            </div>
            <div class="total-card">
                <i class="fa-solid fa-house-user"></i>
                <br></br>
                <h1><span>Total Registered Chapters:</span> <strong>{{ $totalChapters }}</strong></h1>
            </div>
        </div>
    </div>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        var path = "{{ route('directory') }}";
        $("#searchUser").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: path,
                    type: 'GET',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#searchUser').val(ui.item.label);
                return false;
            }
        });

        let btn = document.querySelector('#btn');
        let sidebar = document.querySelector('.sidebar');
        let content = document.querySelector('.main-content')

        btn.onclick = function() {
            sidebar.classList.toggle('active');
            content.classList.toggle('active');
        }
    </script>
</body>