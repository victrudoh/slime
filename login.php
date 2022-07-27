<?php include 'inc/header.php'; ?>

<h2>Login</h2>
<p class="lead text-center">Welcome back, it's been a minute</p>

<div class="alert alert-danger" role="alert" id="error" style="display: none;">...</div>

<form class="mt-4 w-75" id="login-form" name="login_form" role="form" style="display: block;" method="post">
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
    <div class="mb-3">
        <input type="submit" name="submit" value="Login" class="btn btn-dark text-white btn-outline-warning w-100 login">
    </div>
</form>

<?php include 'inc/jquery.php'; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#login-form").submit(function(e) {

            //prevent Default functionality
            e.preventDefault();

            var form = $(this);
            var actionUrl = form.attr('action');

            $.ajax({
                method: "POST",
                url: "handlers/loginHandler.php",
                data: form.serialize(),
                success: function(data) {
                    if (data.status == 200) {
                        location.href = "http://localhost/slime/feed"
                    } else {
                        $("#error").fadeIn(1000, function() {
                            $("#error").html(data.message).show();
                        })
                    }
                }
            })
        });
    });
</script>


<?php include 'inc/footer.php'; ?>