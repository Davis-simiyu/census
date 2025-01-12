<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <script type="text/javascript">
        function displayAlert(){
            alert("Login successful");
        }
    </script>
    <?php include_once 'dbhinc.php'; ?>
    <link rel="stylesheet" href="styleregister.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="form-container">
        <form action="" method="post">
            <h3>Login now</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <span></span>
            <input type="submit" name="submit" id="sweetalert2" value="login now" class="form-btn" onclick="displayAlert()" action="admin_dashboard.html">
            <!-- <script>
                
                document.getElementById('sweetalert2').addEventListener('click',function(){
                    Swal.fire('');
                })
            </script> -->
            <p>Don't have an account?<a href="register.php"> Register now</a></p>
            
        </form>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');
        togglePassword.addEventListener('click', function (e) {
            const type = password_get_Attribute('typr') === 'password' ? 'text' : 'password';
            password.SetAttribute('type', type);
            this.classList.toggle('');
        })
    </script>
</body>
</html>