import '../scss/home.scss';
import 'swiper/dist/css/swiper.css';
import Swiper from 'swiper';

const bannerbrandsSwiper = new Swiper('.bannerbrands .swiper-container', {
    // Default parameters
    slidesPerView: 'auto',
    // Responsive breakpoints
    navigation: {
    nextEl: '.bannerbrands .swiper-button-next',
    prevEl: '.bannerbrands .swiper-button-prev',
    },
});

const moreSalesproductsSwiper = new Swiper('.moreSalesproducts .swiper-container', {
    // Default parameters
    slidesPerView: 'auto',
    // Responsive breakpoints
    navigation: {
    nextEl: '.moreSalesproducts .swiper-button-next',
    prevEl: '.moreSalesproducts .swiper-button-prev',
    },
});

const defaultOption = '<option value="0">Selecciona el modelo</option>';
$('#marca').on('change',function(){
    const value = $(this).val();
    console.log(value);
    $.ajax({
        type: "post",
        dataType: "json",
        url: ajaxUrl,
        data: {
            action: "send_mymodels",
            value: value
        },
        success: function(response) {
            let modelsOptions = '';
            for (let i=0;i<response.length;i++) {
                const modelsItem =  `<option value="${response[i].id}">${response[i].name}</option>`;
                modelsOptions = modelsOptions+modelsItem;
            }
            const finalModelOptions = defaultOption + modelsOptions;
            $('#modelo').html(finalModelOptions);
        }
    });
});

$('#search').on('click',function(e){
    e.preventDefault();
    const marcaValue = $('#marca').val();
    const modeloValue = $('#modelo').val();
    const tipoValue = $('#tipo').val();
    $.ajax({
        type: "post",
        dataType: "json",
        url: ajaxUrl,
        data: {
            action: "logicurls",
            marca: marcaValue,
            modelo: modeloValue,
            tipo: tipoValue,
        },
        success: function(response) {
            location.href = response.link;
        }
    });
});