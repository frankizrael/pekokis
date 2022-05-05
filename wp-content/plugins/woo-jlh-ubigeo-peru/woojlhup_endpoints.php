<?php
function WoojlhupGetMapingDpto($code) {
    $dpto['CAL'] = "070000";
    $dpto['LMA'] = "150000";
    $dpto['AMA'] = "010000";
    $dpto['ANC'] = "020000";
    $dpto['APU'] = "030000";
    $dpto['ARE'] = "040000";
    $dpto['AYA'] = "050000";
    $dpto['CAJ'] = "060000";
    $dpto['CUS'] = "080000";
    $dpto['HUV'] = "090000";
    $dpto['HUC'] = "100000";
    $dpto['ICA'] = "110000";
    $dpto['JUN'] = "120000";
    $dpto['LAL'] = "130000";
    $dpto['LAM'] = "140000";
    $dpto['LIM'] = "150000";
    $dpto['LOR'] = "160000";
    $dpto['MDD'] = "170000";
    $dpto['MOQ'] = "180000";
    $dpto['PAS'] = "190000";
    $dpto['PIU'] = "200000";
    $dpto['PUN'] = "210000";
    $dpto['SAM'] = "220000";
    $dpto['TAC'] = "230000";
    $dpto['TUM'] = "240000";
    $dpto['UCA'] = "250000";

    return $dpto[$code];
}
/**
 * SHIPPING
 */
function GetNameUbigeoShipping($order, $type = 'object')
{
    if ($type == 'object') {
        $idDep = get_post_meta($order->id, '_billing_dpto');
        $prov = get_post_meta($order->id, '_billing_prov');
        $dist = get_post_meta($order->id, '_billing_dist');
    } else {
        $idDep = get_post_meta($order, '_shipping_dpto');
        $prov = get_post_meta($order, '_shipping_prov');
        $dist = get_post_meta($order, '_shipping_dist');
    }
    $ubigeo['dpto'] = GetRecordDptoByCode($idDep[0])['dpto'];
    $ubigeo['prov'] = GetRecordProvByCode($prov[0])['prov'];
    $ubigeo['dist'] = GetRecordDistByCode($dist[0])['dist'];
    
    return $ubigeo;
}
/**
 * BILLING
 */
function GetNameUbigeoBilling($order, $type = 'object')
{
    if ($type == 'object') {
        $idDep = get_post_meta($order->id, '_billing_dpto');
        $prov = get_post_meta($order->id, '_billing_prov');
        $dist = get_post_meta($order->id, '_billing_dist');
    } else {
        $idDep = get_post_meta($order, '_billing_dpto');
        $prov = get_post_meta($order, '_billing_prov');
        $dist = get_post_meta($order, '_billing_dist');
    }
    $ubigeo['dpto'] = GetRecordDptoByCode($idDep[0])['dpto'];
    $ubigeo['prov'] = GetRecordProvByCode($prov[0])['prov'];
    $ubigeo['dist'] = GetRecordDistByCode($dist[0])['dist'];
    
    return $ubigeo;
}

function WoojlhupFormateAddress($data) 
{
    $return = "";
    if(!empty($data['state'])) {
        $codeState = WoojlhupGetMapingDpto($data['state']);
        $_state = WoojlhupGetRecordByCode($codeState);
        $return .= $_state['dpto'] . ", ";
    }
    if(!empty($data['city'])) {
        $_state = WoojlhupGetRecordByCode($data['city']);
        $return .= $_state['prov'] . ", ";
    }
    if(!empty($data['postcode'])) {
        $_state = WoojlhupGetRecordByCode($data['postcode']);
        $return .= $_state['dist'];
    }
    return $return;
}

function WoojlhupGetRecordByCode($code)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jlg_ubigeo_peru";
    $request = "SELECT * FROM ". $table_name ." where code=" . $code;
    return $wpdb->get_row($request, ARRAY_A);
}
function GetRecordDptoByCode($code)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jlg_ubigeo_peru";
    $request = "SELECT dpto FROM ". $table_name ." where code=" . $code;
    return $wpdb->get_row($request, ARRAY_A);
}
function GetRecordProvByCode($code)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jlg_ubigeo_peru";
    $request = "SELECT prov FROM ". $table_name ." where code=" . $code;
    return $wpdb->get_row($request, ARRAY_A);
}
function GetRecordDistByCode($code)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jlg_ubigeo_peru";
    $request = "SELECT dist FROM ". $table_name ." where code=" . $code;
    return $wpdb->get_row($request, ARRAY_A);
}

function GetRecordsDptoSelect()
{
    $dptos = [
        '' => 'Seleccionar Departamento'
    ];

    $departamentoList = GetRecordsDpto();

    foreach ($departamentoList as $dpto) {
        $dptos[$dpto['code']] = $dpto['dpto'];
    }


    return $dptos;
}

function GetRecordsDpto(){
    global $wpdb;
    $table_name = $wpdb->prefix . "jlg_ubigeo_peru";
    $request = "SELECT * FROM $table_name WHERE dist IS NULL AND prov IS NULL";
    return $wpdb->get_results($request, ARRAY_A);
}

function GetRecordsProvs(){
    global $wpdb;
    $table_name = $wpdb->prefix . "jlg_ubigeo_peru";
    $request = "SELECT * FROM $table_name WHERE dist IS NULL AND prov IS NOT NULL";
    return $wpdb->get_results($request, ARRAY_A);
}

function GetRecordsProv($codeDpto){
    global $wpdb;
    $table_name = $wpdb->prefix . "jlg_ubigeo_peru";
    $request = "SELECT * FROM $table_name WHERE code LIKE '$codeDpto%' AND dist IS NULL AND prov IS NOT NULL";
    return $wpdb->get_results($request, ARRAY_A);
}

function GetRecordsDist($codeDpto){
    global $wpdb;
    $table_name = $wpdb->prefix . "jlg_ubigeo_peru";
    $request = "SELECT * FROM $table_name WHERE code LIKE '$codeDpto%' AND dist IS NOT NULL AND prov IS NOT NULL";
    return $wpdb->get_results($request, ARRAY_A);
}

function AjaxGetDpto()
{
    $response = GetRecordsDpto();
    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_jlg_get_dpto', 'AjaxGetDpto');
add_action('wp_ajax_nopriv_jlg_get_dpto', 'AjaxGetDpto');

function AjaxGetDptoByMap()
{
    $codeDpto = isset($_POST['code']) ? $_POST['code'] : $_GET['code'];
    echo json_encode(WoojlhupGetMapingDpto($codeDpto));
    wp_die();
}

add_action('wp_ajax_jlg_get_dist_by_city', 'AjaxGetDptoByMap');
add_action('wp_ajax_nopriv_jlg_get_dist_by_city', 'AjaxGetDptoByMap');

function AjaxGetProv()
{
    $codeDpto = isset($_POST['code']) ? $_POST['code'] : $_GET['code'];
    $response = [];
    if (is_numeric($codeDpto)) {
        $codeDpto = substr($codeDpto, 0, 2);// . 00;
        $result = GetRecordsProv($codeDpto);
        $response[] = $result;
        foreach ($result as $prov) { //aqui pondre los costos y un value para que seleccione el otro select
            $response[] = $prov;
        }
    }
    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_jlg_get_prov', 'AjaxGetProv');
add_action('wp_ajax_nopriv_jlg_get_prov', 'AjaxGetProv');

function AjaxGetDist()
{
    $codeProv = isset($_POST['code']) ? $_POST['code'] : $_GET['code'];
    $response = [];
    if (is_numeric($codeProv)) {
        $codeProv = substr($codeProv, 0, 4);
        $result = GetRecordsDist($codeProv);
        $response[] = $result;
        foreach ($result as $dist) { //aqui pondre los costos y un value para que seleccione el otro select
            $response[] = $dist;
        }
    }
    echo json_encode($response);
    wp_die();
}

add_action('wp_ajax_jlg_get_dist', 'AjaxGetDist');
add_action('wp_ajax_nopriv_jlg_get_dist', 'AjaxGetDist');