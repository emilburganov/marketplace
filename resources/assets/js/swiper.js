import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';

Swiper.use([Navigation]);

const categoriesSwiper = new Swiper('.categories-swiper', {
    direction: 'horizontal',
    loop: true,

    navigation: {
        nextEl: '.categories-swiper-button-next',
        prevEl: '.categories-swiper-button-prev',
    },

    breakpoints: {
        576: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 4,
        },
        1200: {
            slidesPerView: 6,
        },
    },

    spaceBetween: 16,
});

const salesSwiper = new Swiper('.sales-swiper', {
    direction: 'horizontal',

    navigation: {
        nextEl: '.sales-swiper-button-next',
        prevEl: '.sales-swiper-button-prev',
    },

    breakpoints: {
        576: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 4,
        },
    },

    spaceBetween: 30,
});

const productsSwiper = new Swiper('.products-swiper', {
    direction: 'horizontal',

    navigation: {
        nextEl: '.products-swiper-button-next',
        prevEl: '.products-swiper-button-prev',
    },

    breakpoints: {
        576: {
            slidesPerView: 1,
        },
        768: {
            slidesPerView: 2,
        },
        1024: {
            slidesPerView: 3,
        },
        1200: {
            slidesPerView: 4,
        },
    },

    spaceBetween: 30,
});
