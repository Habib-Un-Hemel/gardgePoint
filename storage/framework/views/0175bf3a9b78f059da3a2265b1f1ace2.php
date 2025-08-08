<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <form action="<?php echo e(route('admin.logout')); ?>" method="POST"><?php echo csrf_field(); ?>
            <button class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Tabs for better organization -->
    <ul class="nav nav-tabs mb-4" id="adminTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="appointments-tab" data-toggle="tab" data-target="#appointments" type="button" role="tab" aria-controls="appointments" aria-selected="true">Appointments</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="issues-tab" data-toggle="tab" data-target="#issues" type="button" role="tab" aria-controls="issues" aria-selected="false">User Issues</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="add-mechanic-tab" data-toggle="tab" data-target="#add-mechanic" type="button" role="tab" aria-controls="add-mechanic" aria-selected="false">Add Mechanic</button>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="add-admin-tab" data-toggle="tab" data-target="#add-admin" type="button" role="tab" aria-controls="add-admin" aria-selected="false">Add Admin</button>
        </li> -->
    </ul>

    <div class="tab-content" id="adminTabsContent">
        <!-- Appointments Tab -->
        <div class="tab-pane fade show active" id="appointments" role="tabpanel" aria-labelledby="appointments-tab">
            <h4>Appointments</h4>
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
            <?php endif; ?>
            <table class="table table-bordered mb-5">
                <thead class="table-dark">
                    <tr>
                        <th>Client</th>
                        <th>Phone</th>
                        <th>Car No.</th>
                        <th>Engine</th>
                        <th>Date</th>
                        <th>Current Time Slot</th>
                        <th>Change Time Slot</th>
                        <th>Mechanic</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $appointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <form method="POST" action="<?php echo e(url('/admin/update-appointment/' . $a->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <td><?php echo e($a->name); ?></td>
                            <td><?php echo e($a->phone); ?></td>
                            <td><?php echo e($a->car_license); ?></td>
                            <td><?php echo e($a->car_engine); ?></td>
                            <td>
                                <input type="date" name="appointment_date" class="form-control appointment-date" 
                                       data-appointment-id="<?php echo e($a->id); ?>" 
                                       value="<?php echo e($a->appointment_date); ?>">
                            </td>
                            <td>
                                <span class="badge badge-info p-2"><?php echo e($a->time_slot ?? 'Not set'); ?></span>
                            </td>
                            <td>
                                <select name="time_slot" class="form-control time-slot-select" 
                                        data-appointment-id="<?php echo e($a->id); ?>"
                                        data-mechanic-id="<?php echo e($a->mechanic_id); ?>">
                                    <option value="<?php echo e($a->time_slot ?? ''); ?>" selected><?php echo e($a->time_slot ?? 'Select time'); ?></option>
                                </select>
                            </td>
                            <td>
                                <select name="mechanic_id" class="form-control mechanic-select" 
                                        data-appointment-id="<?php echo e($a->id); ?>">
                                    <?php $__currentLoopData = $mechanics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($m->id); ?>" <?php echo e($a->mechanic_id == $m->id ? 'selected' : ''); ?>><?php echo e($m->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-success">Update</button>
                                <a href="<?php echo e(url('/admin/delete-appointment/' . $a->id)); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete appointment?')">Delete</a>
                            </td>
                        </form>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <!-- User Issues Tab -->
        <div class="tab-pane fade" id="issues" role="tabpanel" aria-labelledby="issues-tab">
            <h4>User Issues</h4>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Problem Type</th>
                        <th>Description</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $issues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $issue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($issue->user_name); ?></td>
                        <td><?php echo e($issue->phone); ?></td>
                        <td><?php echo e($issue->problem_type); ?></td>
                        <td><?php echo e($issue->problem_description); ?></td>
                        <td><?php echo e($issue->created_at->format('d M Y h:i A')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <!-- Add Mechanic Tab -->
        <div class="tab-pane fade" id="add-mechanic" role="tabpanel" aria-labelledby="add-mechanic-tab">
            <div class="row">
                <div class="col-md-6">
                    <h4>Add New Mechanic</h4>
                    <form method="POST" action="<?php echo e(url('/admin/add-mechanic')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Specialty</label>
                            <input type="text" name="specialty" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Experience (years)</label>
                            <input type="number" name="experience" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Mechanic</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h4>Current Mechanics</h4>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Specialty</th>
                                <th>Experience</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $mechanics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mechanic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($mechanic->name); ?></td>
                                <td><?php echo e($mechanic->specialty ?? 'N/A'); ?></td>
                                <td><?php echo e($mechanic->experience ?? 'N/A'); ?> years</td>
                                <td>
                                    <a href="<?php echo e(url('/admin/delete-mechanic/' . $mechanic->id)); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this mechanic?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Admin Tab -->
        <div class="tab-pane fade" id="add-admin" role="tabpanel" aria-labelledby="add-admin-tab">
            <div class="row">
                <div class="col-md-6">
                    <h4>Add New Admin</h4>
                    <form method="POST" action="<?php echo e(url('/admin/add-admin')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Admin</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h4>Current Admins</h4>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $admins ?? collect(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if($admin && is_object($admin) && isset($admin->id)): ?>
                                <tr>
                                    <td><?php echo e($admin->name ?? 'N/A'); ?></td>
                                    <td><?php echo e($admin->email ?? 'N/A'); ?></td>
                                    <td>
                                        <a href="<?php echo e(url('/admin/delete-admin/' . $admin->id)); ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Delete this admin?')">Delete</a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-center">No admins found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Available time slots from the AppointmentController
    const TIME_SLOTS = [
        '8:00 – 10:00 AM',
        '10:00 – 12:00 PM',
        '1:00 – 3:00 PM',
        '3:00 – 5:00 PM'
    ];

    // Initialize time slots for all appointments on page load
    const appointmentRows = document.querySelectorAll('[data-appointment-id]');
    appointmentRows.forEach(element => {
        const appointmentId = element.dataset.appointmentId;
        const date = document.querySelector(`.appointment-date[data-appointment-id="${appointmentId}"]`).value;
        const mechanicId = document.querySelector(`.mechanic-select[data-appointment-id="${appointmentId}"]`).value;
        if (date && mechanicId) {
            updateTimeSlots(appointmentId, mechanicId, date);
        }
    });

    // Handle appointment date change
    const dateInputs = document.querySelectorAll('.appointment-date');
    dateInputs.forEach(input => {
        input.addEventListener('change', function() {
            const appointmentId = this.dataset.appointmentId;
            const mechanicId = document.querySelector(`.mechanic-select[data-appointment-id="${appointmentId}"]`).value;
            updateTimeSlots(appointmentId, mechanicId, this.value);
        });
    });

    // Handle mechanic change
    const mechanicSelects = document.querySelectorAll('.mechanic-select');
    mechanicSelects.forEach(select => {
        select.addEventListener('change', function() {
            const appointmentId = this.dataset.appointmentId;
            const date = document.querySelector(`.appointment-date[data-appointment-id="${appointmentId}"]`).value;
            updateTimeSlots(appointmentId, this.value, date);
        });
    });

    // Function to update available time slots
    function updateTimeSlots(appointmentId, mechanicId, date) {
        if (!date || !mechanicId) return;

        const timeSlotSelect = document.querySelector(`.time-slot-select[data-appointment-id="${appointmentId}"]`);
        
        // Store the current selected time slot
        let currentSelectedSlot = timeSlotSelect.value;
        
        // Clear all options
        timeSlotSelect.innerHTML = '<option value="">Loading time slots...</option>';
        
        // Get available slots for the mechanic on this date
        fetch(`/api/available-mechanics?date=${date}`)
            .then(response => response.json())
            .then(mechanics => {
                console.log('Available mechanics data:', mechanics);
                // Find the selected mechanic
                const mechanic = mechanics.find(m => m.id == mechanicId);
                if (mechanic) {
                    console.log('Selected mechanic:', mechanic);
                    // Get all available slots
                    let slots = mechanic.available_slots || [];
                    
                    // Add the current slot if it's not in the list (to prevent losing the current assignment)
                    if (currentSelectedSlot && !slots.includes(currentSelectedSlot)) {
                        slots.push(currentSelectedSlot);
                    }
                    
                    // If no slots are available (including current), show default time slots
                    if (slots.length === 0) {
                        slots = TIME_SLOTS;
                    }
                    
                    // Clear and repopulate the select
                    timeSlotSelect.innerHTML = '';
                    
                    // Add option to select
                    const placeholderOption = document.createElement('option');
                    placeholderOption.value = '';
                    placeholderOption.textContent = 'Select a time slot';
                    timeSlotSelect.appendChild(placeholderOption);
                    
                    // Add options for each available slot
                    slots.forEach(slot => {
                        const option = document.createElement('option');
                        option.value = slot;
                        option.textContent = slot;
                        if (slot === currentSelectedSlot) {
                            option.selected = true;
                        }
                        timeSlotSelect.appendChild(option);
                    });
                } else {
                    console.error('Mechanic not found:', mechanicId);
                    // No mechanic found, show all possible time slots
                    timeSlotSelect.innerHTML = '<option value="">Select a time slot</option>';
                    TIME_SLOTS.forEach(slot => {
                        const option = document.createElement('option');
                        option.value = slot;
                        option.textContent = slot;
                        if (slot === currentSelectedSlot) {
                            option.selected = true;
                        }
                        timeSlotSelect.appendChild(option);
                    });
                }
            })
            .catch(error => {
                console.error('Error fetching time slots:', error);
                // Fallback to showing all time slots
                timeSlotSelect.innerHTML = '<option value="">-- Select a time slot --</option>';
                
                // Add all standard time slots
                TIME_SLOTS.forEach(slot => {
                    const option = document.createElement('option');
                    option.value = slot;
                    option.textContent = slot;
                    if (slot === currentSelectedSlot) {
                        option.selected = true;
                    }
                    timeSlotSelect.appendChild(option);
                });
            });
    }
});
</script>

<style>
.badge {
    font-size: 1rem;
    font-weight: normal;
    display: block;
    width: 100%;
    text-align: center;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/md.habibunnabihemel/Desktop/gardgePoint/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>