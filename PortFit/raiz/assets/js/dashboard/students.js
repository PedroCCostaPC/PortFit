// FUNCAO PARA DELETAR ALUNOS
function deleteStudent() {
    const main = document.querySelector('#main-dash-students #students')

    for(const article of main.querySelectorAll('article')) {
        const btnDelete = article.querySelector('.btn-delete')
        const overlay = article.querySelector('.overlay')

        openOverlay(overlay, btnDelete)
    }
}

// FUNCAO PARA VALIDAR FORM
function validateStudent() {
    const main = document.querySelector('#form-student form')
    const btn = main.querySelector('.btn-standard-form')

    const firstName = main.querySelector('#first-name')
    const lastName = main.querySelector('#last-name')
    // Nascimento
    const day = main.querySelector('#day')
    const month = main.querySelector('#month')
    const year = main.querySelector('#year')
    // Sexo
    const feminine = main.querySelector('#feminine')
    const masculine = main.querySelector('#masculine')

    const rg = main.querySelector('#rg')
    const email = main.querySelector('#email')
    // Telefone
    const ddd = main.querySelector('#ddd')
    const phone = main.querySelector('#phone')


    btn.type = 'button'

    btn.addEventListener('click', function() {
        // Checando se campos obrigatorios foram preenchidos
        if(!firstName.value || !lastName.value || !day.value || !month.value || !year.value || !rg.value || !email.value) {
            createMessage('Preencha todos os campos obrigatórios!')

            // Checando nome
            if(!firstName.value) inputUbdateColor(firstName)

            // Checando sobrenome
            if(!lastName.value) inputUbdateColor(lastName)

            // Checando dia
            if(!day.value) inputUbdateColor(day)

            // Checando mes
            if(!month.value) inputUbdateColor(month)

            // Checando ano
            if(!year.value) inputUbdateColor(year)

            // Checando rg
            if(!rg.value) inputUbdateColor(rg)

            // Checando email
            if(!email.value) inputUbdateColor(email)

            return
        }

        // Validando sexo
        if(!feminine.checked && !masculine.checked) {
            createMessage('Selecione o sexo!')

            return
        }

        // Validando Telefone
        if(!validatePhone(ddd, phone)) return


        newLoad('../../')
        return btn.type = 'submit'
    })
}