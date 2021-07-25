<script src="<?php echo base_url();?>assets/jquery/jquery-2.2.3.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables-responsive/dataTables.responsive.js"></script>
<link src="<?php echo base_url();?>assets/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
<link src="<?php echo base_url();?>assets/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript">

jQuery(document).ready(function() {

//Mostrar datos en la tabla
    $("#tblUsuarios").DataTable({

      'paging': true,
      'info': true,
      'filter': true,
      'ajax': { "url": "<?=base_url();?>C_Administrar_Usuarios/listar_usuarios", "type": "POST", "dataSrc": ''},
      'columns': [
          { data: 'Rut', render: function(data, type, row){ return '<i class="fa fa-edit" ></i> <a href="#" class="edit" data-toggle="modal" data-target="#modal_editar" onClick="traer_datos(\''+row.Rut+'\',\''+row.Nombre+'\',\''+row.Id_sucursal+'\',\''+row.Id_cuenta+'\',\''+row.Estado+'\');">' + row.Rut + '</a>'; }},
            { data: 'Nombre'},
            { data: 'Sucursal'},
            { data: 'Cuenta'},
            { data: 'Estado'},

          ],

      "order": [[ 0, "asc" ]],
      "language": { "lengthMenu": " _MENU_ Registros por página", "zeroRecords": "No se encontraron resultados", "info": "Página: _PAGE_ de _PAGES_", "infoEmpty": "No se encontraron resultados.", "infoFiltered": "(filtrado de  _MAX_ registros en total)", "sSearch": "Buscar", "oPaginate": { "sFirst": "Primero", "sPrevious": "Anterior", "sNext": "Siguiente", "sLast": "Último" },}

    });
//Fin de mostrar datos en tabla
//Traer datos al modal
traer_datos = function(Rut,Nombre,Id_sucursal,Id_cuenta, Estado){
  $('#rut_usu').val(Rut);
  $('#nombre').val(Nombre);
  $('#id_suc').val(Id_sucursal);
  $('#id_tip').val(Id_cuenta);
  $('#estado').val(Estado);
};
//Fin de Traer datos al modal
//Editar Datos del modal
    $("#btn_editar").click(function(e){

      var parametros = {
       "rut_usu": $("#rut_usu").val(),
       "id_tip": $("#id_tip").val(),
       "id_suc": $("#id_suc").val(),
       "estado": $("#estado").val(),
      }
        $.ajax({
        data: parametros,
        url: '<?php echo base_url();?>C_Administrar_Usuarios/editar_cuenta',
        type: 'post',
        success:function(response){
          $("#modal_editar").modal('hide');
          $("#modal_confirmar").modal('show');
          $('#tblUsuarios').DataTable().ajax.reload();
         }
        });

    });
//Fin de Editar datos
});
</script>


<div class="row">
  <div class="col-lg-12">
    <h3 class="page-header">Administrar Cuentas</h3>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Listado de Usuarios
      </div>
      <div class="panel-body">
        <div >
           <table class="table mt-5 table-sm " id="tblUsuarios" width="100%" class="table table-responsive" >
             <thead>
              <tr>
              <th>Rut</th>
              <th>Nombre</th>
              <th>Sucursal</th>
              <th>Cuenta</th>
              <th>Estado</th>
              </tr>
             </thead>
             <tbody>
             </tbody>
           </table>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_editar" name="modal_editar"  role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title ">Editar Permisos de Usuario</h3>
        </div>
        <div class="modal-body">

          <form id="editar_cuenta" name="editar_cuenta">
            <div class="row">
              <div class="col-lg-3">
                <div class="form-group">
                  <label class="control-label">Rut</label>
                  <input type="text" class="form-control" id="rut_usu" name="rut_usu" readonly=”readonly”>
                </div>
                </div>
                <div class="col-lg-7">
                  <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" readonly=”readonly”>
                  </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-lg-5">
                  <div class="form-group">
                    <label class="control-label">Sucursal</label>
                    <select id="id_suc" name="id_suc" class="form-control">
                    <?php
                      $this->load->model('M_Usuarios');
                      $listar_sucursales = $this->M_Usuarios->sucursales();
                      foreach($listar_sucursales as $fila){
                      echo '<option value="'. $fila->id_suc.'">'. $fila->nombre_suc .'</option>';
                      } ?>
                    </select>
                  </div>
                  </div>
                  <div class="col-lg-5">
                    <div class="form-group">
                      <label class="control-label">Tipo de Cuenta</label>
                      <select id="id_tip" name="id_tip" class="form-control">
                        <?php
                          $this->load->model('M_Usuarios');
                          $listar_cuentas = $this->M_Usuarios->tipos_cuenta();
                          foreach($listar_cuentas as $fila){
                          echo '<option value="'. $fila->id_tip.'">'. $fila->descripcion_tip .'</option>';
                          } ?>
                    </select>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                      <div class="form-group">
                        <label class="control-label">Estado</label>
                        <select id="estado" name="estado" class="form-control">
                        <option value="Activada">Activada</option>
                        <option value="Desactivada">Desactivada</option>
                      </select>
                      </div>
                      </div>
                  </div>

          </form>
      </div>
    <div class="modal-footer">
          <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btn_editar" name="btn_editar">Editar</button>
    </div>
  </div>
 </div>
</div>

<div id="modal_confirmar" class="modal fade" role="dialog">
        <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <h4 class="modal-title">Mensaje de Confirmación</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
           </div>
           <div class="modal-body">
             <p>Datos Ingresados Correctamente</p>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-info ml-3" data-dismiss="modal">Aceptar</button>
           </div>
         </div>
       </div>
</div>
