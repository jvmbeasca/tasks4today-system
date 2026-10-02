<?php

$isEdit = $mode === 'edit';

$action = $isEdit
    ? site_url('users/' . $user['id'])
    : site_url('users');

?>

<section class="form-heading">
    <p class="eyebrow">
        <?= $isEdit ? 'Update record' : 'New record' ?>
    </p>

    <h1>
        <?= $isEdit ? 'Edit user' : 'Add user' ?>
    </h1>

    <p>Fields marked with an asterisk are required.</p>
</section>

<form
    class="form-card"
    action="<?= $action ?>"
    method="post"
    enctype="multipart/form-data"
>
    <?= csrf_field() ?>

    <div class="form-group">
        <label for="username">Username *</label>

        <input
            id="username"
            name="username"
            type="text"
            maxlength="50"
            value="<?= esc(old(
                'username',
                $user['username'] ?? ''
            )) ?>"
        >

        <?php if (validation_show_error('username')): ?>
            <small class="form-error">
                <?= validation_show_error('username') ?>
            </small>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="full_name">Full name *</label>

        <input
            id="full_name"
            name="full_name"
            type="text"
            maxlength="100"
            value="<?= esc(old(
                'full_name',
                $user['full_name'] ?? ''
            )) ?>"
        >

        <?php if (validation_show_error('full_name')): ?>
            <small class="form-error">
                <?= validation_show_error('full_name') ?>
            </small>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="avatar">Profile avatar</label>

        <input
            id="avatar"
            name="avatar"
            type="file"
            accept=".jpg,.jpeg,.png,.webp"
        >

        <small class="form-hint">
            Optional. JPG, PNG, or WEBP. Maximum size: 2 MB.
        </small>

        <?php if (validation_show_error('avatar')): ?>
            <small class="form-error">
                <?= validation_show_error('avatar') ?>
            </small>
        <?php endif; ?>
    </div>

    <?php if ($isEdit && ! empty($user['avatar'])): ?>
        <div class="form-group">
            <p>Current avatar:</p>

            <img
                class="avatar avatar-large"
                src="<?= base_url(
                    'uploads/avatars/' . $user['avatar']
                ) ?>"
                alt="Current user avatar"
            >
        </div>
    <?php endif; ?>

    <div class="form-actions">
        <button
            class="button button-primary"
            type="submit"
        >
            <?= $isEdit ? 'Save changes' : 'Create user' ?>
        </button>

        <a
            class="button button-light"
            href="<?= site_url('users') ?>"
        >
            Cancel
        </a>
    </div>
</form>