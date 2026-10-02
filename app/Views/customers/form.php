<?php

$isEdit = $mode === 'edit';

$action = $isEdit
    ? site_url('customers/' . $customer['id'])
    : site_url('customers');

?>

<section class="form-heading">
    <p class="eyebrow">
        <?= $isEdit ? 'Update record' : 'New record' ?>
    </p>

    <h1>
        <?= $isEdit ? 'Edit customer' : 'Add customer' ?>
    </h1>

    <p>
        Fields marked with an asterisk are required.
    </p>
</section>

<form
    class="form-card"
    action="<?= $action ?>"
    method="post"
    novalidate
>

    <?= csrf_field() ?>

    <div class="form-group">
        <label for="full_name">
            Full name *
        </label>

        <input
            id="full_name"
            name="full_name"
            type="text"
            maxlength="100"
            value="<?= esc(old(
                'full_name',
                $customer['full_name'] ?? ''
            )) ?>"
            class="<?= validation_show_error('full_name')
                ? 'invalid'
                : '' ?>"
        >

        <?php if (validation_show_error('full_name')): ?>

            <small class="form-error">
                <?= validation_show_error('full_name') ?>
            </small>

        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="email">
            Email address *
        </label>

        <input
            id="email"
            name="email"
            type="email"
            maxlength="100"
            value="<?= esc(old(
                'email',
                $customer['email'] ?? ''
            )) ?>"
            class="<?= validation_show_error('email')
                ? 'invalid'
                : '' ?>"
        >

        <?php if (validation_show_error('email')): ?>

            <small class="form-error">
                <?= validation_show_error('email') ?>
            </small>

        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="phone">
            Phone number
        </label>

        <input
            id="phone"
            name="phone"
            type="text"
            maxlength="20"
            value="<?= esc(old(
                'phone',
                $customer['phone'] ?? ''
            )) ?>"
        >

        <small class="form-hint">
            Optional, maximum of 20 characters.
        </small>
    </div>

    <div class="form-actions">

        <button
            class="button button-primary"
            type="submit"
        >
            <?= $isEdit
                ? 'Save changes'
                : 'Create customer' ?>
        </button>

        <a
            class="button button-light"
            href="<?= site_url('customers') ?>"
        >
            Cancel
        </a>

    </div>
</form>