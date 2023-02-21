<!-- require_once('../../controller/Report.controller.php');
$arrayReport = executeReport('2022-06-01', '2022-06-30', 'detalleReporte');

foreach ($arrayReport as $items){
    var_dump($items["id_horaExtra"]);
}



$data = $_POST['data'];
$recargos = json_decode($data['valuesRecargo']);

$ids = array();

foreach ($recargos as $items) {
    foreach ($items as $item){
        $ids[] = $item->codigo;
    }
}
echo json_encode($ids);


$data = $_POST['object'];
$value = $data['id'];
$value2 = $data['titulo'];
echo $value2; -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .table-wrapper {
            height: 100px;
            overflow: auto;
        }

        .table-fixed-header {
            width: auto;
        }

        .table-fixed-header thead {
            position: fixed;
            top: 0;
            background-color: #f3f3f3;
        }

        .table-fixed-header th {
            text-align: center;
        }
    </style>

    <script>
        function fixHeader() {
            var table = document.querySelector('.table-fixed-header');
            var header = table.querySelector('thead');
            var headerHeight = header.offsetHeight;
            table.style.paddingTop = headerHeight + 'px';
        }

        window.addEventListener('load', fixHeader);
        window.addEventListener('resize', fixHeader);
    </script>
</head>

<body>
    <div class="table-wrapper">
        <table class="table-fixed-header">
            <thead>
                <tr>
                    <th>Column 1</th>
                    <th>Column 2</th>
                    <th>Column 3</th>
                    <th>Column 4</th>
                    <th>Column 5</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
                <tr>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                    <td>COLUMNA</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>