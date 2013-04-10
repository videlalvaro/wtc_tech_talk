<?php

public function queue_declare($queue="", $passive=false, $durable=false,
                              $exclusive=false, $auto_delete=true, $nowait=false,
                              $arguments=NULL, $ticket=NULL)
{
    $arguments = $this->getArguments($arguments);
    $ticket = $this->getTicket($ticket);
    
    $args = $this->frameBuilder->queueDeclare(
                        $queue, $passive, $durable, $exclusive, 
                        $auto_delete, $nowait, $arguments, $ticket
                    );
    
    $this->send_method_frame(array(50, 10), $args);
    
    if(!$nowait)
        return $this->wait(array("50,11")); // Channel.queue_declare_ok
}
                                