// FUNCAO PARA DELETAR EMAIL
function deleteEmail() {
    const main = document.querySelector('#main-dash-email section')

    for(const article of main.querySelectorAll('article')) {
        const btnDelete = article.querySelector('.btn-delete')
        const overlay = article.querySelector('.overlay')

        openOverlay(overlay, btnDelete)
    }
}