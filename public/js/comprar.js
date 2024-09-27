function toggleImage(id) {
    const imgElement = document.getElementById('car-image-' + id);
    const currentSrc = imgElement.src;
    const foto1 = imgElement.getAttribute('data-foto1');
    const foto2 = imgElement.getAttribute('data-foto2');

    // Alterna entre as duas imagens
    if (currentSrc === foto1) {
        imgElement.src = foto2;
    } else {
        imgElement.src = foto1;
    }
}