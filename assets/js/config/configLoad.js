var loadConfig = function () {
    return new Promise(async (resolve, reject) => {

        //Generar Key
        const key = await window.crypto.subtle.generateKey({name: 'AES-CBC', length: 128}, true, ['encrypt','decrypt']);
        const keyPair = await window.crypto.subtle.exportKey('raw', key);
        const exportedKey = bufferABase64(keyPair);
        $.ajax({
            async: false,
            data: {'key': exportedKey},
            type: 'post',
            url: '../controller/Config.controller.php',
            success: async function(response){
               data = JSON.parse(response);

                // Decodificar los datos y la clave cifrados
                const cipherText = new Uint8Array(base64ABuffer(data.data));
                const iv = new Uint8Array(base64ABuffer(data.iv));
                //const key = new Uint8Array(base64ABuffer(data.key));

                // Descifrar los datos con la clave compartida
                //const keyImport = await window.crypto.subtle.importKey('raw', key, {name: 'AES-CBC'}, true, ['encrypt','decrypt']);
                const plainText = await window.crypto.subtle.decrypt({name: 'AES-CBC', iv: iv}, key, cipherText);
                const jsonData = JSON.parse(new TextDecoder('utf-8').decode(plainText));
                resolve(jsonData)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error al cargar el archivo JSON:', textStatus, errorThrown);
                reject();
            }
        });

    })
}

const bufferABase64 = buffer => btoa(String.fromCharCode(...new Uint8Array(buffer)));
const base64ABuffer = buffer => Uint8Array.from(atob(buffer), c => c.charCodeAt(0));