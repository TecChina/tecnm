$('.formulario-categoria').submit(function(e) {
    e.preventDefault();

    Swal.fire({
    title: 'Editar categoria',
    text: "Confirmar si accede al proceso",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Confirmar'
    }).then((result) => {
    if (result.isConfirmed) {
        this.submit();
    }
    })
});