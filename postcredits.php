<?php
/*
Plugin Name: Post Credits
Author: Rodolfo Martínez
Author URI: http://www.escritoenelagua.com/
Version: 1.2
Description: Adds a footer to the post, stating the copyright notice, the year, and the author. 
Plugin URI: http://www.escritoenelagua.com/2009/05/26/mi-primer-plugin-de-wordpress/

*/

/* 
Funcionamiento:
Descargar el plugin y copiarlo a la carpeta "midominio/content/plugins/", o bien descargarlo y activarlo automáticamente desde el panel de administración de WordPress (sólo con la versión 2.7.1 y posteriores).
Activarlo si no lo está.
Una vez activado, no es necesario hacer nada más, si no se quiere. A partir de ese momento, todos los post terminarán con un mensaje similar a "(c) 2009, Pepe Pérez".
Este mensaje se genera con las opciones por defecto, que son:
-Alineación izquierda
-Letra normal
-Sin efectos
-Tamaño 12
-Color negro
-Sin texto adicional
Para modificar cualquiera de estos valores basta con ir al menú de configuración del plugin, al que se puede acceder desde las "Opciones" en su panel de administración de WordPress
*/


$currentLocale = get_locale();
if(!empty($currentLocale)) {
$moFile = dirname(__FILE__) . "/languages/post-credits-" . $currentLocale . ".mo";
if(@file_exists($moFile) && is_readable($moFile)) load_textdomain('postcredits', $moFile);
}



//Configuración del plugin a través del menú "Opciones" de WordPress
function add_post_credits_settings() {
	if ($_POST) {
                if($_POST["alineacion"] == "")
			$_POST["alineacion"] = "left";
                if($_POST["tipoletra"] == "")
			$_POST["tipoletra"] = "";
                if($_POST["efectoletra"] == "")
			$_POST["efectoletra"] = "normal";
                if($_POST["tamletra"] == "")
			$_POST["tamletra"] = "10";
                if($_POST["colletra"] == "")
			$_POST["colletra"] = "#000000";
                if($_POST["anno"] == "")
			$_POST["anno"] = "si";
                if($_POST["derechos"] == "")
                        $_POST["derechos"] = "cp";
                if($_POST["donde"] == "")
                        $_POST["donde"] = "post";
		update_option('alineacion', $_POST['alineacion']);
		update_option('tipoletra', $_POST['tipoletra']);
		update_option('efectoletra', $_POST['efectoletra']);
		update_option('tamletra', $_POST['tamletra']);
                update_option('colletra', $_POST['colletra']);
		update_option('linea_extra', $_POST['linea_extra']);
		update_option('anno', $_POST['anno']);
                update_option('derechos', $_POST['derechos']);
                update_option('donde', $_POST['donde']);
	}
	// Get options
	$alineacion = get_option('alineacion');
	$tipoletra = get_option('tipoletra');
	$efectoletra = get_option('efectoletra');
	$tamletra = get_option('tamletra');
	$colletra = get_option('colletra');
	$linea_extra = get_option('linea_extra');
        $anno = get_option('anno');
        $derechos = get_option('derechos');
        $donde = get_option('donde');

?>
<div class="wrap">
<h2><?php  _e('Créditos del post', 'postcredits'); ?></h2>

<?php
//Mensaje de opciones actualizadas
	if ($_POST) {
echo '<div id="message" class="updated fade"><p>';
_e("Opciones actualizadas", 'postcredits');
echo '.</p></div>';
};

?>

<form target="_self" method="post">
<table width=70%>
<tr>
<td></td>
<td><h3><?php _e('Formateo', 'postcredits'); ?></h3></td>
<td width=3%></td>
<td><h3><?php _e("Valores actuales", 'postcredits'); ?></h3></td>
</tr>
<tr>
<td width=20%><strong><?php _e("Justificación", 'postcredits'); ?>: </strong></td>
<td>
<input name="alineacion" type="hidden" style="width:100%;" value="<?php echo $alineacion; ?>" />
<select name="alineacion">
<?php
$alin1 = array ("right", "left", "center");
$alin2 = array (__("Derecha", 'postcredits'), __("Izquierda", 'postcredits'), __("Centro", 'postcredits'));
$i = 0;
while ($i < 3)
{
?>
         <option <?php if ($alineacion==$alin1[$i]) echo 'selected'; ?> value="<?php echo $alin1[$i] ?>"><?php echo $alin2[$i] ?></option>
<?php
$i++;
}
?>
           </select>
</td>
<td width=3%></td> 
<td width=20%><?php
$i = 0;
while ($i < 3)
{
 if ($alineacion==$alin1[$i]) echo $alin2[$i];
 $i++;
}
 ?></td>
</tr>
<tr>
<td width=20%><strong><?php _e("Tipo de letra", 'postcredits'); ?>: </strong></td>
<td><input name="tipoletra" type="hidden" style="width:100%;" value="<?php echo $tipoletra; ?>" />
<select name="tipoletra">
<?php
$tipo1 = array ("", "em", "strong");
$tipo2 = array (__("Normal", 'postcredits'), __("Cursiva", 'postcredits'), __("Negrita", 'postcredits'));
$i = 0;
while ($i < 3)
{
?>
                    	<option <?php if ($tipoletra==$tipo1[$i]) echo 'selected'; ?> value="<?php echo $tipo1[$i]; ?>"><?php echo $tipo2[$i]; ?></option>
<?php
$i++;
}
?>
                    </select> 
</td>
<td width=3%></td>
<td width=20%><?php
$i = 0;
while ($i < 3)
{
 if ($tipoletra==$tipo1[$i]) echo $tipo2[$i];
 $i++;
}
 ?></td>
</tr>

<tr>
<td width=20%><strong><?php _e("Efectos", 'postcredits'); ?>: </strong></td>
<td><input name="efectoletra" type="hidden" style="width:100%;" value="<?php echo $efectoletra; ?>" />
<select name="efectoletra">
<?php
$efecto1 = array ("normal", "small-caps");
$efecto2 = array (__("Normal", 'postcredits'), __("Versalita", 'postcredits'));
$i = 0;
while ($i < 2)
{
?>
                    	<option <?php if ($efectoletra==$efecto1[$i]) echo 'selected'; ?> value="<?php echo $efecto1[$i]; ?>"><?php echo $efecto2[$i]; ?></option>
<?php
$i++;
}
?>
                    </select> 
</td>
<td width=3%></td>
<td width=20%><?php
$i = 0;
while ($i < 2)
{
 if ($efectoletra==$efecto1[$i]) echo $efecto2[$i];
 $i++;
}
 ?></td>
</tr>

<tr>
<td width=20$><strong><?php _e("Tamaño", 'postcredits'); ?>: </strong></td>
<td><input name="tamletra" type="hidden" style="width:100%;" value="<?php echo $tamletra; ?>" />
<select name="tamletra">
<?php 
$i=10;
while ($i<=30)
{ ?>
    <option <?php if ($tamletra==$i) echo 'selected'; ?> value="<?php echo $i; ?>"><?php echo $i; ?> </option>
<?php 
$i++;
}
?>
                    </select>
</td>
<td width=3%></td>
<td width=20%><?php echo $tamletra; ?></td>
</tr>

<tr>
<td width=20$><strong><?php _e("Color", 'postcredits'); ?>: </strong></td>
<td><input name=" colletra" type="hidden" style="width:100%;" value="<?php echo $colletra; ?>" />
<select name="colletra">
<?php
$color1 = array ("#000000", "#696969", "#8B0000", "#FF4500", "#006400", "#FFFF00");
$color2 = array (__("Negro", 'postcredits'), __("Gris", 'postcredits'), __("Rojo oscuro", 'postcredits'), __("Naranja", 'postcredits'), __("Verde", 'postcredits'), __("Amarillo", 'postcredits'));
$i = 0;
while ($i < 6)
{
?>
                    	<option <?php if ($colletra==$color1[$i]) echo 'selected'; ?> value="<?php echo $color1[$i]; ?>"><?php echo $color2[$i]; ?></option>
<?php
$i++;
}
?>
                    </select>
</td>
<td width=3%></td>
<td width=20%>
<span style="background-color: <?php echo $colletra; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
</td>
</tr>


<tr>
<td width=20%><strong><?php _e("Texto adicional", 'postcredits'); ?>: </strong></td>
<td><input name="linea_extra" type="text" style="width:100%;" value="<?php echo $linea_extra; ?>" /></td>
<td width=3%></td> 
<td width=20%><?php echo $linea_extra; ?></td>
</tr>
</table>

<table width=70%>
<tr>
<td></td>
<td><h3><?php _e("Parámetros", 'postcredits'); ?></h3></td>
<td width=3%></td>
<td></td>
</tr>
<tr>
<td width=20%><strong><?php _e("Año", 'postcredits'); ?>: </strong></td>
<td><input name="anno" type="hidden" style="width:100%;" value="<?php echo $anno; ?>" />
<select name="anno">
                    	<option <?php if ($anno=='si') echo 'selected'; ?> value="si"><?php _e("Sí", 'postcredits'); ?></option>
                    	<option <?php if ($anno=='no') echo 'selected'; ?> value="no"><?php _e("No", 'postcredits'); ?></option>
                    </select>
</td>
<td width=3%></td>
<td width=20%><?php
if ($anno=='si') _e("Sí", 'postcredits'); 
if ($anno=='no') _e("No", 'postcredits');
 ?></td>
</tr>
<tr>
<td width=20%><strong><?php _e("Derechos que se reservan", 'postcredits'); ?>: </strong></td>
<td><input name="derechos" type="hidden" style="width:100%;" value="<?php echo $derechos; ?>" />
<select name="derechos">
                    	<option <?php if ($derechos=='cp') echo 'selected'; ?> value="cp">&copy;</option>
                    	<option <?php if ($derechos=='cc') echo 'selected'; ?> value="cc">(CC)</option>
                    </select>
</td>
<td width=3%></td>
<td width=20%><?php 
if ($derechos == 'cp') { echo '&copy;'; };
if ($derechos == 'cc') { echo '(CC)'; };
 ?></td>
</tr>
<tr>
<td width=20%><strong><?php _e("Visualizar en", 'postcredits'); ?>: </strong></td>
<td><input name="donde" type="hidden" style="width:100%;" value="<?php echo $donde; ?>" />
<select name="donde">
<?php
$donde1 = array ("post", "page", "both", "none");
$donde2 = array (__("Entradas", 'postcredits'), __("Páginas", 'postcredits'), __("Entradas y páginas", 'postcredits'), __("No visualizar", 'postcredits')); 
$i = 0;
while ($i < 4)
{
?>
                    	<option <?php if ($donde==$donde1[$i]) echo 'selected'; ?> value="<?php echo $donde1[$i]; ?>"><?php echo $donde2[$i]; ?></option>
<?php
$i++;
}
?>
                    </select>
</td>
<td width=3%></td>
<td width=20%><?php
$i = 0;
while ($i < 4)
{
 if ($donde==$donde1[$i]) echo $donde2[$i];
 $i++;
}
 ?></td>
</tr>

</table>

<p class="submit">
		<input name="submitted" type="hidden" value="yes" />
		<input type="submit" name="Submit" value="<?php _e("Actualizar opciones", 'postcredits'); ?>" />
</p>

</form>
<?php 

}

/* Añadir el plugin a las Opciones de WordPress */
function add_post_credits_add_to_menu() {
    add_submenu_page('options-general.php', 'Post Credits', 'Post Credits', 10, __FILE__, 'add_post_credits_settings');
add_filter('plugin_action_links', 'postcredits_filter_plugin_actions', 10, 2);
}

add_action('admin_menu', 'add_post_credits_add_to_menu');



//Concatenar el texto
$alineacion = get_option('alineacion');
if ($alineacion == '') { $alineacion = 'left'; };

$tipoletra = get_option('tipoletra');
//if ($tipoletra == '') { $tipoletra = 'small-caps'; };

$efectoletra = get_option('efectoletra');
if ($efectoletra == '') { $efectoletra = 'normal'; };

$tamletra = get_option('tamletra');
if ($tamletra == '') { $tamletra = '10'; };

$colletra = get_option('colletra');
if ($colletra == '') { $colletra = '#000000'; };

$linea_extra = get_option('linea_extra');

$anno = get_option('anno');
if ($anno == '') { $anno = 'si'; };

$derechos = get_option('derechos');
if ($derechos == '') { $derechos = 'cp'; };

$donde = get_option('donde');
if ($donde == '') { $donde = 'post'; };


$textopieini = '<div align=' . $alineacion . '>'; 

if ($tipoletra != '') { 
   $textopieini = $textopieini . '<' . $tipoletra . '>';
}

$textopieini = $textopieini . '<span style="font-variant: ' . $efectoletra . ';font-size: ' .$tamletra . 'px; color: ' . $colletra .'">';

if ($derechos == 'cp') { $textopieini = $textopieini . '&copy; ';}
else { $textopieini = $textopieini . '(CC) ';};

/*
if ($anno == 'si') {
   $textopieini = $textopieini .  date('Y') . ', ';
}
else {
   $textopieini = $textopieini .  ' ';
}
*/

if ($linea_extra != '') { $linea_extra = '<br />' . $linea_extra; };

if ($tipoletra != '') { 
   $textopiefin = '</' . $tipoletra . '>' . $textopiefin;
}

$textopiefin = $textopiefin . '</span></div>';


//Obtener el texto completo 
function post_credits() {
        //No visualizar
        global $donde;
        if ( ($donde == "none") || ( ($donde == "post") && (is_page()) ) || ( ($donde == "page") && (!is_page()) ) ) {
            return '';
        }
        //Visualizar
        else {
           //Obtener el año
           global $anno;
           if ($anno == 'si') {
               global $wp_query;
               $fecha_post = $wp_query->post->post_date;
               $fecha = substr($fecha_post, 0, 4) . ', ';
           }
           else {
                $fecha = ' ';
           }
   	   global $textopieini;    
           global $textopiefin;
           global $linea_extra;
           return $textopieini.$fecha.get_the_author().$linea_extra.$textopiefin;
        
       }
}

//Añadir el texto al post automáticamente
add_action('the_content', 'add_post_credits');

function add_post_credits( $content) {
	$content = $content.post_credits();
	return $content;
}

//Añadir en Campos personalizados 
add_action('publish_post', 'add_post_credits_custom_fields');
function add_post_credits_custom_fields($post_ID) {
	global $wpdb;
        global $linea_extra;
        $linea_extra = get_option('linea_extra');
	add_post_meta($post_ID, 'linea_extra', $linea_extra, true);
}

// Borrar en campos personalizados
add_action('delete_post', 'delete_post_credits_custom');
function delete_post_credits_custom($post_ID) {
	global $wpdb;
	delete_post_meta($post_ID, 'linea_extra');	
}

// Actualizar en campos personalizados
add_action('update_post', 'update_post_credits_custom');
function update_post_credits_custom($post_ID) {
        update_post_meta( $post_ID, 'linea_extra', 'valor de prueba' );
        return true;
}


/* Añade link a las opciones en la página de plugins
 * Thanks Dion Hulse -- http://dd32.id.au/wordpress-plugins/?configure-link
 */
function postcredits_filter_plugin_actions($links, $file){
	static $this_plugin;

	if( !$this_plugin ) $this_plugin = plugin_basename(__FILE__);

	if( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=post-credits/postcredits.php">' . __('Opciones') . '</a>';
		$links = array_merge( array($settings_link), $links); // before other links
	}
	return $links;
}

?>