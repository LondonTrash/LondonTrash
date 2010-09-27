<?php

define('_ZONELOOKUP_LIB_PATH', str_replace('\\', '/', dirname(__FILE__)) . '/');

class ZoneLookup {
    protected static $_service_url = 'http://maps.googleapis.com/maps/api/geocode/json';
    protected static $_service_param_addy = 'address';
    
    public function __construct() {
        /* void */
    }
    
    public function get_latlng_by_address($address) {
        $address = trim($address);
        $gdata_url = $this->_build_url(array(self::$_service_param_addy => $address));
        
        $data = null;
        
        $data = file_get_contents($gdata_url);
        $data = json_decode($data);
        
        if( 'OK' == $data->status ) {
            return $data->results;
        }
        
        return false;
    }
    
    public function get_zone_by_latlng($lat, $lng) {
        $data_kml = simplexml_load_file(_ZONELOOKUP_LIB_PATH . 'ET_garbagezones.kml');
        $data_kml = isset($data_kml->Document->Folder->Placemark) ? $data_kml->Document->Folder->Placemark : false;
        
        if( $data_kml ) {
            $found = false;
            $zoneId = null;
            
            foreach( $data_kml as $poly ) {
                if( !isset($poly->Polygon->outerBoundaryIs->LinearRing->coordinates) ) {
                    continue;
                }
                
                $coords = $poly->Polygon->outerBoundaryIs->LinearRing->coordinates;
                $coords = explode('0 ', $coords);
                
                $coords = array_map(array($this, '_coord_cleanup'), $coords);
                $coords_size = count($coords);
                
                $i = 0;
                $j = $coords_size - 1;
                $is_point_in_poly = false;
                
                $lhs = $rhs = null;
                
                $rhs = $coords[$j];
                $rhs = explode(',', $rhs);
                $rhs = array_map('trim', $rhs);
                
                for( ; $i < $coords_size; ++$i ) {
                    $lhs = $coords[$i];
                    $lhs = explode(',', $lhs);
                    $lhs = array_map('trim', $lhs);
                    
                    /* if( !isset($lhs[0]) || !isset($lhs[1]) || !isset($rhs[0]) || !isset($rhs[1]) ) {
                        $rhs = $lhs;
                        continue;
                    } */
                    
                    if( $lhs[0] < $lng && $rhs[0] >= $lng || $rhs[0] < $lng && $lhs[0] >= $lng ) {
                        if( $lhs[1] + ($lng - $lhs[0]) / ($rhs[0] - $lhs[0]) * ($rhs[1] - $lhs[1]) < $lat ) {
                            $is_point_in_poly = !$is_point_in_poly;
                        }
                    }
                    
                    $rhs = $lhs;
                }
                
                if( $is_point_in_poly ) {
                    return $poly->name;
                }
            }
        }
        
        return false;
    }
    
    protected function _coord_cleanup($val) {
        $val = trim($val, ',');
        $val = trim($val);
        return $val;
    }
    
    final protected function _build_url(array $params) {
        $params['sensor'] = 'false';
        $params['region'] = 'London Ontario Canada';
        
        $url = self::$_service_url;
        $url .= '?' . http_build_query($params);
        
        return $url;
    }
}