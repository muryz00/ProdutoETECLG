<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
</head>
<body>
<?php 
if(isset($_REQUEST['valor']) and ($_REQUEST['valor'] == 'enviado'))
{
    $Botao = $_POST["Botao"]; 

    if ($Botao =="Logar")
    {
        session_start();
        $_SESSION["controleAdm"] = "logado";

        // Armazenando o nome do usuário na sessão
        $_SESSION["nomeAdm"] = $_POST["usuario_login"]; // Nome ou e-mail
        include "pagamento.php"; // Redireciona para a página de pagamento ou página do administrador
    }
    if ($Botao =="Cadastro")
    {
        session_start();
        $_SESSION["controleAdm"] = "novo";
        echo "<A href=\"CadastroAdm.php\">Novo</A>"; 
    }
}
else 
{
    ?> 
    <FORM action="LoginAdm.php?valor=enviado" method="POST">
        Usuário: <BR>  
        <INPUT type="text" placeholder="Preencher E-mail" name="usuario_login"><BR><p>

        Senha: <BR>
        <INPUT type="password" placeholder="Preencher Senha" name="senha_login" maxlength="8" ><BR><p>

        <input name="Botao" type="submit" value="Cadastro">
        <input name="Botao" type="submit" value="logar">
        <input name="Botao" type="submit" value="Esqueceu">
    </FORM>
    <?php 
}
?>
</body>
</html>
