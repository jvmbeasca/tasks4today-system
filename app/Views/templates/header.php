<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= esc($title ?? 'POS System') ?> | Modern POS
    </title>

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/style.css') ?>"
    >
</head>

<body>

<header class="site-header">
    <div class="container navigation">

        <a class="brand" href="<?= site_url('/') ?>">
            <span class="brand-icon">M</span>

            <span>
                <strong>Modern POS</strong>
                <small>Account Management</small>
            </span>
        </a>

        <nav>
            <a href="<?= site_url('customers') ?>">
                Customers
            </a>

            <a href="<?= site_url('users') ?>">
                Users
            </a>
        </nav>

    </div>
</header>

<main class="container page-content">

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>