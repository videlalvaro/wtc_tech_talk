<?php

public function queueDeclare($queue, $passive, $durable, $exclusive, $auto_delete, $nowait, $arguments, $ticket)
{
    $args = new AMQPWriter();

    $args->write_short($ticket)
        ->write_shortstr($queue)
        ->write_bit($passive)
        ->write_bit($durable)
        ->write_bit($exclusive)
        ->write_bit($auto_delete)
        ->write_bit($nowait)
        ->write_table($arguments);
    
    return $args; 
}