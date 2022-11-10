$(document).ready(function(){

    console.log('Is Ready');
    send();
    close();
});

function send() {
    $('#send').click(function(e){
        e.preventDefault();

        var data = {
            'user': document.getElementById('user').value,
            'pass': document.getElementById('pass').value
        }

        $.ajax({
            data: data,
            url: './controller/session.controller.php?action=init',
            type: 'post',
            success: function(result){
                
                if (result !== '1') {
                    $.notify("El servidor no esta disponible!", 'error');
                    console.log('No se pudo conectar el servidor');
                    return false;
                }

                $.ajax({
                    url: './controller/session.controller.php?action=validateRole',
                    type: 'post',
                    success: function(result){
                        window.location.href='view/home.php';
                    }
                });     
            },
            error: function(error) {
                console.log('Error al iniciar sesión!', error);
            } 
        });
    })
}

function close(){

    $('#user').on("mouseover click", function(e) {
        $('#close').css("display", "inherit"); 
        $('#close').click(function(e){
            console.log('Hola Mundo');
            $.ajax({
                url: '../controller/session.controller.php?action=finish',
                success: function(result){
                    localStorage.clear();
                    window.location.href='../index.php';
                }
            });
        })
    });

    $('#user').mouseout(function(params) {
        $('#close').css("display", "none"); 
    });
    
}

// function test(){
//     $('#ccBtn').click(function(e){
//         e.preventDefault();

//         var titulo = $('#centro_costo').val();

//         var object = {
//             'object': {
//                 'titulo': titulo
//             }
//         }

//         $.ajax({
//             data: object,
//             url: '../controller/CRUD.controller.php?action=instance&model=CentroCosto&crud=insert',
//             type: 'post',
//             success: function(result){
//                 $('#results').html('<p>' + result + '</p>');
//             }
//         });
//     })
// }
