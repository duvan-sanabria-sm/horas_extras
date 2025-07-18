<?php
session_start();
if (!isset($_SESSION["estadoAutentica"])) {
	require_once "../../config/LoadConfig.config.php";
	$config = LoadConfig::getConfig();
	header('Location:' . $config['URL_SITE'] . 'index.php');
}
?>
<link rel="stylesheet" href="../../assets/css/reporteGeneral.css" />
<div class="container">
    <h3 style="text-align: center;">Filtros</h3>
    <div class="cabecera">
        <div  class="filtros">
            <div class="filter_items" id="fechas">
                <label for="fecha_inicio">Fecha Inicio</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio">
                <label for="fecha_fin">Fecha Fin</label>
                <input type="date" name="fecha_fin" id="fecha_fin">
            </div>
            <div class="filter_items" id="colaborador">
                <label for="colaborador">Colaborador(es)</label>
                <select name="colaborador" id=""></select>
            </div>
            <div class="filter_items" id="cecoClase">
                <label for="ceco">Centro de Costo</label>
                <select name="ceco" id="ceco" style="margin-bottom: 5px;"></select>
                <label for="clase">Clase</label>
                <select name="clase" id="clase"></select>
            </div>
            <div class="filter_items" id="proyecto">
                <label for="proyecto">Proyecto</label>
                <input type="text" name="proyecto" id="proyecto" label="Nombre del proyecto">
            </div>
        </div>
        <div class="enviar">
            <input type="submit" value="Filtrar">
        </div>
    </div>
</div>