// Funcao para loading das paginas
function loading() {
    $(window).on("load", function(){
        document.getElementById("loading").style.display = "none";
    });
}

// Funcao para menu mobile
function navMobile() {
    const body = document.querySelector('body')
    const btnNav = document.querySelector('header .container #btn-nav-mobile button')
    const boxNav = document.querySelector('header .container #nav')

    btnNav.addEventListener('click', function() {
        if(boxNav.classList.contains('open-nav-mobile')) {
            body.classList.add('body-lock')
            boxNav.classList.remove('open-nav-mobile')
        } else {
            body.classList.remove('body-lock')
            boxNav.classList.add('open-nav-mobile')
        }
    })
}

// Funcao para fechar mensagem de alerta
function closeMessage() {
    const box = document.querySelector('.message-alert')

    if(document.body.contains(box)) {
        setTimeout(() => {
            box.classList.add('close')

            setTimeout(() => {
                box.style.display = 'none'
            }, 500)
        }, 3000)
    }
}

loading()
navMobile()
closeMessage()



