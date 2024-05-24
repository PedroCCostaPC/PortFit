// FUNCAO PARA OVERLAY DE DELETAR PRECO
function deletePrice() {
    const main = document.querySelector('#main-academy-prices section')

    for(const article of main.querySelectorAll('article')) {
        const btnDelete = article.querySelector('.btn-delete')
        const overlay = article.querySelector('.overlay')

        openOverlay(overlay, btnDelete)
    }
}

// FUNCAO PARA REMOCAO DE PRODUTOS
function deleteScheme() {
    const main = document.querySelector('#main-academy-price form #products')

    for(const scheme of main.querySelectorAll('.prod-row')) {
        const btnDelete = scheme.querySelector('.btn-delete-product')

        btnDelete.addEventListener('click', function() {
            main.removeChild(scheme)
        })
    }
}


// FUNCAO PARA ADICIONAR PRODUTOS
function addScheme() {
    const main = document.querySelector('#main-academy-price form')
    const box = main.querySelector('#products')
    const btnAdd = main.querySelector('#btn-add-product')

    btnAdd.addEventListener('click', function() {
        // Criando tags
        const div = document.createElement('div')
        const btnRemove = document.createElement('button')
        const i = document.createElement('i')
        const input = document.createElement('input')

        // Adicionando class
        div.classList.add('prod-row')
        btnRemove.classList.add('btn-delete-product')
        i.classList.add('fa-solid')
        i.classList.add('fa-trash')
        input.classList.add('scheme-js')

        // Adicionando type
        btnRemove.type = 'button'
        input.type = 'text'

        // Adicionando name
        input.name = 'scheme[]'

        // Finanlizando
        btnRemove.appendChild(i)
        div.appendChild(btnRemove)
        div.appendChild(input)
        box.appendChild(div)


        // Removendo
        btnRemove.addEventListener('click', function() {
            box.removeChild(div)
        })
    })
}



// FUNCAO PARA VALIDAR FORM DE PRECO
function validatePrice() {
    const form = document.querySelector('#main-academy-price section form')
    const btn = form.querySelector('.btn-send-js')
    let check = false

    btn.type = 'button'

    btn.addEventListener('click', function() {
        const scheme = form.querySelector('#products .prod-row')

        for(const field of form.querySelectorAll('.start-js')) {
            const label = field.querySelector('label')
            const input = field.querySelector('input')

            if(!input.value) {
                inputUbdateColor(input, label)
                check = true
            } else {
                check = false
            }
        }

        if(check) {
            createMessage('Preencha todos os campos obrigatórios!')
            return
        }

        // Validando produtos
        if(!scheme) {
            createMessage('Informe ao menos um item!')
            return
        } else {
            const schemeInput = scheme.querySelector('.scheme-js')
            if(!schemeInput.value) {
                createMessage('Informe ao menos um item!')
                return
            }  
        }

        btn.type = 'submit'
    })

}