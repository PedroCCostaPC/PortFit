//  ----------------- FUNCOES DE FORMULARIOS -----------------

// Funcao para criar mensagem
function createMessage(message) {

    const body = document.querySelector('body')
    const div = document.createElement('div')
    const p = document.createElement('p')

    div.classList.add('message-alert')
    div.classList.add('error')

    p.innerHTML = message

    div.appendChild(p)
    body.appendChild(div)

    // Apagando mensagem
    setTimeout(() => {
        div.classList.add('close')

        setTimeout(() => {
            div.style.display = 'none'
        }, 500)
    }, 3000)

}

// Funcao para mudar cor do input
function inputUbdateColor(input, label = null) {
    input.classList.add('input-error')
    if(label) label.classList.add('label-error')

    input.addEventListener('focus', function() {
        input.classList.remove('input-error')
        if(label) label.classList.remove('label-error')
    })
}


// Funcao para validar telefone
function validatePhone(ddd, phone, msg = 'Telefone inválido!') {
    if(ddd.value && !phone.value) {
        inputUbdateColor(phone)
        createMessage('Informe seu número de telefone')
        return false
    }

    if(phone.value && !ddd.value) {
        inputUbdateColor(ddd)
        createMessage('Informe seu DDD')
        return false
    }

    if(ddd.value && phone.value) {
        // Validando ddd
        if(ddd.value.length !== 2) {
            inputUbdateColor(ddd)
            createMessage('DDD inválido!')
            return false
        }

        // Validando telefone
        if(phone.value.length < 8 || phone.value.length > 9) {
            inputUbdateColor(phone)
            createMessage(msg)
            return false
        }
    }

    return true
}


// Funcion para criar load de tela
function newLoad(directory = '') {
    const body = document.querySelector('body')
    const div = document.createElement('div')
    const img = document.querySelector('img')

    img.setAttribute('src', `${directory}assets/img/loading.svg`)
    
    div.id = 'load-form'

    div.appendChild(img)
    body.appendChild(div)
}


// FUNCAO PARA SELECTS PADRAO DO DASH
function inputSelect(selectP) {
    const body = document.querySelector('body')
    const select = document.querySelector(selectP)
    const btn = select.querySelector('button')
    const i = btn.querySelector('i')
    const input = select.querySelector('input')
    const ul = select.querySelector('ul')

    btn.addEventListener('click', function() {
        if(select.classList.contains('close')) {
            select.classList.remove('close')
        } else {
            select.classList.add('close')
        }
    })

    // Fechando nav com click fora da nav
    body.addEventListener('mouseup', function(e) {
        if(!select.contains(e.target)) {
            select.classList.add('close')
        }
    })


    // Percorrendo ul
    for(const li of ul.querySelectorAll('li')) {
        const inputLi = li.querySelector('input').value
        const p = li.querySelector('p').innerText
        
        li.addEventListener('click', function() {
            input.value = inputLi
            select.classList.add('close')
            btn.innerHTML = p
            btn.appendChild(i)
        })
    }
}


// FUNCAO PARA REMOVER FOTO DE PERFIO DO USUARIO
function deletePhoto(mainP) {
    const main = document.querySelector(mainP)
    const photo = main.querySelector('.photo')
    const btn = main.querySelector('button')
    const input = main.querySelector('#remove-photo')

    if(btn) {
        btn.addEventListener('click', function() {
            input.value = 1
            photo.classList.add('photo-remove')
            main.removeChild(btn)
        })
    }
}