// FUNCAO PARA ABRIR REFEICAO
function openFood() {
    const body = document.querySelector('body')
    const main = document.querySelector('#main-student-food-week section')

    for(const article of main.querySelectorAll('article')) {
        const btnOpen = article.querySelector('.card')
        const overlay = article.querySelector('.overlay-food')

        if(overlay) {
            const btnClose = overlay.querySelector('.box-food .btn-close')
            const box = overlay.querySelector('.box-food')

            // Abrindo overlay
            btnOpen.addEventListener('click', function() {
                body.classList.add('body-lock')
                overlay.classList.remove('close-overlay')

                setTimeout(() => {
                    box.classList.remove('close-box')
                }, 300)
            })

            btnClose.addEventListener('click', function() {
                closeOverlay(overlay, box)
            })
    
            overlay.addEventListener('mouseup', function(e) {
                if(!box.contains(e.target)) closeOverlay(overlay, box)
            })
        }
    }

    // Funcao para fechar overlay
    function closeOverlay(overlay, box) {
        body.classList.remove('body-lock')
        box.classList.add('close-box')
        
        setTimeout(() => {
            overlay.classList.add('close-overlay')
        }, 300)
    }
}