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
class GameSearch extends Game{
    public $card_type;
    public $username;
    public $game_type;
    public function rules() {
        return [
            [['card_number', 'catd_type', 'price', 'in_time', 'out_time', 'card_type', 'username', 'game_type'], 'safe']
        ];
    }
    public function search($params) {
        $gameQuery = Game::find()->joinWith(['gameType', 'user', 'card.cardType']);
        
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$gameQuery
        ]);
        if(!$this->load($params) && $this->validate())
        {
            return $dataProvider;
        }

        $gameQuery->andFilterWhere(['LIKE', 'card_number', $this->card_number])
                ->andFilterWhere(['LIKE', 'price', $this->price])
                ->andFilterWhere(['LIKE', 'in_time', $this->in_time])
                ->andFilterWhere(['LIKE', 'out_time', $this->out_time])
                ->andFilterWhere(['LIKE', 'game_type.name', $this->game_type])
                ->andFilterWhere(['LIKE', 'user.username', $this->username])
                ->andFilterWhere(['LIKE', 'card_type.name', $this->card_type]);
        return $dataProvider;
        
        
    }
}
