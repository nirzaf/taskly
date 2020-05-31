<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('installer_messages.environment.classic.templateTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-code fa-fw" aria-hidden="true"></i> <?php echo e(trans('installer_messages.environment.classic.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <form method="post" action="<?php echo e(route('LaravelInstaller::environmentSaveClassic')); ?>">
        <?php echo csrf_field(); ?>

        <textarea class="textarea" name="envConfig"><?php echo e($envConfig); ?></textarea>
        <div class="buttons buttons--right">
            <button class="button button--light" type="submit">
            	<i class="fa fa-floppy-o fa-fw" aria-hidden="true"></i>
             	<?php echo trans('installer_messages.environment.classic.save'); ?>

            </button>
        </div>
    </form>

    <?php if( ! isset($environment['errors'])): ?>
        <div class="buttons-container">
            <a class="button float-left" href="<?php echo e(route('LaravelInstaller::environmentWizard')); ?>">
                <i class="fa fa-sliders fa-fw" aria-hidden="true"></i>
                <?php echo trans('installer_messages.environment.classic.back'); ?>

            </a>
            <a class="button float-right" href="<?php echo e(route('LaravelInstaller::database')); ?>">
                <i class="fa fa-check fa-fw" aria-hidden="true"></i>
                <?php echo trans('installer_messages.environment.classic.install'); ?>

                <i class="fa fa-angle-double-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\taskly\resources\views/vendor/installer/environment-classic.blade.php ENDPATH**/ ?>