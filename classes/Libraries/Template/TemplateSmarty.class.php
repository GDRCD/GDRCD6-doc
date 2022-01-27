<?php

class TemplateSmarty extends Template
{
    private $smarty;

    public function startTemplate(): TemplateSmarty
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(__DIR__.'/../../../docs/templates');
        $this->smarty->setConfigDir(__DIR__.'/../../../docs/config');
        $this->smarty->setCompileDir(__DIR__.'/../../../docs/compiled');
        $this->smarty->setCacheDir(__DIR__.'/../../../docs/cache');
        return $this;
    }

    public function render($file_name,$data): string
    {
        $this->smarty->assign('file_name',$file_name);
        foreach ($data as $index => $value){
            $this->smarty->assign($index, $value);
        }

        return $this->smarty->fetch('index.tpl');
    }

    public function addValues($container, $values){

        $old_val = $this->smarty->getTemplateVars($container);


        if(!is_array($old_val) && !empty($old_val)){
            $old_val = [$old_val];
        }

        $old_val[] = $values;

        $this->smarty->assign($container,$old_val);
    }

    public function renderSelect($value_cell,$name_cell,$selected,$data): string
    {
        return $this->render('select',['options'=>$data,'value_cell'=>$value_cell,'name_cell'=>$name_cell,'selected_value'=>$selected]);
    }

    public function renderTable($body_file,$data): string
    {
        $this->smarty->assign('body',$body_file);
        return $this->render('table-content',$data);
    }

    public function renderByTemplate(){
        $router = new Bramus\Router\Router();
        $uri = $router->getCurrentUri();
        $data = func_get_args();

        $template_data = DB::query("SELECT template FROM paths_template WHERE uri ='{$uri}' LIMIT 1");

        if(!empty($template_data)) {
            $template = Filters::out($template_data['template']);

            return $this->render($template, $data);
        } else{
            return $this->render404();
        }
    }

    public function render404(){
        return $this->render('404',['test'=>'1']);
    }

}