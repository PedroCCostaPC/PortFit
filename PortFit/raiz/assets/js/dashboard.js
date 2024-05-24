// FUNCAO PARA NAV LATERAL DO DASHBOARD / AREA DO ALUNO
function openNavDash() {
    const body = document.querySelector('body')
    const main = document.querySelector('#main-nav')
    const btnOpen = main.querySelector('.btn-open')

    btnOpen.addEventListener('click', function() {
        if(main.classList.contains('open')) {
            main.classList.remove('open')
            btnOpen.classList.add('anime-close')
            btnOpen.classList.add('mobile')

        } else {
            main.classList.add('open')
            btnOpen.classList.remove('anime-close')
            btnOpen.classList.remove('mobile')
        }
    })

    // Fechando nav com click fora da nav
    body.addEventListener('mouseup', function(e) {
        if(!main.contains(e.target)) {
            main.classList.add('open')
            btnOpen.classList.remove('anime-close')
            btnOpen.classList.remove('mobile')
        }
    })

}


// FUNCAO PARA OVERLAYS DO DASHBOARD / AREA DO ALUNO
function openOverlay(mainP, btnOpenP, closeMouseup = true) {
    const body = document.querySelector('body')
    const main = mainP
    const btnOpen = btnOpenP
    const box = main.querySelector('.main-box')
    const btnClose = main.querySelector('.btn-close-overlay')

    // Abrindo overlay
    btnOpen.addEventListener('click', function() {
        body.classList.add('body-lock')
        main.classList.remove('close-overlay')

        setTimeout(() => {
            box.classList.remove('close-box')
        }, 300)
    })

    // Fechando overlay com btnClose
    btnClose.addEventListener('click', function() {
        closeOverlay()
    })

    // Fechando overlauy com click fora do main
    if(closeMouseup) {
        main.addEventListener('mouseup', function(e) {
            if(!box.contains(e.target)) closeOverlay()
        })
    }

    // Funcao para fechar overlay
    function closeOverlay() {
        body.classList.remove('body-lock')
        box.classList.add('close-box')

        setTimeout(() => {
            main.classList.add('close-overlay')
         }, 300)
    }
}


// FUNCAO PARA PREVIEW DA IMG AO FAZER UPLOAD
function previewIMG(inuptP, boxP) {
    const input = document.querySelector(inuptP)
    const box = document.querySelector(boxP)

    input.addEventListener('change', function(e) {
        const inputTarget = e.target
        const file = inputTarget.files[0]

        if(file) {
            const reader = new FileReader();

            reader.addEventListener('load', function(e) {
                const readerTarget = e.target
                const img = document.createElement('img')

                img.src = readerTarget.result

                box.innerHTML = ""
                box.appendChild(img)
            })

            reader.readAsDataURL(file)
        }
    })
}

// FUNCAO PARA EFEITO NOS FORM DO LABEL COM INPUT
function formLabelInput(formP) {
    const form = document.querySelector(formP)

    for(const row of form.querySelectorAll('.start-js')) {
        const label = row.querySelector('label')
        const input = row.querySelector('input')
        const textarea = row.querySelector('textarea')


        if(label && input) addClass(label, input)
        if(label && textarea) addClass(label, textarea)


    }

    // Funcao para colocar ou tirar class
    function addClass(label, field) {
        // Colocando ou tirando classe 'start' caso input ou textarea preenchido
        if(field.value) {
            label.classList.remove('start')
        } else {
            label.classList.add('start')
        } 

        // Tirando class 'start' ao setar input ou textarea
        field.addEventListener('focus', function() {
            if(label.classList.contains('start')) {
                label.classList.remove('start')
            }
        })
    }
}


// FUNCAO DE PREVIEW DE MULTIPLAS IMAGENS
function previewImages(inputP, boxP) {
    const input = document.querySelector(inputP)
    const boxPreview = document.querySelector(boxP)


    input.addEventListener('change', function(e) {

        // Limpar o seletor que recebe o preview das imagens
        boxPreview.innerHTML = ''

        // Percorrer a lista de arquivos selecionados
        for(const images of e.target.files) {
            const imageHTML = `<img src="${URL.createObjectURL(images)}" alt="${images.name}">`

            boxPreview.insertAdjacentHTML('beforeend', imageHTML)
        }

    })
}

// FUNCAO PARA BOX DE FILTRO
function boxFilter(mainP) {
    const body = document.querySelector('body')
    const main = document.querySelector(mainP)
    const btn = main.querySelector('.btn-open-filter')

    btn.addEventListener('click', function() {
        if(main.classList.contains('open')) {
            main.classList.remove('open')
        } else {
            main.classList.add('open')
        }
    })

    // Fechando nav com click fora da nav
    body.addEventListener('mouseup', function(e) {
        if(!main.contains(e.target)) {
            main.classList.add('open')
        }
    })
}



