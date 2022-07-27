<?php include 'inc/header.php';  ?>


<h2>Add Post</h2>
<p class="lead text-center">Share your juicy gossip</p>
<?php
if (!empty($_SESSION['message'])) {
  echo $_SESSION['message'];
  $_SESSION['message'] = '';
}
?>
<!-- <form action="./submitHandler.php" class="mt-4 w-75" method="POST" enctype="multipart/form-data"> -->
<form class="mt-4 w-75" method="POST" enctype="multipart/form-data" id="addPost-form" name="addPost-form" role="form">
  <div class=" mb-3">
    <label for="username" class="form-label">Userame</label>
    <input type="text" class="form-control <?php echo $usernameErr ? 'is-invalid' : null; ?>" id="username" name="username" placeholder="Enter your username">
    <div class="invalid-feedback">
      <?php echo $usernameErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control <?php echo $titleErr ? 'is-invalid' : null; ?>" id="title" name="title" placeholder="Enter your title">
    <div class="invalid-feedback">
      <?php echo $titleErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control <?php echo $descriptionErr ? 'is-invalid' : null; ?>" id="description" name="description" placeholder="Enter description"></textarea>
    <div class="invalid-feedback">
      <?php echo $descriptionErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control <?php echo $imageErr ? 'is-invalid' : null; ?>" id="image" name="image" placeholder="Enter your image">
    <div class="invalid-feedback">
      <?php echo $imageErr; ?>
    </div>
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="Post" class="btn btn-dark w-100">
  </div>
</form>

<?php include 'inc/jquery.php'; ?>

<script type="text/javascript">
  $(document).ready(function() {
    $("#addPost-form").submit(function(e) {

      //prevent Default functionality
      e.preventDefault();

      var form = $(this);
      var actionUrl = form.attr('action');

      $.ajax({
        method: "POST",
        url: "handlers/addPostHandler.php",
        // type: "multipart/form-data",
        // data: form.serialize(),


        data: new FormData($('#addPost-form')[0]),
        processData: false,
        contentType: false,


        success: function(data) {
          if (data.status == 200) {
            // location.href = "http://localhost/slime/feed"
            console.log("response: ", data);
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