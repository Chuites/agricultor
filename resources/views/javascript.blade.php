<script>
    $(document).ajaxStart(function() {
        $('#loading-overlay').show();
    });

    $(document).ajaxStop(function() {
        $('#loading-overlay').hide();
    });

document.addEventListener("DOMContentLoaded", function(event) {

    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)

    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
        toggle.addEventListener('click', ()=>{
        // show navbar
        nav.classList.toggle('show')
        // change icon
        toggle.classList.toggle('bx-x')
        // add padding to body
        bodypd.classList.toggle('body-pd')
        // add padding to header
        headerpd.classList.toggle('body-pd')
        })
    }
    }

    showNavbar('header-toggle','nav-bar','body-pd','header')

    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')

    function colorLink(){
    if(linkColor){
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
    }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))

    document.getElementById("bienvenida").style.display = "block";
    document.getElementById("datos_cuenta").style.display = "none";
    document.getElementById("datos_envio").style.display = "none";
    document.getElementById("test_conexion").style.display = "none";
    document.getElementById("test_transporte").style.display = "none";
    document.getElementById("test_piloto").style.display = "none";
    document.getElementById("datos_parcialidad").style.display = "none";
    document.getElementById("traking_div").style.display = "none";



    $("#btntestconexion").click(function(e){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                url: "{{route('TestApi')}}",
                data: { "id": "testid" },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                    alert('El servicio se encuentra en linea');
                },
            });
    });

    $(document).ready(function() {
        $('#listadoCargamentos').hide();
        $('[data-tooltip]').tooltip();
    });


    $("#btnConsultarEstado").click(function(e){
        if($("#id_cargamento_estado").val() == ''){
            alert('Debe ingresar un numero de cargamento para consultar el estado')
        }else{
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("estadoCargamento") }}',
                type: 'POST',
                data: {
                    id_cargamento: $("#id_cargamento_estado").val()
                },
                dataType: 'json',
                success: function(data) {
                    estado = data.estado;
                    alert(data.justificacion);
                    $('#creada').removeClass('estado_actual');
                    $('#abierta').removeClass('estado_actual');
                    $('#piniciado').removeClass('estado_actual');
                    $('#pfinalizado').removeClass('estado_actual');
                    $('#cerrada').removeClass('estado_actual');
                    $('#confirmada').removeClass('estado_actual');

                    switch (estado) {
                        case 1:
                        $('#creada').addClass('estado_actual');
                            break;
                        case 2:
                        $('#abierta').addClass('estado_actual');
                            break;
                        case 3:
                        $('#piniciado').addClass('estado_actual');
                            break;
                        case 4:
                        $('#pfinalizado').addClass('estado_actual');
                            break;
                        case 5:
                        $('#pfinalizado').addClass('estado_actual');
                        $('#cerrada').addClass('estado_actual');
                            break;
                        case 6:
                        $('#confirmada').addClass('estado_actual');
                            break;

                        default:
                            break;
                    }
                },
                error: function(response){
                    alert('error');
                }
            });
        }
    });

    $("#btnEnviarParcialidad").click(function(e){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("enviarParcialidad") }}',
            type: 'POST',
            data: {
                id_cargamento: $('#id_cargamento').val(),
                peso_parcialidad: $('#peso_parcialidad').val(),
            },
            dataType: 'json',
            success: function(data) {
                if (data.mensaje) {
                    alert(data.mensaje);
                } else {
                    alert('Todos los campos son requeridos');
                }

            },
            error: function(response){
                alert('error');
            }
        });
    });

    $("#btnMostrarCargamentos").click(function(e){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                url: "{{route('listadoCargamentos')}}",
                data: { "id": "testid" },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    // Construir la tabla dinámica con los datos recibidos
                    var tbody = $('#tabla-dinamica tbody');
                    tbody.empty();
                    // Recorrer los datos y agregar filas a la tabla
                    $.each(data, function(index, data) {
                        console.log(data.id_cargamento);
                        console.log(index);
                        var row = $('<tr>');
                        row.append($('<td>').text(data.id_cargamento));
                        row.append($('<td>').text(data.peso));
                        row.append($('<td>').text(data.parcialidades));
                        tbody.append(row);
                    });
                    $('#listadoCargamentos').show();
                },
                error: function() {
                    // Manejar el error en caso de que la solicitud falle
                    console.log('Error al obtener los datos.');
                }
            });
    });

    $("#logout").click(function(e){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                url: "{{route('logout')}}",
                data: { "id": "testid" },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                    window.location = "{{ url('/') }}";
                },
            });
    });

    $("#btntesttransporte").click(function(e){
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "POST",
            url: "{{route('testTransporte')}}",
            data: {
                placa: $("#placa").val()
            },
            success: function(data) {
                if(data[0] != null)
                {
                    alert(data[0]);
                }else{
                    alert(data.mensaje);
                    console.log(data.mensaje);
                }
            },
            error: function(data){
                console.log(data);
                alert('error');
            }
        });
    });

    $("#btntestpiloto").click(function(e){
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            type: "POST",
            url: "{{route('testPiloto')}}",
            data: {
                dpi_piloto: $("#dpi_piloto").val()
            },
            success: function(data) {
                if(data[0] != null)
                {
                    alert(data[0]);
                }else{
                    alert(data.mensaje);
                    console.log(data.mensaje);
                }
            },
            error: function(data){
                console.log(data);
                alert('error');
            }
        });
    });

    $("#btnEnviarCargamento").click(function(e){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("enviarCargamento") }}',
            type: 'POST',
            data: {
                dpi_piloto: $('#dpi_piloto_envio').val(),
                placa_transporte_envio: $('#placa_transporte_envio').val(),
                peso_total: $('#peso_total').val(),
                parcialidades: $('#parcialidades_envio').val()
            },
            dataType: 'json',
            success: function(data) {
                let mensaje;
                console.log(data);
                if (data.hasOwnProperty('transporte')) {
                    mensaje = data.transporte + "\n";
                }
                if (data.hasOwnProperty('agricultor')) {
                    mensaje = mensaje + data.agricultor + "\n";
                }
                if (data.hasOwnProperty('piloto')) {
                    mensaje = mensaje + data.piloto + "\n";
                }
                console.log(data);
                alert(mensaje);
            },
            error: function(response){
                alert("Error al consultar los datos");
            }
        });
    });

    $("#btnCrearCuenta").click(function(e){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route("crearCuenta") }}',
            type: 'POST',
            data: {
                nombre: $('#nombre').val(),
                dpi: $('#dpi').val(),
                telefono: $('#telefono').val(),
                direccion: $('#direccion').val(),
                correo: $('#correo').val(),
                nit: $('#nit').val(),
                password: $('#password').val()
            },
            dataType: 'json',
            success: function(data) {
                    if(data[0] != null)
                    {
                        alert(data[0]);
                    }else{
                        alert('Cuenta creada correctamente' + '\n' + 'ID de Cuenta: '+ data.user.id + '\n'
                        + data.user.name +' Por favor ingrese con su usuario');
                    }
                },
            error: function(response){
                alert(response);
                console.log(response);
            }
        });
    });


    $("#btn_traking").click(function(e){
        document.getElementById("traking_div").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
        document.getElementById("datos_parcialidad").style.display = "none";
    });
    $("#btn_enviar_parcialidad").click(function(e){
        document.getElementById("datos_parcialidad").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
        document.getElementById("traking_div").style.display = "none";
    });
    $("#btn_test_conexion").click(function(e){
        document.getElementById("test_conexion").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
        document.getElementById("datos_parcialidad").style.display = "none";
        document.getElementById("traking_div").style.display = "none";
    });
    $("#btn_crear_cuenta").click(function(e){
        document.getElementById("datos_cuenta").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
        document.getElementById("datos_parcialidad").style.display = "none";
        document.getElementById("traking_div").style.display = "none";
    });
    $("#btn_crear_cuenta2").click(function(e){
        document.getElementById("datos_cuenta").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
        document.getElementById("datos_parcialidad").style.display = "none";
        document.getElementById("traking_div").style.display = "none";
    });
    $("#btn_inicio").click(function(e){
        document.getElementById("bienvenida").style.display = "block";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
        document.getElementById("datos_parcialidad").style.display = "none";
        document.getElementById("traking_div").style.display = "none";
    });
    $("#btn_realizar_envios").click(function(e){
        document.getElementById("datos_envio").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
        document.getElementById("datos_parcialidad").style.display = "none";
        document.getElementById("traking_div").style.display = "none";
    });
    $("#btn_test_transporte").click(function(e){
        document.getElementById("test_transporte").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_piloto").style.display = "none";
        document.getElementById("datos_parcialidad").style.display = "none";
        document.getElementById("traking_div").style.display = "none";
    });
    $("#btn_test_piloto").click(function(e){
        document.getElementById("test_piloto").style.display = "block";
        document.getElementById("bienvenida").style.display = "none";
        document.getElementById("datos_cuenta").style.display = "none";
        document.getElementById("datos_envio").style.display = "none";
        document.getElementById("test_conexion").style.display = "none";
        document.getElementById("test_transporte").style.display = "none";
        document.getElementById("datos_parcialidad").style.display = "none";
        document.getElementById("traking_div").style.display = "none";
    });
});

</script>
