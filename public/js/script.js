function formatarCelular(input) {
    let valor = input.value.replace(/\D/g, ''); // tira tudo que não é número

    if (valor.length > 11) valor = valor.slice(0, 11); // limita a 11 dígitos

    if (valor.length > 6) {
        input.value = `(${valor.slice(0, 2)}) ${valor.slice(2, 7)}-${valor.slice(7)}`;
    } else if (valor.length > 2) {
        input.value = `(${valor.slice(0, 2)}) ${valor.slice(2)}`;
    } else if (valor.length > 0) {
        input.value = `(${valor}`;
    }
}