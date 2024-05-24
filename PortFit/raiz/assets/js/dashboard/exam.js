// FUNCAO PARA DELETAR ULTIMO EXAME
function deleteLastExam() {
    const main = document.querySelector('#last-exam')

    if(main) {
        const btnDelete = main.querySelector('.exams-btns .btn-delete')
        const overlay = main.querySelector('.overlay')

        openOverlay(overlay, btnDelete)
    }
}

// FUNCAO PARA DELETAR EXAMES
function deleteExam() {
    const main = document.querySelector('#all-exams')

    if(main) {
        for(const article of main.querySelectorAll('.exams .list-exam article')) {
            const btnDelete = article.querySelector('.btn-delete')
            const overlay = article.querySelector('.overlay')
    
            openOverlay(overlay, btnDelete)
        }
    }
}

// FUNCAO PARA VALIDAR FORMULARIO DE EXAME
function validateExam() {
    const form = document.querySelector('#main-dash-exam-form #form form')
    const btn = form.querySelector('button')
    let check = false

    btn.type = 'button'

    btn.addEventListener('click', function() {
        for(const row of form.querySelectorAll('.row-inputs')) {
            if(row) {
                const input = row.querySelector('input')
                const label = row.querySelector('label')

                if(!input.value) {
                    inputUbdateColor(input, label)
                    check = true
                }
            }
        }

        if(check) {
            createMessage('Preencha todos os campos obrigatórios!')
            return
        }

        btn.type = 'submit'
    })
}

// FUNCAO PARA MUDAR COR DOS CAMPOS DO FOR QUE JA ESTAO PREENCHIDOS
function alterColorForm() {
    const form = document.querySelector('#main-dash-exam-form #form form')

    for(const col of form.querySelectorAll('.row .col')) {
        const input = col.querySelector('input')

        if(input && input.value) {
            input.classList.add('input-value')

            input.addEventListener('focus', function() {
                input.classList.remove('input-value')
            })
        }
    }


    for(const col of form.querySelectorAll('.row')) {
        const textarea = col.querySelector('textarea')

        if(textarea && textarea.value) {
            textarea.classList.add('input-value')

            textarea.addEventListener('focus', function() {
                textarea.classList.remove('input-value')
            })
        }
    }
}