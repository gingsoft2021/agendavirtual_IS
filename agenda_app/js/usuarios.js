$('#tabla_usuarios').DataTable({

  'paging': true,
  'info': true,
  'filter': true,
  'stateSave': true,

  'ajax': {
      
      "url":baseurl+"C_Administrar_Usuarios/get_usuarios/",
      "type":"POST",
      dataSrc: ''
     
      },

  'columns': [

      {data: 'nombre'},
      {data: 'app'},
      {data: 'apmaterno'},
      {data: 'dni'},
      {data: 'ciudad'},
      {data: 'intEstado'},
      {"orderable": true,
          render:function(data, type, row){
                 return '<a href="#" title="Editar informacion" data-toggle="modal" data-target="#modalEditPersona" onClick="selPersona(\''+row.rut_usu+'\',\''+row.pnombre+'\',\''+row.apellido_pa+'\',\''+row.apellido_ma+'\',\''+row.descripcion_tip+'\' ,\''+row.nombre_suc+'\',\''+row.estado+'\');"><i style="color:#555;" class="glyphicon glyphicon-edit"></i> Editar</a>';
          } 

        }

      ],

      "order:" [[0, "asc"]],

 });