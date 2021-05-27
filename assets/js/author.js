function Post_query(url, name, data){

    var str = '';

    $.each(data.split('.'), function(k, v){
        str += '&' + v + '=' + $('#'+ v).val();
    });

    $.ajax({

        url:'/' + url,
        type: 'POST',
        data: name + '_f' + str,
        cache: false,
        success: function(result){

            obj = JSON.parse(result);

            if( obj.redirect ) locate(obj.redirect);
            else if (obj.redir && obj.text){alert(obj.text); locate(obj.redir);}
            else alert(obj.message);
        }

      });
}
// Обработчик для изменения данных
// function Type_info(url, type, type_info){
//
//     $.ajax({
//
//         url:'/' + url,
//         type: 'POST',
//         data: str1 + str2,
//         cache: false,
//         success: function(results){
//
//         }
//
//     });
// }
//
function locate(url){

    window.location.href='/'+url;

}
