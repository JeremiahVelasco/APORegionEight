<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="apdicon.png">
    <link rel="stylesheet" href="main/directory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Alpha Phi Omega - Region 8</title>
    <link rel="icon" href="APO SEAL.png">
</head>

<body>
    <div class="main-content">
        <nav>
            <div class="logo">
                <img src="APO SEAL.png" alt="">
                <h1>Alpha Phi Omega | Region 8</h1>
            </div>
            <ul class="nav-links">
                <li><a href="/home"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="/directory"><i class="fa-solid fa-address-book"></i> Alumni Directory</a></li>
                <li><a href="/profile"><i class="fa-solid fa-user"></i> My Profile</a></li>
                <li><a href="/logout" id="logout"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
            </ul>
        </nav>
        <form action="{{ route('directory') }}" method="get">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" class="form-control mb-3" placeholder="Search Alumni" name="q" id="searchUser">
                    <span id="userList"></span>
                    <select name="industry" id="industry">
                        <option value="default">Select Industry</option>
                        <option value="tech">Tech</option>
                        <option value="medical">Healthcare</option>
                        <option value="finance">Finance</option>
                        <option value="education">Education</option>
                        <option value="engineering">Engineering</option>
                        <option value="law">Law and Legal Services</option>
                        <option value="media">Media and Communication</option>
                    </select>
                    <button id="searchBtn" type="submit" class="form-control mb-3" value="Search">Search</button>
                </div>
            </div>

        </form>

        <table style="width: 100%;">
            <thead>
                <th>Image</th>
                <th>Name</th>
                <th>Classification</th>
                <th>Chapter</th>
                <th>Initiation Year</th>
                <th>Batch Name</th>
                <th>Baptismal Name</th>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td><img src="{{ $user->avatar }}" alt="{{ $user->fullname }}"></td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->classification }}</td>
                    <td>{{ $user->chapter }}</td>
                    <td>{{ $user->initiation_year }}</td>
                    <td>{{ $user->batch_name }}</td>
                    <td>{{ $user->baptismal_name }}</td>
                </tr>
                @endforeach
            </tbody>
            <!--
            <center class="mt-5">
                {{ $users->withQueryString()->links() }}
            </center>-->
        </table>
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