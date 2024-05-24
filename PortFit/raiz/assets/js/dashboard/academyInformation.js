// FUNCAO PARA VALIDAR FORM DE LOCALIZACAO
function validateLocation() {
    const form = document.querySelector('#academy-location form')
    const btn = form.querySelector('.btn-standard-form')
    const cep = form.querySelector('.row .cep input')
    const cepLabel = form.querySelector('.row .cep label')

    btn.type = 'button'

    btn.addEventListener('click', function() {
        // Validando CEP
        if(cep.value) {
            if(cep.value.length < 8 || cep.value.length > 9) {
                createMessage('CEP Inválido!')
                inputUbdateColor(cep, cepLabel)

                return
            }
        }
        return btn.type = 'submit'
    })
}

// FUNCAO PARA VALIDAR TELEFONE DE CONTATO
function validatePhoneContact() {
    const form = document.querySelector('#academy-contact form')
    const btn = form.querySelector('.btn-standard-form')
    const ddd = form.querySelector('#ddd')
    const phone = form.querySelector('#phone')
    const dddSapp = form.querySelector('#dddSapp')
    const whatsapp = form.querySelector('#whatsapp')

    btn.type = 'button'

    btn.addEventListener('click', function() {
        if(!validatePhone(ddd, phone)) return
        if(!validatePhone(dddSapp, whatsapp, 'WhatSapp inválido!')) return



        return btn.type = 'submit'
    })
}

// FUNCAO PARA OVERLAYS DE CONFIRMACAO DE EXCLUSAO DAS FOTOS
function confirmDeletePhoto() {
    const main = document.querySelector('#academy-photos .photos')

    for(const photo of main.querySelectorAll('.photo')) {
        const btnOpen = photo.querySelector('.btn-trash-photo')
        const overlay = photo.querySelector('.overlay')

        openOverlay(overlay, btnOpen)
    }
}

// FUNCAO PARA OVERLAY DE ADD PHOTO
function addPhoto() {
    const main = document.querySelector('#academy-photos .photos')
    const overlay = main.querySelector('#overlay-add-photos .overlay')
    const btnOpen = main.querySelector('#add-photo')

    openOverlay(overlay, btnOpen, false)
}

// FUNCAO PARA OVERLAY DE ADD SOCIAL
function addSocial() {
    const main = document.querySelector('#academy-socials #socials')
    const overlay = main.querySelector('.overlay')
    const btnOpen = main.querySelector('#btn-add-social')

    openOverlay(overlay, btnOpen, false)
}


// FUNCAO PARA VALIDAR FORM DE ADD REDE SOCIAL
function validateAddSocial() {
    const form = document.querySelector('#academy-socials .form-add-social')
    const btn = form.querySelector('button')
    const inputName = form.querySelector('#input-name input')
    const LabelName = form.querySelector('#input-name label')
    const inputLink = form.querySelector('#input-link input')
    const LabelLink = form.querySelector('#input-link label')

    btn.type = 'button'

    btn.addEventListener('click', function() {
        
        if(!inputName.value || !inputLink.value) {
            createMessage('Preencha todos os campos obrigatórios!')

            // Validando nome
            if(!inputName.value) inputUbdateColor(inputName, LabelName)

            // Validando link
            if(!inputLink.value) inputUbdateColor(inputLink, LabelLink)

            return
        }


        btn.type = 'submit'
    })
}


// FUNCAO PARA OVERLAY DE ALTERAR E DELETAR REDES SOCIAIS
function overlayUpdateSocial() {
    const main = document.querySelector('#academy-socials #socials')

    for(const social of main.querySelectorAll('.social-dash')) {
        const btnAlter = social.querySelector('.btn-alter')
        const overlayAlter = social.querySelector('.overlay-alter')
        const btnDelete = social.querySelector('.btn-delete')
        const overlayDelete = social.querySelector('.overlay-delete')
        const idSocial = social.querySelector('.overlay .id-social')

        // Abre overlay de alterar
        openOverlay(overlayAlter, btnAlter, false)

        // preview do icon
        const id = `#btn-icon-social-${idSocial.value}`
        const idLabel = `#label-icon-social-${idSocial.value}`
        previewIMG(id, idLabel)

        // Abre overlay de deletar
        openOverlay(overlayDelete, btnDelete)


    }
}


// FUNCAO PARA VALIDAR FORM DE ALTERAR REDE SOCIAL
function validateUpdateSocial() {
    const main = document.querySelector('#academy-socials #socials')

    for(const social of main.querySelectorAll('.social-dash')) {
        const btn = social.querySelector('.overlay form button')
        const inputName = social.querySelector('.overlay form .input-name-update-js input')
        const LabelName = social.querySelector('.overlay form .input-name-update-js label')
        const inputLink = social.querySelector('.overlay form .input-link-update-js input')
        const LabelLink = social.querySelector('.overlay form .input-link-update-js label')

        btn.type = 'button'

        btn.addEventListener('click', function() {
            if(!inputName.value || !inputLink.value) {
                createMessage('Preencha todos os campos obrigatórios!')
    
                // Validando nome
                if(!inputName.value) inputUbdateColor(inputName, LabelName)
    
                // Validando link
                if(!inputLink.value) inputUbdateColor(inputLink, LabelLink)
    
                return
            }
    
            btn.type = 'submit'
        })
    }
}




validateLocation()
validatePhoneContact()
confirmDeletePhoto()
addPhoto()
addSocial()
validateAddSocial()
overlayUpdateSocial()
validateUpdateSocial()