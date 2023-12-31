<!-- Head -->
<?php require 'partials/head.php'; ?>

<!-- Header -->
<?php require 'partials/header.php';?>

    <?php 
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit();
        } 
    ?>

    <!-- Main -->
    <main>
        <div class="main-container-login">
            <form method="post" action="login.php" class="login-form">
                <h1 class="header-text-login">Login Now</h1>
                <div class="container-user-password">
                    <div class="user-with-icon">
                        <label for="username"><i class="fa-solid fa-user icon" style="color: #323352;"></i></label>
                        <input type="text" id="username" name="username" placeholder="Username" class="username-style">
                    </div>
                    <div class="password-with-icon">
                        <label for="password"><i class="fa-solid fa-lock" style="color: #323252;"></i></label>
                        <input type="password" id="password" name="password" placeholder="Password" class="password-style">
                        <i class="fa-solid fa-eye-slash"></i>
                        <!-- <i class="fa-solid fa-eye"></i> -->
                    </div>  
                </div>
                <div class="container-remember-forgot">
                    <!-- <div class="container-remember">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div> -->
                    <a class="<?= ($_SERVER['REQUEST_URI'] == '/forgot-password' ? 'active' : ''); ?>" href="/forgot-password">Forgot password</a>
                </div>
                <input type="submit" name="login" value="Login" class="submit-style">
                <p class="not-a-member">Not a member? <a class="<?= ($_SERVER['REQUEST_URI'] == '/sign-up' ? 'active' : ''); ?>" href="/sign-up">Sign up</a></p>
            </form>
        </div>
    </main>

<!-- Footer -->
<?php require 'partials/footer.php';?>