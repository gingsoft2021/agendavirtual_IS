<?php


require_once APPPATH. '/third_party/mpdf/vendor/autoload.php';


$html ='

<div>
<img  tyle="float:right; margin:10px;"src="'.$_GET['imagen'].'">
<h2 style="text-align:center; top: -400px;">Consulta de Horarios</h2>
</div>
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

<br></br>';


$html .='<div><table style= "width:100%;">
	<tr>
		<th style="text-align:center; background-color:#f2f2f2;">HRS.Ini</th>
		<th style="text-align:center; background-color:#f2f2f2;">HRS.Ter</th>
		<th style="text-align:center; background-color:#f2f2f2;">Lunes</th>
    <th style="text-align:center; background-color:#f2f2f2;">Martes</th>
    <th style="text-align:center; background-color:#f2f2f2;">Miercoles</th>
    <th style="text-align:center; background-color:#f2f2f2;">Jueves</th>
    <th style="text-align:center; background-color:#f2f2f2;">Viernes</th>
    <th style="text-align:center; background-color:#f2f2f2;">Sabado</th>
	</tr>';



	foreach($consulta as $row){
$html .= '<tr style="font-size:10px;">
          <td style=" background-color:#f2f2f2;width: 70px;">&nbsp;'.$row->hrs_ini.'</td>
          <td style="text-align:center; background-color:#f2f2f2; width: 70px;">'.$row->hrs_ter.'</td>
          <td style="text-align:center; background-color:#f2f2f2; width: 70px;">'.$row->lunes.'</td>
          <td style="text-align:center; background-color:#f2f2f2;width: 70px;">'.$row->martes.'</td>
          <td style="text-align:center; background-color:#f2f2f2;width: 70px;">'.$row->miercoles.'</td>
          <td style="text-align:center; background-color:#f2f2f2;width: 70px;">'.$row->jueves.'</td>
          <td style="text-align:center; background-color:#f2f2f2;width: 70px;">'.$row->viernes.'</td>
          <td style="text-align:center; background-color:#f2f2f2;width: 70px;">'.$row->sabado.'</td>
          </tr>'; }



          


$html .='</table></div>';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output('Tabla_Porcentual.pdf','I');
?>




