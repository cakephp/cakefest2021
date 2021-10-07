<?php
namespace Notifications\Worker;

use Cake\Database\Connection;
use Cake\Datasource\ConnectionManager;
use Cake\Datasource\ModelAwareTrait;
use Cake\Error\Debugger;
use Cake\Log\Log;
use Cake\Mailer\MailerAwareTrait;
use Cake\Queue\Job\JobInterface;
use Cake\Queue\Job\Message;
use Cake\Queue\Queue\Processor;

class VirusNotificationWorker implements JobInterface
{
    use ModelAwareTrait;
    use MailerAwareTrait;

    public function execute(Message $message): ?string
    {
        try {
            $id = $message->getArgument('taggedId');
            Debugger::log($id);
            $tagged = $this->loadModel('Tagged')->get($id);
            $result = $this->getMailer('Notifications.Tags')->send('virus', [$tagged]);
            Log::info(json_encode($result));

            return Processor::ACK;
        } catch (\Exception $ex) {
            Debugger::log($ex);
            return Processor::REJECT;
        }
    }
}
