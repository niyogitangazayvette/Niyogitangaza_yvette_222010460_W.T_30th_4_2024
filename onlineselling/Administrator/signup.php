<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registrationModal">
  Register User
</button>

<!-- The Modal -->
<div class="modal fade" id="registrationModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">User Registration Form</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
        <form action="register_user.php" method="post" class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Name" name="name" required>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Mobile Number" name="mobileNumber" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Security Question" name="securityQuestion" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Answer" name="answer" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Address" name="address" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="City" name="city" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="State" name="state" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Country" name="country" required>
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
