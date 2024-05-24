// FUNCAO PARA DELETAR EXERCICIOS
function deleteExercise() {
    const main = document.querySelector('#main-dash-exercises #exercises')

    for(const article of main.querySelectorAll('article')) {
        const btnDelete = article.querySelector('.btn-delete')
        const overlay = article.querySelector('.overlay')

        openOverlay(overlay, btnDelete)
    }
}

// FUNHCAO PARA ABRIR CATEGORIAS
function openCategories() {
    const body = document.querySelector('body')
    const main = document.querySelector('#main-dash-exercises')
    const btnOpen = main.querySelector('.btn-open-category')
    const btnClose = main.querySelector('#categories .btn-close-overlay')
    const box = main.querySelector('#categories')

    // Abrindo categorias
    btnOpen.addEventListener('click', function() {
        box.classList.remove('close')
    })

    // Fechando categorias
    btnClose.addEventListener('click', function() {
        box.classList.add('close')
    })

    body.addEventListener('mouseup', function(e) {
        if(!box.contains(e.target)) {
            box.classList.add('close')
        }
    })
}


// FUNCAO DE PREVIEW DE VIDEO
function previewVideo(inuptP, boxP) {
    const input = document.querySelector(inuptP)
    const box = document.querySelector(boxP)

    input.addEventListener('change', function(e) {
        const inputTarget = e.target
        const file = inputTarget.files[0]

        if(file) {
            const reader = new FileReader();

            reader.addEventListener('load', function(e) {
                const readerTarget = e.target
                const video = document.createElement('video')
                const source = document.createElement('source')

                video.controls = 'controls';
                source.src = readerTarget.result

                box.innerHTML = ""
                video.appendChild(source)
                box.appendChild(video)
            })

            reader.readAsDataURL(file)
        }
    })
}


// FUNCAO PARA REMOVER VIDEO
function removeVideo() {
    const btn = document.querySelector('#form-exercise .btn-trash-video')
    const input = document.querySelector('#form-exercise #remove-video')
    // Externo
    const videoExternal = document.querySelector('#form-exercise .video-external')
    const iframe = document.querySelector('#form-exercise iframe')
    // Interno
    const videoInterno = document.querySelector('#form-exercise #video-exercise')
    const video = document.querySelector('#form-exercise video')

    if(btn) {
        btn.addEventListener('click', function() {
            input.value = 1

            // caso video externo
            if(iframe) {
                videoExternal.removeChild(iframe)
                videoExternal.removeChild(btn)                
            }

            // Caso video interno
            if(video) {
                videoInterno.removeChild(video)
                videoInterno.removeChild(btn)
            }
        })
    }
}