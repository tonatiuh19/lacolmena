<?php
session_start();
require_once('../../admin/cn.php');
if (isset($_SESSION['email'])){


}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.location.href='../sign-in/';
		</SCRIPT>");
}

if ($_SESSION['type_user']=="3") {
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.location.href='../workplace/';
		</SCRIPT>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = test_input($_POST["project"]);
  $email = test_input($_POST["email"]);
	$ci = test_input($_POST["candidate_id"]);

}else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>

    window.location.href='../';
    </SCRIPT>");
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
<!doctype html>
<html lang="en">
<head>
		<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../../../favicon.ico">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

	<title>arcvii</title>
	<style type="text/css">
		hr.style5 {
			background-color: #fff;
			border-top: 2px dashed #8c8b8b;
		}
		#logout_sidebar_button {
		    position: absolute;
		    display: inline-block;
		    bottom: 0;
		    left: 15px;
		}
	</style>

	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Custom styles for this template -->
	<link href="dashboard.css" rel="stylesheet">

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>

</head>

<body>
	<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../"><img src="../../img/logo.png" class="img-responsive" style="width:18%"></a>

		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="../fin.php">Cerrar sesion</a>
			</li>
		</ul>

	</nav>

	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<ul class="nav flex-column">
						&nbsp;
						<li class="nav-item">
							<a class="nav-link" href="../myprojects/">
								<span class="fas fa-box-open"></span>
								Proyectos <span class="sr-only"></span>
							</a>
						</li>

						<li class="nav-item">
							<a class="nav-link active" href="../">
								<i class="fas fa-paint-brush"></i>
								Mis Trabajos
							</a>
						</li>

					</ul>

					<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">

						<a class="d-flex align-items-center text-muted" href="#">

						</a>
					</h6>

					<ul class="nav flex-column mb-2">
						<li class="nav-item ">
							<a class="nav-link " href="../profile/">
								<span class="fas fa-user-cog">&nbsp;</span>
								Mi perfil
							</a>
						</li>

					</ul>
					<p>&nbsp;<ul class="list-inline social-buttons nav nav-sidebar" id="logout_sidebar_button">

						<li class="list-inline-item">
							<a href="https://www.facebook.com/arcvii.mx/" target="_blank">
								<i class="fab fa-facebook"></i>
							</a>
						</li>
						<li class="list-inline-item">
							<a href="https://www.instagram.com/arcvii_mx/" target="_blank">
								<i class="fab fa-instagram"></i>
							</a>
						</li>
					</p><p>&nbsp;<span class="copyright small">Copyright &copy; arcvii 2020</span></p>
				</div>
			</nav>

			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <?php
        $sql = "SELECT a.email, a.nombre, a.apellido, b.descripcion, b.skills, b.educacion, b.titulo, b.awards FROM user as a inner join portfolio as b on b.email_user=a.email WHERE a.email='".$email."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        						<h1 class="h2"></h1>
        						<div class="btn-toolbar mb-2 mb-md-0">';
										echo "<a href=\"javascript:document.getElementById('aceptar".$id."').submit();\" class=\"btn btn-sm btn-success\">Aceptar <i class=\"fas fa-check-square\"></i></a>\n";
										//echo "<a href=\"javascript:document.getElementById('eliminar".$id."').submit();\" class=\"btn btn-sm btn-danger\">Ignorar <i class=\"fas fa-times-circle\"></i></a>\n";
											echo "<form action=\"accept.php\" id=\"aceptar".$id."\" method=\"post\">\n";
											echo "  <input type=\"hidden\"  name=\"projectid\" value=\"".$id."\">\n";
											echo "  <input type=\"hidden\"  name=\"email\" value=\"".$email."\">\n";
											echo "</form>\n";
											echo "<form action=\"delete.php\" id=\"eliminar".$id."\" method=\"post\">\n";
											echo "  <input type=\"hidden\"  name=\"project\" value=\"".$id."\">\n";
											echo "  <input type=\"hidden\"  name=\"email\" value=\"".$email."\">\n";
											echo "</form>\n";
											echo '
        						</div>
        					</div>';
								echo '<div class="container py-4 my-2">
										    <div class="row">
										        <div class="col-md-4 pr-md-5">';

																$folder_path = "../../workplace/portfolio/user/".$row['email']."/profile/";
																if (!file_exists($folder_path)) {
																	echo '<img class="w-100 rounded border" src="../../workplace/portfolio/user/profile_vector.png" />';
															  }else{
																	foreach(glob($folder_path.'*.{jpg,png}', GLOB_BRACE) as $file) {
																		if (preg_match('/(\.jpg|\.png|\.bmp)$/', $file)) {
																		 	echo '<img class="w-100 rounded border" src="'.$file.'" />';
																		}
																	}
																}
										            echo '<div class="pt-4 mt-2">
										                <section class="mb-5 mb-md-0">
										                    <h3 class="h6 font-weight-light text-secondary text-uppercase">Skills</h3>
										                    <div class="skills pt-1 row">
										                        '.$row["skills"].'
										                    </div>
										                </section>
										            </div>
										        </div>
										        <div class="col-md-8">
										            <div class="d-flex align-items-center">
										                <h2 class="font-weight-bold m-0">
										                    '.$row["nombre"].' '.$row["apellido"].'
										                </h2>

										            </div>
										            <p class="h5 text-primary mt-2 d-block font-weight-light">
										                '.$row["titulo"].'
										            </p>
										            <p class="lead mt-4">'.$row["descripcion"].'</p>
																';
																		$sql7 = "SELECT message FROM projects_candidates_messages where id_projects_candidates=".$ci."";
																		$result7 = $conn->query($sql7);

																		if ($result7->num_rows > 0) {
																		    // output data of each row
																		    while($row7 = $result7->fetch_assoc()) {
																						echo '<p class="lead mt-4"><div class="card text-white bg-dark mb-3" style="max-width: 28rem;">
																						  <div class="card-body">
																						    <h5 class="card-title">Mensaje para ser considerado:</h5>
																						    <p class="card-text">';
																		        echo $row7["message"];
																									echo'</p>
																							  </div>
																							</div></p>';
																		    }
																		} else {
																		    echo "";
																		}
																		echo '
										            <section class="mt-5">
										                <h3 class="h6 font-weight-light text-secondary text-uppercase">Calificaciones</h3>
										                <div class="d-flex align-items-center">
										                    <strong class="h1 font-weight-bold m-0 mr-3">5 <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i></strong>
										                    <div>
										                        <input data-filled="fa fa-2x fa-star mr-1 text-warning" data-empty="fa fa-2x fa-star-o mr-1 text-light" value="5" type="hidden" class="rating" data-readonly />
										                    </div>
										                </div>
										            </section>

										            <section class="mt-4">
										                <ul class="nav nav-tabs" id="myTab" role="tablist">
										                    <!--<li class="nav-item">
										                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">
										                            Certificaciones, Reconocimientos, Awards
										                        </a>
										                    </li>-->
										                    <li class="nav-item active" >
										                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
										                            Educacion
										                        </a>
										                    </li>
																				<li class="nav-item">
																					 <a class="nav-link" id="portfolio-tab" data-toggle="tab" href="#portfolio" role="tab" aria-controls="portfolio" aria-selected="false">
																							 Portfolio
																					 </a>
																			 </li>
										                </ul>
										                <div class="tab-content py-4" id="myTabContent">
										                    <div class="tab-pane py-3 fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
										                        '.$row["awards"].'
										                    </div>
										                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">'.$row["educacion"].'</div>
																				<div class="tab-pane fade" id="portfolio" role="tabpanel" aria-labelledby="portfolio-tab">';
																				//echo '../../workplace/portfolio/user/'.$row["email"].'/*.pdf';
																				/*foreach(glob('../../workplace/portfolio/user/'.$row["email"].'/*.pdf') as $file) {
																						echo '<a class="btn btn-light" href="'.$file.'" target="_blank" role="button"><i class="far fa-file-pdf"></i> '.substr($file, strrpos($file, '/') + 1).'</a><br>';
																						//echo "www.yourdomain.com/path/to/dir/" . $file; //or basename($file)
																				}*/
																				foreach(glob('../../workplace/portfolio/user/'.$row['email'].'/*.{jpg,pdf}', GLOB_BRACE) as $file) {
																					if (preg_match('/(\.jpg|\.png|\.bmp)$/', $file)) {
																					 	echo '<a class="btn btn-light" href="'.$file.'" target="_blank" role="button"><i class="far fa-file-image"></i> '.substr($file, strrpos($file, '/') + 1).'</a><br>';
																					}else{
																						echo '<a class="btn btn-light" href="'.$file.'" target="_blank" role="button"><i class="far fa-file-pdf"></i> '.substr($file, strrpos($file, '/') + 1).'</a><br>';
																					}

																						//echo "www.yourdomain.com/path/to/dir/" . $file; //or basename($file)
																				}
																				echo '</div>

										                </div>
										            </section>
										        </div>
										    </div>
										</div>';
            }
        } else {
            echo "0 results";
        }
         ?>



			</main>
			</div>
			</div>
<script type="text/javascript">
	function setTwoNumberDecimal(event) {
	    this.value = parseFloat(this.value).toFixed(2);
	}
	$('#price').html(Math.floor($('.#price').html()));
</script>
<script type="text/javascript">
	$(function() {
		$('[data-toggle="tooltip"]').tooltip({
			html: true
		});
	});
</script>
<script type="text/javascript">
  Conekta.setPublicKey('key_Lc3mLsmPDnNJsv5zYhzAkjA');


  var conektaSuccessResponseHandler = function(token) {
    var $form = $("#card-form");
    //Add the token_id in the form
     $form.append($('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(token.id));
    $form.get(0).submit(); //Submit
  };

  var conektaErrorResponseHandler = function(response) {
    var $form = $("#card-form");
    $form.find(".card-errors").text(response.message_to_purchaser);
    $form.find("button").prop("disabled", false);

  };

  //jQuery generate the token on submit.
  $(function () {
    $("#card-form").submit(function(event) {
      var $form = $(this);
      // Prevents double clic
      $form.find("button").prop("disabled", true);
      Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);

      return false;
    });
  });
</script>
<script type="text/javascript">
	$('#btnClick').on('click',function(){
		if($('#1').css('display')!='none'){
			$('#2').show().siblings('div').hide();
		}else if($('#2').css('display')!='none'){
			$('#1').show().siblings('div').hide();
		}
	});

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

	$(function() {
			$("a#portfolio-tab").click(function() {
					//alert("clicked:" + this.id);
			});

			$("a#portfolio-tab").trigger("click");
	});
</script>
    <!-- Bootstrap core JavaScript
    	================================================== -->
    	<!-- Placed at the end of the document so the pages load faster -->
    	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    	<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    	<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>




    </body>
    </html>
