<?php

namespace ZCE\App;

class About
{

    public function authors()
    {
        $fields = array('Name', 'Hands on', 'Link', 'E-mail');
        $authors = array(
            array('Renato Mendes Figueiredo', 'First Developer', 'http://br.linkedin.com/in/renatomefidf' , 'zce-project@renatomefi.com.br'),
        );
        
        return array('fields' => $fields, 'authors' => $authors);
    }

}