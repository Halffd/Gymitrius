/*$(document).ready(function () {
    $("#continuar").click(function () {
        if ($("#email").val() == "" || $("#senha").val() == "")
            $("#err").html("Digite o email e a senha");
        else
            $.post($("#form").attr("action"),
                $("#form :input").serializeArray(),
                function (data) {
                    $("input").html(data);
                });
        $("form").submit(function () {
            return false;
        });
    });
});
$(document).ready(function () {
    $("#botao").click(function () {
        e = $("#email").val();
        p = $("#senha").val();
        if ($("#email").val() == "" || $("#senha").val() == "")
            $("#err").html("Digite o email e a senha");
        else
            $.post($("#form").attr("action"),
                //$("#myForm :input").serializeArray(),
                { email: e, senha: p },
                function (data) {
                    $("#err").html(data);
                });
        $("#form").submit(function () {
            return false;
        });
    });
});*/