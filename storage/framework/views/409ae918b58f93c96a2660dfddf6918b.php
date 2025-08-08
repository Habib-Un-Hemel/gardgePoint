<?php $__env->startSection('content'); ?>
<div class="container mt-5" style="min-height: 410px; display: flex; flex-direction: column;">
    <h2 class="text-center mb-4">Admin Login</h2>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger"><?php echo e($errors->first()); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(url('/admin/login')); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" type="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input name="password" type="password" class="form-control" required>
        </div>

        <button class="btn btn-primary">Login</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/md.habibunnabihemel/Desktop/gardgePoint/resources/views/admin/login.blade.php ENDPATH**/ ?>