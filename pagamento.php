<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
</head>
<body>

<?php
session_start();  // Inicia a sessão

// Verificando se o nome do usuário está na sessão
if (isset($_SESSION["nomeAdm"])) {
    $nomeAdm = $_SESSION["nomeAdm"];
    echo "Olá, $nomeAdm! Bem-vindo!";
} else {
    echo "Olá, visitante! Faça o login para continuar.";
    // Ou você pode redirecionar para a página de login, se necessário
    // header("Location: LoginAdm.php");
    // exit();
}
?>


<label for="forma_pagamento">Forma de Pagamento:</label>
<select name="forma_pagamento" id="forma_pagamento" class="form-control" required>
    <option value="cartao_credito">Cartão de Crédito</option>
    <option value="cartao_debito">Cartão de Débito</option>
    <option value="pix">PIX 10% de desconto</option>
    <option value="boleto">Boleto</option>
</select>

<label for="parcelas">Parcelas:</label>
<select name="parcelas" id="parcelas" class="form-control" disabled>
    <option value="1x">1x sem juros</option>
    <option value="2x">2x sem juros</option>
    <option value="3x">3x sem juros</option>
    <option value="4x">4x sem juros</option>
    <option value="5x">5x sem juros</option>
    <option value="6x">6x sem juros</option>
    <option value="7x">7x sem juros</option>
    <option value="8x">8x sem juros</option>
    <option value="9x">9x sem juros</option>
    <option value="10x">10x sem juros</option>
    <option value="11x">11x sem juros</option>
    <option value="12x">12x sem juros</option>
</select>

<label for="valor_parcela">Valor da Parcela:</label>
<input type="text" id="valor_parcela" class="form-control" readonly>

<script>
    
    const valorProduto = 3599.00; 


    const formaPagamentoSelect = document.getElementById("forma_pagamento");
    const parcelasSelect = document.getElementById("parcelas");
    const valorParcelaInput = document.getElementById("valor_parcela");

    function calcularValorParcela() {
        const formaPagamento = formaPagamentoSelect.value;
        const parcelas = parseInt(parcelasSelect.value);
        
        if (formaPagamento === "cartao_credito" && parcelas > 0) {
            const valorParcela = valorProduto / parcelas;
            valorParcelaInput.value = `R$ ${valorParcela.toFixed(2).replace('.', ',')}`;
        } else if (formaPagamento === "cartao_debito" || formaPagamento === "boleto") {
            valorParcelaInput.value = `R$ ${valorProduto.toFixed(2).replace('.', ',')}`;
        } else if(formaPagamento == "pix"){
            const valorPix = valorProduto * 0.90
            valorParcelaInput.value = `R$ ${valorPix.toFixed(2).replace('.', ',')}`; 
        } else {
            valorParcelaInput.value = '';
        }
    }

    formaPagamentoSelect.addEventListener("change", function() {
        if (formaPagamentoSelect.value === "cartao_credito") {
            parcelasSelect.disabled = false; 
        } else {
            parcelasSelect.disabled = true; 
            parcelasSelect.selectedIndex = 0;
            valorParcelaInput.value = `R$ ${valorProduto.toFixed(2).replace('.', ',')}`;
        }
        calcularValorParcela(); 
    });

    parcelasSelect.addEventListener("change", calcularValorParcela);

    // Calcular valor da parcela ao carregar a página
    window.onload = calcularValorParcela;
</script>

</body>
</html>
