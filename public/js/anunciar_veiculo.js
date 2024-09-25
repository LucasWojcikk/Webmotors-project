function previewImages(event) {
    var files = event.target.files;

    // Seleciona os elementos de imagem e botões de remoção para pré-visualização
    var img1 = document.getElementsByName('img1')[0];
    var img2 = document.getElementsByName('img2')[0];
    var btnRemoveImg1 = document.getElementsByName('btn-remove-img1')[0];
    var btnRemoveImg2 = document.getElementsByName('btn-remove-img2')[0];

    // Verifica se o primeiro box está vazio e preenche com a primeira imagem disponível
    if (img1.src === "" || img1.style.display === "none") {
        var reader1 = new FileReader();
        reader1.onload = function(e) {
            img1.src = e.target.result;
            img1.style.display = 'block'; // Mostra a imagem no primeiro box
            btnRemoveImg1.style.display = 'inline'; // Exibe o botão de remoção
        };
        reader1.readAsDataURL(files[0]); // Pega a primeira imagem
    } 
    // Se o primeiro box já estiver preenchido, vai para o segundo box
    else if (img2.src === "" || img2.style.display === "none") {
        var reader2 = new FileReader();
        reader2.onload = function(e) {
            img2.src = e.target.result;
            img2.style.display = 'block'; // Mostra a imagem no segundo box
            btnRemoveImg2.style.display = 'inline'; // Exibe o botão de remoção
        };
        reader2.readAsDataURL(files[0]); // Pega a primeira imagem do novo upload
    }
}

// Função para remover a imagem do box
function removeImage(imgName) {
    var img = document.getElementsByName(imgName)[0];
    var btnRemove = document.getElementsByName('btn-remove-' + imgName)[0];
    
    // Limpa a imagem e esconde os elementos
    img.src = ''; 
    img.style.display = 'none'; 
    btnRemove.style.display = 'none'; 
    
    // Reseta o input[type="file"] para permitir carregar a mesma imagem novamente
    document.querySelector('input[type="file"]').value = '';
}
