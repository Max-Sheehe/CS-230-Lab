<?php
require "includes/header.php"
?>

<main>
    <link rel="stylesheet" href="../css/signup.css">
    <div class="bg-cover">
        <div class="h-100 container center-me">
            <div class="my-auto">
                <div class="signup-form">

                    <form action="includes/signup-helper.php" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">Please sign up</h1>
                        <p class="hint-text">Create your account!</p>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" name="fname" placeholder="First Name"
                                        required autofocus>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" name="lname" placeholder="Last Name"
                                        required autofocus>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="uname" placeholder="Userame" required autofocus>

                        <label for="inputEmail" class="sr-only">Email address</label>
                        <input type="email" id="inputEmail" class="form-control" name="email"
                            placeholder="Email address" required autofocus>

                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" class="form-control" name="pwd" placeholder="Password"
                            required>

                        <label for="inputPassword" class="sr-only">Confirm Password</label>
                        <input type="password" id="inputPassword" class="form-control" name="con-pwd"
                            placeholder="Confirm Password" required>

                        <button class="btn btn-lg btn-outline-info btn-block" name="signup-submit" type="submit">Sign
                            in</button>
                        <p class="mt-5 mb-3 text-muted">&copy; 2020-2100</p>
                    </form>

                </div>
            </div>
        </div>
    </div>


</main>