<?php include 'include/header.php'; ?>

<div class="container">
    <div class="row justify-content-center align-items-center" style="height:100vh">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <H3>MyClinic login</H3>
                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                    <form action="index.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="user" name="username" placeholder="username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="pass" name="password" placeholder="password">
                        </div>
                        <div class="g-recaptcha" data-sitekey="6LfdFP8dAAAAABBp7YSUrKQ_XWsmzZEB2VnzO6Eq"></div>
                        <button type="submit" id="btn" name="Submit" value="Submit" class="btn btn-primary">login</button>
                    </form>
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'include/footer.php'; ?>