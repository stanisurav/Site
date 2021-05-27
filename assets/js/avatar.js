$(document).ready(function() {
  
    var button = $("#butUpload"),
        interval, file;
    new AjaxUpload(button, {
        action: "/script_avatar",
        data: {
            file: file
        },
        name: "clientfile",
        type: "POST",
        onSubmit: function(file, ext) { //расширение файла
            if (!(ext && /^(jpg|png|Jpeg|)$/i.test(ext))) {
                alert("Ошибка! Допустимые разрешения: jpg, png, jpeg");
                return false;
            }
            button.text("Загрузка");
            this.disable();
            interval = setInterval(function() {
                var text = button.text(); //Получаем текст кнопки
                if (text.length < 11) {
                    button.text(text + ".");
                } else {
                    button.text("Загрузка");
                }
            }, 300);
        },
        onComplete: function(file, result) { //2 параметра имя файлаб и результат от сервера
            obj = JSON.parse(result);
            if (obj.redirect) locate(obj.redirect);
            else if (obj.redir && obj.text) {
                alert(obj.text);
                locate(obj.redir);
            } else alert(obj.message);
            setInterval(function() {
                location.reload();
            }, 1000);
            window.clearInterval(interval);
            console.log(file);
        }
    });
});
