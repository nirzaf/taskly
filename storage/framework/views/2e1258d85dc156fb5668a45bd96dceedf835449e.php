<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('installer_messages.environment.menu.templateTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-cog fa-fw" aria-hidden="true"></i>
    <?php echo trans('installer_messages.environment.menu.title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <p class="text-center">
        <?php echo trans('installer_messages.environment.menu.desc'); ?>

    </p>
    <div class="buttons">
        <a href="<?php echo e(route('LaravelInstaller::environmentWizard')); ?>" class="button button-wizard">
            <i class="fa fa-sliders fa-fw" aria-hidden="true"></i> <?php echo e(trans('installer_messages.environment.menu.wizard-button')); ?>

        </a>
        <a href="<?php echo e(route('LaravelInstaller::environmentClassic')); ?>" class="button button-classic">
            <i class="fa fa-code fa-fw" aria-hidden="true"></i> <?php echo e(trans('installer_messages.environment.menu.classic-button')); ?>

        </a>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\taskly\resources\views/vendor/installer/environment.blade.php ENDPATH**/ ?>