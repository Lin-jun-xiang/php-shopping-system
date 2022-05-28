<!DOCTYPE html>
<html lang="zh-Hant">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="robots" content="index, follow">
        <meta name="description" content="">
        <meta name="author" content="Jimmy Lin">
        <title>Register</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <base target="_self">
    </head>
    <body>
        <div class="container vh-100">
                <div class="row justify-content-center align-items-center h-100">
                    <div class="card w-25">
                        <div class="card-header text-center">
                            Sign Up
                        </div>
                        <div class="card-body">
                            <form action="../includes/register.inc.php" method="post">
                                <div class="form-group">
                                    <input type="username" name="username" class="form-control form-control-sm" placeholder="Username">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control form-control-sm" placeholder="Email">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control form-control-sm" placeholder="Password">
                                </div>
                                <br>
                                <div class="form-group">
                                    <input type="password"  name="rePassword" class="form-control form-control form-control-sm" placeholder="Retype password">
                                </div>
                                <br/>
                                <input type="submit" name="submit" class="btn btn-primary w-100" value="Register">
                                <br><br/>
                                <a href="login.php" style="text-decoration: none;">Already have account</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
