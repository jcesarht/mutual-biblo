<?php

function plantillaEmailRecuperacionPassword($contenido){
	$html = '
	<!DOCTYPE html>
	<html>
	<head>
		<title>Recuperar Password</title>
	</head>
	<body>
		<div><img src="../../img/logo-sombra.png"></div>
		<div><font size="2"><span>'.$contenido.'</span></font></div>
	</body>
	</html>';
	return $html;
}
function plantillaRegistro($nombres,$email,$telefono,$password,$zona_horaria){
$html = '
    						Se ha registrado una empresa. Datos de la empresa
              	<table width="200" border="1">
              	  <tr>
              		<td bgcolor="#CCFF00"><strong>Nombre de titular</strong></td>
              		<td bgcolor="#CCCCCC">'.$nombres.'</td>
              	  </tr>
              	  <tr>
              		<td bgcolor="#CCFF00"><strong>Email</strong></td>
              		<td bgcolor="#CCCCCC">'.$email.'</td>
              	  </tr>
              	  <tr>
              		<td bgcolor="#CCFF00"><strong>Teléfono</strong></td>
              		<td bgcolor="#CCCCCC">'.$telefono.'</td>
              	  </tr>
              	  
              	  <tr>
              		<td bgcolor="#CCFF00"><strong>Login</strong></td>
              		<td bgcolor="#CCCCCC">'.$email.'</td>
              	  </tr>
              	  <tr>
              		<td bgcolor="#CCFF00"><strong>Password</strong></td>
              		<td bgcolor="#CCCCCC">'.$password.'</td>
              	  </tr>
              	  <tr>
              		<td bgcolor="#CCFF00"><strong>Zona horaria</strong></td>
              		<td bgcolor="#CCCCCC">'.$zona_horaria.'</td>
              	  </tr>
              	</table>
              	';
	return $html;
}
function plantillaBienvenida($nombres,$email,$password){
	$html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>AdminTaxi - Plataforma para la gestión de flotas vehiculares en la Nube</title>
                <style type="text/css">
                <!--
                .style2 {
                	color: #000000;
                	font-family: Arial, Helvetica, sans-serif;
                	font-size: 18px;
                	letter-spacing: -1px;
                }
                .style3 {
                	color: #000000;
                	font-size: 14px;
                }
                -->
                </style>
                </head>
                
                <body>
                <style type="text/css">
                <!--
                body {
                   background-image: url("http://www.admintaxi.com/plantilla/eresimportante/img/bground.jpg");
                   background-repeat:repeat-x;
                   background-color: #ffffff;
                   margin: 0;
                   padding: 0;
                }
                a {
                	color:#45b3d0;
                	text-decoration:none;
                }
                a:hover {
                	color:#45b3d0;
                	text-decoration:underline;
                }
                img {
                <table width="100%" border="0" align="center" cellpadding="20" cellspacing="0" background="http://www.admintaxi.com/plantilla/eresimportante/img/bground.jpg" bgcolor="#ffffff" style="background-repeat:repeat-x">
                  <tr>
                    <td valign="top">    
                      <table width="650" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#ffffff">
                        <tr>
                          <td>
                                        <!-- START OF Header Table -->
                            <table width="633" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td height="67" width="245"  align="left" valign="middle" bgcolor="#FFFFFF" style="color: #e3e3e3; font-family: Helvetica, sans-serif; font-size: 12px; letter-spacing: 0px;"><a href="http://admintaxi.com"><img src="http://admintaxi.com/plantilla/engage/logo.png" alt="AdminTaxi" width="253" height="89" border="0" /></a></td>
                                <td width="386" align="right" valign="middle" bgcolor="#FFFFFF" style="color: #7a7a7a; font-family: Arial, Helvetica, sans-serif; font-size: 12px; letter-spacing: 0px;"><span style="text-align: right"></span>Tienes problemas para ver este Email ? <a style="color:#33333c; text-align: right;" href="http://www.admintaxi.com/plantilla/bienvenido/">Click Aqui.</a></td>
                              </tr>
                              <tr>
                                <td height="19" colspan="2" align="left" bgcolor="#FFFFFF" style="font-family: Arial, Helvetica, sans-serif; color: #7a7a7a; font-size: 12px; letter-spacing: -1px;"><img src="http://www.admintaxi.com/plantilla/eresimportante/img/full_width_hr.jpg" width="633" height="20" alt="break1" /></td>
                              </tr>
                              <tr>
                                <td width="245" height="32" align="left" valign="top" bgcolor="#FFFFFF" style="font-family: Arial, Helvetica, sans-serif; color: #7a7a7a; font-size: 12px; letter-spacing: -1px;">Fecha: '.date('d').'-'.date("M").'-'.date("Y").'</td>
                                <td width="386" align="right" valign="top" bgcolor="#FFFFFF" style="color: #7a7a7a; font-family: Helvetica, sans-serif; font-size: 12px; letter-spacing: 0px;"><span style="text-align: right"></span>
                                  
                                  <table width="300" border="0" align="right" cellpadding="0" cellspacing="0" style="color: #7a7a7a; font-family: Helvetica, sans-serif; font-size: 12px; letter-spacing: 0px; text-align: right;">
                                    <tr>
                                      <td width="179" align="right" valign="middle">Síguenos</td>
                                      <td width="27" align="right" valign="top"><a href="https://www.facebook.com/pages/Admintaxicom/533026690046893?fref=ts"  target="_blank"><img src="http://www.admintaxi.com/plantilla/eresimportante/img/facebook.jpg" alt="facebook" width="19" height="19" border="0" align="absmiddle" /></a></td>
                                      <td width="67" align="right" valign="middle">Síguenos</td>
                                      <td width="27" align="right" valign="top"><a href="https://twitter.com/admontaxi2014"  target="_blank"><img src="http://www.admintaxi.com/plantilla/eresimportante/img/twitter.jpg" alt="Twitter" width="19" height="19" border="0" align="absmiddle" /></a></td>
                                    </tr>
                                  </table>
                                  
                                </td>
                              </tr>
                            </table>
                            <!-- END OF Header Table -->
                            
                            
                            <!-- START OF splash Table -->  
                            <table width="633" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td height="97" valign="top"><a href="http://admintaxi.com"><img src="http://www.admintaxi.com/plantilla/eresimportante/img/admintaxi.com.png" alt="AdminTaxi- Administración de Taxis" width="633" height="97" border="0" /></a></td>
                              </tr>
                            </table>
                            <!-- END OF splash Table -->
                            
                            <!-- START OF full width Table 1 --> 
                            <table width="633" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                <td height="20">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="615" align="left" valign="middle" bgcolor="#ffffff" class="style2">Saludos, Bienvenido a la Plataforma AdminTaxi.com. </td>
                              </tr>
                              <tr>
                                <td height="10"><img src="http://www.admintaxi.com/plantilla/eresimportante/img//three_quarter_HR.gif" width="633" height="20" alt="hr1" /></td>
                              </tr>
                              <tr>
                                <td align="left" valign="top" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #7a7a7a; line-height: 18px;">
                                  <p class="style3"><strong>Hola, '.$nombres.' </strong>
                                    <br />
                                    <br />
                                  Te Agradecemos por haberte registrado en nuestro sistema <strong>AdminTaxi.com</strong>, esta plataforma 100% Online  te permitirá organizar tu compañía,  cooperativa y/o negocio personal de Taxis o Transporte Público. La plataforma  es genérica para que sea útil a todos los propietarios de Taxis tanto de  Colombia como Latinoamérica. <br />
                                  <br />
    															Este es tu usuario y tu Contraseña. <br><br><strong> Usuario: '.$email.'<br>Contraseña : '.$password.'</strong><br><br>
                                  Si  tienes dudas, comentarios, sugerencias,  petición específica, soporte,  deseas ser contactado por telefono, tener una capacitación virtual,  estaríamos feliz de  poder brindarte una respuesta a tus comentarios .&nbsp;<br />
                                    <br />
                                    Gracias,<br />
                                    Estoy atento a sus comentarios.<br />
                                  Cordialmente,</p>
                                  <span class="style3">Tomas Zambrano Bolívar<br />
                                  Ingeniero de Soporte&nbsp;<br />
                                  Cel: (57) 300 5529057 - (57) 300 2229713&nbsp;<br />
                                  Email: info@admintaxi.com<br />
                                  www.admintaxi.com<br />
                                  Bogotá - Colombia - Latinoamérica&nbsp;<br />
                                  Skype: admintaxi2013</span></td>
                              </tr>
                            </table>
                            <!-- END OF full width Table 1 -->           
                            <!-- START OF full width Table 2 -->
                            <!-- END OF full width Table 2 -->
                            <!-- START OF GALLERY TABLE -->
                            <!-- END OF GALLERY TABLE -->
                            <!-- START OF FOOTER TABLE -->
                						<table width="633" border="0" cellspacing="0" cellpadding="0">
                              <tr>
                                
                              </tr>
                              <tr>
                                <td colspan="2" align="right" valign="top" style="color: #7a7a7a; font-family: Helvetica, sans-serif; font-size: 12px; letter-spacing: 0px;">
                                  
                                  <table width="300" border="0" cellspacing="0" cellpadding="0" style="color: #7a7a7a; font-family: Helvetica, sans-serif; font-size: 12px; letter-spacing: 0px;">
                                    <tr>
                                      <td align="right" valign="middle">Síguenos</td>
                                      <td align="right" valign="top"><a href="https://www.facebook.com/pages/Admintaxicom/533026690046893?fref=ts"  target="_blank"><img src="http://www.admintaxi.com/plantilla/eresimportante/img/facebook.jpg" alt="facebook AdminTaxi" width="19" height="19" border="0" align="absmiddle" /></a></td>
                                      <td align="right" valign="middle">Síguenos</td>
                                      <td align="right" valign="top"><a href="https://twitter.com/admontaxi2014" target="_blank"><img src="http://www.admintaxi.com/plantilla/eresimportante/img/twitter.jpg" alt="Twitter AdminTaxi" width="19" height="19" border="0" align="absmiddle" /></a></td>
                                    </tr>
                                  </table>
                                  
                                </td>
                              </tr>
                              <tr>
                                <td height="10" colspan="2" valign="top"><img src="http://www.admintaxi.com/plantilla/eresimportante/img/three_quarter_HR.gif" width="633" height="20" alt="hr1" /></td>
                              </tr>
                              <tr>
                                <td width="401" align="left" valign="top" style="font-family: Helvetica, sans-serif; font-size: 11px; color: #7a7a7a; line-height: 16px;"><p>Copyright © 2010 - '.date('Y').' AdminTaxi.com. All Rights Reserved.<br />
                                  Cra 7ma # 69-17  | Bogotá | Colombia - Latam | info@admintaxi.com</p>
                                  
                                  <p>Ese E-mail fue enviado a usted, por que se ha registrado en nuestra plataforma AdminTaxi.com</td>
                                <td width="232" align="right" valign="top" style="font-family: Helvetica, sans-serif; font-size: 11px; color: #7a7a7a; line-height: 16px;"><a href="http://simbiotica.com.co/" target="_blank">Powered by Simbiotica </a></td>
                              </tr>
                            </table>
                            <!-- END OF FOOTER TABLE -->     
                          </td>
                        </tr>
                      </table>
                      
                    &nbsp;</td>
                  </tr>
                </table>  
                </body>
                </html>';
	return $html;
}
?>