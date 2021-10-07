<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Behavior;

use App\Model\Behavior\InvalidateUsersBehavior;
use Cake\ORM\Table;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Behavior\InvalidateUsersBehavior Test Case
 */
class InvalidateUsersBehaviorTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Behavior\InvalidateUsersBehavior
     */
    protected $InvalidateUsers;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $table = new Table();
        $this->InvalidateUsers = new InvalidateUsersBehavior($table);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->InvalidateUsers);

        parent::tearDown();
    }
}
