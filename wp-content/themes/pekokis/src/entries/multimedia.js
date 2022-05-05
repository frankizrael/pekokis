import '../scss/multimedia.scss';
import 'swiper/dist/css/swiper.css';
import Swiper from 'swiper';

const relatedProducts = new Swiper('.relatedProducts .swiper-container', {
    // Default parameters
    slidesPerView: 'auto',
    // Responsive breakpoints
    navigation: {
    nextEl: '.relatedProducts .swiper-button-next',
    prevEl: '.relatedProducts .swiper-button-prev',
    },
});

$('.filterMobile').on('click',function() {
    $('.contentCategories_inside_flex aside').addClass('active');
});
$('.closeFilter').on('click',function() {
    $('.contentCategories_inside_flex aside').removeClass('active');
});

$('.singleProduct .myProductModal__image__bottom img').on('click',function() {
    const $this = $(this);
    const srcimg = $this.attr('src');
    const $imgprincipal = $('.myProductModal__image__top img');
    $imgprincipal.attr('src',srcimg);
});
const $valueQuantity = $('.simpleSpinner .quantity input');
$valueQuantity.attr('type','text');
$('.simpleSpinner .plus').on('click',function() {
    const value = Number($valueQuantity.val());
    const newvalue = value + 1;
    $valueQuantity.val(newvalue);
});
$('.simpleSpinner .minus').on('click',function() {
    const value = Number($valueQuantity.val());
    const newvalue = value - 1;
    if (value !== 0) {
        $valueQuantity.val(newvalue);
    }    
});