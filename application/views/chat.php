<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Dashboard 2</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="<?php echo base_url('assets/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo base_url('assets/'); ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="pages/widgets.html" class="nav-link active">
                                <i class="nav-icon fas fa-comments"></i>
                                <p>
                                    Chat
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Chat</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Chat</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-- /.card -->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- DIRECT CHAT -->
                            <div class="card direct-chat direct-chat-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Public Chat</h3>
                                    <div class="card-tools">
                                        <span id="status-ws" class="right badge badge-danger">Inactive</span>
                                        <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge badge-warning">3</span> -->
                                        <button id="btn-reconnect" type="button" class="btn btn-tool">Reconnect</button>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        <!-- <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fas fa-comments"></i></button> -->
                                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i> -->
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="attachment-block clearfix">
                                        <form id="form-login" action="#" method="post">
                                            <div class="input-group input-group-sm">
                                                <input id="input-username" type="text" autocomplete="off" name="username" placeholder="Username..." class="form-control">
                                                <span class="input-group-append">
                                                    <button type="submit" class="btn btn-info">Send</button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="direct-chat-messages">

                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <form id="form-message" action="#" method="post">
                                        <div class="input-group input-group-sm">
                                            <input id="input-message" type="text" autocomplete="off" name="message" placeholder="Message..." class="form-control">
                                            <span class="input-group-append">
                                                <button type="submit" class="btn btn-info">Send</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!--/.direct-chat -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!--/. container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.5
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/'); ?>dist/js/adminlte.js"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url('assets/'); ?>plugins/chart.js/Chart.min.js"></script>
    <script>
        var urlSocket = 'ws://localhost:8282';
        var conn = new WebSocket(urlSocket);
        var msgContainer = $('.direct-chat-messages');
        var statusWs = $('#status-ws');
        var formMsg = $('#form-message');
        var inputMsg = $('#input-message');
        var formLogin = $('#form-login');
        var inputUsrnm = $('#input-username');
        var btnRecon = $('#btn-reconnect');
        var client = {
            username: null,
            channel: '<?php echo $channel ?? 'public'; ?>',
            type: 'join',
            message: null
        };


        btnRecon.hide();
        btnRecon.click(function() {
            conn = new WebSocket(urlSocket);
            startSocket();
        })
        startSocket();

        formLogin.submit(function(e) {
            e.preventDefault();
            var username = inputUsrnm.val();
            if (username) {
                inputUsrnm.prop('disabled', true);
                client.type = 'join';
                client.username = username;
                conn.send(JSON.stringify(client));
            }
        })

        formMsg.submit(function(e) {
            e.preventDefault();
            if (client.username) {
                client.type = 'chat';
                client.message = inputMsg.val();
                inputMsg.val('');
                if (client.message) {
                    conn.send(JSON.stringify(client));
                }
            } else {
                addSystemMessage('danger', 'login first');
                scrollContainer();
            }
        });

        function now() {
            var dt = new Date();
            return dt.getHours().toString().padStart(2,'0') + ":" + dt.getMinutes().toString().padStart(2,'0');
        }

        function toggleStatus(status = false) {
            if (status) {
                statusWs.removeClass('badge-danger');
                statusWs.addClass('badge-success');
                statusWs.html('Active');
            } else {
                statusWs.removeClass('badge-success');
                statusWs.addClass('badge-danger');
                statusWs.html('Inactive');
            }
        }

        function messageHtml(from = '', msg = '', at = '', isYou = false) {
            return '<div class="direct-chat-msg ' + (isYou ? 'right' : '') + '">' +
                '<div class="direct-chat-infos clearfix">' +
                '<span class="direct-chat-name ' + (isYou ? 'float-right' : 'float-left') + '">' + from + '</span>' +
                '<span class="direct-chat-timestamp ' + (isYou ? 'float-left' : 'float-right') + '">' + at + '</span>' +
                '</div>' +
                '<img class="direct-chat-img" src="<?php echo base_url('assets/'); ?>dist/img/avatar.png" alt="message user image">' +
                '<div class="direct-chat-text">' +
                msg +
                '</div>' +
                '</div>';
        }

        function systemMsg(type = 'success', msg = '') {
            return '<div class="text-center text-xs text-' + type + '">' + msg + '</div>';
        }

        function print(msg) {
            console.log(msg);
        }

        function addSystemMessage(type, msg) {
            msgContainer.append(systemMsg('gray', '<small>' + now() + '</small>'));
            msgContainer.append(systemMsg(type, msg));
            scrollContainer();
        }

        function addMessage(msg) {
            msgContainer.append(msg);
            scrollContainer();
        }

        function scrollContainer() {
            var height = msgContainer.prop('scrollHeight');
            msgContainer.animate({
                scrollTop: height
            }, 100);
        }


        function startSocket() {
            scrollContainer();
            conn.onclose = function(e) {
                print(e);
                btnRecon.show();
                toggleStatus(false);
                inputMsg.prop('disabled', true);
                inputUsrnm.prop('disabled', true);
                addSystemMessage('danger', 'websocket is offline');
            }

            conn.onopen = function(e) {
                btnRecon.hide();
                toggleStatus(true);
                inputMsg.prop('disabled', false);
                inputUsrnm.prop('disabled', false);
                addSystemMessage('success', 'connected to websocket');
            }

            conn.onmessage = function(e) {
                var data = JSON.parse(e.data);
                if (data.type == 'join') {
                    if (client.username == data.username) {
                        addSystemMessage('success', 'Joinned as "' + data.username + '"');
                    } else {
                        addSystemMessage('success', '"' + data.username + '" Joinned Channel');
                    }
                }
                if (data.type == 'leave') {
                    if (client.username == data.username) {
                        // addSystemMessage('success', '');
                    } else {
                        addSystemMessage('danger', '"' + data.username + '" Leaved Channel');
                    }
                }
                if (data.type == 'chat') {
                    if (client.username == data.username) {
                        addMessage(messageHtml(data.username, data.message, now(), true));
                    } else {
                        addMessage(messageHtml(data.username, data.message, now(), false));
                    }
                }
            }

            conn.onerror = function(e) {
                inputMsg.prop('disabled', true);
                inputUsrnm.prop('disabled', true);
                addSystemMessage('danger', 'could not connect to websocket');
            }
        }
    </script>
</body>

</html>