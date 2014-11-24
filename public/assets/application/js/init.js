$(document).ready(function(){
    $(".telefone").mask("(99)9999-9999");
    $(".data").mask("99/99/9999");
    $(".hora").mask("99:99");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $(".cep").mask("99999-999");
    $(".placa").mask("aaa-9999");
    $(".anoModelo").mask("9999/9999");
    $("#caninscricao").mask("99.999.999/999-99");
    $(".porcentagem").mask("?999,99", {placeholder:"0"});

    $(".inteiro").keyup(function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    
    valorReal = $('input.real');
    valorReal.unbind('keydown').unbind('keyup');
    valorReal.priceFormat({
        prefix             : '',
        centsSeparator     : ',',
        thousandsSeparator : '.',
        centsLimit: 3,
        allowNegative      : true
    });
});