<style>
.status-icon i {
    font-size: 80px; /* Tamaño de los iconos */
    color: #121263; /* Color de los iconos */
    cursor: pointer;
}

.estado_actual i{
    font-size: 100px; /* Tamaño de los iconos */
    color: #1af430; /* Color de los iconos */
    cursor: pointer;
}

.tooltip {
    position: relative;
    display: inline-block;
}

.tooltip .tooltip-text {
    visibility: hidden;
    width: 120px;
    background-color: #000;
    color: #fff;
    text-align: center;
    padding: 5px;
    border-radius: 5px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    transform: translateX(-50%);
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
}
</style>
<div class="height-100 bg-light" style="padding:7%;" id="traking_div">

    <h3>TRACKING</h3>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <input type="text" class="form-control" id="id_cargamento_estado" name="id_cargamento_estado" placeholder="Ingrese el id del cargamento" required>
        </div>
        <div class="col-md-6">
            <a href="#" class="btn btn-primary form-control" id="btnConsultarEstado" name="btnConsultarEstado">Consultar Estado</a>
        </div>
    </div>
    <br>
    <br>
    <div class="cargamento-status">
        <br>
        <center>
            <h1>Estado del Cargamento</h1>
            <br>
            <div class="status-icon">
                <span title="Cuenta Creada" id="creada"><i class='bx bxs-coffee-bean '></i></span>
                &nbsp;
                <span title="Cuenta Abierta" id="abierta"><i class='bx bxs-lock-open'></i></span>
                &nbsp;
                <span title="Pesaje Iniciado" id="piniciado"><i class='bx bx-play-circle'></i></span>
                &nbsp;
                <span title="Pesaje Finalizado" id="pfinalizado"><i class='bx bx-stop-circle'></i></span>
                &nbsp;
                <span title="Cuenta Cerrada" id="cerrada"><i class='bx bxs-lock-alt'></i></span>
                &nbsp;
                <span title="Cuenta Confirmada" id="confirmada"><i class='bx bx-check-double'></i></span>

            </div>

        </center>



    </div>

</div>
