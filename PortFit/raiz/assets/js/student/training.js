// FUNCAO PARA ABRIR TREINO DO DIA
function overlayTraining() {
    const main = document.querySelector('#page-start-cards')

    for(const article of main.querySelectorAll('article')) {
        const btn = article.querySelector('.btn-card')
        const overlay = article.querySelector('.overlay')

        openOverlay(overlay, btn)
    }
}