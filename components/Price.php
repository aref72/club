<?php
namespace app\components;

use yii\base\Component;
/**
 * Description of Price
 *
 * @author asus
 */
class Price extends Component{
    /**
     * XBOX
     * قیمت یک نفره
     */
    const XBOX_SINGLE_ONEHOUR=3000;
    
    /**
     * XBOX
     * قیمت دونفره
     */
    const XBOX_DUBLES_ONEHOUR=5000;
    
    /**
     * XBOX
     *  قیمت سه نفره
     */
    const XBOX_THREE_HANDED_ONEHOUR=6000;
       
    /**
     * XBOX
     * قیمت چهارنفره
     */
    const XBOX_FOUR_ONEHOUR=7000;
    
    
    //-------------------PS4--------------------//
    /**
     * PS4
     * قیمت یک نفره
     */
    const PS4_SINGLE_ONEHOUR=5000;
    
    /**
     * PS4
     * قیمت دونفره
     */
    const PS4_DUBLES_ONEHOUR=8000;
    
    /**
     * PS4
     *  قیمت سه نفره
     */
    const PS4_THREE_HANDED_ONEHOUR=9000;
    
    /**
     * PS4
     * قیمت چهارنفره
     */
    const PS4_FOUR_ONEHOUR=10000;
    
    //----------fotball-----------------//
    
    
    
    public function cumputeByPrice($in_time, $out_time) {
        
    }
    
    
    public function cumputeByTime($price)
    {
        
    }
    
}
