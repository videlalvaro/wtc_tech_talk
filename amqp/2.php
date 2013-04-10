<?php

public function testQueueDeclare() {
    $expected = "\x00\x00\x03foo\x00\x00\x00\x00\x00";

    $args = $this->frameBuilder->queueDeclare('foo', false, false, false, false, false, array(), 0);

    $this->assertEquals($expected, $args->getvalue());
}