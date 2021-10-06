<?php
declare(strict_types=1);

namespace Notifications;

use App\Model\Entity\Tagged;
use App\Model\Table\TaggedTable;
use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Datasource\ModelAwareTrait;
use Cake\Event\Event;
use Cake\Http\MiddlewareQueue;
use Cake\Mailer\MailerAwareTrait;
use Cake\Routing\RouteBuilder;

/**
 * Plugin for Notifications
 */
class Plugin extends BasePlugin
{
    use ModelAwareTrait;
    use MailerAwareTrait;

    /**
     * Load all the plugin configuration and bootstrap logic.
     *
     * The host application is provided as an argument. This allows you to load
     * additional plugin dependencies, or attach events.
     *
     * @param \Cake\Core\PluginApplicationInterface $app The host application
     * @return void
     */
    public function bootstrap(PluginApplicationInterface $app): void
    {
        $this->setupListeners();
    }

    /**
     * Add routes for the plugin.
     *
     * If your plugin has many routes and you would like to isolate them into a separate file,
     * you can create `$plugin/config/routes.php` and delete this method.
     *
     * @param \Cake\Routing\RouteBuilder $routes The route builder to update.
     * @return void
     */
    public function routes(RouteBuilder $routes): void
    {
        $routes->plugin(
            'Notifications',
            ['path' => '/notifications'],
            function (RouteBuilder $builder) {
                // Add custom routes here

                $builder->fallbacks();
            }
        );
        parent::routes($routes);
    }

    /**
     * Add middleware for the plugin.
     *
     * @param \Cake\Http\MiddlewareQueue $middleware The middleware queue to update.
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware(MiddlewareQueue $middlewareQueue): MiddlewareQueue
    {
        // Add your middlewares here

        return $middlewareQueue;
    }

    protected function setupListeners(): void
    {
        /**
         * EventManager: TaggedTable
         * Name: Model.afterSave
         * When: ^
         * What: Send an email to admin when virus tag added to a file
         * @see \App\Model\Table\TaggedTable
         * @see \Notifications\Mailer\TagsMailer::virus
         */
        /**
         * @var TaggedTable $taggedTable
         */
        $taggedTable = $this->loadModel('Tagged');
        $taggedTable
            ->getEventManager()
            ->on('Model.afterSave', [
                'priority' => 100
            ], function (Event $event, Tagged $tagged) use ($taggedTable) {
                if ($tagged->get('table_alias') !== 'Files') {
                    return;
                }
                if (!$tagged->tag) {
                    $taggedTable->loadInto($tagged, ['Tags']);
                }
                if ($tagged?->tag?->name !== 'virus') {
                    return;
                }

                $this->getMailer('Notifications.Tags')->send('virus', [$tagged]);
            });
    }
}
