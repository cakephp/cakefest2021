<?php
echo $this->Form->create();
echo $this->Form->control('message');
echo \Middlewares\Honeypot::getHiddenField('request_id');
echo $this->Form->submit();
echo $this->Form->end();
