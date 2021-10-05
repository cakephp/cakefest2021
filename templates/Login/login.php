<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', 'Metar Finder');
?>

<div class="sm:mx-auto sm:w-full sm:max-w-md">
    <img class="mx-auto h-12 w-auto" src="https://cleptric.com/cleptric-headset.png" alt="cleptric">
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Log in to your account
    </h2>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
        <?= $this->Flash->render() ?>
        <?= $this->Form->create(null, [
            'class' => 'space-y-6'
        ]) ?>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">
                    Email address
                </label>
                <?= $this->Form->control('email', [
                    'label' => false,
                    'placeholder' => 'jane.doe@example.com',
                    'class' => 'form-input w-full px-4 py-3 leading-4 border-gray-300 rounded-md placeholder-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500'
                ]) ?>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">
                    Password
                </label>
                <?= $this->Form->control('password', [
                    'label' => false,
                    'placeholder' => '········',
                    'class' => 'form-input w-full px-4 py-3 leading-4 border-gray-300 rounded-md placeholder-gray-400 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500'
                ]) ?>
            </div>

            <div>
                <button type="submit" class="btn w-full">
                    Login
                </button>
            </div>
        <?= $this->Form->end() ?>
    </div>
</div>