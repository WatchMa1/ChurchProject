<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $first_name
 * @property string|null $other_name
 * @property string $last_name
 * @property string $email
 * @property string $password_hash
 * @property string $auth
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $updated_by
 * @property int $role
 * @property int $status
 *
 * @property Address[] $addresses
 * @property Address[] $addresses0
 * @property Family[] $families
 * @property Family[] $families0
 * @property FamilyChildren[] $familyChildrens
 * @property FamilyChildren[] $familyChildrens0
 * @property FamilyOther[] $familyOthers
 * @property FamilyOther[] $familyOthers0
 * @property Member[] $members
 * @property Member[] $members0
 * @property MembershipStatus[] $membershipStatuses
 * @property MembershipStatus[] $membershipStatuses0
 * @property Role $role0
 * @property User $updatedBy
 * @property User[] $users
 * @property WorkPlace[] $workPlaces
 * @property WorkPlace[] $workPlaces0
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 8;
    const STATUS_ACTIVE = 9;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'status', 'role'], 'required'],
            [['created_at', 'updated_at', 'updated_by', 'role', 'status'], 'integer'],
            [['first_name', 'other_name', 'last_name', 'email', 'password_hash', 'auth'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['email'], 'unique'],
            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'other_name' => 'Other Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth' => 'Auth',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'role' => 'Role',
            'status' => 'Status'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * Gets query for [[Addresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Addresses0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses0()
    {
        return $this->hasMany(Address::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Families]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilies()
    {
        return $this->hasMany(Family::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Families0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilies0()
    {
        return $this->hasMany(Family::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[FamilyChildrens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyChildrens()
    {
        return $this->hasMany(FamilyChildren::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[FamilyChildrens0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyChildrens0()
    {
        return $this->hasMany(FamilyChildren::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[FamilyOthers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyOthers()
    {
        return $this->hasMany(FamilyOther::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[FamilyOthers0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilyOthers0()
    {
        return $this->hasMany(FamilyOther::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[Members]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Members0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembers0()
    {
        return $this->hasMany(Member::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[MembershipStatuses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipStatuses()
    {
        return $this->hasMany(MembershipStatus::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[MembershipStatuses0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershipStatuses0()
    {
        return $this->hasMany(MembershipStatus::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[RightAllocations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRightAllocations()
    {
        return $this->hasMany(RightAllocation::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[Role0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole0()
    {
        return $this->hasOne(Role::className(), ['id' => 'role']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['updated_by' => 'id']);
    }

    /**
     * Gets query for [[WorkPlaces]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkPlaces()
    {
        return $this->hasMany(WorkPlace::className(), ['created_by' => 'id']);
    }

    /**
     * Gets query for [[WorkPlaces0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWorkPlaces0()
    {
        return $this->hasMany(WorkPlace::className(), ['updated_by' => 'id']);
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey() {
        return $this->auth;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates "remember me" authentication key
     * @throws \yii\base\Exception
     */
    public function generateAuthKey() {
        $key = Yii::$app->getSecurity()->generateRandomString(32);

        if (!$this->findOne(['auth' => $key]))
            $this->auth = $key;
        else
            return $this->generateAuthKey();
    }

    public static function findByAuthkey($auth) {
        if (static::findOne(['auth' => $auth])) {
            return true;
        }
        return false;
    }
    public static function findById($id) {
        return static::findOne(['id' => $id]);
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public static function validatePassword($password) {
        return Yii::$app->getSecurity()->validatePassword($password . $this->auth, $this->password_hash);
    }
    
    public static function checkPassword($user, $password){
        if(Yii::$app->getSecurity()->validatePassword($password . $user->auth, $user->password_hash)){
            return true;
        }
        return false;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     * @throws \yii\base\Exception
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password.$this->auth);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId() {
        return $this->getPrimaryKey();
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getFullName()
    {
        return $this->first_name." ".$this->other_name." ".$this->last_name;
    }

    public static function findByEmail($email) {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    public static function userIsAllowedTo($right) {
        $session = Yii::$app->session;
        //$rights = explode(',', $session['rights']);
        if(isset($session['rights'])){
            if (in_array($right, $session['rights'])) {
                return true;
            }
            return false;
        }
            return false;
    }
    
     public static function getCurrentUserID(){
        $identity = Yii::$app->user->identity;
        $id = Yii::$app->user->id;
        
        return $id;
    }
}
