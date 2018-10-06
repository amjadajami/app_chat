<?php include 'head.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <?php if ($cnx == 1) { ?>
                    <div class="alert alert-success">
                        <strong>premiere connexion ^^ </strong> merci pour votre inscription.
                    </div>
                <?php } ?>
                <h1>USERNAME : <?php echo $_SESSION['user']->getUsername(); ?></h1>
                <h1>Mes Conversations (<?php echo sizeof($conversations); ?>)</h1>
                <div class="list-group">
                    <?php if (sizeof($conversations) > 0) { ?>
                        <?php
                        foreach ($conversations as $conversation) { ?>
                            <?php
                            if ($conversation->getEmetteur() == $_SESSION['user']->getId()) { ?>
                                <a href="http://localhost/testmvc/index.php/chat?recepteur=<?php echo $conversation->getRecepteur() ?>"
                            <?php } else { ?>
                                <a href="http://localhost/testmvc/index.php/chat?recepteur=<?php echo $conversation->getEmetteur() ?>"
                            <?php } ?>
                               class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">
                                        <?php
                                        if ($conversation->getEmetteur() == $_SESSION['user']->getId()) {
                                            echo $userService->getByid($conversation->getRecepteur())->getUsername();
                                        } else {
                                            echo $userService->getByid($conversation->getEmetteur())->getUsername();
                                        }
                                        ?>
                                    </h5>
                                    <small class="text-muted">
                                        <?php
                                        echo $conversation->getDate();
                                        ?>
                                    </small>
                                </div>
                                <p class="mb-1">
                                    <?php
                                    echo $conversation->getMessage();
                                    ?>
                                </p>
                            </a>
                        <?php } ?>
                    <?php } ?>

                </div>
            </div>
            <div class="col-md-3">
                <div style="overflow:scroll; height:100%;">
                    <a href="http://localhost/testmvc/index.php/logout" class="btn btn-info btn-lg ">
                        <span class="glyphicon glyphicon-log-out"></span> Log out
                    </a>

                    <h1>Mes amis </h1>
                    <ul class="list-group">
                        <?php foreach ($users as $user) { ?>
                            <?php if ($user->getIsConnect() == 1) { ?>
                                <li class="list-group-item list-group-item-success">
                                    <a href="http://localhost/testmvc/index.php/chat?recepteur=<?php echo $user->getId(); ?>"><?php echo $user->getUsername(); ?>
                                        (connecte)</a>
                                </li>
                            <?php } else { ?>
                                <li class="list-group-item list-group-item-primary">
                                    <a href="http://localhost/testmvc/index.php/chat?recepteur=<?php echo $user->getId(); ?>"><?php echo $user->getUsername(); ?>
                                    (non connecte)</a>
                                </li>
                            <?php } ?>

                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php include 'scripte.php'; ?>
    <script></script>
<?php include 'footer.php'; ?>