<div class="height-100 bg-light" style="padding:7%;" id="datos_envio">
    <h3>DATOS DE ENVIO</h3>
    <hr>
    <center><h4>Datos del Transporte</h4></center>
    <form class="row g-3 needs-validation" novalidate>
        <div class="col-md-6">
            <label for="validationCustom01" class="form-label">DPI del Piloto</label>
            <input type="text" class="form-control" id="dpi_piloto_envio" name="dpi_piloto_envio" placeholder="Introduzca el DPI del Piloto" required>
        </div>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">Placa del Transporte</label>
            <input type="text" class="form-control" id="placa_transporte_envio" name="placa_transporte_envio" placeholder="Introduzca la placa del transporte" required>
        </div>
        <hr>
        <center><h4>Datos del Cargamento</h4></center>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">Peso total</label>
            <input type="text" class="form-control" id="peso_total" name="peso_total" placeholder="Ingrese el peso total en libras del cargamento" required>
        </div>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">Parcialidades</label>
            <input type="text" class="form-control" id="parcialidades_envio" name="parcialidades_envio" placeholder="Ingrese el numero de parcialidades" required>
        </div>
        <center>
            <a href="#" class="btn btn-primary" id="btnEnviarCargamento" name="btnEnviarCargamento">Enviar Carga</a>
        </center>
        <br>
        <br>
    </form>
</div>
