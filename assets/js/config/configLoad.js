var loadConfig = function () {
    return new Promise((resolve, reject) => {
        $.getJSON('../../../HorasExtra/config/config.json', function (data) {
            resolve(data);
        }).fail(function (e) {
            reject(new Error('Failed to load file. ' + e));
        })
    })
}