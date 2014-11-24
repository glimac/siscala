$(function() {
    $('#milmatricula').blur(function(){
        var url = 'adm/militar/ajax-militar';
        $.ajax({
            type: "POST",
            url: url,
            data: { matricula: $('#milmatricula').val() },
            dataType: 'json'
        }).done(function(result) {
            $("#milnomeguerra").val(result.milnomeguerra);
            $("#milcodigo").val(result.milcodigo);
        });
    });
});