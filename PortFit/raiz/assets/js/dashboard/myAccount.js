// FUNCAO PARA REMOVER MINHA FOTO
function deleteMyPhoto(mainP) {
    const main = document.querySelector(mainP)
    const photo = main.querySelector('.photo')
    const btn = main.querySelector('button')
    const input = main.querySelector('#remove-photo')

    if(btn) {
        btn.addEventListener('click', function() {
            const myImg = photo.querySelector('img')
            const img = document.createElement('img')
            
            img.src = '../assets/img/user.png'

            input.value = 1
            
            photo.removeChild(myImg)
            photo.appendChild(img)
            main.removeChild(btn)
        })
    }
}

// FUNCAO PARA VALIDAR FORM
function validateMyAccount() {
    const main = document.querySelector('#form-my-account form')
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

        return btn.type = 'submit'
    })
}


// FUNCAO PARA VALIDAR FOR DE SENHA
function validateFormPassword() {
    const main = document.querySelector('#form-my-password form')
    const btn = main.querySelector('.btn-standard-form')
    const password = main.querySelector('#password')
    const confirmPassword = main.querySelector('#confirm-password')

    btn.type = 'button'

    btn.addEventListener('click', function() {
        if(!password.value) {
            inputUbdateColor(password)
            createMessage('Digite uma senha!')

            return
        }

        if(password.value !== confirmPassword.value) {
            inputUbdateColor(confirmPassword)
            createMessage('Confirme a senha corretamente!')

            return
        }



        return btn.type = 'submit'
    })
}
