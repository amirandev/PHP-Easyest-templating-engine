<?php
class RenderView{
    
    public $template;
    public $template_dir;
    public $template_variables = [];
    public $layout;
    public $layout_dir;
    public $layout_variables = [];
    
    public function makeDirCorrect(string $path) {
        // Replace .php
        $path = str_replace('.php', '', $path);
        
        // Replace dots
        $path = str_replace('.', '/', $path);
        
        // Replace slashes at the begining and at the end
        $path = trim($path, '/');
        
        // Replace back-slashes at the begining and at the end
        $path = trim($path, '\\');
        
        // Add .php back to the file and return the path
        return $path.'.php';
    }
    
    public function render(string $templateName, array $passParams = []) {
        // Set template name
        $this->template = trim($templateName);
        
        // Set the template relative path
        $this->template_dir = VIEWS_DIR.'/'.$this->makeDirCorrect($templateName);
        
        // Keep variables array passed to the template
        $this->template_variables = array_filter($passParams);
        
        return $this;
    }
    
    public function extends($layout_name, array $passParams = []) {
        // Set layout name
        $this->layout = trim($layout_name);
        
        // Set layout relative path
        $this->layout_dir = VIEWS_DIR.'/'.$this->makeDirCorrect($layout_name);
        
        // Keep variables array passed to the layout
        $this->layout_variables = array_filter($passParams);
        
        return $this;
    }
    
    public function content(){
        if(count($this->template_variables)){
            // Extaract template variables if exist
            extract($this->template_variables);
        }

        include $this->template_dir;
    }
    
    public function run() {
        if(count($this->layout_variables)){
            // Extaract layout variables if exist
            extract($this->layout_variables);
        }
        
        if(strlen($this->layout)){
            include $this->layout_dir;
            return false;
        }
        
        $this->content();
    }
   
}

function view(string $template_name, array $arr = []){
    $render = new RenderView();
    return $render->render($template_name, $arr);
}