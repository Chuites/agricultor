<div class="height-100 bg-light" style="padding:7%;" id="datos_parcialidad">
    <h3>ENVIO DE PARCIALIDAD</h3>
    <hr>
    <form class="row g-3 needs-validation" novalidate>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">No. Cargamento</label>
            <input type="text" class="form-control" id="id_cargamento" name="id_cargamento" placeholder="Ingrese el peso total en libras del cargamento" required>
        </div>
        <div class="col-md-6">
            <label for="validationCustom02" class="form-label">Peso de Parcialidad</label>
            <input type="text" class="form-control" id="peso_parcialidad" name="peso_parcialidad" placeholder="Ingrese el numero de cargamento" required>
        </div>
        <center>
            <a href="#" class="btn btn-primary" id="btnEnviarParcialidad" name="btnEnviarParcialidad">Enviar Parcialidad</a>
        </center>
        <br>
        <br>
        <a href="#" class="btn btn-primary" id="btnMostrarCargamentos" name="btnMostrarCargamentos">Mostrar Cargamentos</a>
    </form>
    <form action="{{route('generarQR')}}" id="form_generarQR"></form>
    <br>
    <div id="listadoCargamentos">
        <h3>Cargamentos Creados</h3>
        <table class="table" id="tabla-dinamica">
            <thead>
                <tr>
                    <th scope="col">No Cargamento</th>
                    <th scope="col">Peso</th>
                    <th scope="col">Parcialidades</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
