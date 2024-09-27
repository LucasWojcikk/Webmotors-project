<?php if (
    isset($_SESSION["nivel_usuario"])
    and $_SESSION["nivel_usuario"] == "admin"
    ): 
?>
    <h1>Administrador não pode acessar essa página</h1>
    
<?php else: ?>
    <h1>Você precisa estar logado para acessar está pagina</h1>
<?php endif; ?>