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
class GameCardTypeSearch extends \yii\base\Model{
    public $filter_cardtype;
    
    public function rules() {
        return [
            [['filter_cardtype'], 'safe']
        ];
    }
    public function search($params) {
        $gameQuery = Game::find()->joinWith(['card']);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$gameQuery
        ]);
        $model['GameCardTypeSearch']['filter_cardtype'] = $params['filter_cardtype'];
        if(!$this->load($model) && $this->validate())
        {
            return $dataProvider;
        }
        $gameQuery->andFilterWhere(['LIKE', 'card.card_type', $this->filter_cardtype]);
        return $dataProvider;
        
        
    }
}
