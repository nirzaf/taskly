<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Taskly')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <!-- App css -->
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/css/components.css')); ?>" rel="stylesheet">
</head>
<body>

<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="<?php echo e(asset(Storage::url('logo/logo.png'))); ?>" alt="logo" width="100">
                    </div>
                    <?php if(session()->has('info')): ?>
                        <div class="alert alert-primary">
                            <?php echo e(session()->get('info')); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(session()->has('status')): ?>
                        <div class="alert alert-info">
                            <?php echo e(session()->get('status')); ?>

                        </div>
                    <?php endif; ?>
                    <?php echo $__env->yieldContent('content'); ?>
                    <div class="simple-footer">
                        Copyright &copy; <?php echo e(env('APP_NAME','Taskly')); ?> <?php echo e(date('Y')); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- General JS Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="<?php echo e(asset('assets/js/stisla.js')); ?>"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="<?php echo e(asset('assets/js/scrollreveal.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/scripts.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/custom.js')); ?>"></script>

<!-- Page Specific JS File -->
</body>
</html>
<?php /**PATH D:\xampp\htdocs\taskly\resources\views/layouts/auth.blade.php ENDPATH**/ ?>