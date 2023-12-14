<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/main/loginregister.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="register-body">
    <form class="login">
        <div class="inputs first">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname">
            <label for="email">Email</label>
            <input type="email" id="email">
            <label for="password">Password</label>
            <input type="password" id="password">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password">
            <small id="error" style="color:red;"></small>
            <button type="button" class="btn btn-primary" id="first-next">Next</button>
        </div>

        <div class="inputs hidden second">
            <h3>Fraternity Information</h3>
            <label for="classification">Classification</label>
            <input type="text" id="classification">
            <label for="chapter">Chapter</label>
            <input type="text" id="chapter">
            <label for="initiation_year">Initiation Year</label>
            <input type="year" id="initiation_year">
            <label for="batch_name">Batch Name</label>
            <input type="text" id="batch_name">
            <label for="baptismal_name">Baptismal Name</label>
            <input type="text" id="baptismal_name">
            <button type="button" class="btn btn-primary" id="second-next">Next</button>
            <button type="button" class="btn btn-primary" id="second-prev">Previous</button>
        </div>

        <div class="inputs hidden third">
            <h3>Ritualization Information</h3>
            <label for="ritualization_status">Ritualization Status</label>
            <input type="text" id="ritualization_status">
            <label for="ritualization_year">Ritualization Year</label>
            <input type="year" id="ritualization_year">
            <label for="ritualization_position">Position Held</label>
            <input type="text" id="ritualization_position">
            <label for="ritualization_position_year">Year</label>
            <input type="year" id="ritualization_position_year">
            <button type="button" class="btn btn-primary" id="third-next">Next</button>
            <button type="button" class="btn btn-primary" id="third-prev">Previous</button>
        </div>

        <div class="inputs hidden fourth">
            <h3>APO Alumni Association</h3>
            <label for="alumni_assoc">Alumni Association</label>
            <input type="text" id="alumni_assoc">
            <label for="assoc_position">Position Held</label>
            <input type="text" id="assoc_position">
            <label for="assoc_position_year">Year</label>
            <input type="year" id="assoc_position_year">
            <button type="button" class="btn btn-primary" id="fourth-next">Next</button>
            <button type="button" class="btn btn-primary" id="fourth-prev">Previous</button>
        </div>

        <div class="inputs hidden fifth">
            <h3>Professional Details</h3>
            <label for="employment_status">Employment Status</label>
            <input type="text" id="employment_status">
            <label for="profession">Profession/Trade/Occupation</label>
            <input type="text" id="profession">
            <label for="position">Position</label>
            <input type="text" id="position">
            <button type="submit" class="btn btn-primary" id="register">Register</button>
            <button type="button" class="btn btn-primary" id="fifth-prev">Previous</button>
        </div>

    </form>

    <!--SCRIPTS-->
    <script>
        {
            /*
                        //**********************Password And Config Password Listeners and Functions***************************

                        const password = document.querySelector("#password");
                        const confPass = document.querySelector("#confirm-password");
                        const passwordErr = document.querySelector("#password-error");
                        const confPassErr = document.querySelector("#confirmpassword-error");
                        //initialize confPass to be disabled;
                        confPass.disabled = true;

                        function validatePassword(pass) {
                            if (pass.length == 0) {
                                passwordErr.textContent = "Password field is required!";
                                return false;
                            }
                            if (pass.length < 8) {
                                passwordErr.textContent = "Password must contain at least 8 characters";
                                return false;
                            }
                            passwordErr.textContent = "";
                            return true;
                        }
                        password.addEventListener('change', () => {
                            if (password.value === "") {
                                confPass.disabled = true;
                                confPass.value = "";
                                confPass.textContent = "";
                            } else {
                                confPass.disabled = false;
                            }
                        });
                        password.addEventListener('input', () => {
                            if (password.value === "") {
                                passwordErr.textContent = "";
                            } else {
                                validatePassword(password.value);
                            }
                        });

                        function validateConfirmPassword(confPass) {
                            if (confPass.length === 0) {
                                confPassErr.textContent = "Confirm password field is required!";
                            }
                            if (confPass != password.value) {
                                confPassErr.textContent = "Both passwords do not match!";
                                return false;
                            }
                            confPassErr.textContent = "";
                            return true;
                        }
                        confPass.addEventListener('change', () => {
                            if (confPass.value === "") {
                                confPass.textContent = "";
                            } else {
                                validateConfirmPassword(confPass.value);
                            }
                        })
                        //**********************Submit listeners and functions*************************************************
                        //create listeners and function for the password and config password
                        function validateFields(fields) {
                            let result = {
                                emailField: (validateEmail(fields.email) ? true : false),
                                fullNameField: (validateFullname(fields.fullname) ? true : false),
                                passwordField: (validatePassword(fields.password) ? true : false),
                            }
                            let isValid = true;
                            for (let key in result) {
                                if (result[key] == false) {
                                    isValid = false;
                                }
                            }
                            if (isValid) {
                                addUser(fields);
                            }
                        }*/

            function addUser(fields) {
                console.log(fields);
                var csrfHeader = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                    type: 'POST',
                    url: '/register',
                    data: fields,
                    headers: {
                        'X-CSRF-TOKEN': csrfHeader
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log('User successfully registered!');
                            window.location.href = "/";
                        }
                    },
                    error: function(error) {
                        console.error("Student regisration request error: ", error);
                    }
                });
            }
            $("form").submit(function(e) {
                e.preventDefault();
                let field = {
                    fullname: "",
                    email: "",
                    password: "",
                    classification: "",
                    chapter: "",
                    initiation_year: "",
                    batch_name: "",
                    baptismal_name: "",
                    ritualization_status: "",
                    ritualization_year: "",
                    ritualization_position_year: "",
                    alumni_assoc: "",
                    assoc_position: "",
                    assoc_position_year: "",
                    employment_status: "",
                    profession: "",
                    position: "",
                };
                field.fullname = $('#fullname').val();
                field.email = $('#email').val();
                field.password = $('#password').val();
                field.classification = $('#classification').val();
                field.chapter = $('#chapter').val();
                field.initiation_year = $('#initiation_year').val();
                field.batch_name = $('#batch_name').val();
                field.baptismal_name = $('#baptismal_name').val();
                field.ritualization_status = $('#ritualization_status').val();
                field.ritualization_year = $('#ritualization_year').val();
                field.ritualization_position = $('#ritualization_position').val();
                field.ritualization_position_year = $('#ritualization_position_year').val();
                field.alumni_assoc = $('#alumni_assoc').val();
                field.assoc_position = $('#assoc_position').val();
                field.assoc_position_year = $('#assoc_position_year').val();
                field.employment_status = $('#employment_status').val();
                field.profession = $('#profession').val();
                field.position = $('#position').val();
                addUser(field);
            });

        }


        //SCRIPTS FOR FORM ANIMATIONS
        //FORMS
        const first = document.querySelector('.first');
        const second = document.querySelector('.second');
        const third = document.querySelector('.third');
        const fourth = document.querySelector('.fourth');
        const fifth = document.querySelector('.fifth');
        //NEXT BUTTONS
        const firstNext = document.getElementById('first-next');
        const secondNext = document.getElementById('second-next');
        const thirdNext = document.getElementById('third-next');
        const fourthNext = document.getElementById('fourth-next');
        const register = document.getElementById('register');
        //PREVIOUS BUTTONS
        const secondPrev = document.getElementById('second-prev');
        const thirdPrev = document.getElementById('third-prev');
        const fourthPrev = document.getElementById('fourth-prev');
        const fifthPrev = document.getElementById('fifth-prev');

        // Event listeners for Next buttons
        firstNext.addEventListener('click', () => {
            first.classList.add('hidden');
            second.classList.remove('hidden');
        });

        secondNext.addEventListener('click', () => {
            second.classList.add('hidden');
            third.classList.remove('hidden');
        });

        thirdNext.addEventListener('click', () => {
            third.classList.add('hidden');
            fourth.classList.remove('hidden');
        });

        fourthNext.addEventListener('click', () => {
            fourth.classList.add('hidden');
            fifth.classList.remove('hidden');
        });

        // Event listener for Register button
        register.addEventListener('click', () => {
            // Add your logic for the final step (if needed)
        });

        // Event listeners for Previous buttons
        secondPrev.addEventListener('click', () => {
            second.classList.add('hidden');
            first.classList.remove('hidden');
        });

        thirdPrev.addEventListener('click', () => {
            third.classList.add('hidden');
            second.classList.remove('hidden');
        });

        fourthPrev.addEventListener('click', () => {
            fourth.classList.add('hidden');
            third.classList.remove('hidden');
        });

        fifthPrev.addEventListener('click', () => {
            fifth.classList.add('hidden');
            fourth.classList.remove('hidden');
        });
    </script>
</body>

</html>