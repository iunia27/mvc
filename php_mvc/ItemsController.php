<?php

class ItemsController extends ActionController{
    
    function view($id=null,$name=null){
        $this->set('title',$name . ' - My Todo List');
        $this->set('todo',$this->Item->select($id));
    }
    
    function viewAll(){
        $this->set('title', 'All items');
        $this->set('todo',$this->Item->selectAll());
    }
    
}

?>