<?php $__env->startSection('content'); ?>
    <div class="card card-primary">
    <!-- title-->
        <div class="card-header"><h4><?php echo e(__('Free Sign Up')); ?></h4></div>

        <div class="card-body">
            <p class="text-muted"> <?php echo e(__('Don\'t have an account? Create your account, it takes less than a minute')); ?></p>
            <!-- form -->
            <form method="POST" action="<?php echo e(route('register')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="fullname"><?php echo e(__('Full Name')); ?></label>
                    <input class="form-control <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="name" type="text" id="fullname" placeholder="<?php echo e(__('Enter Your Name')); ?>" value="<?php echo e(old('name')); ?>" required autocomplete="name">
                    <?php if ($errors->has('name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('name'); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
                <div class="form-group">
                    <label for="workspace_name"><?php echo e(__('Workspace Name')); ?></label>
                    <input class="form-control <?php if ($errors->has('workspace_name')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('workspace_name'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="workspace" type="text" id="workspace_name" placeholder="<?php echo e(__('Enter Workspace Name')); ?>" value="<?php echo e(old('workspace')); ?>" required autocomplete="workspace">
                    <?php if ($errors->has('company')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('company'); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
                <div class="form-group">
                    <label for="emailaddress"><?php echo e(__('Email Address')); ?></label>
                    <input class="form-control <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="email" type="email" id="emailaddress" required autocomplete="email" placeholder="<?php echo e(__('Enter Your Email')); ?>" value="<?php echo e(old('email')); ?>">
                    <?php if ($errors->has('email')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('email'); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
                <div class="form-group">
                    <label for="password"><?php echo e(__('Password')); ?></label>
                    <input class="form-control <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password" type="password" required autocomplete="new-password" id="password" placeholder="<?php echo e(__('Enter Your Password')); ?>">
                    <?php if ($errors->has('password')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password'); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>
                </div>
                <div class="form-group">
                    <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
                    <input class="form-control <?php if ($errors->has('password_confirmation')) :
if (isset($message)) { $messageCache = $message; }
$message = $errors->first('password_confirmation'); ?> is-invalid <?php unset($message);
if (isset($messageCache)) { $message = $messageCache; }
endif; ?>" name="password_confirmation" type="password" required autocomplete="new-password" id="password_confirmation" placeholder="<?php echo e(__('Enter Your Password')); ?>">
                </div>

                <div class="form-group mb-0 text-center">
                    <button class="btn btn-primary btn-block" type="submit"><i class="mdi mdi-account-circle"></i> <?php echo e(__('Sign Up')); ?> </button>
                </div>

            </form>
            <!-- end form-->
        </div>
    </div>
    <!-- Footer-->
    <div class="mt-5 text-muted text-center">
        <p class="text-muted"><?php echo e(__('Already Have Account?')); ?> <a href="<?php echo e(route('login')); ?>" class="text-muted ml-1"><b><?php echo e(__('Log In')); ?></b></a></p>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\xampp\htdocs\taskly\resources\views/auth/register.blade.php ENDPATH**/ ?>