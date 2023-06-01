<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <title>Información de Transporte</title>
    <title>Ejemplo de página HTML</title>
    <style>
        body {
            background: rgb(9,9,121);
            background: radial-gradient(circle, rgba(9,9,121,1) 56%, rgba(4,120,194,1) 93%);
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Altura del viewport */
        }

        .rectangle {
            align-self: auto;
            width: 600px;
            height: 600px;
            border-radius: 10%;
            background-color: #fffced; /* Color del rectángulo centrado */
            border: 2px solid #000; /* Borde de 2 píxeles de ancho y color negro */
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.2); /* Sombra de 4 píxeles de desplazamiento en x, 4 píxeles de desplazamiento en y, 8 píxeles de desenfoque y transparencia de 0.2 */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="rectangle">

            <center>
                <div class="row" style="padding: 10%">
        <div style="page-break-inside: avoid; width:100%">
            <i class='bx bxs-user-detail' style="font-size: 80px"></i>
            <br>
            <hr>
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
            <i class='bx bxs-truck' style="font-size: 80px"></i>
            <br>
            <hr>
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
            </center>
        </div>
    </div>
</body>
</html>
