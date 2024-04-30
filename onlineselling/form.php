<?php
// Include the header file
include 'header.php';
?>

<div class="container mt-4">
    <h2>Buyer Registration Form</h2>
    <form action="Administrator/server.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="mobileNumber">Mobile Number</label>
                    <input type="text" class="form-control" id="mobileNumber" placeholder="Enter your mobile number" name="mobileNumber" required>
                </div>
                <div class="form-group">
                    <label for="securityQuestion">Security Question</label>
                    <select class="form-control" id="securityQuestion" name="securityQuestion" required>
                        <option value="" selected disabled>Select a security question</option>
                        <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value="What city were you born in?">What city were you born in?</option>
                        <option value="What is the name of your first pet?">What is the name of your first pet?</option>
                        <!-- Add more options as needed -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="answer">Answer</label>
                    <input type="text" class="form-control" id="answer" placeholder="Enter the answer" name="answer" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Enter your address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" placeholder="Enter your city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" placeholder="Enter your state" name="state" required>
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" placeholder="Enter your country" name="country" required>
                </div>
            </div>
            <input type="hidden" name="role" value="buyer">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary" name="register">Register</button>
            </div>
        </div>
    </form>
</div>
