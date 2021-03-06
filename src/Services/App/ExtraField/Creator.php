<?php

namespace Betalabs\LaravelHelper\Services\App\ExtraField;

use Betalabs\LaravelHelper\Events\ExtraFieldAndFormCreated;
use Betalabs\LaravelHelper\Services\Engine\ExtraFieldType\Indexer as ExtraFieldTypeIndexer;
use Betalabs\LaravelHelper\Services\Engine\Channel\Indexer as ChannelIndexer;
use Betalabs\LaravelHelper\Services\Engine\Entity\Indexer as EntityIndexer;
use Betalabs\LaravelHelper\Services\Engine\Form\Indexer as FormIndexer;
use Betalabs\LaravelHelper\Services\Engine\Form\Creator as FormCreator;
use Betalabs\LaravelHelper\Services\Engine\ExtraField\Indexer as ExtraFieldIndexer;
use Betalabs\LaravelHelper\Services\Engine\ExtraField\Creator as ExtraFieldCreator;
use Betalabs\LaravelHelper\Services\Engine\FieldMap\Creator as FieldMapCreator;
use Betalabs\LaravelHelper\Services\Engine\FormExtraField\Creator as FormExtraFieldCreator;
use Betalabs\LaravelHelper\Services\Engine\FormExtraField\Indexer as FormExtraFieldIndexer;
use Illuminate\Support\Facades\Auth;


class Creator
{
    /**
     * @var string
     */
    protected $extraFieldType;
    /**
     * @var string
     */
    protected $extraFieldLabel;
    /**
     * @var string
     */
    protected $formName;
    /**
     * @var string
     */
    protected $entityIdentification;
    /**
     * @var string
     */
    protected $channel = 'ERP';
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\ExtraFieldType\Indexer
     */
    protected $extraFieldTypeIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Channel\Indexer
     */
    protected $channelIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Form\Indexer
     */
    protected $formIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Form\Creator
     */
    protected $formCreator;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\Entity\Indexer
     */
    protected $entityIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\ExtraField\Indexer
     */
    protected $extraFieldIndexer;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\ExtraField\Creator
     */
    protected $extraFieldCreator;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\FormExtraField\Creator
     */
    protected $formExtraFieldCreator;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\FormExtraField\Indexer
     */
    protected $formExtraFieldIndexer;
    /**
     * @var string
     */
    protected $fieldMapKey;
    /**
     * @var \Betalabs\LaravelHelper\Services\Engine\FieldMap\Creator
     */
    protected $fieldMapCreator;
    /**
     * @var int
     */
    protected $appRegistryId;
    /**
     * @var array
     */
    protected $options = [];
    /**
     * @var \Betalabs\LaravelHelper\Services\App\ExtraField\ExtraFieldFormFinder
     */
    private $extraFieldFormFinder;

    /**
     * Creator constructor.
     * @param \Betalabs\LaravelHelper\Services\Engine\ExtraFieldType\Indexer $extraFieldTypeIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\Channel\Indexer $channelIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\Entity\Indexer $entityIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\Form\Indexer $formIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\Form\Creator $formCreator
     * @param \Betalabs\LaravelHelper\Services\Engine\ExtraField\Indexer $extraFieldIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\ExtraField\Creator $extraFieldCreator
     * @param \Betalabs\LaravelHelper\Services\Engine\FormExtraField\Creator $formExtraFieldCreator
     * @param \Betalabs\LaravelHelper\Services\Engine\FormExtraField\Indexer $formExtraFieldIndexer
     * @param \Betalabs\LaravelHelper\Services\Engine\FieldMap\Creator $fieldMapCreator
     * @param \Betalabs\LaravelHelper\Services\App\ExtraField\ExtraFieldFormFinder $extraFieldFormFinder
     */
    public function __construct(
        ExtraFieldTypeIndexer $extraFieldTypeIndexer,
        ChannelIndexer $channelIndexer,
        EntityIndexer $entityIndexer,
        FormIndexer $formIndexer,
        FormCreator $formCreator,
        ExtraFieldIndexer $extraFieldIndexer,
        ExtraFieldCreator $extraFieldCreator,
        FormExtraFieldCreator $formExtraFieldCreator,
        FormExtraFieldIndexer $formExtraFieldIndexer,
        FieldMapCreator $fieldMapCreator,
        ExtraFieldFormFinder $extraFieldFormFinder
    ) {
        $this->extraFieldTypeIndexer = $extraFieldTypeIndexer;
        $this->channelIndexer = $channelIndexer;
        $this->entityIndexer = $entityIndexer;
        $this->formIndexer = $formIndexer;
        $this->formCreator = $formCreator;
        $this->extraFieldIndexer = $extraFieldIndexer;
        $this->extraFieldCreator = $extraFieldCreator;
        $this->formExtraFieldCreator = $formExtraFieldCreator;
        $this->formExtraFieldIndexer = $formExtraFieldIndexer;
        $this->fieldMapCreator = $fieldMapCreator;
        $this->extraFieldFormFinder = $extraFieldFormFinder;
    }


    /**
     * @param string $extraFieldType
     * @return Creator
     */
    public function setExtraFieldType(string $extraFieldType): Creator
    {
        $this->extraFieldType = $extraFieldType;
        return $this;
    }

    /**
     * @param string $extraFieldLabel
     * @return Creator
     */
    public function setExtraFieldLabel(string $extraFieldLabel): Creator
    {
        $this->extraFieldLabel = $extraFieldLabel;
        return $this;
    }

    /**
     * @param string $formName
     * @return Creator
     */
    public function setFormName(string $formName): Creator
    {
        $this->formName = $formName;
        return $this;
    }

    /**
     * @param string $entityIdentification
     * @return Creator
     */
    public function setEntityIdentification(string $entityIdentification): Creator
    {
        $this->entityIdentification = $entityIdentification;
        return $this;
    }

    /**
     * @param string $channel
     * @return Creator
     */
    public function setChannel(string $channel): Creator
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * @param string $fieldMapKey
     * @return Creator
     */
    public function setFieldMapKey(string $fieldMapKey): Creator
    {
        $this->fieldMapKey = $fieldMapKey;
        return $this;
    }

    /**
     * @param int $appRegistryId
     * @return Creator
     */
    public function setAppRegistryId(int $appRegistryId): Creator
    {
        $this->appRegistryId = $appRegistryId;
        return $this;
    }

    /**
     * @param array $options
     * @return Creator
     */
    public function setOptions(array $options): Creator
    {
        $this->options = $options;
        return $this;
    }

    /**
     * Create an extra field on Engine and associate it with a form and a field map
     */
    public function create()
    {
        $channelId = $this->getChannelId();
        $entityId = $this->getEntityId();

        $form = $this->createOrGetForm(
            $entityId,
            [$channelId]
        );
        $extraFieldTypeId = $this->getExtraFieldTypeId($this->extraFieldType);
        $extraField = $this->createOrGetExtraField($entityId, $extraFieldTypeId, $form);
        $formExtraField = $this->createOrGetFormExtraField($form->id, $extraField->id);
        $this->createFieldMap($formExtraField->id, $entityId);
    }

    /**
     * @param $type
     * @return mixed
     */
    protected function getExtraFieldTypeId($type)
    {
        return $this->extraFieldTypeIndexer
            ->setQuery(compact('type'))
            ->index()
            ->first()
            ->id;
    }

    /**
     * @return mixed
     */
    protected function getChannelId()
    {
        return $this->channelIndexer
            ->setQuery(['channel' => $this->channel])
            ->index()
            ->first()
            ->id;
    }

    /**
     * @return mixed
     */
    protected function getEntityId()
    {
        return $this->entityIndexer
            ->setQuery(['identification' => $this->entityIdentification])
            ->index()
            ->first()
            ->id;
    }

    /**
     * Create or get form
     *
     * @param int $entityId
     * @param array $channels
     * @return mixed
     */
    protected function createOrGetForm(
        int $entityId,
        array $channels
    ) {
        $form = $this->formIndexer
            ->setQuery([
                'name' => $this->formName,
                'entity' => $this->entityIdentification,
                '_filter-approach' => 'and',
                '_with' => 'extra_fields'
            ])
            ->index()
            ->first();
        if(empty($form)) {
            $form = $this->formCreator->setName($this->formName)
                ->setEntityId($entityId)
                ->setChannels($channels)
                ->create();
        }
        return $form;
    }

    /**
     * Create or get Extra Field
     *
     * @param int $entityId
     * @param int $extraFieldTypeId
     * @param $form
     * @return mixed
     */
    protected function createOrGetExtraField(int $entityId, int $extraFieldTypeId, $form)
    {
        if($extraField = $this->extraFieldFormFinder->findByLabel($form, $this->extraFieldLabel)) {
            return $extraField;
        }

        $extraField = $this->extraFieldIndexer
            ->setQuery(["label" => $this->extraFieldLabel])
            ->index()
            ->first();

        if(empty($extraField)) {
            $extraField = $this->extraFieldCreator->setEntityId($entityId)
                ->setExtraFieldTypeId($extraFieldTypeId)
                ->setLabel($this->extraFieldLabel)
                ->setOptions($this->options)
                ->create();
        }

        return $extraField;
    }

    /**
     * Create or get Form Extra Field
     *
     * @param int $formId
     * @param int $extraFieldId
     * @return mixed
     */
    protected function createOrGetFormExtraField(int $formId, int $extraFieldId)
    {
        $formExtraField = $this->formExtraFieldIndexer
            ->setFormId($formId)
            ->setQuery(['extra_field_id' => $extraFieldId])
            ->index()
            ->last();

        if(empty($formExtraField)) {
            $formExtraField = $this->formExtraFieldCreator
                ->setFormId($formId)
                ->setExtraFieldId($extraFieldId)
                ->create();
        }

        return $formExtraField;
    }

    /**
     * Create Field Map
     *
     * @param int $formExtraFieldId
     * @param int $entityId
     */
    protected function createFieldMap(int $formExtraFieldId, int $entityId)
    {
        $this->fieldMapCreator
            ->setIdentification($this->fieldMapKey)
            ->setAppRegistryId($this->appRegistryId)
            ->setEntityId($entityId)
            ->setFormExtraFieldId($formExtraFieldId)
            ->create();
    }

}