<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="apdicon.png">
    <link rel="stylesheet" href="admin/app.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Dental Feature: Patients</title>
</head>

<body>
    <div class="sidebar">
        <div class="top">
            <div class="logo">
                <i class="fa-solid fa-tooth"></i>
                <span>Mediatrix</span>
            </div>
            <i class="fa-solid fa-bars" id="btn"></i>
        </div>
        <div class="user">
            <img src="" alt="secret-user" class="user-img">
            <div class="">
                <p class="bold">Jeremiah V.</p>
                <p>Admin</p>
            </div>
        </div>
        <ul>
            <li>
                <a href="/dashboard">
                    <i class="fa-solid fa-grip"></i>
                    <span class="nav-item">Dashboard</span>
                </a>
                <span class="tooltip">Dashboard</span>
            </li>
            <li>
                <a href="/appointment">
                    <i class="fa-solid fa-file-code"></i>
                    <span class="nav-item">Appointment</span>
                </a>
                <span class="tooltip">Appointment</span>
            </li>
            <li>
                <a href="/patients">
                    <i class="fa-solid fa-newspaper"></i>
                    <span class="nav-item">Patients</span>
                </a>
                <span class="tooltip">Patients</span>
            </li>
            <li>
                <a href="/records">
                    <i class="fa-solid fa-user-secret"></i>
                    <span class="nav-item">Records</span>
                </a>
                <span class="tooltip">Records</span>
            </li>
            <li>
                <a href="/logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="nav-item">Logout</span>
                </a>
                <span class="tooltip">Logout</span>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <form action="{{ route('home') }}" method="get">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" class="form-control mb-3" placeholder="search" name="q" id="searchUser">
                    <span id="userList"></span>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="form-control mb-3" value="Search">
                </div>
            </div>
        </form>

        <table style="width: 100%;">
            <thead>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Classification</th>
                <th>Chapter</th>
                <th>Initiation Year</th>
                <th>Batch Name</th>
                <th>Baptismal Name</th>
                <th> </th>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td><img src="{{ $user->avatar }}" alt="{{ $user->fullname }}" width="50" height="50" style="border-radius: 50%"></td>
                    <td>{{ $user->fullname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->classification }}</td>
                    <td>{{ $user->chapter }}</td>
                    <td>{{ $user->initiation_year }}</td>
                    <td>{{ $user->batch_name }}</td>
                    <td>{{ $user->baptismal_name }}</td>
                    <td><a href="#" style="background: red; border-radius: 5px; padding: 5px;" data-userid="{{ $user['uid'] }}" class="delete-user"><i class="fa-solid fa-trash-can"></i> Delete </a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <center class="mt-5">
            {{ $users->withQueryString()->links() }}
        </center>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        var path = "{{ route('home') }}";
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