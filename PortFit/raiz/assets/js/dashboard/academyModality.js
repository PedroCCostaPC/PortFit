// FUNCAO PARA OVERLAY DE DELETAR MODALIDADE
function deleteModality() {
    const main = document.querySelector('#cards-modalities')

    for(const section of main.querySelectorAll('section')) {
        const btnDelete = section.querySelector('.btn-delete')
        const overlay = section.querySelector('.overlay')

        openOverlay(overlay, btnDelete)
    }
}


// FUNCAO PARA VALIDAR FORMULARIO DE ADD / ALTER MODALIDADE
function validateModality() {
    const form = document.querySelector('#form-modality form')
    const btn = form.querySelector('button')
    let check = false

    btn.type = 'button'
    
    btn.addEventListener('click', function() {
        for(const field of form.querySelectorAll('.start-js')) {
            const label = field.querySelector('label')
            const input = field.querySelector('input')
            const textarea = field.querySelector('textarea')

            if(input && !input.value) {
                inputUbdateColor(input, label)
                check = true
            }

            if(textarea && !textarea.value) {
                inputUbdateColor(textarea, label)
                check = true
            }
        }

        if(check) {
            createMessage('Preencha todos os campos obrigatórios!')
            return
        }

        btn.type = 'submit'
    })
}



// FUNCAO PARA ADICIONAR NOVO HORARIO
function addTime() {
    const main = document.querySelector('#time-modality form .row')
    const btnAdd = main.querySelector('.day-add .btn-add')

    btnAdd.addEventListener('click', function() {
        // Criando tags
        const article = document.createElement('article')

        const btnClose = document.createElement('button')
        const i = document.createElement('i')

        const openHour = document.createElement('input')
        const openMinute = document.createElement('input')
        const closeHour = document.createElement('input')
        const closeMinute = document.createElement('input')

        const span = document.createElement('span')

        // Adicionando type
        btnClose.type = 'button'
        
        openHour.type = 'number'
        openMinute.type = 'number'
        closeHour.type = 'number'
        closeMinute.type = 'number'

        // Adicionando class
        i.classList.add('fa-solid')
        i.classList.add('fa-trash')
        
        // Adicionando name
        openHour.name = 'open-hour[]'
        openMinute.name = 'open-minute[]'
        closeHour.name = 'close-hour[]'
        closeMinute.name = 'close-minute[]'

        // Adicionando placeholder
        openHour.placeholder = 'Hora'
        openMinute.placeholder = 'Min'
        closeHour.placeholder = 'Hora'
        closeMinute.placeholder = 'Min'

        
        span.innerHTML = '-'

        
        // Finalizando
        btnClose.appendChild(i)
        article.appendChild(btnClose)

        article.appendChild(openHour)
        article.appendChild(openMinute)

        article.appendChild(span)

        article.appendChild(closeHour)
        article.appendChild(closeMinute)
        
        main.appendChild(article)


        // Excluindo time ao clicar no botao de excluir
        btnClose.addEventListener('click', function() {
            main.removeChild(article)
        })
    })
}



// FUNCAO PARA EXCLUIR HORARIO
function deleteTime() {
    const main = document.querySelector('#time-modality form .row')

    for(const article of main.querySelectorAll('article')) {
        if(article) {
            const btnTrash = article.querySelector('button')

            btnTrash.addEventListener('click', function() {
                main.removeChild(article)
            })
        }
    }
}

