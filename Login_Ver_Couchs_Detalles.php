<?php
session_start();
if(!isset($_SESSION['estaLoggeadoUsuario']) || isset($_SESSION['estaLoggeadoUsuario']) && $_SESSION['estaLoggeadoUsuario'] == false){
	die("Ud. no tiene acceso para visitar esta secci&oacute;n.");
}
include("Conectar.php");
?>
<!DOCTYPE html>
<head>
	<script type="text/javascript">

		function refrescar(elemento){//aca recibe el div que tiene el textarea y el input
			var textarea = elemento.childNodes[0];
			var boton =(elemento.childNodes[2]);
			var id = textarea.getAttribute('ID');
			alert(textarea.value);
			alert(boton.value);
			alert(id);

			var nodo = document.createElement('div');
			var contenido = document.createTextNode('Tu respuesta:'+textarea.value);
			nodo.appendChild(contenido);
			elemento.appendChild(nodo);
			var conexion;
			alert('ndo');
			conexion = new XMLHttpRequest();
			conexion.onreadystatechange=function(){
				if(conexion.readyState==4 && conexion.status==200){
					//alert(conexion.status);
					document.getElementById('div-respuesta').textContent='textarea.value';
				}

			}
			alert('0000000000000');
			conexion.open("GET","updateDato.php?dato="+textarea.value+"&idComment="+id, true);
			alert(id);
			conexion.send();
			elemento.removeChild(elemento.childNodes[0]);
			elemento.removeChild(elemento.childNodes[1]);
			elemento.removeChild(elemento.childNodes[2]);
		}
	</script>
	<title> CouchInn </title>
	<link rel ="stylesheet" type ="text/css" href ="Estilos_Login_Ver_Couchs_Detalles.css"/>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">

	<!-- Add jQuery library -->
	<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>

</head>
<body>
	<?php
		include("Login_Cabeza.php");
	?>
	<div id= "cuerpo">
		<?php
			include("Login_Menu.php");
		?>
		<?php
			$couch= $_GET["couch"];
			$query = "SELECT * FROM comentarios WHERE idCouch=".$couch."";
			$que = mysql_query($query, $link);
			$numCom=mysql_num_rows ($que);
			if($numCom <> 0) {

				echo '<div id= "lista">';

					echo '<div id= "subLis">';

						$couch= $_GET["couch"];
						$query = "SELECT * FROM couch WHERE idCouch='".$couch."'";   //CONSULTA A LA TABLA COUCH
						$q = mysql_query($query, $link);
						$resCouch=mysql_fetch_array($q);

						echo '<div id= "imagIzq" class="scrollbardos">';
							$query = "SELECT * FROM imagenes WHERE idCouch='".$resCouch['idCouch']."'";   //CONSULTA A LA TABLA IMAGENES CHOCANDO IDCOUCH
							$qe = mysql_query($query, $link);
							$num=mysql_num_rows ($qe);
							for ($i=0; $i<$num; $i++) {
								$resImg=mysql_fetch_array($qe);
								if ($resImg['Imagen']<>"") {
									//echo '<a class="fancybox-thumbs" data-fancybox-group="thumb" href="'.$resImg['Imagen'].'"><img src="'.$resImg['Imagen'].'" width="74" height="74" /></a>';
									echo '<a class="fancybox" href="'.$resImg['Imagen'].'" data-fancybox-group="gallery"><img src="'.$resImg['Imagen'].'" width="74" height="74"/></a>';
								}
								else {
									echo '<a class="fancybox" href="Imagen/sillon.png" data-fancybox-group="gallery"><img src="Imagen/sillon.png" width="74" height="74"/></a>';
								}
							}
						echo '</div>';

						echo '<div id= "titu">';
							echo '<b> '.$resCouch['Titulo'].' </b>';
						echo '</div>';

						echo '<div id= "ciudad">';
							$query = "SELECT * FROM provincias WHERE idProvincias='".$resCouch['idProvincias']."'";   //CONSULTA PROVINIA
							$qe = mysql_query($query, $link);
							$resID=mysql_fetch_array($qe);
							$ciudad= $resID['Provincia'];

							$query = "SELECT * FROM departamentos WHERE idDepartamentos='".$resCouch['idDepartamentos']."'";   //CONSULTA DEPARTAMENTO
							$qe = mysql_query($query, $link);
							$resID=mysql_fetch_array($qe);
							$ciudad= $ciudad.", ".$resID['Departamento'];

							$query = "SELECT * FROM localidades WHERE idLocalidades='".$resCouch['idLocalidades']."'";   //CONSULTA LOCALIDAD
							$qe = mysql_query($query, $link);
							$resID=mysql_fetch_array($qe);
							$ciudad= $ciudad.", ".$resID['Localidad'];

							echo '<p> <b>Ciudad</b>: '.$ciudad.' </p>';
						echo '</div>';

						echo '<div id= "tipo">';
							$query = "SELECT * FROM tipo WHERE idTipo='".$resCouch['idTipo']."'";
							$q = mysql_query($query, $link);
							$result=mysql_fetch_array($q);
							echo '<p> <b>Tipo</b>: '.$result['Tipo'].' </p>';
						echo '</div>';

						echo '<div id= "capac">';
							echo '<p> <b>Capacidad</b>: '.$resCouch['Capacidad'].' </p>';
						echo '</div>';

						echo '<div id= "puntaje">';
							if ($resCouch['Puntaje'] < 1) {
								echo '<p> <b>Puntaje</b>: Sin puntaje </p>';
							}
							else {
								echo '<p> <b>Puntaje</b>: '.$resCouch['Puntaje'].' </p>';
							}
						echo '</div>';

						echo '<div id= "des">';
							echo '<p> '.$resCouch['Descripcion'].' </p>';
						echo '</div>';
						echo '<div id="reserva">';
							echo '<form action="Login_Reservar_Couch.php" method="post">';
								echo '<input type=hidden name="couch" value="'.$resCouch['idCouch'].'"/>';
								echo '<div id="reservaboton">';
									echo '<input type="submit" value="Hacer Reserva"/>';
								echo '</div>';
							echo '</form>';
						echo '</div>';

					echo '</div>';

					echo '<div id= "comentario">';   //HACER UN COMENTARIO A LA PUBLICAcION
						echo '<form method="post" name="registro">';
							echo '<div id= "formulario">';
								echo '<textarea rows="3" cols="60" name="comentario" REQUIRED MAXLENGTH="140" PLACEHOLDER="Ingrese un comentario"></textarea>';
							echo '</div>';
							echo '<div id= "formularioBoton">';
								echo '<input type="submit" name="publicar" value="Publicar"/>';
							echo '</div>';
						echo '</form>';/*
						if (isset($_POST['publicar'])) {
							$query= "INSERT INTO comentarios (idCouch, idUComun, Comentario)
							VALUES ('".$resCouch['idCouch']."','".$_SESSION['idUComun']."','".$_POST['comentario']."')";
							mysql_query ($query);

							$dir="Login_Ver_Couchs_Detalles.php?couch='".$resCouch['idCouch']."'";
							?>
								<script type="text/javascript">
									location.href= $dir;
								</script>
							<?php
						}*/
						/**************************************aca ingresa una pregunta enla parte que se muestran los comentearios, o sea que tiene coments /*******************/
						if (isset($_POST['publicar'])) {
							if($_SESSION['idUComun']<>$resCouch['idUComun']){//si no soy dueño del couch que quiero preguntar
								$query= "INSERT INTO comments (idCouch, idUsuario, pregunta, idDuenio)
								VALUES ('".$resCouch['idCouch']."','".$_SESSION['idUComun']."','".$_POST['comentario']."','".$resCouch['idUComun']."')";
								mysql_query ($query);
								$dir="Login_Ver_Couchs_Detalles.php?couch='".$resCouch['idCouch']."'";
								?>
									<script type="text/javascript">
										location.href= $dir;
									</script>
								<?php
							}else{
								?> <script type="text/javascript">
									alert("Ud. no puede preguntar sobre un couch propio");
								</script>
								<?php
							}
						}
						/**********************************************************************/
					echo '</div>';

					echo '<div class="scrollbar" id= "listamenor">';
						echo '<div id= "comentarioVer">';

							$query = "SELECT * FROM couch WHERE idCouch=".$couch."";
							$que = mysql_query($query, $link);
							$resCouch=mysql_fetch_array($que);

							$query = "SELECT * FROM comments WHERE idCouch=".$couch." ORDER BY idComment DESC";
							$que = mysql_query($query, $link);
							$numCom=mysql_num_rows ($que);

							/*for ($i=0; $i<$numCom; $i++) {

								echo '<div id= "fila">';

								$resCom=mysql_fetch_array($que);

									echo '<div id= "filaNom">';
										$query = "SELECT * FROM ucomun WHERE idUComun=".$resCom['idUComun']."";
										$quer = mysql_query($query, $link);
										$resNom=mysql_fetch_array($quer);

										if ($resCouch['idUComun'] == $resCom['idUComun']) {
											echo '<b> '.$resNom['Nombre'].': (Respuesta) </b>';
										}
										else {
											echo '<b> '.$resNom['Nombre'].': (Pregunta) </b>';
										}
									echo '</div>';

									echo '<div id= "filaCom">';
										echo '<p> '.$resCom['Comentario'].' </p>';
									echo '</div>';

								echo '</div>';
							}*/


							/*************esta parte es para mostrar los comentarios de cada couch******************/
							while($comment=mysql_fetch_array($que)){//mientras tenga comments los muestro
								$quienPregunta = mysql_fetch_array(mysql_query("SELECT Nombre FROM ucomun WHERE ucomun.idUComun='".$comment['idUsuario']."'"));
								?>
									<div class="comment-container">

											<div id='filaComentario'>
												<div class="comment-pregunta">
													<div><?php echo "<b>pregunta de  ".$quienPregunta['Nombre'].":</b> ".$comment['pregunta'] ?></div>
												</div>
												<div class="comment-respuesta" >
													<div>
														<?php
															if($comment['respuesta']!=''){//si tiene respuesta la imprimo
																echo "<b>respuesta:</b>";
																echo $comment['respuesta'];
															}
															else{//sino le muestro el textarea para que responda y lo manejo en este mismo archivo
															//	$_POST['idComment']=$comment['idComment'];
																echo "<div>";
																echo "<textarea  id='".$comment['idComment']."' class='visible' name='textoRespuesta' rows='4' cols='65'></textarea>"	;
																echo 	"<br>";
																echo	"<input id='boton1' class='visible' type='button' onclick='refrescar(this.parentNode)' name='responder' value='Responder'>";
																echo 	"</div>";

															}
														?>

														</div>
												</div>
											</div>

									</div>
<!--********************* ESTILOS CSS **********************-->
								<style media="screen">
									.comment-container{
										width: 100%;
										margin-left: 10%;
									}
									#filaComentario{
										width:90%;
										background:;
										border-bottom: 1px dotted black;
										border-top: 1px dotted black;
									}
									.comment-pregunta{
										padding: 10px;
									}
									.comment-respuesta{
										padding: 10px;
									}
									.visible{
										visibility: visible;
									}
									.invisible{
										visibility: hidden;
										display: none;
									}

								</style>
								<?php
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
			else {//no tiene comentarios
				echo '<div id= "listaSinComentarios">';

					echo '<div id= "subLis">';

						$couch= $_GET["couch"];
						$query = "SELECT * FROM couch WHERE idCouch='".$couch."'";   //CONSULTA A LA TABLA COUCH
						$q = mysql_query($query, $link);
						$resCouch=mysql_fetch_array($q);

						echo '<div id= "imagIzq" class="scrollbardos">';
							$query = "SELECT * FROM imagenes WHERE idCouch='".$resCouch['idCouch']."'";   //CONSULTA A LA TABLA IMAGENES CHOCANDO IDCOUCH
							$qe = mysql_query($query, $link);
							$num=mysql_num_rows ($qe);
							for ($i=0; $i<$num; $i++) {
								$resImg=mysql_fetch_array($qe);
								if ($resImg['Imagen']<>"") {
									//echo '<a class="fancybox-thumbs" data-fancybox-group="thumb" href="'.$resImg['Imagen'].'"><img src="'.$resImg['Imagen'].'" width="74" height="74" /></a>';
									echo '<a class="fancybox" href="'.$resImg['Imagen'].'" data-fancybox-group="gallery"><img src="'.$resImg['Imagen'].'" width="74" height="74"/></a>';
								}
								else {
									echo '<a class="fancybox" href="Imagen/sillon.png" data-fancybox-group="gallery"><img src="Imagen/sillon.png" width="74" height="74"/></a>';
								}
							}
						echo '</div>';

						echo '<div id= "titu">';
							echo '<b> '.$resCouch['Titulo'].' </b>';
						echo '</div>';

						echo '<div id= "ciudad">';
							$query = "SELECT * FROM provincias WHERE idProvincias='".$resCouch['idProvincias']."'";   //CONSULTA PROVINIA
							$qe = mysql_query($query, $link);
							$resID=mysql_fetch_array($qe);
							$ciudad= $resID['Provincia'];

							$query = "SELECT * FROM departamentos WHERE idDepartamentos='".$resCouch['idDepartamentos']."'";   //CONSULTA DEPARTAMENTO
							$qe = mysql_query($query, $link);
							$resID=mysql_fetch_array($qe);
							$ciudad= $ciudad.", ".$resID['Departamento'];

							$query = "SELECT * FROM localidades WHERE idLocalidades='".$resCouch['idLocalidades']."'";   //CONSULTA LOCALIDAD
							$qe = mysql_query($query, $link);
							$resID=mysql_fetch_array($qe);
							$ciudad= $ciudad.", ".$resID['Localidad'];

							echo '<p> <b>Ciudad</b>: '.$ciudad.' </p>';
						echo '</div>';

						echo '<div id= "tipo">';
							$query = "SELECT * FROM tipo WHERE idTipo='".$resCouch['idTipo']."'";
							$q = mysql_query($query, $link);
							$result=mysql_fetch_array($q);
							echo '<p> <b>Tipo</b>: '.$result['Tipo'].' </p>';
						echo '</div>';

						echo '<div id= "capac">';
							echo '<p> <b>Capacidad</b>: '.$resCouch['Capacidad'].' </p>';
						echo '</div>';

						echo '<div id= "puntaje">';
							if ($resCouch['Puntaje'] < 1) {
								echo '<p> <b>Puntaje</b>: Sin puntaje </p>';
							}
							else {
								echo '<p> <b>Puntaje</b>: '.$resCouch['Puntaje'].' </p>';
							}
						echo '</div>';

						echo '<div id= "des">';
							echo '<p> '.$resCouch['Descripcion'].' </p>';
						echo '</div>';
						echo '<div id= "reserva">';
							echo '<form action="Login_Reservar_Couch.php" method="post">';
								echo '<input type=hidden name="couch" value="'.$resCouch['idCouch'].'"/>';
								echo '<div id="reservaboton">';
									echo '<input type="submit" value="Hacer Reserva"/>';
								echo '</div>';
							echo '</form>';
						echo '</div>';

					echo '</div>';

					echo '<div id= "comentario">';
						echo '<form method="post" name="registro">';
							echo '<div id= "formulario">';
								echo '<textarea rows="3" cols="60" name="comentario" REQUIRED MAXLENGTH="140" PLACEHOLDER="Ingrese un comentario"></textarea>';
							echo '</div>';
							echo '<div id= "formularioBoton">';
								echo '<input type="submit" name="publicar" value="Publicar"/>';
							echo '</div>';
						echo '</form>';
					/*	if (isset($_POST['publicar'])) {aca voy a cambiar laforma de hacer comentarios
							$query= "INSERT INTO comentarios (idCouch, idUComun, Comentario)
							VALUES ('".$resCouch['idCouch']."','".$_SESSION['idUComun']."','".$_POST['comentario']."')";
							mysql_query ($query);

							$dir="Login_Ver_Couchs_Detalles.php?couch='".$resCouch['idCouch']."'";
							?>
								<script type="text/javascript">
									location.href= $dir;
								</script>
							<?php
						}*/
						/*************** esto es para ingresar una pregunta en un couch/**************/
						if (isset($_POST['publicar'])) {
							if($_SESSION['idUComun']<>$resCouch['idUComun']){//si no soy dueño del couch que quiero preguntar
								$query= "INSERT INTO comments (idCouch, idUsuario, pregunta, idDuenio)
								VALUES ('".$resCouch['idCouch']."','".$_SESSION['idUComun']."','".$_POST['comentario']."','".$resCouch['idUComun']."')";
								mysql_query ($query);
								$dir="Login_Ver_Couchs_Detalles.php?couch='".$resCouch['idCouch']."'";
								?>
									<script type="text/javascript">
										location.href= $dir;
									</script>
								<?php
							}else{
								?> <script type="text/javascript">
									alert("Ud. no puede preguntar sobre un couch propio");
								</script>
								<?php
							}
						}
						/****************************************************/
					echo '</div>';

				echo '</div>';
			}
		?>
	</div>
	<?php
		include("Pie.php");
	?>
</body>
</html>
