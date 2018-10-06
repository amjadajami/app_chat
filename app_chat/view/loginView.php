<?php include 'head.php'; ?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="wrapper">
                <form class="form-signin" action="http://localhost/testmvc/index.php/authentification" method="post">
                    <h2 class="form-signin-heading">Please login</h2>
                    <input type="text" class="form-control" name="username" placeholder="Username" required=""
                           autofocus=""/>
                    <input type="password" class="form-control" name="mdp" placeholder="Password" required=""/> <br/>
                    <input type="hidden" name="token" value="<?php echo $token; ?>"/>
                    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'scripte.php'; ?>
<script></script>
<?php include 'footer.php'; ?>
