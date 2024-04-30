 <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="Administrator/server.php" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="loginEmail">Email</label>
                                    <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Enter your email" required>
                                </div>
                                <div class="form-group">
                                    <label for="loginPassword">Password</label>
                                    <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Enter your password" required>
                                </div>
                                <div class="form-group">
                                    <label for="loginRole">Role</label>
                                    <select class="form-control" id="loginRole" name="role" required>
                                        <option value="">Select your role</option>
                                        <option value="seller">Seller</option>
                                        <option value="buyer">Buyer</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="login">Login</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <!-- Admin Login Modal -->
<div class="modal fade" id="AdminloginModal" tabindex="-1" role="dialog" aria-labelledby="AdminloginModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AdminloginModalLabel">Admin Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="Administrator/server.php" method="POST">
          <div class="form-group">
            <label for="adminUsername">Username</label>
            <input type="text" class="form-control" id="adminUsername" name="adminUsername" required>
          </div>
          <div class="form-group">
            <label for="adminPassword">Password</label>
            <input type="password" class="form-control" id="adminPassword" name="adminPassword" required>
          </div>
          <input type="hidden" name="role" value="administrator">
          <button type="submit" class="btn btn-primary" name="adminlogin" value="adminLogin">Login</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>