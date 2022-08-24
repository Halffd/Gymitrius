window.onload = function() {
    document.getElementById("conteudo").style.display = "none";
    var i = setTimeout(function () {
        document.getElementById("loading").style.display = "none";
        document.getElementById("conteudo").style.display = "inline";
    }, 3000);
}