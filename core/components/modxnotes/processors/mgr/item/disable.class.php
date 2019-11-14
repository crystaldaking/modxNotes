<?php

class modxNotesItemDisableProcessor extends modObjectProcessor
{
    public $objectType = 'modxNotesItem';
    public $classKey = 'modxNotesItem';
    public $languageTopics = ['modxNotes'];
    //public $permission = 'save';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $id = $this->getProperty('id');
        if (empty($id)) {
            return $this->failure($this->modx->lexicon('modxNotes_item_err_ns'));
        }
        
        /** @var modxNotesItem $object */
        if (!$object = $this->modx->getObject($this->classKey, $id)) {
            return $this->failure($this->modx->lexicon('modxNotes_item_err_nf'));
        }

        $object->set('active', false);
        $object->save();

        return $this->success();
    }

}

return 'modxNotesItemDisableProcessor';