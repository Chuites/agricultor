<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <h1>Boleta de envio parcialidad</h1>
    </center>
    <br>
    <div class="row">
        <div style="page-break-inside: avoid; width:100%">
            <table border="1" width="100%" cellspacing=0>
                <tr align="center" style="background-color: rgba(131, 131, 131, 0.6)">
                    <td colspan="2"><b>Datos del Piloto</b></td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>DPI</strong></td>
                    <td align="left">&nbsp;{{$dpi_piloto}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Nombre</strong></td>
                    <td align="left">&nbsp;{{$nombre_piloto}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Estado</strong></td>
                    <td align="left">&nbsp;{{$estado_piloto}}</td>
                </tr>
            </table>
        </div>
        <br>
        <div style="page-break-inside: avoid; width:100%">
            <table border="1" width="100%" cellspacing=0>
                <tr align="center" style="background-color: rgba(131, 131, 131, 0.6)">
                    <td colspan="2"><b>Datos del Transporte</b></td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Placa</strong></td>
                    <td align="left">&nbsp;{{$placa_transporte}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Marca</strong></td>
                    <td align="left">&nbsp;{{$marca_transporte}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Color</strong></td>
                    <td align="left">&nbsp;{{$color_transporte}}</td>
                </tr>
                <tr>
                    <td width="20%" align="right" style="background-color: rgba(131, 131, 131, 0.6)"><strong>Estado</strong></td>
                    <td align="left">&nbsp;{{$estado_transporte}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
