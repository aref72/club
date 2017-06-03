<?php
namespace app\modules\account\models;

use yii\data\ActiveDataProvider;
/**
 * Description of UserSearch
 *
 * @author Akbar Joudi <akbar.joody@gmail.com>
 */
class UserSearch extends User{
    public $roleName;
    public function rules() {
        return [
            [['username', 'id', 'status', 'created_at', 'updated_at', 'roleName'], 'safe']
        ];
    }
    
    public function search($params) {
        $activeQuery = User::find();
        
        $dataProvider = new ActiveDataProvider([
            'query' => $activeQuery,
        ]);
        if(!$this->load($params))
        {
            return $dataProvider;
        }
        $activeQuery->andFilterWhere(['LIKE', 'username', $this->username])
                ->andFilterWhere(['LIKE', 'id', $this->id])
                ->andFilterWhere(['LIKE', 'status', $this->status])
                ->andFilterWhere(['LIKE', 'created_at', $this->created_at])
                ->andFilterWhere(['LIKE', 'updated_at', $this->updated_at]);
        return $dataProvider;
    }
}
