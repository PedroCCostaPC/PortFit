// FUNCAO PARA VALIDA FORM DE CONTATO
function formContact() {
    const form = document.querySelector('#contact form')
    const btn = form.querySelector('button')
    const name = form.querySelector('.name')
    const email = form.querySelector('.email')
    const message = form.querySelector('.message')
    const messageLabel = form.querySelector('.message-label')

    const ddd = form.querySelector('.ddd input')
    const phone = form.querySelector('.phone input')
    
    btn.type = 'button'
    
    btn.addEventListener('click', function() {

        // Checando campos obrigatorios
        if(!name.value || !email.value || !message.value) {
            createMessage('Preencha todos os campos obrigatórios!')

            // Checando nome
            if(!name.value) inputUbdateColor(name)

            // Checando email
            if(!email.value) inputUbdateColor(email)

            // Checando mensagem
            if(!message.value) inputUbdateColor(message, messageLabel)

            return
        
        } else {

            // Validando Telefone
            if(!validatePhone(ddd, phone)) return
        }

        newLoad()
        return btn.type = 'submit'
    })
}

formContact()