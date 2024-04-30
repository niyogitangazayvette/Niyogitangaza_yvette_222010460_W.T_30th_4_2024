<?php
include 'header.php';
$houses = OHSMS::getAvailableHouses();
?>

<!-- Blogs section -->
<div class="about-section">
  <div class="section-title">
    <h2>My Latest Houses</h2>
  </div>
  <section id="Blog" class="container">
    <div class="row">
      <?php
      $count = 0;
      foreach ($houses as $house) {
        if ($count % 3 == 0) {
          echo '</div><div class="row">';
        }
        ?>
        <div class="col-md-4 mb-4">
          <div class="blog">
            <div class="blog_image" style="width: 100%; height: 200px; overflow: hidden;">
              <?php if (file_exists("../Administrator/" . $house['pic'])) : ?>
                <img src="<?php echo "../Administrator/" . $house['pic']; ?>" class="img-fluid rounded" style="width: 100%; height: 100%; object-fit: cover;" alt="Blog" />
              <?php else : ?>
                <div style="height: 100%; background-color: #ccc;"></div>
              <?php endif; ?>
            </div>
            <div class="blog_body">
              <div>
                <p class="author"><label><b>Owner: </b></label><?php echo $house['name']; ?></p>
              </div>
              <div>
                <h3 class="blog_title"><label><b>UPI: </b></label><?php echo $house['upiNumber']; ?></h3>
              </div>
              <div>
                <p class="blog_desc"><label><b>Detail: </b></label><?php echo $house['description']; ?> <b>House Location: </b><?php echo $house['location']; ?></p>
              </div>
              <div>
                <p class="price"><label><b>Price: </b></label><?php echo "$" . $house['price']; ?></p>
              </div>
              <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#buyModal<?php echo $house['house_id']; ?>" style="height: 25px; padding: 2px; font-size: 12px; width:100px; margin-top: 0px;">Buy Now</button>
              </div>
            </div>
          </div>
        </div>
      <?php
        $count++;
      }
      ?>
    </div>
  </section>
</div>

<!-- Modals -->
<?php foreach ($houses as $house) : ?>
  <div class="modal fade" id="buyModal<?php echo $house['house_id']; ?>" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="buyModalLabel">Buy House</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="../Administrator/server.php">
          <div class="modal-body">
            <!-- House details will be displayed here -->
            <p><b>House UPID: </b><?php echo $house['upiNumber']; ?></p>
            <p><b>House Price: </b><?php echo $house['price']; ?></p>
            <p><b>House Location: </b><?php echo $house['location']; ?></p>
            <input type="hidden" name="orderIdBuy" value="<?php echo $house['house_id']; ?>">
            <input type="hidden" name="price" value="<?php echo $house['price']; ?>">
            <!-- Add more details here as needed -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-sm">Buy</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?php include 'footer.php'; ?>
