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
            [['card_number', 'catd_type', 'in_time', 'out_time', 'card_type', 'username', 'game_type'], 'safe']
        ];
    }
    /**
     * تابعی برای جستجو بازی ها
     * @param type $params
     * @return Array
     */
    public function search($params) {
        $array = [];
        $gameQuery = Game::find()->joinWith(['gameType', 'user', 'card.cardType']);
        
//        die(var_dump($gameQuery->createCommand()->rawSql));
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$gameQuery
        ]);
        
        $comulativeDataProvider = $this->comulative($gameQuery);// مبلغ تجمعی بدون فیلتر
        
        if(!$this->load($params) && $this->validate())
        {
            $array = [
                'comulativeDataProvider' => $comulativeDataProvider,
                'dataProvider' => $dataProvider
                ];
            return $array;
        }
        
//        $gameQuery->addSelect([
//            '*',
//            'out_time' => 'DATE_FORMAT(out_time, "%Y %M %d")'
//        ]);
//        $date = explode('/', $this->out_time);
//        
//        $res = \Yii::$app->utility->jmktime('', '', '', $date[1], $date[2], $date[0], $mod = '');
//        die(var_dump($res));

        $gameQuery->andFilterWhere(['LIKE', 'card_number', $this->card_number])
                ->andFilterWhere(['LIKE', 'price', $this->price])
                ->andFilterWhere(['LIKE', 'in_time', $this->in_time])
                ->andFilterWhere(['LIKE', 'out_time', $this->out_time])
                ->andFilterWhere(['LIKE', 'game_type.name', $this->game_type])
                ->andFilterWhere(['LIKE', 'user.username', $this->username])
                ->andFilterWhere(['LIKE', 'card_type.name', $this->card_type]);
//        die(var_dump($gameQuery->createCommand()->rawSql));
        $array= [
            'comulativeDataProvider' => $this->comulative($gameQuery),//مبلغ تجمعی با فبلتر
            'dataProvider' => $dataProvider,
        ];
        return $array;
    }
    
    public function comulative(\yii\db\ActiveQuery $activeQuery) {
        $activeQuery = clone $activeQuery;
        $data = $activeQuery->select([
            'price' => 'SUM(price)'
        ]);
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $activeQuery,
        ]);
        return $dataProvider;
    }
}
