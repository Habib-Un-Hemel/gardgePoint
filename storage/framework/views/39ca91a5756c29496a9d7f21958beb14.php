<?php $__env->startSection('styles'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <h2 class="mb-4">Book an Appointment</h2>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="/book-appointment" method="POST" id="appointmentForm">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Phone Number</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <textarea name="address" class="form-control" placeholder="Enter your address" required></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Car License Number</label>
                <input type="text" name="car_license" class="form-control" placeholder="Enter car license number" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Car Engine Number</label>
                <input type="text" name="car_engine" class="form-control" placeholder="Enter car engine number" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="form-control" 
                    min="<?php echo e(date('Y-m-d')); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Select Mechanic</label>
                <select name="mechanic_id" id="mechanic_select" class="form-control" required>
                    <option value="">-- Select a Mechanic --</option>
                    <?php $__currentLoopData = $mechanics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($m->slots_left > 0): ?>
                        <option value="<?php echo e($m->id); ?>" data-slots="<?php echo e($m->slots_left); ?>" data-time-slots="<?php echo e(json_encode($m->available_slots)); ?>"><?php echo e($m->name); ?> (<?php echo e($m->slots_left); ?> slots available)</option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Select Time Slot</label>
                <select name="time_slot" id="time_slot_select" class="form-control" required disabled>
                    <option value="">-- Select a Date and Mechanic First --</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Book Appointment</button>
    </form>
</div>

<!-- Success Popup Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <i class="fa fa-check-circle text-success mb-3" style="font-size: 3rem;"></i>
                <h4 id="successMessage"><?php echo e(session('success_popup')); ?></h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Continue</button>
                <a href="/" class="btn btn-outline-secondary">Go to Home</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('appointment_date');
    const mechanicSelect = document.getElementById('mechanic_select');
    const timeSlotSelect = document.getElementById('time_slot_select');

    function updateAvailableMechanics() {
        const selectedDate = dateInput.value;
        if (!selectedDate) return;

        fetch(`/api/available-mechanics?date=${selectedDate}`)
            .then(response => response.json())
            .then(mechanics => {
                mechanicSelect.innerHTML = '<option value="">-- Select a Mechanic --</option>';
                mechanics.forEach(mechanic => {
                    if (mechanic.slots_left > 0) {
                        const option = document.createElement('option');
                        option.value = mechanic.id;
                        option.textContent = `${mechanic.name} (${mechanic.slots_left} slots available)`;
                        option.dataset.timeSlots = JSON.stringify(mechanic.available_slots);
                        mechanicSelect.appendChild(option);
                    }
                });
                if (mechanicSelect.options.length <= 1) {
                    const option = document.createElement('option');
                    option.textContent = 'No mechanics available on this date';
                    option.disabled = true;
                    mechanicSelect.appendChild(option);
                }
            });
    }

    function updateTimeSlots() {
        timeSlotSelect.innerHTML = '<option value="">-- Select a Time Slot --</option>';
        timeSlotSelect.disabled = true;
        const selectedOption = mechanicSelect.options[mechanicSelect.selectedIndex];
        if (!selectedOption || !selectedOption.value) return;
        try {
            const timeSlots = JSON.parse(selectedOption.dataset.timeSlots);
            if (timeSlots && timeSlots.length) {
                timeSlots.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot;
                    option.textContent = slot;
                    timeSlotSelect.appendChild(option);
                });
                timeSlotSelect.disabled = false;
            }
        } catch (e) {
            console.error('Error parsing time slots:', e);
        }
    }

    dateInput.addEventListener('change', updateAvailableMechanics);
    mechanicSelect.addEventListener('change', updateTimeSlots);

    if (dateInput.value) {
        updateAvailableMechanics();
    }

    <?php if(session('success_popup')): ?>
        $('#successModal').modal('show');
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/md.habibunnabihemel/Desktop/gardgePoint/resources/views/appointment/create.blade.php ENDPATH**/ ?>