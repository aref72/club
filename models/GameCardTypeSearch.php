<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of GameCardTypeSearch
 *
 * @author asus
 */
class GameCardTypeSearch extends Game{
    public $filter_cardtype;
    
    public function search($params) {
        $gameQuery = static::find();
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$gameQuery
        ]);
        return $dataProvider;
        
        
    }
}
