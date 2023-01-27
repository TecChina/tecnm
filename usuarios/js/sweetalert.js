//Alerta de eliminar usuario
function alerta_eliminar(codigo) {
    Swal.fire({
        title: 'SEGURO DESEAS ELIMINAR?',
        text: "UNA VEZ HECHO EL CAMBIO NO SE PUEDE REVERTIR!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, ELIMINARLO!'
      }).then((result) => {
        if (result.isConfirmed) {
          mandar_php(codigo)
        }
    })
}

function mandar_php(codigo) {
    parametros = { id: codigo };
    $.ajax({
        data: parametros,
        url: "eliminar_usuario.php",
        type: "GET",
        beforeSend: function () {},
        success: function () {
            Swal.fire("ELIMINADO", "EL CAMPO A SIDO ELIMINADO.", "success").then((result) =>{
                window.location.href = "lista-usuarios.php"
            });
        }
    });
}

//Alerta de guardar usuarios, jefes de departamento y departamentos a la hora de editar
function alerta_guardar() {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'SEGUARDO CORRECTAMENTE',
        showConfirmButton: true,
      })
}

//Alerta de eliminar departamento
function alerta_eliminar2(codigos1) {
    Swal.fire({
        title: 'SEGURO DESEAS ELIMINAR?',
        text: "UNA VEZ HECHO EL CAMBIO NO SE PUEDE REVERTIR!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, ELIMINARLO!'
      }).then((result) => {
        if (result.isConfirmed) {
          mandar_php2(codigos1)
        }
    })
}

function mandar_php2(codigos1) {
    parametros2 = { id: codigos1 };
    $.ajax({
        data: parametros2,
        url: "eliminar_dep.php",
        type: "GET",
        beforeSend: function () {},
        success: function () {
            Swal.fire("ELIMINADO", "EL CAMPO A SIDO ELIMINADO..", "success").then((result) =>{
                window.location.href = "añadirDepartamento.php"
            });
        }
    });
}

//Alerta de eliminar jefes de departamento
function alerta_eliminar3(codig) {
    Swal.fire({
        title: 'SEGURO DESEAS ELIMINAR?',
        text: "UNA VEZ HECHO EL CAMBIO NO SE PUEDE REVERTIR!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'SI, ELIMINARLO!'
      }).then((result) => {
        if (result.isConfirmed) {
          mandar_php3(codig)
        }
    })
}

function mandar_php3(codig) {
    parametros3 = { id: codig };
    $.ajax({
        data: parametros3,
        url: "eliminar_jefes.php",
        type: "GET",
        beforeSend: function () {},
        success: function () {
            Swal.fire("ELIMINADO", "EL CAMPO A SIDO ELIMINADO.", "success").then((result) =>{
                window.location.href = "lista-jefes.php"
            });
        }
    });
}


/******************************/
/*********EXTRAESCOLAR*********/
/******************************/

function extra_eliminar(extra) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          mandar_php(extra)
        }
    })
}


function mandar_php2(codigos1) {
    parametros2 = { id: codigos1 };
    $.ajax({
        data: parametros2,
        url: "eliminar_dep.php",
        type: "GET",
        beforeSend: function () {},
        success: function () {
            Swal.fire("Deleted", "Your file has been deleted.", "success").then((result) =>{
                window.location.href = "añadirDepartamento.php"
            });
        }
    });
}

function alerta_eliminar3(codig) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          mandar_php3(codig)
        }
    })
}

function mandar_php3(codig) {
    parametros3 = { id: codig };
    $.ajax({
        data: parametros3,
        url: "eliminar_jefes.php",
        type: "GET",
        beforeSend: function () {},
        success: function () {
            Swal.fire("Deleted", "Your file has been deleted.", "success").then((result) =>{
                window.location.href = "lista-jefes.php"
            });
        }
    });
}


/******************************/
/*********EXTRAESCOLAR*********/
/******************************/

function extra_eliminar(extra) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          mandar_php(extra)
        }
    })
}