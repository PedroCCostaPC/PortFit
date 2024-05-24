// FUNHCAO PARA ABRIR CATEGORIAS
function openCategories() {
    const body = document.querySelector('body')
    const main = document.querySelector('#main-dash-blog')
    const btnOpen = main.querySelector('.btn-open-category')
    const btnClose = main.querySelector('#categories .btn-close-overlay')
    const box = main.querySelector('#categories')

    // Abrindo categorias
    btnOpen.addEventListener('click', function() {
        box.classList.remove('close')
    })

    // Fechando categorias
    btnClose.addEventListener('click', function() {
        box.classList.add('close')
    })

    body.addEventListener('mouseup', function(e) {
        if(!box.contains(e.target)) {
            box.classList.add('close')
        }
    })
}


// FUNCAO PARA DELETAR BLOG
function deleteBlog() {
    const main = document.querySelector('#main-dash-blog #posts')

    for(const article of main.querySelectorAll('article')) {
        const btnDelete = article.querySelector('.btn-delete')
        const overlay = article.querySelector('.overlay-delete')

        openOverlay(overlay, btnDelete)
    }
}

// FUNCAO PARA DISPARAR EMAILS
function shootBlog() {
    const main = document.querySelector('#main-dash-blog #posts')

    for(const article of main.querySelectorAll('article')) {
        const btnShoot = article.querySelector('.btn-email')
        const overlay = article.querySelector('.overlay-send-email')      
        
        if(btnShoot) { 
            const btnConfirm = overlay.querySelector('form button')
            btnConfirm.type = 'button'

            openOverlay(overlay, btnShoot)

            btnConfirm.addEventListener('click', function() {
                newLoad('../')
                btnConfirm.type = 'submit'
            }) 
        }
    }
}

// FUNCAO PARA TEXTAREA DE CRIACAO DO POST
function textareaBlog() {
    $('#post').trumbowyg({
        btns: [
            ['viewHTML'],
            ['undo', 'redo'], // Only supported in Blink browsers
            ['formatting'],
            ['strong', 'em'],
            ['superscript', 'subscript'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ],
        autogrow: true
    });
}


// FUNCAO PARA DELETAR COMENTARIOS
function deleteComment() {
    const main = document.querySelector('#main-dash-blog-comment section')

    for(const article of main.querySelectorAll('article')) {
        const btnDelete = article.querySelector('.btn-delete')
        const overlay = article.querySelector('.overlay')

        openOverlay(overlay, btnDelete)
    }
}