// FUNCAO PARA DELETAR ALIMENTACAO
function deleteFood() {
    const main = document.querySelector('#main-dash-all-food #list-food')

    if(main) {
        for(const article of main.querySelectorAll('article')) {
            const btnDelete = article.querySelector('.btn-delete')
            const overlay = article.querySelector('.overlay-delete')
    
            openOverlay(overlay, btnDelete)
        }
    }

}

// FUNCAO PARA DELETAR ALIMENTACAO
function updateFood() {
    const main = document.querySelector('#main-dash-all-food #list-food')

    if(main) {
        for(const article of main.querySelectorAll('article')) {
            const btnDelete = article.querySelector('.btn-alter')
            const overlay = article.querySelector('.overlay-update')
    
            openOverlay(overlay, btnDelete)
        }
    }
}


// ----------------------------- PAGINA DE MONTAR ALIMENTACAO -----------------------------
// FUNCAO PARA REMOVER REFEICAO
function removeFood(mainP, boxP, trashP) {
    const main = document.querySelector(mainP)

    for(const box of main.querySelectorAll(boxP)) {
        const btnTrash = box.querySelector(trashP)

        btnTrash.addEventListener('click', function() {
            box.remove()
        })
    }
}

// FUNCAO PARA CRIAR REFEICAO
function createFood(mainP, createP, categoryP) {
    const main = document.querySelector(mainP)
    const btnCreate = document.querySelector(createP)

    btnCreate.addEventListener('click', function() {
        // Criando tags
        const article = document.createElement('article')
        const divTime = document.createElement('div')
        const divFood = document.createElement('div')
        const btnTrash = document.createElement('button')
        const i = document.createElement('i')
        const inputHour = document.createElement('input')
        const inputMinute = document.createElement('input')
        const span = document.createElement('span')
        const textarea = document.createElement('textarea')

        // Colocando 'type'
        btnTrash.type = 'button'
        inputHour.type = 'number'
        inputMinute.type = 'number'
        
        // Colocando 'class'
        article.classList.add('box')
        divTime.classList.add('trash-time')
        divFood.classList.add('food')
        btnTrash.classList.add('btn-trash')
        i.classList.add('fa-solid')
        i.classList.add('fa-trash')

        // Colocando 'name'
        inputHour.name = 'new-hour[]'
        inputMinute.name ='new-minute[]'
        textarea.name = `new-${categoryP}[]`

        // Colocando 'placeholder'
        inputHour.placeholder = 'H'
        inputMinute.placeholder = 'M'

        // Textarea
        textarea.cols = 70
        textarea.rows = 10

        // span
        span.innerHTML = ':'

        // Imprimindo na pagina
        main.appendChild(article)
        article.appendChild(divTime)
        divTime.appendChild(btnTrash)
        btnTrash.appendChild(i)
        divTime.appendChild(inputHour)
        divTime.appendChild(span)
        divTime.appendChild(inputMinute)
        article.appendChild(divFood)
        divFood.appendChild(textarea)

        // Removendo refeicao
        btnTrash.addEventListener('click', function() {
            article.remove()
        })

    })
}










