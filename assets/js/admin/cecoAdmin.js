'use strict';
$(document).ready(function () {
    console.log('Cargando admin CECO');

    $.when($.ajax('../controller/CRUD.controller.php?action=listAll&model=CentroCosto&crud=get'))
        .then(function (result) {
            let html = '';
            let data = JSON.parse(result);
            data.forEach(element=>{
                html += `<tr>
                         <td><input type="text" class="fieldEdit" name="" id="ceco_${element.id}" value="${element.titulo}" style="font-size: 12px;" required></td>
                         <td> <span data-id="${element.id}" class="updateCeco icon solid fa-check-circle fi"></span> </td>
                        </tr>`;
            });

            $('#ceco').html(html);
            updateCECO();
            createCECO();
        })
});

function updateCECO() {
    $('.updateCeco').click(function () {
        console.log('update');
        swal('¿Desea actualizar el registro?', {
            buttons: ["No!", "Si!"],
        }).then(async (val)=>{
            if (val){
                let id = $(this).data('id');
                let titulo = $(`#ceco_${id}`).val();

                let object = {
                    'object': {
                        'id': id,
                        'titulo': titulo
                    }
                }

                console.log(object);

                $.when($.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=CentroCosto&crud=update', type: 'post'}))
                    .then(function (result){
                        console.log(result);
                        if (!result){
                            $.notify('Error al actualizar', 'error');
                            return;
                        }

                        $.notify('Actualizado con exito!', 'success');
                    })

            }else{
                $.notify('Se ha cancelado la transacción.', 'info');
            }
        });

    })
}
function createCECO() {
    $('#sendData').click(function (e) {
        e.preventDefault();
        console.log('crear');
        swal('¿Desea crear el registro?', {
            buttons: ["No!", "Si!"],
        }).then(async (val)=>{
            if (val){
                let titulo = $(`#formCeco input[name="title"]`).val();

                let object = {
                    'object': {
                        'titulo': titulo
                    }
                }

                console.log(object);

                $.when($.ajax({data: object, url: '../controller/CRUD.controller.php?action=execute&model=CentroCosto&crud=insert', type: 'post'}))
                    .then(function (result){
                        console.log(result);
                        if (!result){
                            $.notify('Error al actualizar', 'error');
                            return;
                        }

                        $.notify('Actualizado con exito!', 'success');
                        reloadPageAdmin();
                    })

            }else{
                $.notify('Se ha cancelado la transacción.', 'info');
            }
        });
    })
}

function reloadPageAdmin() {
    $.when($.ajax('./admin/centroCosto.view.php'))
        .then(function(result) {
            var script = "<script src=\"../assets/js/admin/cecoAdmin.js\"></script>";

            //Cargar HTML
            $('#links').append(script);
            $('#result').html(result);
        })
}