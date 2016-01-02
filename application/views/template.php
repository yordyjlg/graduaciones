
<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Graduaciones Esmeralda C.A.</title>
		<meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link href="<?= base_url() ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
                <link href="data:text/css;charset=utf-8," data-href="<?= base_url() ?>bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" id="bs-theme-stylesheet">
                
                
                <link rel="stylesheet" href="<?= base_url() ?>css/style.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?= base_url() ?>css/style_menu1.css" type="text/css" media="screen">
                <!--[if lt IE 9]><script src="../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
                <script src="<?= base_url() ?>bootstrap/js/ie-emulation-modes-warning.js"></script>
                <!-- Placed at the end of the document so the pages load faster -->
                
                
                
    </head>
    <body id="cuerpo">
    

    <header class="container-fluid" style="background:#151515">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <img src="<?= base_url() ?>img/barner.png" style="width:100%">
        </div>
    </header>
    <div class="body1">
        <div class="main">
            <header>
                <?php $this->load->view($menu); ?>
            </header>
        </div>
    </div>
    <div class="container-fluid" id="content">
        <?php $this->load->view($contenido); ?>
    </div> 



    <!--<script>
      window.twttr = (function (d,s,id) {
        var t, js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.async=1;
        js.src="<?//= base_url() ?>bootstrap/jswidgets.js"; fjs.parentNode.insertBefore(js, fjs);
        return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
      }(document, "script", "twitter-wjs"));
    </script> -->
                <script src="<?= base_url() ?>bootstrap/js/docs.min.js"></script>
                <script src="<?= base_url() ?>bootstrap/js/ie10-viewport-bug-workaround.js"></script>
                <script src="<?= base_url() ?>js/url.js"></script>

    </body>

</html>