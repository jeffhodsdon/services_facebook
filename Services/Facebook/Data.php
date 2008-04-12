<?php

require_once 'Services/Facebook/Common.php';
require_once 'Services/Facebook/Exception.php';

class Services_Facebook_Data extends Services_Facebook_Common
{
    const _PROP_TYPE_INTEGER = 1;
    const _PROP_TYPE_STRING = 2;
    const _PROP_TYPE_BLOB = 3;

    protected $_prefix = 'data.';

    protected function sendRequest($method, array $args = array())
    {
        return parent::sendRequest($this->_prefix . $method, $args);
    }

    public function getUserPreference($pref_id) 
    {
        return $this->sendRequest('getUserPreference', array(
            'pref_id' => (int)$pref_id,
        ));
    }

    public function getUserPreferences()
    {
        return $this->sendRequest('getUserPreferences');
    }

    public function setUserPreference($pref_id, $value)
    {
        return $this->sendRequest(
            'setUserPreference',
            array(
                'pref_id' => $pref_id,
                'value' => $value,
            )
        );
    }

    public function setUserPreferences()
    {
        throw new Services_Facebook_Exception('not yet implemented');
    }

    public function createObjectType($name) {
        return $this->sendRequest(
            'createObjectType',
            array(
                'name' => $name,
            )
        );
    }

    public function dropObjectType($obj_type) {
        return $this->sendRequest(
            'dropObjectType',
            array(
                'obj_type' => $obj_type,
            )
        );
    }

    public function renameObjectType($obj_type, $new_name) {
        return $this->sendRequest(
            'renameObjectType',
            array(
                'obj_type' => $obj_type,
                'new_name' => $new_name,
            )
        );
    }

    public function defineObjectProperty($obj_type, $prop_name, $prop_type) {
        // todo refactor into its own testable object
        if (is_int($prop_type)) {
            if (!($prop_type >= 1 && $prop_type <= 3)) {
                throw new Services_Facebook_Exception('prop_type is an invalid integer: ' . $prop_type);
            }
        } else {
            $const_name = 'self::_PROP_TYPE_' . strtoupper($prop_type);
            var_dump($const_name);
            if (!defined($const_name)) {
                throw new Services_Facebook_Exception('prop_type is not a valid string: ' . $prop_type);
            }
            $prop_type = constant($const_name);
        }

        return $this->sendRequest(
            'defineObjectProperty',
            array(
                'obj_type' => $obj_type,
                'prop_name' => $prop_name,
                'prop_type' => $prop_type,
            )
        );
    }

    public function undefineObjectProperty($obj_type, $prop_name) {
        return $this->sendRequest(
            'undefineObjectProperty',
            array(
                'obj_type' => $obj_type,
                'prop_name' => $prop_name,
            )
        );
    }

    public function renameObjectProperty($obj_type, $prop_name, $new_name) {
        return $this->sendRequest(
            'renameObjectProperty',
            array(
                'obj_type' => $obj_type,
                'prop_name' => $prop_name,
                'new_name' => $new_name,
            )
        );
    }

    public function getObjectTypes() {
        return $this->sendRequest('getObjectTypes');
    }

    public function getObjectType($obj_type) {
        return $this->sendRequest(
            'getObjectType',
            array(
                'obj_type' => $obj_type,
            )
        );
    }

    public function createObject($obj_type, array $properties = array()) {
        $args = array(
            'obj_type' => $obj_type,
        );
        if (count($properties) > 0) {
            $args['properties'] = json_encode($properties);
        }

        return $this->sendRequest('createObject', $args);
    }

    public function updateObject($obj_id, array $properties, $replace) {
        return $this->sendRequest(
            'updateObject',
            array(
                'obj_id' => $obj_id,
                'properties' => json_encode($properties),
                'replace' => $replace ? 1 : 0,
            )
        );
    }

    public function deleteObject($obj_id) {
        return $this->sendRequest(
            'deleteObject',
            array(
                'obj_id' => $obj_id,
            )
        );
    }

    public function deleteObjects(array $obj_ids) {
        return $this->sendRequest(
            'deleteObjects',
            array(
                'obj_ids' => json_encode($obj_ids),
            )
        );
    }

    public function getObject($obj_id, array $properties = array()) {
        if (count($properties) > 0) {
            throw new Services_Facebook_Exception('filtering by property name doesnot seem to work...');
        }
        $args = array(
            'obj_id' => $obj_id,
        );
        if (count($properties) > 0) {
            $args['properties'] = json_encode($properties);
        }
        return $this->sendRequest('getObject', $args);
    }

    public function getObjects(array $obj_ids, array $properties = array()) {
        $args = array(
            'obj_ids' => json_encode($obj_ids),
        );
        if (count($properties) > 0) {
            $args['properties'] = json_encode($properties);
        }

        return $this->sendRequest('getObjects', $args);
    }

    public function getObjectProperty($obj_id, $prop_name) {
        return $this->sendRequest(
            'getObjectProperty',
            array(
                'obj_id' => $obj_id,
                'prop_name' => $prop_name,
            )
        );
    }

    public function setObjectProperty($obj_id, $prop_name, $prop_value) {
        return $this->sendRequest(
            'setObjectProperty',
            array(
                'obj_id' => $obj_id,
                'prop_name' => $prop_name,
                'prop_value' => $prop_value,
            )
        );
    }

    public function getHashValue() {
        throw new Services_Facebook_Exception(__METHOD__ . ' not yet implemented');
    }

    public function setHashValue() {
        throw new Services_Facebook_Exception(__METHOD__ . ' not yet implemented');
    }

    public function incHashValue() {
        throw new Services_Facebook_Exception(__METHOD__ . ' not yet implemented');
    }

    public function removeHashKey() {
        throw new Services_Facebook_Exception(__METHOD__ . ' not yet implemented');
    }

    public function removeHashKeys() {
        throw new Services_Facebook_Exception(__METHOD__ . ' not yet implemented');
    }
}

