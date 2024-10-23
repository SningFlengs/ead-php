// Função de busca simples - filtra os cursos com base no termo de busca
document.querySelector('.search-bar input').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const courses = document.querySelectorAll('.course-item');
    
    courses.forEach(course => {
        const courseTitle = course.querySelector('h3').textContent.toLowerCase();
        if (courseTitle.includes(searchTerm)) {
            course.style.display = 'block';
        } else {
            course.style.display = 'none';
        }
    });
});

// Troca de imagens no banner (slider simples)
const bannerImages = [
    'images/banner-image1.png',
    'images/banner-image2.png',
    'images/banner-image3.png'
];

let currentImageIndex = 0;
const bannerImageElement = document.querySelector('.banner-image img');

function changeBannerImage() {
    currentImageIndex = (currentImageIndex + 1) % bannerImages.length;
    bannerImageElement.src = bannerImages[currentImageIndex];
}

// Trocar imagem a cada 5 segundos
setInterval(changeBannerImage, 5000);

// Mostrar mensagem de boas-vindas
function showWelcomeMessage() {
    const user = "Pedro"; // Substitua pelo nome do usuário atual, se necessário
    alert(`Bem-vindo de volta, ${user}! Vamos continuar aprendendo.`);
}

// Exibir mensagem de boas-vindas ao carregar a página
window.onload = function() {
    showWelcomeMessage();
};
