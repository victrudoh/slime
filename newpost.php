<?php include 'inc/header.php'; ?>

<h2>Add Post</h2>
<p class="lead text-center">Share your juicy gossip</p>

<div class="alert alert-danger" role="alert" id="error" style="display: none;">...</div>

<form class="mt-4 w-75" id="newPost-form" name="newPost_form" role="form" style="display: block;" method="post">
    <div class=" mb-3">
        <input type="hidden" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username'] ?>" required>
    </div>
    <div class=" mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Enter post title" required>
    </div>
    <div class=" mb-3">
        <label for="description" class="form-label">description</label>
        <textarea class="form-control" name="description" id="description" placeholder="Enter post description"></textarea>
    </div>
    <div class=" mb-3">
        <label for="file" class="form-label">Add image</label>
        <input type="file" class="form-control" id="file" name="file" placeholder="Select an image">
    </div>
    <div class="mb-3">
        <input type="submit" name="submit" value="Post" class="btn btn-dark text-white btn-outline-warning w-100">
    </div>
</form>

<?php include 'inc/jquery.php'; ?>

<script type="text/javascript">
    $(document).ready(function() {
        $("#newPost-form").submit(function(e) {

            //prevent Default functionality
            e.preventDefault();

            var fd = new FormData();
            var form = $(this);

            // username
            var username = $("input#username").val();
            fd.append('username', username);

            // title
            var title = $("input#title").val();
            fd.append('title', title);

            // description
            var description = $("textarea#description").val();
            fd.append('description', description);


            var files = $('#file')[0].files;
            fd.append('file', files[0]);

            $.ajax({
                method: "POST",
                url: "handlers/newPostHandler.php",
                data: fd,
                contentType: false,
                processData: false,
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