

function msmNoRegisters() {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "¡No cuenta con registros en esta sección!",
    });
}

function sinArchivo() {
    Swal.fire({
        icon: "warning",
        title: "Oops...",
        text: "¡Sin cargar archivo!",
    });
}

function guardarArchivo() {
    Swal.fire({
        icon: "success",
        text: "Archivo guardado!",
    });
}

function registroGuardado() {
    Swal.fire({
        icon: "success",
        text: "Registro guardado!",
    });
}