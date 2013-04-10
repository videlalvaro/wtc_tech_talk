<?php

public function queue_declare($queue="", $passive=false, $durable=false,
                              $exclusive=false, $auto_delete=true, $nowait=false,
                              $arguments=NULL, $ticket=NULL)
{
    if($arguments == NULL)
        $arguments = array();
    
    $args = new AMQPWriter();
    
    if($ticket != NULL) # 1
        $args->write_short($ticket); 
    else
        $args->write_short($this->default_ticket);
    
    $args->write_shortstr($queue); 
    $args->write_bit($passive); 
    $args->write_bit($durable); 
    $args->write_bit($exclusive); 
    $args->write_bit($auto_delete); 
    $args->write_bit($nowait); 
    $args->write_table($arguments); 
    
    $this->send_method_frame(array(50, 10), $args);
    
    if(!$nowait)
        return $this->wait(array("50,11")); // Channel.queue_declare_ok
}
                                