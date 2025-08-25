// Executar Mascara
function mascara(o, funcao) {
    setTimeout(function () {
        o.value = funcao(o.value);
    }, 1);
}

function telefone1(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/^(\d\d)(\d)/g, "($1) $2");
    v = v.replace(/(\d{5})(\d)/, "$1-$2");
    return v;
}


function cep(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{5})(\d)/, "$1-$2");
    return v;
}

function data(v) {
    v = v.replace(/\D/g, "");
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    v = v.replace(/(\d{2})(\d)/, "$1/$2");
    return v;
}

function numero(v) {
    return v.replace(/\D/g, "");
}

function nome1(v) {
    return v.replace(/\d/g, "");
}
