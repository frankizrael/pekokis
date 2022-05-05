import '../scss/page.scss';
import Swal from 'sweetalert2'

const $p = $('.woocommerce-billing-fields__field-wrapper .form-row');
for (let i=0;i<$p.length;i++) {
    const style = 'order:'+i;
    $p.eq(i).attr('style',style);
}

const $delivery = $('#billing_tipo_envio_field .woocommerce-input-wrapper label').eq(0);
const $recojo = $('#billing_tipo_envio_field .woocommerce-input-wrapper label').eq(1);

$delivery.prepend('<svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 21.1818V9.18182L10 1L19 9.18182V21.1818H1Z" stroke="#C41A2C"/><rect x="7" y="13" width="6" height="8" rx="1" stroke="#C41A2C"/></svg>');
$recojo.prepend('<svg width="22" height="14" viewBox="0 0 22 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 11H1V1H14V11H7" stroke="#C41A2C" stroke-linecap="round"/><path d="M19 11H21V6.55556L19 3H14V11H15" stroke="#C41A2C" stroke-linecap="round"/><circle cx="5" cy="11" r="2" stroke="#C41A2C"/><circle cx="17" cy="11" r="2" stroke="#C41A2C"/></svg>');


function isChecked($fhater){
    const $radioslabel = $fhater.find('.radio');
    $radioslabel.removeClass('checkedInput');
    for (let i=0;i<$radioslabel.length;i++) {
        const id = '#'+$radioslabel.eq(i).attr('for');
        if($(id).is(':checked')) {
            $radioslabel.eq(i).addClass('checkedInput');
        }
    }
}
function renderIsChecked($fhater) {
    const $radios = $fhater.find('.input-radio');
    $radios.on('change',function() {
        setTimeout(function(){
            isChecked($fhater);
        },100);
    });
    isChecked($fhater);
}
renderIsChecked($('#billing_tipo_envio_field .woocommerce-input-wrapper'));

function hideClass($conditional, conditional_value, classeActive, classDesactive) {
    $conditional.on('change',function(){   
        const valyueDireccion = $('#billing_address_1').val();
        const value = $(this).val();
        if (value == conditional_value) {
            $(classeActive).show();
            $(classDesactive).hide();
            //especial
            $('#billing_departamento_field').hide();
            $('#billing_provincia_field').hide();
            $('#billing_distrito_field').hide();
            if (valyueDireccion.length < 1) {
                $('#billing_address_1').val('Recojo en tienda');
            }
        } else {
            $(classeActive).hide();
            $(classDesactive).show();
            //especial
            $('#billing_departamento_field').show();
            $('#billing_provincia_field').show();
            $('#billing_distrito_field').show();
            if (valyueDireccion == 'Recojo en tienda') {
                $('#billing_address_1').val('');
            }
        }
    });    
    $(classeActive).hide();
}
hideClass($('#billing_tipo_envio_field .woocommerce-input-wrapper .input-radio'), 'recojo', '.onlyrecojo', '.onlydelivery');
 
$('.onlyotra').hide();
$('#billing_who_tipo_field .input-radio').on('change',function(){
    const value = $(this).val();
    if (value == 'otra') {
        $('.onlyotra').show();
    } else {
        $('.onlyotra').hide();
    }
}); 

//prevalidCamps

function createDataLabels($id, type) {
    let value = '';
    if (type == 'select') {
        const $option = $id.find('select').find('option');
        const selectvalue = $id.find('select').val(); 
        for (let u=0;u<$option.length;u++) {
            if ($option.eq(u).attr('value') == selectvalue) {
                value = $option.eq(u).text();
            }
        }

    }
    if (type == 'input') {
        value = $id.find('input').val();        
    }
    if (value.length < 1) {
        $id.addClass('woocommerce-invalid');        
    }
    return value;
}

//value statususer 
function addButtonToReference() {
    const templateButton = '<div class="widthButton onlydelivery"><a href="javascript:void(0)" id="sendAjaxNewDirection" class="btn">Agregar dirección</a></div>';
    $(templateButton).insertAfter('#billing_referencia_address_field');
    //functions buttonAddSeries 
    $('#sendAjaxNewDirection').on('click',function(){
        const departamento_data = createDataLabels($('#billing_departamento_field'), 'select');
        const provincia_data = createDataLabels($('#billing_provincia_field'), 'select');
        const distrito_data = createDataLabels($('#billing_distrito_field'), 'select');
        const direccion_data= createDataLabels($('#billing_address_1_field'), 'input');
        const numero_data = createDataLabels($('#billing_numero_address_field'), 'input');
        const piso_data = createDataLabels($('#billing_piso_address_field'), 'input');
        const interior_data = createDataLabels($('#billing_interior_address_field'), 'input');
        const referencia_data = createDataLabels($('#billing_referencia_address_field'), 'input');

        if (departamento_data != '' && provincia_data != '' && distrito_data != '' && direccion_data != '' && numero_data != '' && piso_data != '' && interior_data != '' && referencia_data != '') {
            $.ajax({
                type: "post",
                dataType: "json",
                url: ajaxUrl,
                data: {
                    action: "update_fields_user",
                    user_id: userId,
                    departamento_data: departamento_data,
                    provincia_data: provincia_data,
                    distrito_data: distrito_data,
                    direccion_data: direccion_data,
                    numero_data: numero_data,
                    piso_data: piso_data,
                    interior_data: interior_data,
                    referencia_data: referencia_data,
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        text: 'Tu nueva dirección se agregó con éxito',
                        confirmButtonText: 'Continuar',
                        confirmButtonColor: '#c41a2c'
                    });
                    $('#sendAjaxNewDirection').addClass('btn-disable');
                    getDirections();
                }
            });          
        }
    });
}

//my account changes
function createDataLabelsAccount($id) {
    let value = '';
    const $option = $id.find('option');
    const selectvalue = $id.val(); 
    for (let u=0;u<$option.length;u++) {
        if ($option.eq(u).attr('value') == selectvalue) {
            value = $option.eq(u).text();
        }
    }
    return value;
}


$('#order_review #payment').insertAfter('#maquinariasProvincia');

let addNew = 1;
let constantEditID = 0;
const mineUserID = $('#ajaxForm').attr('user-id');
$('#sendAjax').on('click',function(e) {
    e.preventDefault();
    const departamento_data = createDataLabelsAccount($('#ajax_departamento'));
    const provincia_data = createDataLabelsAccount($('#ajax_provincia'));
    const distrito_data = createDataLabelsAccount($('#ajax_distrito'));
    const direccion_data= $('#ajax_direccion').val();
    const numero_data = $('#ajax_numero').val();
    const piso_data = $('#ajax_piso').val();
    const interior_data = $('#ajax_interior').val();
    const referencia_data = $('#ajax_referencia').val();
    if (departamento_data != '' && provincia_data != '' && distrito_data != '' && direccion_data != '' && numero_data != '' && piso_data != '' && interior_data != '' && referencia_data != '') {
        if (addNew === 1) {
            $.ajax({
                type: "post",
                dataType: "json",
                url: ajaxUrl,
                data: {
                    action: "update_fields_user",
                    user_id: mineUserID,
                    departamento_data: departamento_data,
                    provincia_data: provincia_data,
                    distrito_data: distrito_data,
                    direccion_data: direccion_data,
                    numero_data: numero_data,
                    piso_data: piso_data,
                    interior_data: interior_data,
                    referencia_data: referencia_data,                
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        text: 'Tu nueva dirección se agregó con éxito',
                        confirmButtonText: 'Continuar',
                        confirmButtonColor: '#c41a2c'
                    });
                    location.reload();
                }
            });
        } else {
            $.ajax({
                type: "post",
                dataType: "json",
                url: ajaxUrl,
                data: {
                    action: "update_this_field",
                    user_id: mineUserID,
                    departamento_data: departamento_data,
                    provincia_data: provincia_data,
                    distrito_data: distrito_data,
                    direccion_data: direccion_data,
                    numero_data: numero_data,
                    piso_data: piso_data,
                    interior_data: interior_data,
                    referencia_data: referencia_data,   
                    idlist: constantEditID             
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        text: 'La dirección se actualizo con éxito',
                        confirmButtonText: 'Continuar',
                        confirmButtonColor: '#c41a2c'
                    });
                    location.reload();
                }
            });
        }
    }
});


$('.deleteDirectionAjax').on('click', function(){
    const $this = $(this);
    const id = $this.closest('li').attr('data-id');
    $.ajax({
        type: "post",
        dataType: "json",
        url: ajaxUrl,
        data: {
            action: "update_delete_user",
            list_id: id,
            user_id: mineUserID
        },
        success: function(response) {
            Swal.fire({
                icon: 'success',
                text: 'La dirección se elimino con éxito',
                confirmButtonText: 'Continuar',
                confirmButtonColor: '#c41a2c'
            });
            location.reload();
        }
    });
});

function editMyAccountSelect(valueDepartamento, valueProvincia, valueDistrito) {
    const $departamento = $('#ajax_departamento');
    const $provincia = $('#ajax_provincia');
    const $distrito = $('#ajax_distrito');
    for (let i=0;i<$departamento.find('option').length;i++){
        if (valueDepartamento == $departamento.find('option').eq(i).text()) {
           const id_departamento =  $departamento.find('option').eq(i).attr('value');
           $departamento.val(id_departamento);
           //change select2
           $departamento.closest('.inputAjaxRowInput').find('.select2-selection__rendered').text(valueDepartamento);
            var dataDepartament = {
                'action': 'rt_ubigeo_load_provincias_front',
                'idDepa': id_departamento
            }        
            $.ajax({
                type: 'POST',
                url: ajaxUrl,
                data: dataDepartament,
                dataType: 'json',
                success: function (response) {
                    if (response) {
                        jQuery('#ajax_provincia').append('<option value="">Seleccionar Provincia</option>');
                        for (var r in response) {
                            $('#ajax_provincia').append('<option value=' + r + '>' + response[r] + '</option>');
                        }
                        for (let e=0;e<$provincia.find('option').length;e++){                            
                            if (valueProvincia == $provincia.find('option').eq(e).text()) {
                              const id_provincia =  $provincia.find('option').eq(e).attr('value');
                              $provincia.val(id_provincia);
                              $provincia.closest('.inputAjaxRowInput').find('.select2-selection__rendered').text(valueProvincia);
                              var dataProvincia = {
                                    'action': 'rt_ubigeo_load_distritos_front',
                                    'idProv': id_provincia
                                }                            
                                $.ajax({
                                    type: 'POST',
                                    url: ajaxUrl,
                                    data: dataProvincia,
                                    dataType: 'json',
                                    success: function (response) {
                                        if (response) {
                                            jQuery('#ajax_distrito').append('<option value="">Seleccionar Distrito</option>');
                                            for (var r in response) {
                                                $('#ajax_distrito').append('<option value=' + r + '>' + response[r] + '</option>')
                                            }
                                            setTimeout(function(){
                                                for (let a=0;a<$distrito.find('option').length;a++){
                                                    if (valueDistrito == $distrito.find('option').eq(a).text()) {
                                                        const id_distrito =  $distrito.find('option').eq(a).attr('value');
                                                        $distrito.val(id_distrito);
                                                        $distrito.closest('.inputAjaxRowInput').find('.select2-selection__rendered').text(valueDistrito);
                                                    }
                                                }
                                            },800);
                                        }
                                    }
                                });
                            }
                        } 
                    }
                }
            });
        }
    }
}

$('.editDirectionAjax').on('click',function(){
    const $this = $(this);
    const departamento = $this.closest('li').attr('departamento');
    const provincia = $this.closest('li').attr('provincia');
    const distrito = $this.closest('li').attr('distrito');
    const direccion = $this.closest('li').attr('direccion');
    const numero = $this.closest('li').attr('numero');
    const piso = $this.closest('li').attr('piso');
    const interior = $this.closest('li').attr('interior');
    const referencia = $this.closest('li').attr('referencia');
    
    $('#ajax_direccion').val(direccion);
    $('#ajax_numero').val(numero);
    $('#ajax_piso').val(piso);
    $('#ajax_interior').val(interior);
    $('#ajax_referencia').val(referencia);

    //select2Changes
    editMyAccountSelect(departamento, provincia, distrito);       
    $('.editDirectionAjax').closest('li').find('.selectDirection').removeClass('active');
    $this.closest('li').find('.selectDirection').addClass('active');
    addNew = 0;
    constantEditID = $this.closest('li').attr('data-id');
});


function editInput($id,value) {
    $id.find('input').val(value);
}

function getItemsEvent(codeItem, selectType, actionType, itemType) {
    var data = {
        'action': actionType,
        'code': codeItem
    }

    jQuery.ajax({
        type: 'POST',
        url: ajaxUrl,
        data: data,
        dataType: 'json',
        success: function (response) {
            if (response) {
                console.log(response);
                response.map(function(obj) {
                    if(obj.code) {
                        if('prov' === itemType) {                                
                            jQuery('#' + selectType).append('<option value="" selected disabled hidden>Escoge una provincia</option>');
                            jQuery('#' + selectType).append('<option value=' + obj.code + '>' + obj.prov+ '</option>');
                        } else {                              
                            jQuery('#' + selectType).append('<option value="" selected disabled hidden>Escoge un distrito</option>');
                            jQuery('#' + selectType).append('<option value=' + obj.code + '>' + obj.dist+ '</option>');
                        }
                    }
                });
                
            }
        }
    })
}

function editSelect(valueDepartamento, valueProvincia, valueDistrito) {
    const $departamento = $('#billing_departamento');
    const $provincia = $('#billing_provincia');
    const $distrito = $('#billing_distrito');
    for (let i=0;i<$departamento.find('option').length;i++){
        if (valueDepartamento == $departamento.find('option').eq(i).text()) {
           const id_departamento =  $departamento.find('option').eq(i).attr('value');
           $departamento.val(id_departamento);
           //change select2
           $departamento.closest('.woocommerce-input-wrapper').find('.select2-selection__placeholder').text(valueDepartamento);
           const who = jQuery('#billing_who_dep option');
            for (let i=0;i<who.length;i++) {
                if (valueDepartamento.toUpperCase() == who.eq(i).text().toUpperCase()) {
                    const valor = who.eq(i).attr('value');
                    jQuery('#billing_who_dep').val(valor);
                    jQuery('#billing_city').empty();
                    jQuery('#billing_postcode').empty();
                    var data = {
                        'action': 'jlg_get_dist_by_city',
                        'code': valor
                    }
                    jQuery.ajax({
                        type: 'POST',
                        url: woocommerce_params.ajax_url,
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            if (response) {
                                getItemsEvent(response, 'billing_city', 'jlg_get_prov', 'prov');                                
                                var dataDepartament = {
                                    'action': 'rt_ubigeo_load_provincias_front',
                                    'idDepa': id_departamento
                                }        
                                $.ajax({
                                    type: 'POST',
                                    url: ajaxUrl,
                                    data: dataDepartament,
                                    dataType: 'json',
                                    success: function (response) {
                                        if (response) {
                                            jQuery('#billing_provincia').append('<option value="">Seleccionar Provincia</option>');
                                            for (var r in response) {
                                                $('#billing_provincia').append('<option value=' + r + '>' + response[r] + '</option>');
                                            }
                                            for (let e=0;e<$provincia.find('option').length;e++){                            
                                                if (valueProvincia == $provincia.find('option').eq(e).text()) {
                                                    const id_provincia =  $provincia.find('option').eq(e).attr('value');
                                                    $provincia.val(id_provincia);
                                                    $provincia.closest('.woocommerce-input-wrapper').find('.select2-selection__placeholder').text(valueProvincia);
                                                    setTimeout(function(){
                                                        const whobilling_city = jQuery('#billing_city option');
                                                        for (let i=0;i<whobilling_city.length;i++) {
                                                            if (valueProvincia.toUpperCase().replace(/ /g, "") == whobilling_city.eq(i).text().toUpperCase().replace(/ /g, "")) {
                                                                const valor_city = whobilling_city.eq(i).attr('value');
                                                                jQuery('#billing_city').val(valor_city);
                                                                getItemsEvent(valor_city, 'billing_postcode', 'jlg_get_dist', 'dist');   
                                                            }
                                                        }
                                                    },800);
                                                    var dataProvincia = {
                                                        'action': 'rt_ubigeo_load_distritos_front',
                                                        'idProv': id_provincia
                                                    }                            
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: ajaxUrl,
                                                        data: dataProvincia,
                                                        dataType: 'json',
                                                        success: function (response) {
                                                            if (response) {
                                                                jQuery('#billing_distrito').append('<option value="">Seleccionar Distrito</option>');
                                                                for (var r in response) {
                                                                    $('#billing_distrito').append('<option value=' + r + '>' + response[r] + '</option>')
                                                                }
                                                                setTimeout(function(){
                                                                    for (let a=0;a<$distrito.find('option').length;a++){
                                                                        if (valueDistrito == $distrito.find('option').eq(a).text()) {
                                                                            const id_distrito =  $distrito.find('option').eq(a).attr('value');
                                                                            $distrito.val(id_distrito);
                                                                            $distrito.closest('.woocommerce-input-wrapper').find('.select2-selection__placeholder').text(valueDistrito);
                                                                            setTimeout(function(){
                                                                                const whobilling_postcode = jQuery('#billing_postcode option');
                                                                                for (let i=0;i<whobilling_postcode.length;i++) {
                                                                                    if (valueDistrito.toUpperCase().replace(/ /g, "") == whobilling_postcode.eq(i).text().toUpperCase().replace(/ /g, "")) {                                                                                                                                                                                
                                                                                        const valor_state = whobilling_postcode.eq(i).attr('value');
                                                                                        jQuery('#billing_postcode').val(valor_state);
                                                                                        jQuery(document.body).trigger("update_checkout", {update_shipping_method: true});
                                                                                    }
                                                                                }
                                                                            },600);
                                                                        }
                                                                    }
                                                                },800);
                                                            }
                                                        }
                                                    });
                                                }
                                            } 
                                        }
                                    }
                                });
                            }
                        }
                    });
                }
            }
        }
    }
}

function cleanSelect() {
    const direccion = '';
    const numero = '';
    const piso = '';
    const interior = '';
    const referencia = '';
    const $departamento = $('#billing_departamento');
    const $provincia = $('#billing_provincia');
    const $distrito = $('#billing_distrito');
    editInput($('#billing_address_1_field'),direccion);       
    editInput($('#billing_numero_address_field'),numero);
    editInput($('#billing_piso_address_field'),piso);
    editInput($('#billing_interior_address_field'),interior);
    editInput($('#billing_referencia_address_field'),referencia);
    $departamento.val('');
    $provincia.val('');
    $distrito.val('');
    $departamento.closest('.woocommerce-input-wrapper').find('.select2-selection__placeholder').text('Seleccionar Departamento');
    $provincia.closest('.woocommerce-input-wrapper').find('.select2-selection__rendered').text('Seleccionar Provincia');
    $distrito.closest('.woocommerce-input-wrapper').find('.select2-selection__placeholder').text('Seleccionar Distrito');
}

function buttonsDirectionsFunctions() {
    $('.editDirection').on('click',function(){
        const $this = $(this);
        const departamento = $this.closest('li').attr('departamento');
        const provincia = $this.closest('li').attr('provincia');
        const distrito = $this.closest('li').attr('distrito');
        const direccion = $this.closest('li').attr('direccion');
        const numero = $this.closest('li').attr('numero');
        const piso = $this.closest('li').attr('piso');
        const interior = $this.closest('li').attr('interior');
        const referencia = $this.closest('li').attr('referencia');
        editInput($('#billing_address_1_field'),direccion);       
        editInput($('#billing_numero_address_field'),numero);
        editInput($('#billing_piso_address_field'),piso);
        editInput($('#billing_interior_address_field'),interior);
        editInput($('#billing_referencia_address_field'),referencia);

        //select2Changes
        editSelect(departamento, provincia, distrito);       
        $('.editDirection').closest('li').find('.selectDirection').removeClass('active');
        $this.closest('li').find('.selectDirection').addClass('active');
    });
    $('.selectDirection').on('click',function(){
        const $this = $(this);
        const departamento = $this.closest('li').attr('departamento');
        const provincia = $this.closest('li').attr('provincia');
        const distrito = $this.closest('li').attr('distrito');
        const direccion = $this.closest('li').attr('direccion');
        const numero = $this.closest('li').attr('numero');
        const piso = $this.closest('li').attr('piso');
        const interior = $this.closest('li').attr('interior');
        const referencia = $this.closest('li').attr('referencia');
        editInput($('#billing_address_1_field'),direccion);       
        editInput($('#billing_numero_address_field'),numero);
        editInput($('#billing_piso_address_field'),piso);
        editInput($('#billing_interior_address_field'),interior);
        editInput($('#billing_referencia_address_field'),referencia);
        editSelect(departamento, provincia, distrito);       
        $('.selectDirection').removeClass('active');
        $this.addClass('active');
    });
    //
    $('.btnNewDirection').on('click',function(){
        cleanSelect();
        $('.selectDirection').removeClass('active');
    });
    $('.deleteDirection').on('click', function(){
        const $this = $(this);
        const id = $this.closest('li').attr('data-id');
        $.ajax({
            type: "post",
            dataType: "json",
            url: ajaxUrl,
            data: {
                action: "update_delete_user",
                list_id: id,
                user_id: userId
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    text: 'La dirección se elimino con éxito',
                    confirmButtonText: 'Continuar',
                    confirmButtonColor: '#c41a2c'
                });                
                cleanSelect();
                getDirections();
            }
        });
    });

}

function getDirections() {
    const newTitle = 'O ingresa una nueva dirección de envío';
    $('.newDirectionPosible').remove();
    $.ajax({
        type: "post",
        dataType: "json",
        url: ajaxUrl,
        data: {
            action: "get_directions_user",
            user_id: userId,
        },
        success: function(response) {
            let directionOptions = '';
            for (let i=0;i<response.length;i++) {
                const directionItem =  `<li data-id="${i}" departamento="${response[i].departamento}"
                provincia="${response[i].provincia}"
                distrito="${response[i].distrito}"
                direccion="${response[i].direccion}"
                numero="${response[i].numero}"
                piso="${response[i].piso}"
                interior="${response[i].interior}"
                referencia="${response[i].referencia}"
                ><span><i class="selectDirection"></i> ${response[i].direccion}</span><div><a href="javascript:void" class="editDirection">Editar</a><a href="javascript:void" class="deleteDirection">Eliminar</a></div></li>`;
                directionOptions = directionOptions+directionItem;
            } 
            const templateDirection = `<div class="newDirectionPosible onlydelivery">
            <p>Selecciona la dirección de envío</p>
            <ul>${directionOptions}</ul>
            <a class="btn btnNewDirection" href="javascript:void(0)">Nueva dirección</a>
            </div>`;
            $(templateDirection).insertAfter('#billing_tipo_envio_field');
            $('#billing_heading_title_ingresadatos_field h3').text(newTitle);
            buttonsDirectionsFunctions();
        }
    }); 
}

function addLocales() {
    $.ajax({
        type: "post",
        dataType: "json",
        url: ajaxUrl,
        data: {
            action: "get_locales",            
        },
        success: function(response) {
            let directionOptions = '';
            for (let i=0;i<response.length;i++) {
                const directionItem =  `<li data-id="${i}" label="${response[i].label}"
                direccion="${response[i].direccion}"
                ><span><i class="selectDirectionNew"></i> ${response[i].label}</span>${response[i].direccion}</li>`;
                directionOptions = directionOptions+directionItem;
            } 
            const templateDirection = `<div class="newLocalesPosible onlyrecojo" style="display:none">
            <p>Locales</p>
            <ul>${directionOptions}</ul>
            </div>`;
            $(templateDirection).insertAfter('#billing_locales_recojo_field');
            $('.selectDirectionNew').on('click',function(){
                const $this = $(this);
                const label = $this.closest('li').attr('label');
                const direccion = $this.closest('li').attr('direccion');
                const text = label + ' ' + direccion;
                $('#billing_locales_recojo').val(text);
                $('.selectDirectionNew').removeClass('active');
                $this.addClass('active');
            });
        }
    }); 
}


if (statusUser === 'not-direction') {
    addButtonToReference();
} 

if (statusUser === 'have-direction') {
    getDirections();
    addButtonToReference();
}
addLocales();