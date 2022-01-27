<?php

class Template extends BaseClass
{

    protected $engine;
    protected $used_class;

    /**
     * @fn __construct
     * @return Template
     */
    public function startTemplate(): Template
    {
        $this->engine = 'Smarty';

        switch ($this->engine) {
            case 'Smarty':
                $this->used_class = TemplateSmarty::getInstance()->startTemplate();
                break;
            case 'Plate':
                $this->used_class = TemplatePlate::getInstance()->startTemplate();
                break;
            default:
                die('TEMPLATE_ENGINE_NOT_EXIST');
                break;
        }

        return $this;
    }

    public function render($file_name, $data)
    {
        return $this->used_class->render($file_name, $data);
    }

    public function renderSelect($value_cell, $name_cell, $selected, $data)
    {
        return $this->used_class->renderSelect($value_cell, $name_cell, $selected, $data);
    }

    public function renderTable($body_file,$data){
        return $this->used_class->renderTable($body_file,$data);
    }

    public function addValues($container,$values){
        return $this->used_class->addValues($container,$values);
    }

    public function renderByTemplate(){
        $this->startTemplate();
        echo $this->used_class->renderByTemplate();
    }

    public function render404(){
        $this->startTemplate();
        echo $this->used_class->render404();
    }


}