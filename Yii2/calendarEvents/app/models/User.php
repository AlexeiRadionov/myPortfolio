<?php
    namespace app\models;

    use yii\db\ActiveRecord;
    use Yii;

    class User extends ActiveRecord implements \yii\web\IdentityInterface {

        public $password;

        /**
         * {@inheritdoc}
         */
        public static function findIdentity($id) {
            return static::findOne(['id_user' => $id]);
        }

        /**
         * {@inheritdoc}
         */
        public static function findIdentityByAccessToken($token, $type = null) {

            return null;
        }

        /**
         * Finds user by username
         *
         * @param string $username
         * @return static|null
         */
        public static function findByUsername($username) {

            return static::find() -> where(['username' => $username]) -> one();
        }

        /**
         * {@inheritdoc}
         */
        public function getId() {
            return $this->getPrimaryKey();
        }

        /**
         * {@inheritdoc}
         */
        public function getAuthKey() {
            return $this->auth_key;
        }

        /**
         * {@inheritdoc}
         */
        public function validateAuthKey($authKey) {
            return $this->getAuthKey() === $authKey;
        }

        /**
         * Validates password
         *
         * @param string $password password to validate
         * @return bool if password provided is valid for current user
         */
        public function validatePassword($password) {
            return Yii::$app -> security -> validatePassword($password, $this -> password_hash);
        }

        public function setPassword($password) {
            $this -> password_hash = Yii::$app -> security -> generatePasswordHash($password);
        }

        public function generateAuthKey() {
            $this->auth_key = Yii::$app -> security -> generateRandomString();
        }

        public function createUser($user) {
            $db = Yii::$app -> db;
            
            if ($this -> findByUsername($user -> username)) {
                $result = 0;

                return $result > 0;
            } else {
                $this -> setPassword($user -> password);
                $this -> generateAuthKey();

                $result = $db -> createCommand() -> insert('user', [
                    'username' => $user -> username,
                    'email' => $user -> email,
                    'password_hash' => $this -> password_hash,
                    'auth_key' => $this->auth_key
                ]) -> execute();   
            }

            $id = User::find() -> select('id_user') -> where(['username' => $user -> username]) -> asArray() ->all();
            $id_user = (int)$id[0]['id_user'];
            
            if ($this -> addAssign('simple', $id_user)) {
                return $result > 0;
            }
        }

        public function rules() {
            return [
                [['username', 'password', 'email'], 'required'],
            ];
        }

        public function addAssign($role, $userId) {
            $authManager = Yii::$app -> authManager;
            $modelRole = $authManager -> getRole($role);
            
            if(is_null($modelRole)) {
                $result = 0;
                return $result > 0;
            }
            
            $authManager -> assign($modelRole, $userId);
            $result = 1;
            return $result > 0;
        }
    }
?>