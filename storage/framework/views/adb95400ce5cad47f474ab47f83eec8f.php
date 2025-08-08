<?php $__env->startSection('content'); ?>
<div class="container py-4" style="min-height: 430px; display: flex; flex-direction: column;">
    <h2 class="mb-4">Track Your Appointments</h2>

    <div class="card mb-4">
        <div class="card-body">
            <form action="/track" method="POST">
                <?php echo csrf_field(); ?>
                <div class="row align-items-end">
                    <div class="col-md-9 mb-3">
                        <label>Enter Your Phone Number</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-primary w-100">Find Appointments</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if(isset($appointments) && $appointments->count() > 0): ?>
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Your Appointments</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time Slot</th>
                                <th>Car License</th>
                                <th>Car Engine</th>
                                <th>Assigned Mechanic</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(date('d M Y', strtotime($appointment->appointment_date))); ?></td>
                                <td><?php echo e($appointment->time_slot ?? 'Not specified'); ?></td>
                                <td><?php echo e($appointment->car_license); ?></td>
                                <td><?php echo e($appointment->car_engine); ?></td>
                                <td><?php echo e($appointment->mechanic->name); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php elseif(isset($appointments)): ?>
        <div class="alert alert-warning">
            No appointments found with this phone number.
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/md.habibunnabihemel/Desktop/gardgePoint/resources/views/track/index.blade.php ENDPATH**/ ?>