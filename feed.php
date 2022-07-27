<?php include 'inc/header.php'; ?>

<?php
$sql = 'SELECT * FROM post';
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<h2>News Feed</h2>
<p class="lead text-center">Catch all the latest gists</p>

<!-- if no posts -->
<?php if (empty($post)) : ?>
  <p class="lead mt-5">Psych! Nobody added any gist yet</p>
  <a href="/slime/add" class="btn btn-secondary">Make a post</a>
<?php endif; ?>

<!-- if post -->
<?php foreach ($post as $item) : ?>
  <div class="card my-3 w-75 br-5">
    <div class="d-flex justify-content-center mt-3">
      <?php $image_src = "./uploads/${item['image']}"; ?>
      <img src='<?php echo $image_src; ?>' class="card-img-top" alt="<?php echo $item['image'] ?>">
    </div>
    <div class="text-center mt-2">
      <h4><?php echo $item['title'] ?></h4>
    </div>
    <div class="card-body text-center">
      <?php echo $item['description'] ?>
      <hr>
      <div class="text-secondary mt-2">
        <?php echo "By ${item['username']}, on ${item['date']}" ?>
      </div>
      <hr>
      <div>
        <form action="./deleteHandler.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
          <input type="submit" name="delete" value="Delete Post" class="btn btn-danger">
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>
<?php include 'inc/footer.php'; ?>