<?php include 'inc/header.php'; ?>

<h2>Register</h2>
<p class="lead text-center">Join our community</p>

<div class="alert alert-danger" role="alert" id="error" style="display: none;">...</div>

<form class="mt-4 w-75" method="POST" id="register-form">
    <div class=" mb-3">
        <label for="username" class="form-label">Userame</label>
        <input type="text" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" id="username" name="username" placeholder="Enter your username" required>
        <div class="invalid-feedback">
            <?php echo $usernameErr; ?>
        </div>
    </div>
    <div class=" mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email" placeholder="Enter your email" required>
        <div class="invalid-feedback">
            <?php echo $emailErr; ?>
        </div>
    </div>
    <div class=" mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control <?php echo $passwordErr ? 'is-invalid' : null; ?>" id="password" name="password" placeholder="Enter your password" title="password is case sensitive, at least 6 characters long" required>
        <div class="invalid-feedback">
            <?php echo $passwordErr; ?>
        </div>
    </div>
    <div class=" mb-3">
        <label for="confirmPassword" class="form-label">confirmPassword</label>
        <input type="password" class="form-control <?php echo $confirmPasswordErr ? 'is-invalid' : null; ?>" id="confirmPassword" name="confirmPassword" placeholder="Enter your confirmPassword" required>
        <div class="invalid-feedback">
            <?php echo $confirmPasswordErr; ?>
        </div>
    </div>
    <div class=" mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="number" class="form-control <?php echo $phoneErr ? 'is-invalid' : null; ?>" id="phone" name="phone" placeholder="Enter your phone number" title="phone number begins with 0 and is 11-digits" required>
        <div class="invalid-feedback">
            <?php echo $phoneErr; ?>
        </div>
    </div>
    <div class="mb-3">
        <input type="submit" name="submit" value="Register" class="btn btn-dark text-white btn-outline-warning w-100">
    </div>
    <div class="my-3">
        <p>Already have an account? <a href="login.php" class="btn btn-info">Login</a></p>
    </div>
</form>

<?php include 'inc/jquery.php'; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#register-form").submit(function(e) {

            //prevent Default functionality
            e.preventDefault();

            var form = $(this);
            var actionUrl = form.attr('action');

            $.ajax({
                method: "POST",
                url: "handlers/registerHandler.php",
                data: form.serialize(),
                success: function(data) {
                    if (data.status == 200) {
                        window.location = "http://localhost/slime/login"
                    } else {
                        $("#error").fadeIn(500, function() {
                            $("#error").html(data.message).show();
                        })
                    }
                }
            })
        });
    });
</script>

<?php include 'inc/footer.php'; ?>