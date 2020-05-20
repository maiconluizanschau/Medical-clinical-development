function MascaraData(data) {
    if (mascaraInteiro(data) == false) {
        event.returnValue = false;
    }
    return formataCampo(data, '00/00/0000', event);
}
function MascaraCelular(tel, id) {
    if (mascaraInteiro(tel) == false) {
        event.returnValue = false;
    }
    if(document.getElementById(id).value.length < 14)
        return formataCampo(tel, '(00) 0000-0000', event);
    return formataCampo(tel, '(00) 0-0000-0000', event);
}
function MascaraCPF(cpf) {
    if (mascaraInteiro(cpf) == false) {
        event.returnValue = false;
    }
    return formataCampo(cpf, '000.000.000-00', event);
}
function MascaraMAC(mac) {
    return formataCampo(mac, '00-00-00-00-00-00', event);
}
function validaCelular(tel) {
    exp = /\(\d{2}\)\ \d{1}\-\d{4}\-\d{4}|\d{11}/g;
    if (!exp.test(tel.value)) showNotification('top', 'center', 'danger', 'Celular inválido!');
}
function validaCPF(Objcpf) {
    var cpf = Objcpf.value;
    exp = /\.|\-/g
    cpf = cpf.toString().replace(exp, "");
    var digitoDigitado = eval(cpf.charAt(9) + cpf.charAt(10));
    var soma1 = 0, soma2 = 0;
    var vlr = 11;
    for (i = 0; i < 9; i++) {
        soma1 += eval(cpf.charAt(i) * (vlr - 1));
        soma2 += eval(cpf.charAt(i) * vlr);
        vlr--;
    }
    soma1 = (((soma1 * 10) % 11) == 10 ? 0 : ((soma1 * 10) % 11));
    soma2 = (((soma2 + (2 * soma1)) * 10) % 11);
    var digitoGerado = (soma1 * 10) + soma2;
    if (digitoGerado != digitoDigitado) showNotification('top', 'center', 'danger', 'CPF inválido!');
}
function mascaraInteiro() {
    if (event.keyCode < 48 || event.keyCode > 57) {
        event.returnValue = false;
        return false;
    }
    return true;
}
function formataCampo(campo, Mascara, evento) {
    var boleanoMascara;
    var Digitato = evento.keyCode;
    exp = /\-|\.|\:|\/|\(|\)| /g
    campoSoNumeros = campo.value.toString().replace(exp, "");
    var posicaoCampo = 0;
    var NovoValorCampo = "";
    var TamanhoMascara = campoSoNumeros.length;
    if (Digitato != 8) {
        for (i = 0; i <= TamanhoMascara; i++) {
            boleanoMascara = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".") || (Mascara.charAt(i) == "/"));
            boleanoMascara = boleanoMascara || (Mascara.charAt(i) == ":");
            boleanoMascara = boleanoMascara || ((Mascara.charAt(i) == "(") || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "));
            if (boleanoMascara) {
                NovoValorCampo += Mascara.charAt(i);
                TamanhoMascara++;
            } else {
                NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
                posicaoCampo++;
            }
        }
        campo.value = NovoValorCampo;
        return true;
    } else {
        return true;
    }
}
function retornaCelular(celular) {
    var NovoValorCampo = "(";
    celular = celular.toString();
    for (j=0; j <= 11; j++) {
        if(j==2) {
            NovoValorCampo+=") "; 
        } else if(j==4 || j==8) {
            NovoValorCampo+="-";
        }
        NovoValorCampo+=celular.charAt(j);
    }
    return NovoValorCampo;
}
function retornaCPF(cpf) {
    var NovoValorCampo = "";
    cpf = cpf.toString();
    for (j=0; j <= 11; j++) {
        if(j==3 || j==6) {
            NovoValorCampo+="."; 
        } else if(j == 9) {
            NovoValorCampo+="-";
        }
        NovoValorCampo+=cpf.charAt(j);
    }
    return NovoValorCampo;
}

function moeda(z) {
    v = z.value;
        v = v.replace(/\D/g, "") 
        v = v.replace(/(\d{1})(\d{14})$/, "$1.$2")
        v = v.replace(/(\d{1})(\d{11})$/, "$1.$2") 
        v = v.replace(/(\d{1})(\d{8})$/, "$1.$2") 
        v = v.replace(/(\d{1})(\d{5})$/, "$1.$2") 
        v = v.replace(/(\d{1})(\d{1,2})$/, "$1,$2")
        z.value = v;
}

function MascaraCep(cep) {
    if (mascaraInteiro(cep) == false) {
        event.returnValue = false;
    }
    return formataCampo(cep, '00000-000', event);
}

function validaCep(cep) {
    exp = /^[0-9]{5}-[0-9]{3}$/g;
    if (!exp.test(cep.value)) showNotification('top', 'center', 'danger', 'Cep inválido!');
}