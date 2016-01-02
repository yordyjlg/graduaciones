
    <link rel="stylesheet" href="<?= base_url() ?>css/slider.css" type="text/css" media="screen">
    
    <div class="bs-docs-grid">
      <div class="row show-grid">
          <div class="col-xs-12 col-sm-8 col-md-8 ">
            <div class="flex-container">
                <div class="flexslider">
                    <ul class="slides">
                        <li>
                            <img src="<?= base_url() ?>images/logogra.jpg" alt="" title="<strong>Empresa Graduaciones Esmeralda C.A</strong><span></a></span>"></a>
                        </li>

                        <li>
                            <img src="<?= base_url() ?>images/album.jpg" alt="" title="<strong>Álbumes</strong><span></a></span>">
                        </li>
                        <li>
                            <img src="<?= base_url() ?>images/ve.jpg" alt="" title="<strong>CD</strong><span></a></span>">
                        </li>
                        <li>
                            <img src="<?= base_url() ?>images/botones.jpg" alt="" title="<strong>Botones con logo y vitrificado</strong><span></a></span>">
                        </li>
                        <li>
                            <img src="<?= base_url() ?>images/medallas.jpg" alt="" title="<strong>Medallas</strong><span></a></span>">
                        </li>
                    </ul>
                </div>
            </div>
          </div>
          
        <div class="clearfix visible-xs-block"></div>
      </div>
    </div>
        
<script type="text/javascript" src="<?= base_url() ?>js/jquery-1.6.js" ></script>
<script type="text/javascript" src="<?= base_url() ?>js/jquery.flexslider-min.js" ></script>   
		

	<script type="text/javascript">
$(document).ready(function () {
	$('.flexslider').flexslider({
		animation: 'fade',
		controlsContainer: '.flexslider'
	});
});
        </script>