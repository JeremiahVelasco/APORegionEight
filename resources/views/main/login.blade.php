<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/main/loginregister.css">
    <title>Alpha Phi Omega - Region 8</title>
    <link rel="icon" href="APO SEAL.png">
</head>

<body>
    <form action="" class="login">
        <img src="APO SEAL.png" alt="APO SEAL" width="200" height="200">
        <h1>Login</h1>
        <div class="inputs">
            <label for="email">Email</label>
            <input type="email" id="email">
            <label for="password">Password</label>
            <input type="password" id="password">
            <small id="error" style="color:red;"></small>
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>

    <!--SCRIPTS-->
    <script>
        //*******************************Student Id Listeners and Functions*********************************************************

        const email = document.querySelector("#email");
        email.addEventListener('keypress', (event) => {
            var letters = /^[A-Za-z]+$/;
            if (event.keyCode == 8 || event.keyCode == 13) {
                return true;
            }
            if (letters.test(event.key)) {
                event.preventDefault();
                return false;
            }
        })
        //********************************Form Validations**************************************************************************
        function validateEmail(email) {
            if (email.length == 0) {
                $("#error").text("Please Fill in The Fields!");
                return false;
            }
            return true;
        }

        function validatePassword(password) {
            if (password.length == 0) {
                $("#error").text("Please Fill in The Fields!");
                return false;
            }
            return true;
        }

        function formHandler(field) {
            const forms = {
                'email': validateEmail(field.email),
                'password': validatePassword(field.password)
            };
            if (forms.email && forms.password) {
                checkProfile(field);
            }
        }
        //*******************************Form Listeners and Functions***************************************************************
        function checkProfile(field) {
            $.ajax({
                type: "POST",
                url: "/login",
                data: {
                    'email': field.email,
                    'password': field.password
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response.data);
                        if (response.role === "admin") {
                            window.location.href = "/admindashboard";
                        } else {
                            window.location.href = "/home";
                        }
                    } else {
                        $("#error").text("Incorrect Credentials!");
                    }
                },
                error: function(error) {
                    console.error("Alumni Login Request Error:", error)
                }
            });
        }
        $("form").submit(function(e) {
            e.preventDefault();
            let field = {
                email: "",
                password: ""
            };
            field.email = $("#email").val();
            field.password = $("#password").val();
            formHandler(field);
        });
    </script>
</body>

</html>