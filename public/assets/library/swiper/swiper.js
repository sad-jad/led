var swiper = new Swiper('.mySwiper', {
    breakpoints: {
        640: {
            slidesPerView: 4,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        },
    },
});

var swiper = new Swiper('.mySwiper-modal', {
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        },
    },
});

let openAll = document.querySelector('.open-all');
let closeAll = document.querySelector('.close-all');
let accordionButton = document.querySelectorAll('.accordion-button');
let accordionCollapse = document.querySelectorAll('.accordion-collapse');

openAll.addEventListener('click', function (e) {
    e.preventDefault();
    openAll.classList.add('d-none');
    closeAll.classList.remove('d-none');
    accordionButton.forEach((button) => {
        button.classList.remove('collapsed');
    });
    accordionCollapse.forEach((collapse) => {
        collapse.classList.add('show');
    });
});
closeAll.addEventListener('click', function (e) {
    e.preventDefault();
    openAll.classList.remove('d-none');
    closeAll.classList.add('d-none');
    accordionButton.forEach((button) => {
        button.classList.add('collapsed');
    });
    accordionCollapse.forEach((collapse) => {
        collapse.classList.remove('show');
    });
});
