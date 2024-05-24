// FUNCAO PARA DELETAR TREINO
function deleteTraining() {
    const main = document.querySelector('#main-dash-all-training #list-training')

    if(main) {
        // Percorrendo categorias
        for(const category of main.querySelectorAll('section')) {

            // Percorrendo Exercicios
            for(const exercise of category.querySelectorAll('ul li')) {
                const btnDelete = exercise.querySelector('.btn-delete')
                const overlay = exercise.querySelector('.overlay-delete')

                openOverlay(overlay, btnDelete)
            }
        }
    }
}

// FUNCAO PARA ALTERAR TREINO
function updateTraining() {
    const main = document.querySelector('#main-dash-all-training #list-training')

    if(main) {
        // Percorrendo categorias
        for(const category of main.querySelectorAll('section')) {

            // Percorrendo Exercicios
            for(const exercise of category.querySelectorAll('ul li')) {
                const btnDelete = exercise.querySelector('.btn-alter')
                const overlay = exercise.querySelector('.overlay-update')

                openOverlay(overlay, btnDelete)
            }
        }
    }
}

// ----------------------------- PAGINA DE MONTAR TREINO -----------------------------
// FUNCAO PARA INPUT SELECT
function inputSelect() {
    const main = document.querySelector('#main-dash-setup-training #categories')

    for(const article of main.querySelectorAll('section article')) {
        for(const exercise of article.querySelectorAll('.exercise')) {
            const select = exercise.querySelector('.select')
            const input = select.querySelector('input')

            if(input.checked) select.classList.add('set')

            input.addEventListener('click', function() {
                if(input.checked) {
                    select.classList.add('set')
                } else {
                    select.classList.remove('set')
                }
            })
        }
    }
}


// FUNCAO PARA SELECAO DOS EXERCICIOS
function training(mainP, boxP, checkBoxP, seriesP, minP, maxP, idTrainingP = null) {
    const main = document.querySelector(mainP)

    for(const training of main.querySelectorAll(boxP)) {
        const checkBox = training.querySelector(checkBoxP)
        let series = training.querySelector(seriesP)
        let min = training.querySelector(minP)
        let max = training.querySelector(maxP)
        let idTraining = training.querySelector(idTrainingP)

        let seriesName = series.className + '[]'
        let minName = min.className + '[]'
        let maxName = max.className + '[]'
        
        checkBox.addEventListener('click', function() {
            if(checkBox.checked) {
                series.value = 3
                min.value = 10
                max.value = 15

                series.classList.add('value-standard')
                min.classList.add('value-standard')
                max.classList.add('value-standard')

                series.name = `${seriesName}`
                min.name = `${minName}`
                max.name = `${maxName}`

                if(idTraining) {
                    idTraining.name = 'id-training[]'
                }

            } else {
                series.value = null
                min.value = null
                max.value = null

                series.removeAttribute('name')
                min.removeAttribute('name')
                max.removeAttribute('name')

                series.classList.remove('value-standard')
                min.classList.remove('value-standard')
                max.classList.remove('value-standard')

                if(idTraining) {
                    idTraining.removeAttribute('name')
                }
            }

            series.addEventListener('focus', function () {
                series.classList.remove('value-standard')
            })
            min.addEventListener('focus', function () {
                min.classList.remove('value-standard')
            })
            max.addEventListener('focus', function () {
                max.classList.remove('value-standard')
            })

        })
    }
}

// FUNCAO PARA ABRIR CATEGORIA
function openCategory() {
    const body = document.querySelector('body')
    const main = document.querySelector('#categories')

    for(const category of main.querySelectorAll('.category')) {
        const btnOpen = category.querySelector('.btn-open-category')
        const btnClose = category.querySelector('.btn-close-category')
        const article = category.querySelector('article')
        const box = category.querySelector('.box')

        // Abrindo overlay
        btnOpen.addEventListener('click', function() {
            body.classList.add('body-lock')
            article.classList.remove('open-category')

            setTimeout(() => {
                box.classList.remove('open-box')
            }, 300)
        })

        // Fechando overlay
        btnClose.addEventListener('click', function() {
            closeOverlay()
        })

        article.addEventListener('mouseup', function(e) {
            if(!box.contains(e.target)) closeOverlay()
        })

        function closeOverlay() {
            body.classList.remove('body-lock')
            box.classList.add('open-box')

            setTimeout(() => {
                article.classList.add('open-category')
            }, 300)
        }
    }
}
