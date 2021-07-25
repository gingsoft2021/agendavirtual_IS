<?php


require_once APPPATH. '/third_party/mpdf/vendor/autoload.php';


$html ='

<div>
<img  tyle="float:right; margin:10px;"src="'.$_GET['imagen'].'">
<h2 style="text-align:center; top: -400px;">Porcentaje de Citas</h2>
</div>
<br></br>
<br></br>
<br></br>
<br></br>
<br></br>
<div>
	<label><b>Fecha de Inicio:</b>&nbsp;'.$_GET['fecha_ini'].'</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><b>Fecha de Termino:</b>&nbsp;'.$_GET['fecha_ter'].'</label>
</div>

<div>
    <label><b>Fecha de Emision:</b>&nbsp;'.$_GET['hoy'].'</label></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<label><b>Jefe de Carrera:</b>&nbsp;'.$_GET['jc'].'</label>
</div>

<div>
<label><b>Sede:</b>&nbsp;'.$_GET['sede'].'</label></label>
</div>


<br></br>


<br></br>
<br></br>
<br></br>
<br></br>';


$html .='<div><table style= "width:100%;">
	<tr>
		<th style="text-align:center; background-color:#f2f2f2;">Motivo</th>
		<th style="text-align:center; background-color:#f2f2f2;">Cantidad</th>
		<th style="text-align:center; background-color:#f2f2f2;">Porcentaje</th>
	</tr>';

$html .= '<tr>
          <td style=" background-color:#f2f2f2;">&nbsp;&nbsp;&nbsp;</td>
          <td style="text-align:center; background-color:#f2f2f2;">&nbsp;</td>
          <td style="text-align:center; background-color:#f2f2f2;">&nbsp;</td>
          </tr>' ;

	foreach($consulta as $row){
$html .= '<tr>
          <td style=" background-color:#f2f2f2;">&nbsp;&nbsp;&nbsp; '.$row->descripcion_mot.'</td>
          <td style="text-align:center; background-color:#f2f2f2;">'.$row->cantidad_motivos.'</td>
          <td style="text-align:center; background-color:#f2f2f2;">'.$row->porcentaje.' %</td>
          </tr>'; }
$html .= '<tr>
          <td style=" background-color:#f2f2f2;">&nbsp;&nbsp;&nbsp;</td>
          <td style="text-align:center; background-color:#f2f2f2;">&nbsp;</td>
          <td style="text-align:center; background-color:#f2f2f2;">&nbsp;</td>
          </tr>' ;
          
$html .='<tr>
         <td style=" background-color:#dddddd;">&nbsp;&nbsp;&nbsp;&nbsp;Totales</td>
         <td style="text-align:center; background-color:#dddddd;">'; 
     foreach($total as $row){
$html .=' '.$row->total.' '; }


$html .='</td>
         <td style="text-align:center; background-color:#dddddd;">100.00 % </td>
         </tr>';

$html .='</table></div>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('Tabla_Porcentual.pdf','I');
?>




