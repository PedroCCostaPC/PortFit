// FUNCAO PARA FORM DE LOGIN
function login() {
    const form = document.querySelector('#login form')
    const btn = form.querySelector('button')
    const email = form.querySelector('.email')
    const password = form.querySelector('.password')

    btn.type = 'button'

    btn.addEventListener('click', function() {
        // Checando campos obrigatorios
        if(!email.value || !password.value) {
            createMessage('Digite seu e-mail e senha!')

            // Checando email
            if(!email.value) inputUbdateColor(email)

            // Checando senha
            if(!password.value) inputUbdateColor(password)

            return
        }

        btn.type = 'submit'
    })
}

// FUNCAO PARA FORM DE RECUPERAR SENHA
function recoverPassword() {
    const form = document.querySelector('#login form')
    const btn = form.querySelector('button')
    const email = form.querySelector('.email')

    btn.type = 'button'

    btn.addEventListener('click', function() {
        // Checando campos obrigatorios
        if(!email.value) {
            createMessage('Digite seu e-mail!')

            // Checando email
            if(!email.value) inputUbdateColor(email)


            return
        }

        newLoad('../')
        btn.type = 'submit'
    })
}

