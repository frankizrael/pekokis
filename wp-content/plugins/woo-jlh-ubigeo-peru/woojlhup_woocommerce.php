<?php
//add_filter( 'woocommerce_shipping_calculator_enable_country', '__return_false' );
//add_filter( 'woocommerce_shipping_calculator_enable_state', '__return_false' );
//add_filter( 'woocommerce_shipping_calculator_enable_city', '__return_false' );
add_filter( 'woocommerce_shipping_calculator_enable_postcode', '__return_true' );

// function WoojlhupClearCountry($states)
// {
//     //$states['PE'=> array();
//     //print_r($states['PE']);
//     return $states;
// }

//add_filter('woocommerce_states', 'WoojlhupClearCountry');

function WoojlhupCountryLocaleFields($locale_fields)
{
    $custom_locale_fields = array(
        'dpto' => '#billing_dpto_field, #shipping_dpto_field',
        'prov' => '#billing_prov_field, #shipping_prov_field',
        'dist' => '#billing_dist_field, #shipping_dist_field',
    );

    $locale_fields = array_merge($locale_fields, $custom_locale_fields);

    return $locale_fields;
}

//add_filter('woocommerce_country_locale_field_selectors', 'WoojlhupCountryLocaleFields');

function WoojlhupAddressFields($fields)
{
    $custom_fields = array(
        'dpto' => array(
            'hidden' => true,
            'required' => false,
        ),
        'prov' => array(
            'hidden' => true,
            'required' => false,
        ),
        'dist' => array(
            'hidden' => true,
            'required' => false,
        ),
    );

    $fields = array_merge($fields, $custom_fields);

    return $fields;
}

//add_filter('woocommerce_default_address_fields', 'WoojlhupAddressFields');

function WoojlhupLocale($locale)
{
    // $locale['PE']['dpto'=> array(
    //     'required' => true,
    //     'hidden' => false,
    // );

    // $locale['PE']['prov'=> array(
    //     'required' => true,
    //     'hidden' => false,
    // );

    // $locale['PE']['dist'=> array(
    //     'required' => true,
    //     'hidden' => false,
    // );

    // $locale['PE']['state'=> array(
    //     'required' => true,
    //     'hidden' => false,
    // );

    // $locale['PE']['city'=> array(
    //     'required' => true,
    //     'hidden' => false,
    // );

    // $locale['PE']['postcode'=> array(
    //     'required' => true,
    //     'hidden' => false,
    // );

    return $locale;
}

add_filter('woocommerce_get_country_locale', 'WoojlhupLocale');

function WoojlhupCheckoutFields($fields)
{
    //unset($fields['billing']['billing_state']);
    //unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['shipping_postcode']);
    
    $fields['billing']['billing_phone']['priority']= 34;
    $fields['billing']['billing_email']['priority']= 36;
    $fields['billing']['billing_address_1']['priority']= 74;
    $fields['billing']['billing_address_2']['priority']= 76;

    $fields['shipping']['shipping_phone']['priority']= 34;
    $fields['shipping']['shipping_email']['priority']= 36;
    $fields['shipping']['shipping_address_1']['priority']= 74;
    $fields['shipping']['shipping_address_2']['priority']= 76;
    //$fields['shipping']['billing_state']['priority'=> 45;
    // $fields['shipping']['billing_city']['priority'=> 67;
    // $fields['shipping']['billing_city']['billing_postcode'=> 69;

    // $fields['billing']['billing_state'=> [
    //     'type' => 'select',
    //     'label' => 'Departamento BILLING',
    //     'required' => false,
    //     'class' => array('form-row-wide'),
    //     'clear' => true,
    //     'options' => GetRecordsDptoSelect(),
    //     'priority' => 50
    // ];

    $fields['billing']['billing_who_dep'] = [
        'type' => 'select',
        'label' => 'Departamento',
        'required' => false,
        'class' => array('form-row-wide'),
        'clear' => true,
        'options' => [
            '' => 'Seleccionar Departamento',
            'CAL' => "Callao",
            'LMA' => "Lima Metropolitana",
            'AMA' => "Amazonas",
            'ANC' => "Ancash",
            'APU' => "Apurimac",
            'ARE' => "Arequipa",
            'AYA' => "Ayacucho",
            'CAJ' => "Cajamarca",
            'CUS' => "Cuzco",
            'HUV' => "Huancavelica",
            'HUC' => "Huanuco",
            'ICA' => "Ica",
            'JUN'=> "Junín",
            'LAL'=> "La libertad",
            'LAM'=> "Lambayeque",
            'LIM'=> "Lima",
            'LOR'=> "Loreto",
            'MDD'=> "Madre de Dios",
            'MOQ'=> "Moquegua",
            'PAS'=> "Cerro de Pasco",
            'PIU'=> "Pirua",
            'PUN'=> "Puno",
            'SAM'=> "San Martin de Porres",
            'TAC'=> "Tacna",
            'TUM'=> "Tumbes",
            'UCA'=> "Ucayali"
        ],
        'priority' => 97
    ];

    $fields['billing']['billing_city'] = [
        'type' => 'select',
        'label' => 'Provincia',
        'required' => false,
        'class' => array('form-row-wide'),
        'clear' => true,
        'options' => [
            '' => 'Seleccionar Provincia',
        ],
        'priority' => 98
    ];

    $fields['billing']['billing_postcode'] = [
        'type' => 'select',
        'label' => 'Distrito',
        'required' => false,
        'class' => array('form-row-wide'),
        'clear' => true,
        'options' => [
            '' => 'Seleccionar Distrito',
        ],
        'priority' => 98
    ];

    // $fields['shipping']['shipping_state'=> [
    //     'type' => 'select',
    //     'label' => 'Departamento SHIPPING',
    //     'required' => false,
    //     'class' => array('form-row-wide'),
    //     'clear' => true,
    //     'options' => GetRecordsDptoSelect(),
    //     'priority' => 65
    // ];

    $fields['shipping']['shipping_city'] = [
        'type' => 'select',
        'label' => 'Provincia',
        'required' => false,
        'class' => array('form-row-wide'),
        'clear' => true,
        'options' => [
            '' => 'Seleccionar Provincia',
        ],
        'priority' => 98
    ];

    $fields['shipping']['shipping_postcode'] = [
        'type' => 'select',
        'label' => 'Distrito',
        'required' => false,
        'class' => array('form-row-wide'),
        'clear' => true,
        'options' => [
            '' => 'Seleccionar Distrito',
        ],
        'priority' => 99
    ];
    //print_r($fields);
    return $fields;
}

add_filter('woocommerce_checkout_fields', 'WoojlhupCheckoutFields', 99);

function WoojlhupCheckoutOrderReview($post_data)
{
    $packages = WC()->cart->get_shipping_packages();
    foreach ($packages as $package_key => $package) {
        WC()->session->set('shipping_for_package_' . $package_key, false); // Or true
    }
}

add_action('woocommerce_checkout_update_order_review', 'WoojlhupCheckoutOrderReview', 10, 1);


function WoojlhupAdminOrderDataAfterShippingAddress($order)
{
    $ubigeo_shipping = GetNameUbigeoShipping($order->get_id(), 'value');
    if ($ubigeo_shipping) {
        echo '<div class="ubigeo_data_column">';
        echo '<h3>Shipping Ubigeo Perú</h3>';
        echo '<p><strong>' . __('Departamento') . ':</strong> ' . $ubigeo_shipping['dpto'] . '</p>';
        echo '<p><strong>' . __('Provincia') . ':</strong> ' . $ubigeo_shipping['prov'] . '</p>';
        echo '<p><strong>' . __('Distrito') . ':</strong> ' . $ubigeo_shipping['dist'] . '</p>';
        echo '</div>';
    }
}
//add_action( 'woocommerce_admin_order_data_after_shipping_address', 'WoojlhupAdminOrderDataAfterShippingAddress', 1 );


function WoojlhupAdminOrderDataAfterBillingAddress($order)
{
    $ubigeo_billing = GetNameUbigeoBilling($order->get_id(), 'value');
    if ($ubigeo_billing) {
        echo '<div class="ubigeo_data_column">';
        echo '<h3>Billing Ubigeo Perú</h3>';
        echo '<p><strong>' . __('Departamento') . ':</strong> ' . $ubigeo_billing['dpto'] . '</p>';
        echo '<p><strong>' . __('Provincia') . ':</strong> ' . $ubigeo_billing['prov'] . '</p>';
        echo '<p><strong>' . __('Distrito') . ':</strong> ' . $ubigeo_billing['dist'] . '</p>';
        echo '</div>';
    }
}
//add_action( 'woocommerce_admin_order_data_after_billing_address', 'WoojlhupAdminOrderDataAfterBillingAddress', 1 );

function WoojlhupLocalesShow($order) 
{
    echo '<section class="woocommerce-customer-details">';
    echo '<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">';
    $ubigeo = GetNameUbigeoBilling($order,'value');
    if ($ubigeo) {
        echo '<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address col-1">';
        echo '<h2 class="woocommerce-column__title">Billing Ubigeo Perú</h2>';
        echo '<p><strong>' . __('Departamento') . ':</strong> ' . $ubigeo['dpto'] . '</p>';
        echo '<p><strong>' . __('Provincia') . ':</strong> ' . $ubigeo['prov'] . '</p>';
        echo '<p><strong>' . __('Distrito') . ':</strong> ' . $ubigeo['dist'] . '</p>';
        echo '</div>';
    }

    $ubigeo_shipping = GetNameUbigeoShipping($order, 'value');
    if ($ubigeo_shipping) {
        echo '<div class="woocommerce-column woocommerce-column--2 woocommerce-column--billing-address col-1">';
        echo '<h2 class="woocommerce-column__title">Shipping Ubigeo Perú</h2>';
        echo '<p><strong>' . __('Departamento') . ':</strong> ' . $ubigeo_shipping['dpto'] . '</p>';
        echo '<p><strong>' . __('Provincia') . ':</strong> ' . $ubigeo_shipping['prov'] . '</p>';
        echo '<p><strong>' . __('Distrito') . ':</strong> ' . $ubigeo_shipping['dist'] . '</p>';
        echo '</div>';
    }
    echo '</section>';
    echo '</section>';
}
//add_action( 'woocommerce_thankyou', 'WoojlhupLocalesShow', 20 );
//add_action( 'woocommerce_view_order', 'WoojlhupLocalesShow', 20 );

function WoojlhupLocalesShowEmail($orden, $sent_to_admin, $order) 
{
    $ubigeo = GetNameUbigeoBilling($order,'object');
    echo '<h2 class="woocommerce-order-details__title">Ubigeo Perú</h2>';
    echo '<p><strong>' . __('Departamento') . ':</strong> ' . $ubigeo['dpto'] . '</p>';
    echo '<p><strong>' . __('Provincia') . ':</strong> ' . $ubigeo['prov'] . '</p>';
    echo '<p><strong>' . __('Distrito') . ':</strong> ' .$ubigeo['dist'] . '</p>';
}
//add_action( 'woocommerce_email_order_meta_fields', 'WoojlhupLocalesShowEmail', 10 , 3 );

function WoojlhupFieldsValidation($fields, $errors)
{
    if ('PE' === $fields['billing_country']) {
        if ('' === $fields['billing_dpto']) {
            $errors->add('required-field', apply_filters('woocommerce_checkout_required_field_notice', sprintf(__('%s is a required field.', 'woocommerce'), '<strong>' . esc_html('Billing Departamento') . '</strong>'), 'Billing Departamento'));
        }
        if ('' === $fields['billing_prov']) {
            $errors->add('required-field', apply_filters('woocommerce_checkout_required_field_notice', sprintf(__('%s is a required field.', 'woocommerce'), '<strong>' . esc_html('Billing Provincia') . '</strong>'), 'Billing Provincia'));
        }
        if ('' === $fields['billing_dist']) {
            $errors->add('required-field', apply_filters('woocommerce_checkout_required_field_notice', sprintf(__('%s is a required field.', 'woocommerce'), '<strong>' . esc_html('Billing Distrito') . '</strong>'), 'Billing Distrito'));
        }
    }

    if (1 == $fields['ship_to_different_address']) {
        if ('PE' === $fields['shipping_country']) {
            if ('' === $fields['shipping_dpto']) {
                $errors->add('required-field', apply_filters('woocommerce_checkout_required_field_notice', sprintf(__('%s is a required field.', 'woocommerce'), '<strong>' . esc_html('Shipping Departamento') . '</strong>'), 'Shipping Departamento'));
            }
            if ('' === $fields['shipping_prov']) {
                $errors->add('required-field', apply_filters('woocommerce_checkout_required_field_notice', sprintf(__('%s is a required field.', 'woocommerce'), '<strong>' . esc_html('Shipping Provincia') . '</strong>'), 'Shipping Provincia'));
            }
            if ('' === $fields['shipping_dist']) {
                $errors->add('required-field', apply_filters('woocommerce_checkout_required_field_notice', sprintf(__('%s is a required field.', 'woocommerce'), '<strong>' . esc_html('Shipping Distrito') . '</strong>'), 'Shipping Distrito'));
            }
        }
    }
}
//add_action('woocommerce_after_checkout_validation', 'WoojlhupFieldsValidation', 999, 2);

function WoojlhupCheckoutForm()
{
    wp_localize_script( 'jlhup', 'woojlhup', array( 'ajax_url' => admin_url('admin-ajax.php')) );
    wp_register_script('select2-js', plugins_url('assets/js/select2.min.js', __FILE__), array(), '4.0.1', true);
    wp_enqueue_script('select2-js');
    ?>
<script>
    jQuery(document).ready(function () {
        // jQuery("#billing_dpto").select2();
        // jQuery("#billing_prov").select2();
        // jQuery("#billing_dist").select2();
        // jQuery("#shipping_dpto").select2();
        // jQuery("#shipping_prov").select2();
        // jQuery("#shipping_dist").select2();

        jQuery(document).on('change','#billing_who_dep', function () {
            jQuery('#billing_city').empty();
            jQuery('#billing_postcode').empty();
            var data = {
                'action': 'jlg_get_dist_by_city',
                'code': jQuery(this).val()
            }
            jQuery.ajax({
                type: 'POST',
                url: woocommerce_params.ajax_url,
                data: data,
                dataType: 'json',
                beforeSend: function (xhr, settings) {
                    // jQuery('form.woocommerce-checkout').addClass('processing').block({
                    //     message: null,
                    //     overlayCSS: {
                    //         background: '#fff',
                    //         opacity: 0.6
                    //     }
                    // });

                },
                success: function (response) {
                    if (response) {
                        getItems(response, 'billing_city', 'jlg_get_prov', 'prov');
                    }
                },
                complete: function (xhr, ts) {
                    //jQuery('form.woocommerce-checkout').removeClass('processing').unblock()
                }
            });
        });
        jQuery(document).on('change','#billing_city', function () {
            jQuery('#billing_postcode').empty();
            getItems(jQuery('#billing_city').val(), 'billing_postcode', 'jlg_get_dist', 'dist');
        });
        jQuery(document).on('change','#billing_postcode', function () {
            jQuery(document.body).trigger("update_checkout", {update_shipping_method: true});
        });

        jQuery(document).on('change','#shipping_state', function () {
            jQuery('#shipping_city').empty();
            jQuery('#shipping_postcode').empty();
            var data = {
                'action': 'jlg_get_dist_by_city',
                'code': jQuery(this).val()
            }
            jQuery.ajax({
                type: 'POST',
                url: woocommerce_params.ajax_url,
                data: data,
                dataType: 'json',
                beforeSend: function (xhr, settings) {
                    // jQuery('form.woocommerce-checkout').addClass('processing').block({
                    //     message: null,
                    //     overlayCSS: {
                    //         background: '#fff',
                    //         opacity: 0.6
                    //     }
                    // });
                },
                success: function (response) {
                    if (response) {
                        getItems(response, 'shipping_city', 'jlg_get_prov', 'prov');
                    }
                },
                complete: function (xhr, ts) {
                    //jQuery('form.woocommerce-checkout').removeClass('processing').unblock()
                }
            });
        });
        jQuery(document).on('change','#shipping_city', function () {
            jQuery('#shipping_postcode').empty();
            getItems(jQuery('#shipping_city').val(), 'shipping_postcode', 'jlg_get_dist', 'dist');
        });
        jQuery(document).on('change','#shipping_postcode', function () {
            jQuery(document.body).trigger("update_checkout", {update_shipping_method: true});
        });
    });

    function getItems(codeItem, selectType, actionType, itemType) {
        var data = {
            'action': actionType,
            'code': codeItem
        }

        jQuery.ajax({
            type: 'POST',
            url: woocommerce_params.ajax_url,
            data: data,
            dataType: 'json',
            beforeSend: function (xhr, settings) {
                /*jQuery('form.woocommerce-checkout').addClass('processing').block({
                    message: null,
                    overlayCSS: {
                        background: '#fff',
                        opacity: 0.6
                    }
                });*/
            },
            success: function (response) {
                if (response) {
                    
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
            },
            complete: function (xhr, ts) {
                /*jQuery('form.woocommerce-checkout').removeClass('processing').unblock()*/
            }
        })
    }
</script>
    <?php
}
add_action('woocommerce_after_checkout_form', 'WoojlhupCheckoutForm');

function WoojlhupAddScriptCart(){
    if ( function_exists( 'is_woocommerce' ) ) {
        if ( is_page( 'cart' ) || is_cart() ) {
            ?>
<style type="text/css">
    .addOpacity {
        opacity: 0.4 !important;
        pointer-events: none !important;
    }
</style>
<script>
    function getItems(select, idCode, selectType, actionType, itemType) {
        var data = {
            'action': actionType,
            'code': idCode
        }

        jQuery.ajax({
            type: 'POST',
            url: woocommerce_params.ajax_url,
            data: data,
            dataType: 'json',
            beforeSend: function (xhr, settings) {
                // jQuery('form.woocommerce-checkout').addClass('processing').block({
                //     message: null,
                //     overlayCSS: {
                //         background: '#fff',
                //         opacity: 0.6
                //     }
                // });
                /*jQuery('#calc_shipping_city_field').addClass('addOpacity');
                jQuery('#calc_shipping_postcode_field').addClass('addOpacity');*/
            },
            success: function (response) {
                if (response) {
                    
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
            },
            complete: function (xhr, ts) {
                jQuery('#calc_shipping_city_field').removeClass('addOpacity');
                jQuery('#calc_shipping_postcode_field').removeClass('addOpacity');
                //jQuery('form.woocommerce-checkout').removeClass('processing').unblock()
            }
        })
    }
    setTimeout(function(){
        if (jQuery('#calc_shipping_state').val()) {
            jQuery('#calc_shipping_state').trigger('change');
        }
        setTimeout(function(){
            if (jQuery('#calc_shipping_city').val()) {
                jQuery('#calc_shipping_city').trigger('change');
            }
        },1250);
    },100);
    


    jQuery(document).ready(function () {
        jQuery(document).on('change','#calc_shipping_state', function () {
            jQuery('#calc_shipping_city').empty();
            jQuery('#calc_shipping_postcode').empty();
            var data = {
                'action': 'jlg_get_dist_by_city',
                'code': jQuery(this).val()
            }
            jQuery.ajax({
                type: 'POST',
                url: woocommerce_params.ajax_url,
                data: data,
                dataType: 'json',
                beforeSend: function (xhr, settings) {
                    jQuery('#calc_shipping_city_field').addClass('addOpacity');
                    jQuery('#calc_shipping_postcode_field').addClass('addOpacity');
                    // jQuery('form.woocommerce-checkout').addClass('processing').block({
                    //     message: null,
                    //     overlayCSS: {
                    //         background: '#fff',
                    //         opacity: 0.6
                    //     }
                    // });
                },
                success: function (response) {
                    if (response) {
                        getItems(jQuery('#calc_shipping_state'), response, 'calc_shipping_city', 'jlg_get_prov', 'prov');
                    }
                },
                complete: function (xhr, ts) {
                    jQuery('#calc_shipping_city_field').removeClass('addOpacity');
                    jQuery('#calc_shipping_postcode_field').removeClass('addOpacity');
                    //jQuery('form.woocommerce-checkout').removeClass('processing').unblock()
                }
            })
        });
        jQuery(document).on('change','#calc_shipping_city', function () {
            jQuery('#calc_shipping_postcode').empty();
            jQuery('#calc_shipping_city_val').val(jQuery(this).val());
            getItems(jQuery(this), jQuery(this).val(), 'calc_shipping_postcode', 'jlg_get_dist', 'dist');
        });
        jQuery(document).on('change','#calc_shipping_postcode', function () {
            jQuery('#calc_shipping_postcode_val').val(jQuery(this).val());
        });
    });
</script>
            <?php
        }
    }
}
add_action('wp_footer', 'WoojlhupAddScriptCart');