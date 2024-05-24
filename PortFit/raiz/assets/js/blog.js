// FUNCAO PARA SLIDE
function slide() {
    $('#slide-blog ul').slick({
        infinite: true,
        speed: 1000,
        autoplay: true,
        autoplaySpeed: 5000,
        dots: true,
        dotsClass: 'slick-dots', 
    });
}



// FUNCAO PARA FORMULARIO DE COMENTARIO
function comentary() {
    const form = document.querySelector('#comentary form')
    const btn = form.querySelector('button')
    const comentary = form.querySelector('textarea')
    const name = form.querySelector('.name input')
    const email = form.querySelector('.email input')

    btn.type = 'button'

    btn.addEventListener('click', function() {
        // Checando campos obrigatorios
        if(!comentary.value || !name.value || !email.value) {
            createMessage('Preencha todos os campos obrigatórios!')
    
            // Checando comentario
            if(!comentary.value) inputUbdateColor(comentary)

            // Checando nome
            if(!name.value) inputUbdateColor(name)

            // Checando email
            if(!email.value) inputUbdateColor(email)
    
            return
        }

        return btn.type = 'submit'
    })
    


}