<?php

class modxNotesItemGetListProcessor extends modObjectGetListProcessor
{
    public $objectType = 'modxNotesItem';
    public $classKey = 'modxNotesItem';
    public $defaultSortField = 'rank';
    public $defaultSortDirection = 'ASC';
    //public $permission = 'list';


    /**
     * We do a special check of permissions
     * because our objects is not an instances of modAccessibleObject
     *
     * @return boolean|string
     */
    public function beforeQuery()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }

    public function prepareRow(xPDOObject $object)
    {
        /** @var modUser $userObj */
        $userObj = $object->getOne('User');
        $array = $object->toArray();
        $array['user'] = $userObj->username;
        return $array;
    }

}

return 'modxNotesItemGetListProcessor';