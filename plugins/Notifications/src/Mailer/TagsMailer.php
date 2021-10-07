<?php
declare(strict_types=1);

namespace Notifications\Mailer;

use App\Model\Entity\Tagged;
use Cake\Mailer\Mailer;

/**
 * Tags mailer.
 */
class TagsMailer extends Mailer
{
    /**
     * Mailer's name.
     *
     * @var string
     */
    public static $name = 'Tags';

    public function virus(Tagged $tagged): self
    {
        $file = $this->loadModel('Files')
            ->get($tagged->get('foreign_key'));
        $filePath = realpath(ROOT . DS . $file->get('path'));
        $this
            ->setTo('security@example.com')
            ->setSubject(__('File tagged as a virus: {0}', h($file->get('name'))))
            ->addAttachments([
                h($file->get('name')) => $filePath
            ])
            ->setEmailFormat('text')
            ->viewBuilder()
                ->setVars(compact('tagged', 'file'))
                ->setTemplate('Notifications.virus');

        return $this;
    }
}
