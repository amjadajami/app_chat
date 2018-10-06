<?php include 'head.php'; ?>
    <style>
        .message-bubble {
            padding: 10px 0px 10px 0px;
        }

        .message-bubble:nth-child(even) {
            background-color: #F5F5F5;
        }

        .message-bubble > * {
            padding-left: 10px;
        }

        .panel-body {
            padding: 0px;
        }

        .panel-heading {
            background-color: #3d6da7 !important;
            color: white !important;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="container" style="width: 1000px;">
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading"><?php echo $recepteur->getUsername(); ?> <p
                                        id="nbrMessage"><?php $nbrMessage = sizeof($conversation);
                                    echo "($nbrMessage Messages)" ?></p></div>
                            <div class="panel-body" >
                                <div class="container" id="chatMessage" style="overflow:scroll; height:80%; position: relative ; width: 1000px;">
                                    <?php if ($nbrMessage > 0) {
                                        foreach ($conversation as $conv) { ?>
                                            <div class="row message-bubble">
                                                <p class="text-muted">
                                                    <?php
                                                    echo $userService->getByid($conv->getEmetteur())->getUsername();
                                                    ?>
                                                </p>
                                                <span>
                                                <?php
                                                  echo $conv->getMessage();
                                                  ?>
                                                </span>
                                             </div>
                                        <?php }
                                    } ?>
                                </div>
                                <br/>
                                <div class="panel-footer" style="position: absolute ; bottom: 0 ; right: 0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="messageChat">
                                        <span class="input-group-btn">
                                        <button class="btn btn-default" type="button" id="btnSend">Send</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div style="overflow:scroll; height:100%;">
                    <a href="http://localhost/testmvc/index.php/dashboard" class="btn btn-info btn-lg ">
                        <span class="glyphicon glyphicon-align-right"></span> dashboard
                    </a>
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
                                    <a href="http://localhost/testmvc/index.php/chat?recepteur=<?php echo $user->getId(); ?>"><?php echo $user->getUsername(); ?></a>
                                </li>
                            <?php } ?>

                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php include 'scripte.php'; ?>
    <script>
        $(document).ready(function () {
            var $t = $('#chatMessage');
            $t.scrollTop(1E10);
            setInterval(refreshconversation, 10000);
            function refreshconversation() {
                var emetteur = <?php echo $userConnect->getId();?> ;
                var recepteur = <?php echo $recepteur->getId();?> ;
                var url = "http://localhost/testmvc/index.php/refreshconversation"
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {emetteur: emetteur, recepteur: recepteur},
                    dataType: "json",
                    success: function (result) {
                        $("#chatMessage").html("");
                        var html = "";
                        var nbrMessage = 0;
                        result.forEach(function (obj) {
                            html += "<div class='row message-bubble'> <p class='text-muted'>" + obj.emetteur + "</p><span>" + obj.message + "</span></div>";
                            nbrMessage = nbrMessage + 1;
                        });
                        $("#chatMessage").html(html);
                        $("#nbrMessage").html("(" + nbrMessage + " Messages)");
                        var $t = $('#chatMessage');
                        $t.scrollTop(1E10);
                    }
                });
            }

            $("#btnSend").click(function () {
                var message = $("#messageChat").val();
                var emetteur = <?php echo $userConnect->getId();?> ;
                var recepteur = <?php echo $recepteur->getId();?> ;
                $("#messageChat").val('');
                var url = "http://localhost/testmvc/index.php/addmessage"
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {message: message, emetteur: emetteur, recepteur: recepteur},
                    dataType: "json",
                    success: function (result) {
                        $("#chatMessage").html("");
                        var html = "";
                        var nbrMessage = 0;
                        result.forEach(function (obj) {
                            html += "<div class='row message-bubble'> <p class='text-muted'>" + obj.emetteur + "</p><span>" + obj.message + "</span></div>";
                            nbrMessage = nbrMessage + 1;
                        });
                        $("#chatMessage").html(html);
                        $("#nbrMessage").html("(" + nbrMessage + " Messages)");
                        var $t = $('#chatMessage');
                        $t.scrollTop(1E10);
                    }
                });
            });
        });
    </script>
<?php include 'footer.php'; ?>