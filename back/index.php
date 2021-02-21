<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>La Colmena</title>
<link rel="stylesheet" href="css/styles.css" type="text/css" />

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.pack.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>

</head>
<body>
<div id="container">
<div id="inner">

    <?php include("header.php") ?>
    <div id="banner">
    
         <div id="slider-wrapper">        
            <div id="slider" class="nivoSlider">
                <img src="images/slide1.jpg" alt="" style="width:960px;height:250px;" />
                <img src="images/slide2.jpg" alt="" style="width:960px;height:250px;" />
                <img src="images/slide3.jpg" alt="" style="width:960px;height:250px;" />
                
            </div>
                
        </div> 
       
    </div>    
	<div class="welcome-bar">
		<div class="bar-top">
			<div class="bar-title">
				<h3>Nuestros cirios son elaborados con cera de abeja y el proceso de elaboración es 100% a mano. También contamos con velas decorativas y veladoras a la Santísima Providencia. </h3>
			</div><!--/ bar-titlte-->
			<div class="bar-button">
				<a class="button medium" href="#">Leer Más</a>
			</div><!--/ bar-button-->
			<div class="clear"></div>
		</div><!--/bar-top-->	
	</div>
    
    <div id="content-bottom">
        <div class="content-bottom-inner">
            <ul>
            	<li>
   	                <h4>Acerca de La Colmena</h4></li>
                <li><img src="images/acerca.jpg" alt="image1" style="width:270px;height:320px" /></li>
                <li>Tenemos más de 68 años en el mercado, nuestros cirios son elaborados con cera de abeja y contamos con productos de las más alta calidad. </li>
                <li><a href="acerca.php">Ver más</a></li>
            </ul>
            
            <ul>
            	<li>
            	  <h4>Cirios de Pascua</h4></li>
                <li><img src="images/cirios.jpg" alt="image2" style="width:270px;height:320px" /></li>
                <li>Los cirios de Pascua son dedicados a la Ceremonia del Sábado Santo. Contamos con más de 16 tamaños y diferentes tipos de decorado. </li>
                <li><a href="catalogoCategoria.php?id=1">Ver más</a></li>
            </ul>
            
            <ul class="lastcol">
       	    <li>
                <h4>Veladoras y velas a la Santísima Providencia</h4></li>
                <li><img src="images/veladoraSantisima.jpg" alt="image3" style="width:270px; height:320px" /></li>
                 <li>Contamos con velas y veladoras a la Santísima Providencia en 3 diferentes colores y con un grato aroma. ¡Conócelas! </li>
                <li><a href="catalogoCategoria.php?id=2">Ver más</a></li>
            </ul>
            
            <div class="clear"></div>
        </div>
 
    </div>
    
    <div class="footer">
            <p>&copy; La colmena 2012. Design by <a href="http://www.electrictowelrail.org.uk/chrome-towel-radiator/" target="_blank">Chrome Towel Radiator</a>  | <a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional"><abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a> | <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" title="This page validates as CSS"><abbr title="Cascading Style Sheets">CSS</abbr></a></p>
         </div>
</div>
</div>
</body>
</html>
