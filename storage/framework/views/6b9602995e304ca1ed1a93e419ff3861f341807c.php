<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('installer_messages.requirements.templateTitle')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
    <i class="fa fa-list-ul fa-fw" aria-hidden="true"></i>
    <?php echo e(trans('installer_messages.requirements.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('container'); ?>

    <?php $__currentLoopData = $requirements['requirements']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type => $requirement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <ul class="list">
            <li class="list__item list__title <?php echo e($phpSupportInfo['supported'] ? 'success' : 'error'); ?>">
                <strong><?php echo e(ucfirst($type)); ?></strong>
                <?php if($type == 'php'): ?>
                    <strong>
                        <small>
                            (version <?php echo e($phpSupportInfo['minimum']); ?> required)
                        </small>
                    </strong>
                    <span class="float-right">
                        <strong>
                            <?php echo e($phpSupportInfo['current']); ?>

                        </strong>
                        <i class="fa fa-fw fa-<?php echo e($phpSupportInfo['supported'] ? 'check-circle-o' : 'exclamation-circle'); ?> row-icon" aria-hidden="true"></i>
                    </span>
                <?php endif; ?>
            </li>
            <?php $__currentLoopData = $requirements['requirements'][$type]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extention => $enabled): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list__item <?php echo e($enabled ? 'success' : 'error'); ?>">
                    <?php echo e($extention); ?>

                    <i class="fa fa-fw fa-<?php echo e($enabled ? 'check-circle-o' : 'exclamation-circle'); ?> row-icon" aria-hidden="true"></i>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if( ! isset($requirements['errors']) && $phpSupportInfo['supported'] ): ?>
        <div class="buttons">
            <a class="button" href="<?php echo e(route('LaravelInstaller::permissions')); ?>">
                <?php echo e(trans('installer_messages.requirements.next')); ?>

                <i class="fa fa-angle-right fa-fw" aria-hidden="true"></i>
            </a>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('vendor.installer.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\taskly\resources\views/vendor/installer/requirements.blade.php ENDPATH**/ ?>