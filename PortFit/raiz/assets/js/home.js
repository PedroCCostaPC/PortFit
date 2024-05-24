// FUNCAO PARA SLIDE
function slide() {
    $('#slide ul').slick({
        infinite: true,
        speed: 1000,
        autoplay: true,
        autoplaySpeed: 7000
    });
}


// FUNCAO PARA CAROUSEL DAS MODALIDADES
function modalities() {
    $('#home-modality .modalities').slick({
        dots: true,
        infinite: true,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 2,
        arrows: false,
        dotsClass: 'slick-dots', 
        responsive: [
            {
                breakpoint: 900,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1
                }
            }
        ]
    });
}


// FUNCAO PARA CAROUSEL DOS PRECOS
function prices(main) {
    const amount = document.querySelector('#amount-price').value

    $(`${main} .price-main .prices`).slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: amount,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 900,
                settings: {
                slidesToShow: 1,
                slidesToScroll: 1
                }
            }
        ]
    });
}


// FUNCAO PARA COLOCAR ALTURA NOS PRECOS
function heightPrice(main, mobile = null) {
    const prices = document.querySelector(`${main} .price-main .prices`)
    const emphasis = document.querySelector(`${main} .price-main .emphasis`)
    const height = []

    // Caso tenha preco destacado
    if(emphasis) {
        const heightEmphasis = emphasis.clientHeight

        // pega altura dos precos normais e verifica qual o maior
        for(let col of prices.querySelectorAll('.all-prices')) {
            height.push(col.clientHeight)
        }
        const bigger = Math.max(...height)

        // coloca a maior altura nas div dos preco normais e destaque
        for(let col of prices.querySelectorAll('.all-prices')) {
            if(heightEmphasis > bigger) {
                col.style.height = `${heightEmphasis}px`
                if(mobile) emphasis.style.height = `${heightEmphasis}px`
            } else {
                col.style.height = `${bigger}px`
                if(mobile) emphasis.style.height = `${bigger}px`
            }
        }

    // Caso nao tenha preco destacado
    } else {
        for(let col of prices.querySelectorAll('.all-prices')) {
            height.push(col.clientHeight)
        }
        const bigger = Math.max(...height)
            
        for(let col of prices.querySelectorAll('.all-prices')) {
            col.style.height = `${bigger}px`
        }
    }
}



slide()
modalities()
prices('#home-price')
prices('#home-price-mobile')
heightPrice('#home-price')
heightPrice('#home-price-mobile', true)