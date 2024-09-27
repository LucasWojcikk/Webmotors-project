function previewImages(event) {
    const files = event.target.files;
    const maxFiles = 2;

    if (files.length > maxFiles) {
        alert("Selecione no máximo 2 imagens.");
        return;
    }

    // Referências aos elementos img e botão de remoção
    const img1 = document.getElementsByName("img1")[0];
    const btnRemoveImg1 = document.getElementsByName("btn-remove-img1")[0];
    const img2 = document.getElementsByName("img2")[0];
    const btnRemoveImg2 = document.getElementsByName("btn-remove-img2")[0];

    // Função para atualizar a imagem e o botão de remoção
    const updateImagePreview = (imgElement, btnElement, file) => {
        const reader = new FileReader();
        reader.onload = function (e) {
            imgElement.src = e.target.result;
            imgElement.style.display = "block";
            btnElement.style.display = "block";
        };
        reader.readAsDataURL(file);
    };

    // Lógica para adicionar as imagens às tags correspondentes
    if (files[0]) {
        updateImagePreview(img1, btnRemoveImg1, files[0]);
    }
    if (files[1]) {
        updateImagePreview(img2, btnRemoveImg2, files[1]);
    }
}

// Função para remover a imagem
function removeImage(imgName) {
    const imgElement = document.getElementsByName(imgName)[0];
    const btnElement = document.getElementsByName(`btn-remove-${imgName}`)[0];

    imgElement.src = '';
    imgElement.style.display = 'none';
    btnElement.style.display = 'none';
    
    // Resetar o input de arquivo
    const input = document.querySelector('input[type="file"]');
    input.value = '';
}
